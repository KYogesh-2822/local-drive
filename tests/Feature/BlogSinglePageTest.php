<?php

namespace Tests\Feature;

use Tests\TestCase;

class BlogSinglePageTest extends TestCase
{
    public function test_published_blog_uses_the_article_layout_and_dynamic_sidebar(): void
    {
        $this->get('/blog/complete-guide-to-car-rental-in-jordan-for-first-time-visitors')
            ->assertOk()
            ->assertSee('blog-single__layout', false)
            ->assertSee('Complete Guide to Car Rental in Jordan for First-Time Visitors')
            ->assertSee('Browse by topic')
            ->assertSee('Recent articles')
            ->assertSee('Start a Reservation')
            ->assertSee('More Jordan travel guides')
            ->assertSee('BlogPosting');
    }

    public function test_unpublished_blog_cannot_be_viewed(): void
    {
        $this->get('/blog/future-car-rental-guide')->assertNotFound();
    }
}
