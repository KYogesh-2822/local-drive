<?php

namespace Tests\Feature;

use App\Models\Content\ContentPage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HomeJourneySectionsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_staged_homepage_uses_the_booking_and_destination_designs(): void
    {
        $this->get('/new-home')
            ->assertOk()
            ->assertSee('Simple steps to secure your vehicle in minutes')
            ->assertSee('<div class="step-badge">1</div>', false)
            ->assertSee('<div class="step-badge">4</div>', false)
            ->assertSee('Select Vehicle')
            ->assertSee('Collect &amp; Drive', false)
            ->assertSee('Design your itinerary and explore at your own pace')
            ->assertSee('<div class="destination-card">', false)
            ->assertSee('Petra')
            ->assertSee('The Dead Sea')
            ->assertSee('Wadi Rum')
            ->assertSee('Jerash');
    }

    public function test_booking_and_destination_content_comes_from_managed_items(): void
    {
        $page = ContentPage::where('slug', 'home')->firstOrFail();

        $page->sections()->where('section_key', 'booking_process')->firstOrFail()
            ->items()->orderBy('sort_order')->firstOrFail()
            ->update(['title' => 'Administrator-managed booking step']);

        $page->sections()->where('section_key', 'destinations')->firstOrFail()
            ->items()->orderBy('sort_order')->firstOrFail()
            ->update(['title' => 'Administrator-managed destination']);

        $this->get('/new-home')
            ->assertOk()
            ->assertSee('Administrator-managed booking step')
            ->assertSee('Administrator-managed destination');
    }
}
