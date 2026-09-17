<?php

namespace Tests\Unit;

use App\Models\Content\BlogPost;
use App\Services\Content\BlogPublicationScheduler;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class BlogPublicationSchedulerTest extends TestCase
{
    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_today_publishes_immediately_without_requiring_a_time(): void
    {
        Carbon::setTestNow('2026-08-31 22:30:00 UTC');

        $publishedAt = app(BlogPublicationScheduler::class)->resolve(
            '2026-09-01',
            'published'
        );

        $this->assertSame('2026-08-31 22:30:00', $publishedAt->utc()->format('Y-m-d H:i:s'));
        $this->assertSame(
            '2026-09-01',
            $publishedAt->timezone('Asia/Amman')->toDateString()
        );
    }

    public function test_future_date_is_scheduled_for_the_start_of_that_day_in_jordan(): void
    {
        Carbon::setTestNow('2026-09-01 08:30:00 UTC');

        $publishedAt = app(BlogPublicationScheduler::class)->resolve(
            '2026-09-05',
            'published'
        );

        $this->assertSame('2026-09-04 21:00:00', $publishedAt->utc()->format('Y-m-d H:i:s'));
        $this->assertSame(
            '2026-09-05 00:00:00',
            $publishedAt->timezone('Asia/Amman')->format('Y-m-d H:i:s')
        );
    }

    public function test_old_future_time_on_today_is_replaced_with_the_current_time(): void
    {
        Carbon::setTestNow('2026-09-01 08:30:00 UTC');
        $post = new BlogPost([
            'status' => 'published',
            'published_at' => '2026-09-01 14:00:00',
        ]);

        $publishedAt = app(BlogPublicationScheduler::class)->resolve(
            '2026-09-01',
            'published',
            $post
        );

        $this->assertSame('2026-09-01 08:30:00', $publishedAt->utc()->format('Y-m-d H:i:s'));
    }
}
