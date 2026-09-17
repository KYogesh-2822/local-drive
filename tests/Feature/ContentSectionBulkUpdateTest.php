<?php

namespace Tests\Feature;

use App\Models\Content\ContentPage;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ContentSectionBulkUpdateTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware([
            \App\Http\Middleware\Authenticate::class,
            \App\Http\Middleware\AdminMiddleware::class,
        ]);

        $this->actingAs(new User([
            'name' => 'Content administrator',
            'email' => 'section-content@example.test',
            'role' => 0,
        ]));
    }

    public function test_admin_editor_has_one_combined_save_at_the_end_of_each_section(): void
    {
        $page = ContentPage::where('slug', 'car-rental-aqaba-airport')->firstOrFail();
        $response = $this->get('/admin/content/pages/car-rental-aqaba-airport/edit')
            ->assertOk()
            ->assertSee('Content before cards/list (optional)')
            ->assertSee('Content after cards/list (optional)')
            ->assertSee('Save Section and Items')
            ->assertDontSee('Save All Sections')
            ->assertDontSee('position-sticky', false)
            ->assertDontSee('>Update Item<', false);

        $this->assertSame(
            $page->sections()->count(),
            substr_count($response->getContent(), 'Save Section and Items')
        );
    }

    public function test_one_section_save_updates_content_existing_cards_and_a_new_card(): void
    {
        $page = ContentPage::where('slug', 'car-rental-aqaba-airport')->firstOrFail();
        $section = $page->sections()->where('section_key', 'rental_requirements')->firstOrFail();
        $item = $section->items()->orderBy('sort_order')->firstOrFail();

        $this->put("/admin/content/pages/{$page->slug}/sections/{$section->id}", [
            'heading' => $section->heading,
            'subheading' => '',
            'body_html' => '<p>Updated content before requirement cards.</p>',
            'after_content' => '<p>Updated content after requirement cards.</p>',
            'is_enabled' => 1,
            'items' => [
                $item->id => [
                    'title' => 'Updated licence requirement',
                    'subtitle' => 'Bring the original document.',
                    'body' => '',
                    'sort_order' => 0,
                    'is_enabled' => 1,
                ],
            ],
            'new_items' => [[
                'title' => 'Additional requirement',
                'subtitle' => 'This optional subtitle is admin managed.',
                'body' => '',
                'sort_order' => 3,
                'is_enabled' => 1,
            ]],
        ])->assertRedirect()->assertSessionHas('message');

        $section->refresh();
        $item->refresh();

        $this->assertSame('<p>Updated content before requirement cards.</p>', $section->body_html);
        $this->assertSame('<p>Updated content after requirement cards.</p>', data_get($section->settings, 'after_content'));
        $this->assertSame('Updated licence requirement', $item->title);
        $this->assertSame('Bring the original document.', $item->subtitle);
        $this->assertDatabaseHas('content_section_items', [
            'content_page_section_id' => $section->id,
            'title' => 'Additional requirement',
            'subtitle' => 'This optional subtitle is admin managed.',
        ]);

        $this->get('/new-car-rental-aqaba-airport')
            ->assertOk()
            ->assertSee('Updated content before requirement cards.')
            ->assertSee('Updated licence requirement')
            ->assertSee('Bring the original document.')
            ->assertSee('Additional requirement')
            ->assertSee('Updated content after requirement cards.');
    }

    public function test_aqaba_airport_requirements_use_three_left_aligned_cards(): void
    {
        $page = ContentPage::where('slug', 'car-rental-aqaba-airport')->firstOrFail();
        $this->assertSame('destination-grid', $page->sections()->where('section_key', 'rental_requirements')->value('layout'));

        $html = $this->get('/new-car-rental-aqaba-airport')
            ->assertOk()
            ->assertSee('Need to Rent a Car at Aqaba Airport, Jordan')
            ->assertSee('A valid driving licence')
            ->assertSee('A valid passport')
            ->assertSee('Minimum age requirement of around 25 years')
            ->assertSee('Road conditions in Aqaba are well-maintained')
            ->getContent();

        $start = strpos($html, 'Need to Rent a Car at Aqaba Airport, Jordan');
        $end = strpos($html, 'Explore Aqaba and Surroundings with Ease', $start);
        $requirementsHtml = substr($html, $start, $end - $start);

        $this->assertSame(3, substr_count($requirementsHtml, '<div class="destination-card">'));
        $this->assertStringContainsString('row justify-content-start', $requirementsHtml);
    }
}
