<?php

namespace Tests\Feature;

use App\Models\Content\BlogPost;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class JulyBlogPublishingTest extends TestCase
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
    public function test_july_blogs_are_published_one_per_day_with_images_and_faqs(): void
    {
        Carbon::setTestNow('2026-07-31 07:00:00');
        $expected = [
            'common-airport-car-rental-mistakes-and-how-to-avoid-them' => [
                'date' => '2026-07-29',
                'title' => 'Common Airport Car Rental Mistakes and How to Avoid Them',
            ],
            'rental-car-guide-suv-vs-sedan-for-travel-in-jordan' => [
                'date' => '2026-07-30',
                'title' => 'SUV vs Sedan: Which Rental Car is Best for Jordan?',
            ],
            'car-hire-guide-private-driver-tips-for-travel-in-jordan' => [
                'date' => '2026-07-31',
                'title' => 'Hiring a Private Driver in Jordan: Costs, Benefits & Expert Tips',
            ],
        ];

        foreach ($expected as $slug => $details) {
            $post = BlogPost::where('slug', $slug)->with('activeFaqs')->firstOrFail();

            $this->assertSame('published', $post->status);
            $this->assertSame($details['date'], $post->published_at->toDateString());
            $this->assertSame(5, $post->activeFaqs->count());
            $this->assertFileExists(public_path($post->featured_image));
            $this->assertStringNotContainsString('continue with the full blog', $post->body_html);

            $this->get('/blog/'.$slug)
                ->assertOk()
                ->assertSee($details['title'])
                ->assertSee($post->featured_image, false)
                ->assertSee('BlogPosting')
                ->assertSee('FAQPage');
        }
    }

    public function test_july_blog_schedule_releases_one_article_per_day(): void
    {
        $slugs = [
            'common-airport-car-rental-mistakes-and-how-to-avoid-them',
            'rental-car-guide-suv-vs-sedan-for-travel-in-jordan',
            'car-hire-guide-private-driver-tips-for-travel-in-jordan',
        ];

        foreach ([
            '2026-07-29 07:00:00' => 1,
            '2026-07-30 07:00:00' => 2,
            '2026-07-31 07:00:00' => 3,
        ] as $now => $expectedCount) {
            Carbon::setTestNow($now);

            $this->assertSame(
                $expectedCount,
                BlogPost::published()->whereIn('slug', $slugs)->count()
            );
        }
    }
    public function test_july_blog_archive_orders_the_three_articles_newest_first(): void
    {
        Carbon::setTestNow('2026-07-31 07:00:00');
        $this->get('/blog')
            ->assertOk()
            ->assertSeeInOrder([
                'Hiring a Private Driver in Jordan: Costs, Benefits &amp; Expert Tips',
                'SUV vs Sedan: Which Rental Car is Best for Jordan?',
                'Common Airport Car Rental Mistakes and How to Avoid Them',
            ], false);
    }
}
