<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $sectionId = $this->fleetSectionId();

        if (! $sectionId) {
            return;
        }

        $timestamp = now();

        DB::table('content_page_sections')->where('id', $sectionId)->update([
            'heading' => 'Meet the Fleet',
            'subheading' => "From SUVs to compact cars, we've got your perfect ride",
            'body_html' => null,
            'layout' => 'fleet-cards',
            'updated_at' => $timestamp,
        ]);

        $items = [
            ['Mini', '<p>Ideal for solo travelers with excellent fuel efficiency</p>'],
            ['Economy', '<p>Affordable and reliable for city exploration</p>'],
            ['Compact', '<p>Perfect balance of comfort and efficiency</p>'],
            ['Intermediate', '<p>Extra space for small families and groups</p>'],
            ['Standard', '<p>Premium comfort for long-distance journeys</p>'],
        ];

        foreach ($items as $sortOrder => [$title, $body]) {
            $this->saveItem($sectionId, $sortOrder, [
                'title' => $title,
                'body' => $body,
                'image' => null,
                'image_alt' => null,
                'button_label' => null,
                'button_url' => null,
            ], $timestamp);
        }

        $this->saveItem($sectionId, 5, [
            'title' => 'View the Complete Fleet',
            'body' => null,
            'image' => null,
            'image_alt' => null,
            'button_label' => 'View All Vehicles',
            'button_url' => '/all-vechicles',
        ], $timestamp);

        DB::table('content_section_items')
            ->where('content_page_section_id', $sectionId)
            ->whereNotIn('sort_order', range(0, 5))
            ->update(['is_enabled' => false, 'updated_at' => $timestamp]);
    }

    public function down(): void
    {
        $sectionId = $this->fleetSectionId();

        if (! $sectionId) {
            return;
        }

        DB::table('content_page_sections')->where('id', $sectionId)->update([
            'heading' => 'A Wide Range of Vehicles for Every Journey',
            'subheading' => null,
            'body_html' => '<p>Find the right balance of space, comfort, performance and value for your itinerary.</p>',
            'layout' => null,
            'updated_at' => now(),
        ]);
    }

    private function fleetSectionId(): ?int
    {
        if (! Schema::hasTable('content_pages') ||
            ! Schema::hasTable('content_page_sections') ||
            ! Schema::hasTable('content_section_items')) {
            return null;
        }

        $pageId = DB::table('content_pages')->where('slug', 'home')->value('id');

        if (! $pageId) {
            return null;
        }

        return DB::table('content_page_sections')
            ->where('content_page_id', $pageId)
            ->where('section_key', 'fleet')
            ->value('id');
    }

    private function saveItem(int $sectionId, int $sortOrder, array $data, $timestamp): void
    {
        $query = DB::table('content_section_items')
            ->where('content_page_section_id', $sectionId)
            ->where('sort_order', $sortOrder);

        $data += [
            'subtitle' => null,
            'additional_data' => null,
            'is_enabled' => true,
            'updated_at' => $timestamp,
        ];

        if ($query->exists()) {
            $query->update($data);
        } else {
            DB::table('content_section_items')->insert($data + [
                'content_page_section_id' => $sectionId,
                'sort_order' => $sortOrder,
                'created_at' => $timestamp,
            ]);
        }
    }
};
