<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContentManagementTest extends TestCase
{
    public function test_legacy_homepage_remains_on_the_root_route_while_pages_are_staged(): void
    {
        $this->assertFalse(config('content.managed_pages_live'));

        $this->get('/')
            ->assertOk()
            ->assertSee('Reserve a Vehicle')
            ->assertDontSee('Best Car Rental in Jordan for Airport and City Travel');
    }

    public function test_managed_pages_are_available_on_public_review_urls(): void
    {
        $pages = [
            '/new-home' => 'Best Car Rental in Jordan',
            '/new-car-rental-aqaba-airport' => 'Car Rental at Aqaba Airport',
            '/new-car-rental-amman-airport' => 'Car Rental at Amman Airport',
            '/new-car-rental-amman' => 'Car Hire in Amman',
            '/new-car-rental-aqaba' => 'Car Rental in Aqaba',
        ];

        foreach ($pages as $url => $heading) {
            $this->get($url)
                ->assertOk()
                ->assertSee($heading)
                ->assertSee('name="robots" content="noindex, nofollow"', false)
                ->assertSee('FAQPage');
        }

        $this->get('/locations/car-rental-amman')->assertNotFound();
    }

    public function test_blog_listing_and_seeded_articles_are_available(): void
    {
        $this->get('/blog')
            ->assertOk()
            ->assertSee('Jordan Driving and Car Rental Guides');

        $this->get('/blog/complete-guide-to-car-rental-in-jordan-for-first-time-visitors')
            ->assertOk()
            ->assertSee('Complete Guide to Car Rental in Jordan')
            ->assertSee('BlogPosting');
    }

    public function test_content_admin_requires_authentication(): void
    {
        $this->get('/admin/content/pages')->assertRedirect('/login');
        $this->get('/admin/content/faqs')->assertRedirect('/login');
        $this->get('/admin/content/blogs')->assertRedirect('/login');
    }

    public function test_dynamic_sitemap_hides_unapproved_managed_pages(): void
    {
        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml')
            ->assertDontSee('/locations/car-rental-amman', false)
            ->assertSee('/blog/family-car-rental-in-jordan-best-vehicles-for-your-trip', false);
    }
}
