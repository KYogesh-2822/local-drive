<?php

use App\Models\Content\BlogPost;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const DATA_FILES = [
        'jordan-travel-guide-everything-you-need-for-an-unforgettable-trip.json',
        'enterprise-vs-other-car-rental-companies-in-jordan.json',
        'best-jordan-road-trips-10-scenic-routes-you-must-drive.json',
    ];

    public function up(): void
    {
        if (! $this->requiredTablesExist()) {
            return;
        }

        $blogs = $this->loadBlogData();
        $this->validateFeaturedImages($blogs);

        DB::transaction(function () use ($blogs): void {
            $categoryId = $this->travelGuidesCategoryId();

            foreach ($blogs as $blog) {
                $faqs = $blog['faqs'];
                unset($blog['faqs'], $blog['source_document_id']);

                $slug = $blog['slug'];
                $post = DB::table('blog_posts')->where('slug', $slug)->first();
                $timestamp = now();
                $payload = $blog + [
                    'blog_category_id' => $categoryId,
                    'canonical_url' => rtrim((string) config('app.url'), '/').'/blog/'.$slug,
                    'og_image' => $blog['featured_image'],
                    'deleted_at' => null,
                    'updated_at' => $timestamp,
                ];

                if ($post) {
                    DB::table('blog_posts')->where('id', $post->id)->update($payload);
                    $postId = $post->id;
                } else {
                    $postId = DB::table('blog_posts')->insertGetId($payload + [
                        'created_at' => $timestamp,
                    ]);
                }

                DB::table('content_faqs')
                    ->where('faqable_type', (new BlogPost)->getMorphClass())
                    ->where('faqable_id', $postId)
                    ->delete();

                foreach ($faqs as $sortOrder => $faq) {
                    DB::table('content_faqs')->insert([
                        'faqable_type' => (new BlogPost)->getMorphClass(),
                        'faqable_id' => $postId,
                        'question' => $faq['question'],
                        'answer' => $faq['answer'],
                        'sort_order' => $sortOrder,
                        'is_active' => true,
                        'created_at' => $timestamp,
                        'updated_at' => $timestamp,
                    ]);
                }
            }
        });
    }

    public function down(): void
    {
        if (! $this->requiredTablesExist()) {
            return;
        }

        $slugs = collect(self::DATA_FILES)
            ->map(fn (string $file): string => pathinfo($file, PATHINFO_FILENAME));
        $postIds = DB::table('blog_posts')->whereIn('slug', $slugs)->pluck('id');

        DB::transaction(function () use ($postIds, $slugs): void {
            DB::table('content_faqs')
                ->where('faqable_type', (new BlogPost)->getMorphClass())
                ->whereIn('faqable_id', $postIds)
                ->delete();

            DB::table('content_page_blog_post')->whereIn('blog_post_id', $postIds)->delete();
            DB::table('blog_posts')->whereIn('slug', $slugs)->delete();
        });
    }

    private function loadBlogData(): array
    {
        return collect(self::DATA_FILES)->map(function (string $file): array {
            $path = database_path('data/2026-08-blogs/'.$file);

            if (! is_file($path)) {
                throw new RuntimeException("Missing August blog data file: {$path}");
            }

            $data = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

            if (($data['status'] ?? null) !== 'published' || count($data['faqs'] ?? []) !== 5) {
                throw new RuntimeException("Invalid August blog data file: {$path}");
            }

            return $data;
        })->all();
    }

    private function validateFeaturedImages(array $blogs): void
    {
        foreach ($blogs as $blog) {
            $path = public_path($blog['featured_image']);

            if (! is_file($path)) {
                throw new RuntimeException("Missing August blog featured image: {$path}");
            }
        }
    }

    private function travelGuidesCategoryId(): int
    {
        $category = DB::table('blog_categories')->where('slug', 'travel-guides')->first();

        if ($category) {
            return (int) $category->id;
        }

        return (int) DB::table('blog_categories')->insertGetId([
            'name' => 'Travel Guides',
            'slug' => 'travel-guides',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function requiredTablesExist(): bool
    {
        return Schema::hasTable('blog_categories')
            && Schema::hasTable('blog_posts')
            && Schema::hasTable('content_faqs')
            && Schema::hasTable('content_page_blog_post');
    }
};
