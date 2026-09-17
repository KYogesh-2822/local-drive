<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const PAGES = [
        'car-rental-aqaba-airport' => 'destinations',
        'car-rental-amman-airport' => 'destinations',
        'car-rental-amman' => 'rental_offices',
        'car-rental-aqaba' => 'rental_offices',
    ];

    public function up(): void
    {
        $this->swapSections();
    }

    public function down(): void
    {
        $this->swapSections();
    }

    private function swapSections(): void
    {
        if (! Schema::hasTable('content_pages') || ! Schema::hasTable('content_page_sections')) {
            return;
        }

        foreach (self::PAGES as $slug => $highlightsKey) {
            $pageId = DB::table('content_pages')->where('slug', $slug)->value('id');

            if (! $pageId) {
                continue;
            }

            $sections = DB::table('content_page_sections')
                ->where('content_page_id', $pageId)
                ->whereIn('section_key', [$highlightsKey, 'rental_requirements'])
                ->get(['id', 'section_key', 'sort_order'])
                ->keyBy('section_key');

            $highlights = $sections->get($highlightsKey);
            $requirements = $sections->get('rental_requirements');

            if (! $highlights || ! $requirements) {
                continue;
            }

            DB::table('content_page_sections')->where('id', $requirements->id)->update([
                'sort_order' => $highlights->sort_order,
                'updated_at' => now(),
            ]);

            DB::table('content_page_sections')->where('id', $highlights->id)->update([
                'sort_order' => $requirements->sort_order,
                'updated_at' => now(),
            ]);
        }
    }
};
