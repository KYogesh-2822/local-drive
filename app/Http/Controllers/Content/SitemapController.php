<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\BlogPost;
use App\Models\Content\ContentPage;

class SitemapController extends Controller
{
    public function __invoke()
    {
        $entries = [];
        $addEntry = static function (string $location, ?string $lastModified = null) use (&$entries): void {
            $url = preg_match('#^https?://#i', $location)
                ? $location
                : url('/'.ltrim($location, '/'));

            $entries[$url] = [
                'loc' => $url,
                'lastmod' => $lastModified,
            ];
        };

        foreach (config('sitemap.static_paths', []) as $path) {
            $addEntry($path);
        }

        foreach (config('sitemap.faq_question_ids', []) as $id) {
            $addEntry('/faq-pickup/'.$id);
        }

        foreach (config('sitemap.vehicle_ids', []) as $id) {
            $addEntry('/vehicle-detail/'.$id);
        }

        if (config('content.managed_pages_live')) {
            ContentPage::published()
                ->get()
                ->each(fn (ContentPage $page) => $addEntry(
                    $page->publicUrl(),
                    $page->updated_at?->toAtomString()
                ));
        }

        $posts = BlogPost::published()
            ->latest('published_at')
            ->get();

        if ($posts->isNotEmpty()) {
            $addEntry('/blog', $posts->max('updated_at')?->toAtomString());
        }

        $posts->each(fn (BlogPost $post) => $addEntry(
            $post->publicUrl(),
            $post->updated_at?->toAtomString()
        ));

        return response()
            ->view('content.sitemap', [
                'entries' => array_values($entries),
            ])
            ->header('Content-Type', 'application/xml');
    }
}
