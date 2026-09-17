<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const PAGE_SLUGS = [
        'car-rental-aqaba-airport',
        'car-rental-amman-airport',
        'car-rental-amman',
        'car-rental-aqaba',
    ];

    public function up(): void
    {
        $this->setLayout('destination-grid');
    }

    public function down(): void
    {
        $this->setLayout('safety-list');
    }

    private function setLayout(string $layout): void
    {
        if (! Schema::hasTable('content_pages') || ! Schema::hasTable('content_page_sections')) {
            return;
        }

        $pageIds = DB::table('content_pages')->whereIn('slug', self::PAGE_SLUGS)->pluck('id');

        if ($pageIds->isEmpty()) {
            return;
        }

        DB::table('content_page_sections')
            ->whereIn('content_page_id', $pageIds)
            ->where('section_key', 'rental_requirements')
            ->update(['layout' => $layout, 'updated_at' => now()]);
    }
};
