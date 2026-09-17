<?php

namespace Tests\Feature;

use App\Models\Content\ContentPage;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ManagedHomepagePerformanceTest extends TestCase
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

    public function test_managed_homepage_uses_and_preloads_the_optimized_hero(): void
    {
        $page = ContentPage::where('slug', 'home')->firstOrFail();
        $page->update(['hero_image' => 'images/home-banner.jpg']);

        $this->get('/')
            ->assertOk()
            ->assertSee('rel="preload" as="image"', false)
            ->assertSee('images/home-banner.webp', false)
            ->assertSee('fetchpriority="high"', false)
            ->assertSee('DIN2014-Regular.woff2', false)
            ->assertSee('DIN2014-Bold.woff2', false);
    }
}
