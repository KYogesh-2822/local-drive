<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SiteAuditRemediationTest extends TestCase
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

    public function test_blog_has_one_h1_and_a_sufficient_meta_description(): void
    {
        $response = $this->get('/blog/complete-guide-to-car-rental-in-jordan-for-first-time-visitors')
            ->assertOk();
        $html = $response->getContent();

        $this->assertSame(1, preg_match_all('/<h1\b/i', $html));
        $this->assertStringContainsString(
            'Explore practical Jordan driving, car rental and road-trip guides from Enterprise, with expert advice on routes, vehicles, airports and travel planning.',
            $this->get('/blog')->assertOk()->getContent()
        );
    }

    public function test_shared_assets_are_deferred_and_inline_layout_css_is_removed(): void
    {
        $html = $this->get('/blog')->assertOk()->getContent();

        foreach ([
            'bundle.min.js',
            'ProjectName.js',
            'language.js',
            'developer.js',
            'reservation.js',
            'site-runtime.js',
        ] as $script) {
            $this->assertMatchesRegularExpression(
                '/<script defer src="[^"]*'.preg_quote($script, '/').'"/',
                $html
            );
        }

        $this->assertStringNotContainsString('<style type="text/css">', $html);
        $this->assertStringNotContainsString('widget-cdn.partnerbookingkit.com', $html);
    }

    public function test_booking_widget_script_is_guarded_and_normalizes_its_loading_heading(): void
    {
        $script = file_get_contents(public_path('js/reservation.js'));

        $this->assertStringContainsString("document.querySelector('#pbk-widget')", $script);
        $this->assertStringContainsString("h1.enterprise-pbk-loading-text", $script);
        $this->assertStringContainsString("document.createElement('div')", $script);
    }

    public function test_career_form_has_a_real_h1_and_lazy_country_selector(): void
    {
        $html = $this->get('/career-form')->assertOk()->getContent();

        $this->assertSame(1, preg_match_all('/<h1\b/i', $html));
        $this->assertStringContainsString("one('focus'", $html);
    }
}
