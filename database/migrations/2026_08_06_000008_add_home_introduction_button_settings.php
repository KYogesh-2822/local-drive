<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $section = $this->introductionSection();

        if (! $section) {
            return;
        }

        $settings = $this->decodeSettings($section->settings);
        $settings['button_label'] = 'Contact Us';
        $settings['button_url'] = '/contact';

        DB::table('content_page_sections')->where('id', $section->id)->update([
            'settings' => json_encode($settings, JSON_UNESCAPED_SLASHES),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        $section = $this->introductionSection();

        if (! $section) {
            return;
        }

        $settings = $this->decodeSettings($section->settings);
        unset($settings['button_label'], $settings['button_url']);

        DB::table('content_page_sections')->where('id', $section->id)->update([
            'settings' => $settings === []
                ? null
                : json_encode($settings, JSON_UNESCAPED_SLASHES),
            'updated_at' => now(),
        ]);
    }

    private function introductionSection(): ?object
    {
        if (! Schema::hasTable('content_pages') || ! Schema::hasTable('content_page_sections')) {
            return null;
        }

        return DB::table('content_page_sections')
            ->join('content_pages', 'content_pages.id', '=', 'content_page_sections.content_page_id')
            ->where('content_pages.slug', 'home')
            ->where('content_page_sections.section_key', 'introduction')
            ->select('content_page_sections.id', 'content_page_sections.settings')
            ->first();
    }

    private function decodeSettings($settings): array
    {
        if (is_array($settings)) {
            return $settings;
        }

        return $settings ? (json_decode($settings, true) ?: []) : [];
    }
};
