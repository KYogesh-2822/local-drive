<?php

namespace Tests\Feature;

use App\Models\Content\ContentPage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LocationPageSectionDesignTest extends TestCase
{
    use DatabaseTransactions;

    public function test_all_location_pages_use_the_approved_homepage_section_designs(): void
    {
        $pages = [
            '/new-car-rental-aqaba-airport' => 'Explore Aqaba and Surroundings with Ease',
            '/new-car-rental-amman-airport' => 'Explore Amman and Beyond with Confidence',
            '/new-car-rental-amman' => 'Our Car Rental Offices in Amman',
            '/new-car-rental-aqaba' => 'Our Car Rental Offices in Aqaba',
        ];

        foreach ($pages as $url => $highlightsHeading) {
            $slug = str_replace('/new-', '', $url);
            $requirementsHeading = ContentPage::where('slug', $slug)
                ->firstOrFail()
                ->sections()
                ->where('section_key', 'rental_requirements')
                ->value('heading');

            $response = $this->get($url)
                ->assertOk()
                ->assertSee('href="/contact"', false)
                ->assertSee('Contact Us')
                ->assertSee('Choose the Right Car for Your Trip')
                ->assertSee('<div class="fleet-card">', false)
                ->assertSee($highlightsHeading)
                ->assertSeeInOrder([$requirementsHeading, $highlightsHeading])
                ->assertSee('<ul class="safety-list">', false)
                ->assertSee('Simple Booking Process')
                ->assertSee('<div class="process-item text-center">', false)
                ->assertSee('<div class="step-badge">1</div>', false);

            $this->assertSame(5, substr_count($response->getContent(), '<div class="fleet-card">'));
            $this->assertSame(4, substr_count($response->getContent(), '<div class="process-item text-center">'));
        }
    }

    public function test_location_designs_and_introduction_buttons_are_admin_managed(): void
    {
        $pages = [
            'car-rental-aqaba-airport' => 'destinations',
            'car-rental-amman-airport' => 'destinations',
            'car-rental-amman' => 'rental_offices',
            'car-rental-aqaba' => 'rental_offices',
        ];

        foreach ($pages as $slug => $highlightsKey) {
            $page = ContentPage::where('slug', $slug)->firstOrFail();

            $this->assertSame('fleet-cards', $page->sections()->where('section_key', 'fleet')->value('layout'));
            $this->assertSame('safety-list', $page->sections()->where('section_key', $highlightsKey)->value('layout'));
            $this->assertSame('booking-process', $page->sections()->where('section_key', 'booking_process')->value('layout'));

            $introduction = $page->sections()->where('section_key', 'introduction')->firstOrFail();
            $this->assertSame('Contact Us', data_get($introduction->settings, 'button_label'));
            $this->assertSame('/contact', data_get($introduction->settings, 'button_url'));
        }
    }
}
