<?php

namespace Tests\Feature;

use App\Models\Content\ContentPage;
use Tests\TestCase;

class SafetyItemAdminFieldsTest extends TestCase
{
    public function test_safety_item_forms_show_only_the_fields_used_by_the_checklist(): void
    {
        $this->withoutMiddleware([
            \App\Http\Middleware\Authenticate::class,
            \App\Http\Middleware\AdminMiddleware::class,
        ]);

        $page = ContentPage::where('slug', 'home')->firstOrFail();
        $section = $page->sections()->where('section_key', 'safety')->firstOrFail();
        $html = $this->get('/admin/content/pages/home/edit')->assertOk()->getContent();

        $start = strpos($html, 'id="section'.$section->id.'"');
        $this->assertNotFalse($start);

        $end = strpos($html, '<div class="accordion-item', $start + 1);
        $safetyPanel = substr($html, $start, $end === false ? null : $end - $start);

        $this->assertStringNotContainsString('[body]', $safetyPanel);
        $this->assertStringNotContainsString('[button_label]', $safetyPanel);
        $this->assertStringNotContainsString('[button_url]', $safetyPanel);
        $this->assertStringNotContainsString('[image]', $safetyPanel);
        $this->assertStringNotContainsString('[image_alt]', $safetyPanel);
        $this->assertStringContainsString('[title]', $safetyPanel);
        $this->assertStringContainsString('[sort_order]', $safetyPanel);
        $this->assertStringContainsString('[is_enabled]', $safetyPanel);
        $this->assertStringContainsString('Save Section and Items', $safetyPanel);
    }
}
