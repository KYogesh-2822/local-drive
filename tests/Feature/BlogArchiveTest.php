<?php

namespace Tests\Feature;

use App\Models\Content\BlogCategory;
use App\Models\Content\BlogPost;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BlogArchiveTest extends TestCase
{
    use DatabaseTransactions;
    public function test_blog_archive_displays_all_published_articles_in_the_existing_site_layout(): void
    {
        $this->get('/blog')
            ->assertOk()
            ->assertSee('Jordan Driving and Car Rental Guides')
            ->assertSee('Explore all articles')
            ->assertSee('Browse by topic')
            ->assertSee('Recent articles')
            ->assertSee('Read More')
            ->assertDontSee('blog-card__image-link')
            ->assertDontSee('<h3><a', false)
            ->assertSee('Complete Guide to Car Rental in Jordan for First-Time Visitors')
            ->assertSee('Is Renting a Car in Jordan Worth It Compared to Public Transport?')
            ->assertSee('Family Car Rental in Jordan: Best Vehicles for Your Trip');
    }

    public function test_blog_archive_can_be_filtered_by_an_active_category(): void
    {
        $this->get('/blog?category=travel-guides')
            ->assertOk()
            ->assertSee('Travel Guides')
            ->assertSee('Complete Guide to Car Rental in Jordan for First-Time Visitors');

        $this->get('/blog?category=not-a-real-category')->assertNotFound();
    }
    public function test_blog_archive_shows_ten_posts_per_page_with_latest_first(): void
    {
        $category = BlogCategory::create([
            'name' => 'Pagination Test',
            'slug' => 'pagination-test',
            'is_active' => true,
        ]);

        foreach (range(1, 11) as $number) {
            BlogPost::create([
                'blog_category_id' => $category->id,
                'title' => "Pagination Article {$number}",
                'slug' => "pagination-article-{$number}",
                'excerpt' => "Pagination excerpt {$number}",
                'body_html' => '<p>Pagination test article.</p>',
                'status' => 'published',
                'published_at' => now()->subMinutes($number),
            ]);
        }

        $this->get('/blog?category=pagination-test')
            ->assertOk()
            ->assertSeeInOrder(['Pagination Article 1', 'Pagination Article 10'])
            ->assertDontSee('Pagination Article 11');

        $this->get('/blog?category=pagination-test&page=2')
            ->assertOk()
            ->assertSee('Pagination Article 11');
    }
}
