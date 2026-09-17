<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const PAGES = [
        'car-rental-aqaba-airport' => [
            'highlights_key' => 'destinations',
            'rental_phrase' => 'Aqaba airport car rental',
        ],
        'car-rental-amman-airport' => [
            'highlights_key' => 'destinations',
            'rental_phrase' => 'Amman airport car rental',
        ],
        'car-rental-amman' => [
            'highlights_key' => 'rental_offices',
            'rental_phrase' => 'car rental in Amman',
        ],
        'car-rental-aqaba' => [
            'highlights_key' => 'rental_offices',
            'rental_phrase' => 'car rental in Aqaba',
        ],
    ];

    public function up(): void
    {
        if (! $this->tablesExist()) {
            return;
        }

        foreach (self::PAGES as $slug => $configuration) {
            $pageId = DB::table('content_pages')->where('slug', $slug)->value('id');

            if (! $pageId) {
                continue;
            }

            $content = '<p>With your own vehicle, visiting multiple attractions in one trip becomes simple and convenient.</p>'
                .'<p>Many travellers who choose '.$configuration['rental_phrase'].' enjoy the flexibility to explore remote and scenic locations without worrying about transport limitations.</p>';

            DB::table('content_page_sections')
                ->where('content_page_id', $pageId)
                ->where('section_key', $configuration['highlights_key'])
                ->update([
                    'body_html' => $content,
                    'updated_at' => now(),
                ]);

            DB::table('content_page_sections')
                ->where('content_page_id', $pageId)
                ->where('section_key', 'rental_requirements')
                ->update([
                    'subheading' => 'Prepare the required documents before collecting your rental vehicle.',
                    'layout' => 'destination-grid',
                    'updated_at' => now(),
                ]);
        }
    }

    public function down(): void
    {
        if (! $this->tablesExist()) {
            return;
        }

        foreach (self::PAGES as $slug => $configuration) {
            $pageId = DB::table('content_pages')->where('slug', $slug)->value('id');

            if (! $pageId) {
                continue;
            }

            DB::table('content_page_sections')
                ->where('content_page_id', $pageId)
                ->where('section_key', $configuration['highlights_key'])
                ->update(['body_html' => null, 'updated_at' => now()]);

            DB::table('content_page_sections')
                ->where('content_page_id', $pageId)
                ->where('section_key', 'rental_requirements')
                ->update([
                    'subheading' => null,
                    'layout' => null,
                    'updated_at' => now(),
                ]);
        }
    }

    private function tablesExist(): bool
    {
        return Schema::hasTable('content_pages') && Schema::hasTable('content_page_sections');
    }
};
