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

            $this->configureHighlights($pageId, $slug, $highlightsKey);
            $this->configureRequirements($pageId, $slug);
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

            $this->removeAfterContent($pageId, $highlightsKey);
            $this->removeAfterContent($pageId, 'rental_requirements');

            DB::table('content_page_sections')
                ->where('content_page_id', $pageId)
                ->where('section_key', 'rental_requirements')
                ->update(['layout' => 'destination-grid', 'updated_at' => now()]);
        }
    }

    private function configureHighlights(int $pageId, string $slug, string $sectionKey): void
    {
        $section = DB::table('content_page_sections')
            ->where('content_page_id', $pageId)
            ->where('section_key', $sectionKey)
            ->select('id', 'body_html', 'settings')
            ->first();

        if (! $section) {
            return;
        }

        $settings = $this->settings($section->settings);
        $settings['after_content'] = $section->body_html;

        $beforeContent = match ($slug) {
            'car-rental-aqaba-airport' => '<p>Booking a rental car at Aqaba Airport gives you full freedom to design your itinerary without depending on fixed transport options. You can travel comfortably and explore destinations at your own pace.</p><p>Popular destinations include:</p>',
            'car-rental-amman-airport' => '<p>Booking a rental car at Amman Airport gives you the freedom to plan your route and explore the capital and surrounding destinations at your own pace.</p><p>Popular destinations include:</p>',
            'car-rental-amman' => '<p>Choose a convenient Enterprise location in Amman and collect a vehicle suited to your journey.</p><p>Available rental offices include:</p>',
            'car-rental-aqaba' => '<p>Choose a convenient Enterprise location in Aqaba and collect a vehicle suited to your journey.</p><p>Available rental offices include:</p>',
        };

        DB::table('content_page_sections')->where('id', $section->id)->update([
            'body_html' => $beforeContent,
            'settings' => json_encode($settings, JSON_UNESCAPED_SLASHES),
            'updated_at' => now(),
        ]);
    }

    private function configureRequirements(int $pageId, string $slug): void
    {
        $section = DB::table('content_page_sections')
            ->where('content_page_id', $pageId)
            ->where('section_key', 'rental_requirements')
            ->select('id', 'settings')
            ->first();

        if (! $section) {
            return;
        }

        $update = ['layout' => 'safety-list', 'updated_at' => now()];

        if ($slug === 'car-rental-aqaba-airport') {
            $settings = $this->settings($section->settings);
            $settings['after_content'] = '<p>Road conditions in Aqaba are well-maintained, and bilingual road signage in Arabic and English makes navigation simple for international visitors.</p>';

            $update += [
                'heading' => 'What You’ll Need to Rent a Car at Aqaba Airport, Jordan',
                'subheading' => null,
                'body_html' => '<p>Driving in Aqaba with a foreign licence is usually straightforward, and an International Driving Permit is not typically required. To complete your booking, you will generally need:</p>',
                'settings' => json_encode($settings, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            ];

            $items = [
                'A valid driving licence',
                'A valid passport',
                'Minimum age requirement of around 25 years',
            ];

            foreach ($items as $order => $title) {
                $this->saveItem($section->id, $order, $title);
            }
        }

        DB::table('content_page_sections')->where('id', $section->id)->update($update);
    }

    private function saveItem(int $sectionId, int $sortOrder, string $title): void
    {
        $query = DB::table('content_section_items')
            ->where('content_page_section_id', $sectionId)
            ->where('sort_order', $sortOrder);

        $data = [
            'title' => $title,
            'subtitle' => null,
            'body' => null,
            'image' => null,
            'image_alt' => null,
            'button_label' => null,
            'button_url' => null,
            'additional_data' => null,
            'is_enabled' => true,
            'updated_at' => now(),
        ];

        if ($query->exists()) {
            $query->update($data);
        } else {
            DB::table('content_section_items')->insert($data + [
                'content_page_section_id' => $sectionId,
                'sort_order' => $sortOrder,
                'created_at' => now(),
            ]);
        }
    }

    private function removeAfterContent(int $pageId, string $sectionKey): void
    {
        $section = DB::table('content_page_sections')
            ->where('content_page_id', $pageId)
            ->where('section_key', $sectionKey)
            ->select('id', 'settings')
            ->first();

        if (! $section) {
            return;
        }

        $settings = $this->settings($section->settings);
        unset($settings['after_content']);

        DB::table('content_page_sections')->where('id', $section->id)->update([
            'settings' => $settings === [] ? null : json_encode($settings, JSON_UNESCAPED_SLASHES),
            'updated_at' => now(),
        ]);
    }

    private function settings($settings): array
    {
        return $settings ? (json_decode($settings, true) ?: []) : [];
    }

    private function tablesExist(): bool
    {
        return Schema::hasTable('content_pages') &&
            Schema::hasTable('content_page_sections') &&
            Schema::hasTable('content_section_items');
    }
};
