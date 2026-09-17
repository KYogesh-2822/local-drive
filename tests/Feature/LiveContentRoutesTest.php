<?php

namespace Tests\Feature;

use Tests\TestCase;

class LiveContentRoutesTest extends TestCase
{
    public function test_approved_pages_use_their_final_urls_when_managed_pages_are_live(): void
    {
        if (! config('content.managed_pages_live')) {
            $this->markTestSkipped('This test runs with CONTENT_MANAGED_PAGES_LIVE=true.');
        }

        $this->assertTrue(config('content.managed_pages_live'));

        $this->get('/')
            ->assertOk()
            ->assertSee('Best Car Rental in Jordan');

        $pages = [
            'car-rental-aqaba-airport' => 'Car Rental at Aqaba Airport',
            'car-rental-amman-airport' => 'Car Rental at Amman Airport',
            'car-rental-amman' => 'Car Hire in Amman',
            'car-rental-aqaba' => 'Car Rental in Aqaba',
        ];

        foreach ($pages as $slug => $heading) {
            $this->get('/'.$slug)
                ->assertOk()
                ->assertSee($heading)
                ->assertDontSee('noindex, nofollow');

            $this->get('/new-'.$slug)
                ->assertRedirect('/'.$slug)
                ->assertStatus(301);

            $this->get('/locations/'.$slug)
                ->assertRedirect('/'.$slug)
                ->assertStatus(301);
        }

        $this->get('/new-home')
            ->assertRedirect('/')
            ->assertStatus(301);
    }
}
