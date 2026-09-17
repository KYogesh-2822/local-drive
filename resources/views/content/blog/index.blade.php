@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/blog-archive.css') }}">
@endpush

@section('content')
<div class="blog-archive">
    <header class="blog-archive__hero">
        <div class="container-fluid blog-archive__hero-inner">
            <ol class="blog-archive__breadcrumb" aria-label="Breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li aria-hidden="true">/</li>
                <li aria-current="page">Blog</li>
            </ol>
            <span class="blog-archive__eyebrow">Enterprise Rent-A-Car Jordan</span>
            <h1>Jordan Driving and Car Rental Guides</h1>
            <p>Practical destination advice, driving guidance and vehicle rental insights to help you plan a smoother journey across Jordan.</p>
        </div>
    </header>

    <section class="blog-archive__body">
        <div class="container-fluid">
            <div class="blog-archive__heading-row">
                <div>
                    <span class="blog-archive__eyebrow">Latest insights</span>
                    <h2>{{ $activeCategoryModel ? $activeCategoryModel->name : 'Explore all articles' }}</h2>
                </div>
                <p>{{ $posts->total() }} {{ Str::plural('article', $posts->total()) }}</p>
            </div>

            <nav class="blog-archive__filters" aria-label="Filter articles by category">
                <a class="blog-archive__filter {{ $activeCategory === '' ? 'is-active' : '' }}" href="{{ route('content.blog.index') }}">All guides</a>
                @foreach($categories as $category)
                    <a class="blog-archive__filter {{ $activeCategory === $category->slug ? 'is-active' : '' }}" href="{{ route('content.blog.index', ['category' => $category->slug]) }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </nav>

            <div class="blog-archive__layout">
                <main>
                    <div class="blog-archive__grid">
                        @forelse($posts as $post)
                            @php
                                $image = $post->featured_image;
                                if ($image && !str_starts_with($image, 'http')) {
                                    $image = str_starts_with($image, 'content/')
                                        ? asset('storage/'.$image)
                                        : asset(ltrim($image, '/'));
                                }
                            @endphp
                            <article class="blog-card">
                                @if($image)
                                    <div class="blog-card__image-wrap">
                                        <img class="blog-card__image" src="{{ $image }}" alt="{{ $post->featured_image_alt }}" loading="lazy" width="800" height="450">
                                    </div>
                                @endif
                                <div class="blog-card__body">
                                    <div class="blog-card__meta">
                                        <time datetime="{{ $post->publicationDate()?->toDateString() }}">{{ $post->publicationDate()?->format('F j, Y') }}</time>
                                        @if($post->category)<span class="blog-card__category">{{ $post->category->name }}</span>@endif
                                    </div>
                                    <h3>{{ $post->title }}</h3>
                                    <p class="blog-card__excerpt">{{ $post->excerpt }}</p>
                                    <a class="blog-card__link" href="{{ route('content.blog.show', $post) }}">Read More <span aria-hidden="true">&rarr;</span></a>
                                </div>
                            </article>
                        @empty
                            <div class="blog-archive__empty">
                                <h3>No articles found</h3>
                                <p>There are currently no published articles in this category.</p>
                                <a class="blog-card__link" href="{{ route('content.blog.index') }}">View all guides <span aria-hidden="true">&rarr;</span></a>
                            </div>
                        @endforelse
                    </div>

                    @if($posts->hasPages())
                        <nav class="blog-pagination" aria-label="Blog pagination">{{ $posts->onEachSide(1)->links('pagination::bootstrap-5') }}</nav>
                    @endif
                </main>

                <aside class="blog-sidebar" aria-label="Blog sidebar">
                    <section class="blog-sidebar__panel">
                        <h2 class="blog-sidebar__title">Browse by topic</h2>
                        <ul class="blog-sidebar__categories">
                            <li>
                                <a class="{{ $activeCategory === '' ? 'is-active' : '' }}" href="{{ route('content.blog.index') }}">
                                    <span>All guides</span><span class="blog-sidebar__count">{{ $allPostsCount }}</span>
                                </a>
                            </li>
                            @foreach($categories as $category)
                                <li>
                                    <a class="{{ $activeCategory === $category->slug ? 'is-active' : '' }}" href="{{ route('content.blog.index', ['category' => $category->slug]) }}">
                                        <span>{{ $category->name }}</span><span class="blog-sidebar__count">{{ $category->published_posts_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </section>

                    <section class="blog-sidebar__panel">
                        <h2 class="blog-sidebar__title">Recent articles</h2>
                        <ul class="blog-sidebar__recent">
                            @foreach($recentPosts as $recentPost)
                                <li>
                                    <time datetime="{{ $recentPost->publicationDate()?->toDateString() }}">{{ $recentPost->publicationDate()?->format('M j, Y') }}</time>
                                    <a href="{{ route('content.blog.show', $recentPost) }}">{{ $recentPost->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </section>

                    <section class="blog-sidebar__cta">
                        <span>Plan your journey</span>
                        <h2>Ready to explore Jordan?</h2>
                        <p>Choose a vehicle suited to your route, passengers and luggage.</p>
                        <a class="blog-sidebar__button" href="{{ route('reservation') }}">Start a Reservation</a>
                    </section>
                </aside>
            </div>
        </div>
    </section>
</div>

@include('content.partials.structured-data', [
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Blog', 'url' => url('/blog')],
    ],
    'faqs' => collect(),
])
@endsection
