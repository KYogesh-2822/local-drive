<?php

namespace Tests\Feature;

use App\Models\Content\ContentPage;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class IntroductionSectionButtonTest extends TestCase
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
            'email' => 'content-admin@example.test',
            'role' => 0,
        ]));
    }

    public function test_introduction_admin_has_button_fields_without_repeatable_items(): void
    {
        $page = ContentPage::where('slug', 'home')->firstOrFail();
        $section = $page->sections()->where('section_key', 'introduction')->firstOrFail();
        $html = $this->get('/admin/content/pages/home/edit')->assertOk()->getContent();

        $start = strpos($html, 'id="section'.$section->id.'"');
        $this->assertNotFalse($start);

        $end = strpos($html, '<div class="accordion-item', $start + 1);
        $introductionPanel = substr($html, $start, $end === false ? null : $end - $start);

        $this->assertStringContainsString('name="button_label"', $introductionPanel);
        $this->assertStringContainsString('name="button_url"', $introductionPanel);
        $this->assertStringNotContainsString('Add section item', $introductionPanel);
        $this->assertStringNotContainsString('section-items', $introductionPanel);
    }

    public function test_admin_can_update_the_introduction_contact_button(): void
    {
        $page = ContentPage::where('slug', 'home')->firstOrFail();
        $section = $page->sections()->where('section_key', 'introduction')->firstOrFail();

        $this->put("/admin/content/pages/home/sections/{$section->id}", [
            'heading' => $section->heading,
            'subheading' => $section->subheading,
            'body_html' => $section->body_html,
            'button_label' => 'Contact Our Team',
            'button_url' => 'contact',
            'is_enabled' => 1,
        ])->assertRedirect();

        $section->refresh();
        $this->assertSame('Contact Our Team', $section->settings['button_label']);
        $this->assertSame('/contact', $section->settings['button_url']);

        $this->get('/new-home')
            ->assertOk()
            ->assertSee('Contact Our Team')
            ->assertSee('href="/contact"', false);
    }
}
