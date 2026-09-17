<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $items = [
        'Regular servicing and mechanical inspections before every rental',
        'Thorough cleaning and sanitisation for every vehicle',
        'Brake, tyre, and engine performance checks for optimal safety',
        'Continuous fleet monitoring to ensure road readiness and reliability',
        'Replacement of vehicles that do not meet our safety standards',
    ];

    public function up(): void
    {
        if (! Schema::hasTable('content_pages') ||
            ! Schema::hasTable('content_page_sections') ||
            ! Schema::hasTable('content_section_items')) {
            return;
        }

        $pageId = DB::table('content_pages')->where('slug', 'home')->value('id');

        if (! $pageId) {
            return;
        }

        $sectionId = DB::table('content_page_sections')
            ->where('content_page_id', $pageId)
            ->where('section_key', 'safety')
            ->value('id');

        if (! $sectionId) {
            return;
        }

        $timestamp = now();

        DB::table('content_page_sections')->where('id', $sectionId)->update([
            'heading' => 'Safety & Maintenance Standards',
            'subheading' => 'Rigorous inspections ensure your safety on every journey',
            'body_html' => null,
            'layout' => 'safety-list',
            'updated_at' => $timestamp,
        ]);

        foreach ($this->items as $sortOrder => $title) {
            DB::table('content_section_items')->updateOrInsert(
                [
                    'content_page_section_id' => $sectionId,
                    'sort_order' => $sortOrder,
                ],
                [
                    'title' => $title,
                    'subtitle' => null,
                    'body' => null,
                    'image' => null,
                    'image_alt' => null,
                    'button_label' => null,
                    'button_url' => null,
                    'additional_data' => null,
                    'is_enabled' => true,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]
            );
        }

        DB::table('content_section_items')
            ->where('content_page_section_id', $sectionId)
            ->whereNotIn('sort_order', array_keys($this->items))
            ->update(['is_enabled' => false, 'updated_at' => $timestamp]);
    }

    public function down(): void
    {
        $pageId = DB::table('content_pages')->where('slug', 'home')->value('id');

        if (! $pageId) {
            return;
        }

        $sectionId = DB::table('content_page_sections')
            ->where('content_page_id', $pageId)
            ->where('section_key', 'safety')
            ->value('id');

        if (! $sectionId) {
            return;
        }

        DB::table('content_page_sections')->where('id', $sectionId)->update([
            'heading' => 'Safety and Maintenance Standards',
            'subheading' => null,
            'body_html' => '<p>Every rental vehicle is inspected and maintained to support a safe, clean and dependable driving experience for business, leisure and long-distance travel.</p>',
            'layout' => null,
            'updated_at' => now(),
        ]);

        DB::table('content_section_items')
            ->where('content_page_section_id', $sectionId)
            ->whereIn('sort_order', [3, 4])
            ->update(['is_enabled' => false, 'updated_at' => now()]);
    }
};
