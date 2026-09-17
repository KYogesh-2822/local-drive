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
        $this->updateBookingSections('booking-process', false);
    }

    public function down(): void
    {
        $this->updateBookingSections('destination-grid', true);
    }

    private function updateBookingSections(string $layout, bool $includeNumbers): void
    {
        if (! Schema::hasTable('content_pages') ||
            ! Schema::hasTable('content_page_sections') ||
            ! Schema::hasTable('content_section_items')) {
            return;
        }

        $pageIds = DB::table('content_pages')->whereIn('slug', self::PAGE_SLUGS)->pluck('id');
        $sectionIds = DB::table('content_page_sections')
            ->whereIn('content_page_id', $pageIds)
            ->where('section_key', 'booking_process')
            ->pluck('id');

        DB::table('content_page_sections')->whereIn('id', $sectionIds)->update([
            'layout' => $layout,
            'updated_at' => now(),
        ]);

        $titles = [
            'Select Your Vehicle',
            'Choose Rental Dates',
            'Confirm Your Reservation',
            'Collect Your Vehicle',
        ];

        foreach ($sectionIds as $sectionId) {
            foreach ($titles as $sortOrder => $title) {
                DB::table('content_section_items')
                    ->where('content_page_section_id', $sectionId)
                    ->where('sort_order', $sortOrder)
                    ->update([
                        'title' => $includeNumbers ? ($sortOrder + 1).'. '.$title : $title,
                        'updated_at' => now(),
                    ]);
            }
        }
    }
};
