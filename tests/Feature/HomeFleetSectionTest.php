<?php

namespace Tests\Feature;

use App\Models\Content\ContentPage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HomeFleetSectionTest extends TestCase
{
    use DatabaseTransactions;

    public function test_staged_homepage_uses_the_dynamic_fleet_card_design(): void
    {
        $response = $this->get('/new-home')
            ->assertOk()
            ->assertSee('Meet the Fleet')
            ->assertSee("From SUVs to compact cars, we&#039;ve got your perfect ride", false)
            ->assertSee('<div class="fleet-card">', false)
            ->assertSee('Mini')
            ->assertSee('Economy')
            ->assertSee('Compact')
            ->assertSee('Intermediate')
            ->assertSee('Standard')
            ->assertSee('/vehicles/', false)
            ->assertSee('View All Vehicles')
            ->assertSee('href="/all-vechicles"', false);

        $this->assertSame(5, substr_count($response->getContent(), '<div class="fleet-card">'));
    }

    public function test_fleet_card_content_is_loaded_from_the_managed_items(): void
    {
        $page = ContentPage::where('slug', 'home')->firstOrFail();
        $section = $page->sections()->where('section_key', 'fleet')->firstOrFail();
        $item = $section->items()->orderBy('sort_order')->firstOrFail();
        $item->update(['title' => 'Administrator-managed vehicle']);

        $this->get('/new-home')
            ->assertOk()
            ->assertSee('Administrator-managed vehicle');
    }
}
