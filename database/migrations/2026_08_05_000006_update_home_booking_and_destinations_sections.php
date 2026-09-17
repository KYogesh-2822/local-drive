<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $pageId = $this->homePageId();

        if (! $pageId) {
            return;
        }

        $this->updateSection(
            $pageId,
            'booking_process',
            'Our Easy Booking Process',
            'Simple steps to secure your vehicle in minutes',
            'booking-process',
            [
                ['Select Vehicle', '<p>Browse our fleet and choose a vehicle that matches your needs and budget</p>'],
                ['Choose Dates', '<p>Select your pick-up location and rental dates for your trip</p>'],
                ['Confirm Booking', '<p>Complete your reservation through our secure booking system</p>'],
                ['Collect & Drive', '<p>Pick up your vehicle and begin your journey with confidence</p>'],
            ]
        );

        $this->updateSection(
            $pageId,
            'destinations',
            'Explore Jordan with Freedom',
            'Design your itinerary and explore at your own pace',
            'destination-grid',
            [
                ['Petra', '<p>The ancient rose-red city carved into cliffs, one of the New Seven Wonders of the World and a UNESCO World Heritage Site</p>'],
                ['The Dead Sea', '<p>Known for its unique floating experience and mineral-rich waters. The lowest point on Earth offers therapeutic healing benefits</p>'],
                ['Wadi Rum', '<p>A stunning desert landscape famous for its red sand and dramatic cliffs. Perfect for adventure seekers and nature lovers</p>'],
                ['Jerash', '<p>One of the best-preserved Roman cities outside Italy with incredible history. A must-visit for archaeology enthusiasts</p>'],
            ]
        );
    }

    public function down(): void
    {
        $pageId = $this->homePageId();

        if (! $pageId) {
            return;
        }

        $this->updateSection(
            $pageId,
            'booking_process',
            'Our Easy Booking Process',
            null,
            null,
            [
                ['1. Select Your Vehicle', '<p>Choose a vehicle that fits your route, passenger count, luggage and budget.</p>'],
                ['2. Choose Location and Dates', '<p>Select an airport or city pickup point and the rental dates that match your plans.</p>'],
                ['3. Confirm Your Booking', '<p>Review your details and complete your reservation through the secure booking system.</p>'],
                ['4. Collect and Start Driving', '<p>Complete the handover at your chosen location and begin your journey confidently.</p>'],
            ],
            '<p>Secure your vehicle quickly and start your journey without unnecessary delays.</p>'
        );

        $this->updateSection(
            $pageId,
            'destinations',
            'Explore Jordan with Freedom',
            null,
            null,
            [
                ['Petra', '<p>Discover the ancient rose-red city and one of the New Seven Wonders of the World.</p>'],
                ['The Dead Sea', '<p>Experience its mineral-rich water and unique floating conditions.</p>'],
                ['Wadi Rum', '<p>Explore dramatic desert scenery, red sand and towering cliffs.</p>'],
                ['Jerash', '<p>Visit one of the best-preserved Roman cities outside Italy.</p>'],
            ],
            '<p>Create your own itinerary, travel at your own pace and experience Jordan without depending on fixed transport schedules.</p>'
        );
    }

    private function homePageId(): ?int
    {
        if (! Schema::hasTable('content_pages') ||
            ! Schema::hasTable('content_page_sections') ||
            ! Schema::hasTable('content_section_items')) {
            return null;
        }

        return DB::table('content_pages')->where('slug', 'home')->value('id');
    }

    private function updateSection(
        int $pageId,
        string $sectionKey,
        string $heading,
        ?string $subheading,
        ?string $layout,
        array $items,
        ?string $bodyHtml = null
    ): void {
        $sectionId = DB::table('content_page_sections')
            ->where('content_page_id', $pageId)
            ->where('section_key', $sectionKey)
            ->value('id');

        if (! $sectionId) {
            return;
        }

        $timestamp = now();

        DB::table('content_page_sections')->where('id', $sectionId)->update([
            'heading' => $heading,
            'subheading' => $subheading,
            'body_html' => $bodyHtml,
            'layout' => $layout,
            'updated_at' => $timestamp,
        ]);

        foreach ($items as $sortOrder => [$title, $body]) {
            $itemQuery = DB::table('content_section_items')
                ->where('content_page_section_id', $sectionId)
                ->where('sort_order', $sortOrder);

            $itemData = [
                'title' => $title,
                'subtitle' => null,
                'body' => $body,
                'image' => null,
                'image_alt' => null,
                'button_label' => null,
                'button_url' => null,
                'additional_data' => null,
                'is_enabled' => true,
                'updated_at' => $timestamp,
            ];

            if ($itemQuery->exists()) {
                $itemQuery->update($itemData);
            } else {
                DB::table('content_section_items')->insert($itemData + [
                    'content_page_section_id' => $sectionId,
                    'sort_order' => $sortOrder,
                    'created_at' => $timestamp,
                ]);
            }
        }

        DB::table('content_section_items')
            ->where('content_page_section_id', $sectionId)
            ->whereNotIn('sort_order', array_keys($items))
            ->update(['is_enabled' => false, 'updated_at' => $timestamp]);
    }
};
