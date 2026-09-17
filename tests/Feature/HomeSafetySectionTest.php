<?php

namespace Tests\Feature;

use App\Models\Content\ContentPage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HomeSafetySectionTest extends TestCase
{
    use DatabaseTransactions;

    public function test_staged_homepage_uses_the_dynamic_safety_checklist_design(): void
    {
        $this->get('/new-home')
            ->assertOk()
            ->assertSee('<section class="fleet-section">', false)
            ->assertSee('<ul class="safety-list">', false)
            ->assertSee('Safety &amp; Maintenance Standards', false)
            ->assertSee('Rigorous inspections ensure your safety on every journey')
            ->assertSee('Regular servicing and mechanical inspections before every rental')
            ->assertSee('Thorough cleaning and sanitisation for every vehicle')
            ->assertSee('Brake, tyre, and engine performance checks for optimal safety')
            ->assertSee('Continuous fleet monitoring to ensure road readiness and reliability')
            ->assertSee('Replacement of vehicles that do not meet our safety standards');
    }

    public function test_safety_checklist_text_is_loaded_from_the_managed_section_items(): void
    {
        $page = ContentPage::where('slug', 'home')->firstOrFail();
        $section = $page->sections()->where('section_key', 'safety')->firstOrFail();
        $item = $section->items()->orderBy('sort_order')->firstOrFail();
        $item->update(['title' => 'Administrator-managed safety standard']);

        $this->get('/new-home')
            ->assertOk()
            ->assertSee('Administrator-managed safety standard');
    }
}
