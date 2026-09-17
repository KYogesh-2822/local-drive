<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const LOCATION_SLUGS = [
        'car-rental-aqaba-airport',
        'car-rental-amman-airport',
        'car-rental-amman',
        'car-rental-aqaba',
    ];

    public function up(): void
    {
        $this->updateCanonicalUrls(false);
    }

    public function down(): void
    {
        $this->updateCanonicalUrls(true);
    }

    private function updateCanonicalUrls(bool $includeLocationsPrefix): void
    {
        if (! Schema::hasTable('content_pages')) {
            return;
        }

        $baseUrl = rtrim((string) config('app.url'), '/');
        $prefix = $includeLocationsPrefix ? '/locations/' : '/';

        foreach (self::LOCATION_SLUGS as $slug) {
            DB::table('content_pages')->where('slug', $slug)->update([
                'canonical_url' => $baseUrl.$prefix.$slug,
                'updated_at' => now(),
            ]);
        }
    }
};
