<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\ContentPage;
use Illuminate\Support\Facades\DB;
use Throwable;

class PageController extends Controller
{
    public function home()
    {
        $page = $this->loadPage('home', 'home');
        $vehicles = $this->loadVehicles();

        return view('content.pages.home', $this->viewData($page, compact('vehicles')));
    }

    public function location(ContentPage $page)
    {
        abort_unless($page->template === 'location' && $this->isPublic($page), 404);
        $page->load($this->relations());
        $extra = $page->activeSections->contains('layout', 'fleet-cards')
            ? ['vehicles' => $this->loadVehicles()]
            : [];

        return view('content.pages.location', $this->viewData($page, $extra));
    }

    public function preview(ContentPage $page)
    {
        $page->load($this->relations());
        $view = $page->template === 'home' ? 'content.pages.home' : 'content.pages.location';
        $needsVehicles = $page->template === 'home' || $page->activeSections->contains('layout', 'fleet-cards');
        $extra = $needsVehicles ? ['vehicles' => $this->loadVehicles()] : [];

        return view($view, $this->viewData($page, $extra + ['isPreview' => true]));
    }
    public function redirectPreview(ContentPage $page)
    {
        abort_unless(array_key_exists($page->slug, config('content.system_pages', [])), 404);
        abort_unless($this->isPublic($page), 404);

        if ($page->template === 'home') {
            return redirect('/', 301);
        }

        abort_unless($page->template === 'location', 404);

        return redirect('/'.$page->slug, 301);
    }

    public function redirectLegacyLocation(ContentPage $page)
    {
        abort_unless($page->template === 'location' && $this->isPublic($page), 404);

        return redirect('/'.$page->slug, 301);
    }

    private function loadVehicles()
    {
        try {
            return DB::connection('mysql_second')
                ->table('vehicles')
                ->whereNotNull('image')
                ->orderBy('id')
                ->take(5)
                ->get();
        } catch (Throwable $exception) {
            report($exception);

            return collect();
        }
    }
    private function loadPage(string $slug, string $template): ContentPage
    {
        return ContentPage::published()
            ->where('slug', $slug)
            ->where('template', $template)
            ->with($this->relations())
            ->firstOrFail();
    }

    private function isPublic(ContentPage $page): bool
    {
        return $page->status === 'published'
            && ($page->published_at === null || $page->published_at->isPast());
    }

    private function relations(): array
    {
        return [
            'activeSections.activeItems',
            'activeFaqs',
            'blogPosts' => fn ($query) => $query->published()->with('category'),
        ];
    }

    private function viewData(ContentPage $page, array $extra = []): array
    {
        return $extra + [
            'page' => $page,
            'sections' => $page->activeSections->keyBy('section_key'),
            'faqs' => $page->activeFaqs,
            'blogs' => $page->blogPosts,
            'seo' => [
                'title' => $page->meta_title,
                'description' => $page->meta_description,
                'canonical' => $page->canonical_url ?: $page->publicUrl(),
                'image' => $page->og_image ?: $page->hero_image,
                'type' => 'website',
            ],
        ];
    }
}
