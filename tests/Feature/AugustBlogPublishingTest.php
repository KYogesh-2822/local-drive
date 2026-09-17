<?php

namespace Tests\Feature;

use App\Models\Content\BlogPost;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AugustBlogPublishingTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (! Schema::hasTable('nav_top')) {
            Schema::create('nav_top', function (Blueprint $table): void {
                $table->id();
                $table->string('heading')->nullable();
                $table->string('link')->nullable();
            });
        }

        if (! Schema::hasTable('nav_headings')) {
            Schema::create('nav_headings', function (Blueprint $table): void {
                $table->id();
                $table->string('heading')->nullable();
            });
        }

        if (! Schema::hasTable('nav_sub_headings')) {
            Schema::create('nav_sub_headings', function (Blueprint $table): void {
                $table->id();
                $table->unsignedBigInteger('nav_id')->nullable();
                $table->string('sub_heading')->nullable();
                $table->string('link')->nullable();
                $table->boolean('status')->default(true);
            });
        }
    }

    public function test_august_blogs_are_published_one_per_day_with_images_and_faqs(): void
    {
        Carbon::setTestNow('2026-09-02 07:00:00');
        $expected = [
            'jordan-travel-guide-everything-you-need-for-an-unforgettable-trip' => [
                'date' => '2026-08-29',
                'title' => 'Jordan Travel Guide: Everything You Need for an Unforgettable Trip',
            ],
            'enterprise-vs-other-car-rental-companies-in-jordan' => [
                'date' => '2026-08-30',
                'title' => 'Enterprise Vs Other Car Rental Companies In Jordan',
            ],
            'best-jordan-road-trips-10-scenic-routes-you-must-drive' => [
                'date' => '2026-08-31',
                'title' => 'Best Jordan Road Trips: 10 Scenic Routes You Must Drive',
            ],
        ];

        foreach ($expected as $slug => $details) {
            $post = BlogPost::where('slug', $slug)->with('activeFaqs')->firstOrFail();

            $this->assertSame('published', $post->status);
            $this->assertSame($details['date'], $post->published_at->toDateString());
            $this->assertSame(5, $post->activeFaqs->count());
            $this->assertFileExists(public_path($post->featured_image));
            $this->assertStringNotContainsString('Meta Title:', $post->body_html);
            $this->assertStringNotContainsString('Focus Keyword:', $post->body_html);

            $this->get('/blog/'.$slug)
                ->assertOk()
                ->assertSee($details['title'])
                ->assertSee($post->featured_image, false)
                ->assertSee('BlogPosting')
                ->assertSee('FAQPage');
        }
    }

    public function test_august_blog_archive_orders_the_articles_newest_first(): void
    {
        Carbon::setTestNow('2026-09-02 07:00:00');

        $this->get('/blog')
            ->assertOk()
            ->assertSeeInOrder([
                'Best Jordan Road Trips: 10 Scenic Routes You Must Drive',
                'Enterprise Vs Other Car Rental Companies In Jordan',
                'Jordan Travel Guide: Everything You Need for an Unforgettable Trip',
            ]);
    }

    public function test_august_migration_does_not_modify_an_existing_blog(): void
    {
        $existing = BlogPost::where('slug', 'complete-guide-to-car-rental-in-jordan-for-first-time-visitors')
            ->firstOrFail();
        $before = DB::table('blog_posts')->where('id', $existing->id)->first();
        $faqCount = DB::table('content_faqs')
            ->where('faqable_type', $existing->getMorphClass())
            ->where('faqable_id', $existing->id)
            ->count();
        $postCount = DB::table('blog_posts')->count();

        $migration = require database_path('migrations/2026_09_02_000017_publish_august_blog_posts.php');
        $migration->up();

        $after = DB::table('blog_posts')->where('id', $existing->id)->first();

        $this->assertEquals($before, $after);
        $this->assertSame($faqCount, DB::table('content_faqs')
            ->where('faqable_type', $existing->getMorphClass())
            ->where('faqable_id', $existing->id)
            ->count());
        $this->assertSame($postCount, DB::table('blog_posts')->count());
    }
}
