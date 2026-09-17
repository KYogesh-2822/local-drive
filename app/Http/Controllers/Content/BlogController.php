<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\BlogCategory;
use App\Models\Content\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categories = BlogCategory::query()
            ->where('is_active', true)
            ->whereHas('posts', fn ($query) => $query->published())
            ->withCount([
                'posts as published_posts_count' => fn ($query) => $query->published(),
            ])
            ->orderBy('name')
            ->get();

        $activeCategory = trim((string) $request->query('category', ''));
        $activeCategoryModel = $activeCategory !== ''
            ? $categories->firstWhere('slug', $activeCategory)
            : null;

        abort_if($activeCategory !== '' && ! $activeCategoryModel, 404);

        $posts = BlogPost::published()
            ->with('category')
            ->when(
                $activeCategoryModel,
                fn ($query) => $query->where('blog_category_id', $activeCategoryModel->id)
            )
            ->latest('published_at')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('content.blog.index', [
            'posts' => $posts,
            'categories' => $categories,
            'activeCategory' => $activeCategory,
            'activeCategoryModel' => $activeCategoryModel,
            'allPostsCount' => BlogPost::published()->count(),
            'recentPosts' => BlogPost::published()->latest('published_at')->take(4)->get(),
            'seo' => [
                'title' => $activeCategoryModel
                    ? $activeCategoryModel->name.' | Jordan Travel Guides'
                    : 'Jordan Car Rental Travel Guides | Enterprise Rent-A-Car',
                'description' => 'Explore practical Jordan driving, car rental and road-trip guides from Enterprise, with expert advice on routes, vehicles, airports and travel planning.',
                'canonical' => url('/blog'),
                'type' => 'website',
            ],
        ]);
    }

    public function show(BlogPost $post)
    {
        abort_unless($post->isPubliclyAvailable(), 404);

        $post->load(['category', 'activeFaqs']);

        $categories = BlogCategory::query()
            ->where('is_active', true)
            ->whereHas('posts', fn ($query) => $query->published())
            ->withCount([
                'posts as published_posts_count' => fn ($query) => $query->published(),
            ])
            ->orderBy('name')
            ->get();

        $otherPublishedPosts = BlogPost::published()
            ->whereKeyNot($post->getKey())
            ->with('category')
            ->latest('published_at');

        return view('content.blog.show', [
            'post' => $post,
            'faqs' => $post->activeFaqs,
            'categories' => $categories,
            'allPostsCount' => BlogPost::published()->count(),
            'recentPosts' => (clone $otherPublishedPosts)->take(4)->get(),
            'relatedPosts' => (clone $otherPublishedPosts)->take(3)->get(),
            'seo' => [
                'title' => $post->meta_title,
                'description' => $post->meta_description,
                'canonical' => $post->canonical_url ?: $post->publicUrl(),
                'image' => $post->og_image ?: $post->featured_image,
                'type' => 'article',
            ],
        ]);
    }
}
