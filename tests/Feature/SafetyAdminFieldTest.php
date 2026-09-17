<?php

namespace Tests\Feature;

use App\Models\Content\ContentPage;
use Tests\TestCase;

class SafetyAdminFieldTest extends TestCase
{
    public function test_safety_admin_panel_omits_the_unused_section_content_editor(): void
    {
        $this->withoutMiddleware([
            \App\Http\Middleware\Authenticate::class,
            \App\Http\Middleware\AdminMiddleware::class,
        ]);

        $page = ContentPage::where('slug', 'home')->firstOrFail();
        $section = $page->sections()->where('section_key', 'safety')->firstOrFail();
        $html = $this->get('/admin/content/pages/home/edit')->assertOk()->getContent();
        $start = strpos($html, 'id="section'.$section->id.'"');
        $end = strpos($html, '<div class="accordion-item', $start + 1);
        $safetyPanel = substr($html, $start, $end === false ? null : $end - $start);

        $this->assertStringNotContainsString('name="body_html"', $safetyPanel);
        $this->assertStringNotContainsString('name="after_content"', $safetyPanel);
        $this->assertStringContainsString('Safety &amp; Maintenance Standards', $safetyPanel);
        $this->assertStringContainsString('Regular servicing and mechanical inspections before every rental', $safetyPanel);
    }
}
