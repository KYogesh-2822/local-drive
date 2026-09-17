<?php

namespace Tests\Feature;

use App\Models\Content\ContentPage;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LocationSectionContentTest extends TestCase
{
    use DatabaseTransactions;

    public function test_location_highlights_and_requirements_render_admin_managed_content_areas(): void
    {
        $pages = [
            '/new-car-rental-aqaba-airport' => 'Aqaba airport car rental',
            '/new-car-rental-amman-airport' => 'Amman airport car rental',
            '/new-car-rental-amman' => 'car rental in Amman',
            '/new-car-rental-aqaba' => 'car rental in Aqaba',
        ];

        foreach ($pages as $url => $rentalPhrase) {
            $this->get($url)
                ->assertOk()
                ->assertSee('With your own vehicle, visiting multiple attractions in one trip becomes simple and convenient.')
                ->assertSee('Many travellers who choose '.$rentalPhrase)
                ->assertSee('location-section-content--before', false)
                ->assertSee('location-section-content--after', false);
        }
    }

    public function test_admin_can_update_the_location_highlights_content(): void
    {
        $this->withoutMiddleware([
            \App\Http\Middleware\Authenticate::class,
            \App\Http\Middleware\AdminMiddleware::class,
        ]);

        $this->actingAs(new User([
            'name' => 'Content administrator',
            'email' => 'location-content@example.test',
            'role' => 0,
        ]));

        $page = ContentPage::where('slug', 'car-rental-aqaba-airport')->firstOrFail();
        $section = $page->sections()->where('section_key', 'destinations')->firstOrFail();

        $this->put("/admin/content/pages/{$page->slug}/sections/{$section->id}", [
            'heading' => $section->heading,
            'subheading' => $section->subheading,
            'body_html' => '<p>Administrator-managed destination content.</p>',
            'is_enabled' => 1,
        ])->assertRedirect();

        $this->get('/new-car-rental-aqaba-airport')
            ->assertOk()
            ->assertSee('Administrator-managed destination content.');
    }

    public function test_all_location_requirements_use_the_configured_card_layout(): void
    {
        foreach (array_keys(config('content.system_pages')) as $slug) {
            if ($slug === 'home') {
                continue;
            }

            $page = ContentPage::where('slug', $slug)->firstOrFail();

            $this->assertSame(
                'destination-grid',
                $page->sections()->where('section_key', 'rental_requirements')->value('layout')
            );
        }
    }
}
