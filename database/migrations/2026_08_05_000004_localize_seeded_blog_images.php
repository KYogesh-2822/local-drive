<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private array $images = [
        'complete-guide-to-car-rental-in-jordan-for-first-time-visitors' => 'images/content/blogs/complete-guide-to-car-rental-in-jordan-for-first-time-visitors.webp',
        'is-renting-a-car-in-jordan-worth-it-compared-to-public-transport' => 'images/content/blogs/is-renting-a-car-in-jordan-worth-it-compared-to-public-transport.webp',
        'family-car-rental-in-jordan-best-vehicles-for-your-trip' => 'images/content/blogs/family-car-rental-in-jordan-best-vehicles-for-your-trip.webp',
    ];

    public function up(): void
    {
        foreach ($this->images as $slug => $image) {
            DB::table('blog_posts')
                ->where('slug', $slug)
                ->update(['featured_image' => $image]);
        }
    }

    public function down(): void
    {
        DB::table('blog_posts')
            ->whereIn('slug', array_keys($this->images))
            ->update(['featured_image' => null]);
    }
};
