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
        if (! $this->tablesExist()) {
            return;
        }

        foreach (self::PAGES as $slug => $highlightsKey) {
            $pageId = DB::table('content_pages')->where('slug', $slug)->value('id');

            if (! $pageId) {
                continue;
            }

            $timestamp = now();

            $this->updateSection($pageId, 'fleet', [
                'subheading' => 'Select a vehicle category based on passenger numbers, luggage, distance and comfort preferences.',
                'body_html' => null,
                'layout' => 'fleet-cards',
                'updated_at' => $timestamp,
            ]);

            $highlightsId = $this->updateSection($pageId, $highlightsKey, [
                'subheading' => 'Travel on your own schedule with the freedom to explore the area and nearby destinations.',
                'body_html' => null,
                'layout' => 'safety-list',
                'updated_at' => $timestamp,
            ]);

            if ($highlightsId) {
                DB::table('content_section_items')
                    ->where('content_page_section_id', $highlightsId)
                    ->update(['body' => null, 'updated_at' => $timestamp]);
            }

            $this->updateSection($pageId, 'booking_process', [
                'subheading' => 'Reserve your rental vehicle in four straightforward steps.',
                'body_html' => null,
                'layout' => 'destination-grid',
                'updated_at' => $timestamp,
            ]);

            $this->setIntroductionButton($pageId, $timestamp, true);
        }
    }

    public function down(): void
    {
        if (! $this->tablesExist()) {
            return;
        }

        foreach (self::PAGES as $slug => $highlightsKey) {
            $pageId = DB::table('content_pages')->where('slug', $slug)->value('id');

            if (! $pageId) {
                continue;
            }

            $timestamp = now();

            $this->updateSection($pageId, 'fleet', [
                'subheading' => null,
                'body_html' => '<p>Select a vehicle category based on passenger numbers, luggage, distance and comfort preferences.</p>',
                'layout' => null,
                'updated_at' => $timestamp,
            ]);

            $highlightsId = $this->updateSection($pageId, $highlightsKey, [
                'subheading' => null,
                'body_html' => '<p>A rental vehicle gives you the flexibility to travel without relying on fixed transportation schedules.</p>',
                'layout' => null,
                'updated_at' => $timestamp,
            ]);

            if ($highlightsId) {
                DB::table('content_section_items')
                    ->where('content_page_section_id', $highlightsId)
                    ->update([
                        'body' => '<p>Travel comfortably on your own schedule with an Enterprise rental vehicle.</p>',
                        'updated_at' => $timestamp,
                    ]);
            }

            $this->updateSection($pageId, 'booking_process', [
                'subheading' => null,
                'body_html' => '<p>Reserve in four straightforward steps.</p>',
                'layout' => null,
                'updated_at' => $timestamp,
            ]);

            $this->setIntroductionButton($pageId, $timestamp, false);
        }
    }

    private function updateSection(int $pageId, string $sectionKey, array $data): ?int
    {
        $sectionId = DB::table('content_page_sections')
            ->where('content_page_id', $pageId)
            ->where('section_key', $sectionKey)
            ->value('id');

        if ($sectionId) {
            DB::table('content_page_sections')->where('id', $sectionId)->update($data);
        }

        return $sectionId;
    }

    private function setIntroductionButton(int $pageId, $timestamp, bool $enabled): void
    {
        $section = DB::table('content_page_sections')
            ->where('content_page_id', $pageId)
            ->where('section_key', 'introduction')
            ->select('id', 'settings')
            ->first();

        if (! $section) {
            return;
        }

        $settings = $section->settings ? (json_decode($section->settings, true) ?: []) : [];

        if ($enabled) {
            $settings['button_label'] = 'Contact Us';
            $settings['button_url'] = '/contact';
        } else {
            unset($settings['button_label'], $settings['button_url']);
        }

        DB::table('content_page_sections')->where('id', $section->id)->update([
            'settings' => $settings === [] ? null : json_encode($settings, JSON_UNESCAPED_SLASHES),
            'updated_at' => $timestamp,
        ]);
    }

    private function tablesExist(): bool
    {
        return Schema::hasTable('content_pages') &&
            Schema::hasTable('content_page_sections') &&
            Schema::hasTable('content_section_items');
    }
};
