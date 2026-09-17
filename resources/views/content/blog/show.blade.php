@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/blog-single.css') }}">
@endpush

@section('content')
@php
    $resolveBlogImage = function ($path) {
        if (! $path || str_starts_with($path, 'http')) {
            return $path;
        }

        return str_starts_with($path, 'content/')
            ? asset('storage/'.$path)
            : asset(ltrim($path, '/'));
    };

    $featuredImage = $resolveBlogImage($post->featured_image);
    $categoryName = optional($post->category)->name ?: 'Travel Guide';
@endphp

<div class="blog-single">
    <nav class="blog-single__breadcrumb-bar" aria-label="Breadcrumb">
        <ol class="container-fluid blog-single__breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li aria-hidden="true">/</li>
            <li><a href="{{ route('content.blog.index') }}">Blog</a></li>
            @if($post->category)
                <li aria-hidden="true">/</li>
                <li><a href="{{ route('content.blog.index', ['category' => $post->category->slug]) }}">{{ $post->category->name }}</a></li>
            @endif
            <li aria-hidden="true">/</li>
            <li aria-current="page">Article</li>
        </ol>
    </nav>

    <section class="blog-single__body">
        <div class="container-fluid blog-single__layout">
            <main>
                <article class="blog-single__article">
                    <header class="blog-single__header">
                        <span class="blog-single__eyebrow">{{ $categoryName }}</span>
                        <h1>{{ $post->title }}</h1>
                        <ul class="blog-single__meta" aria-label="Article details">
                            @if($post->publicationDate())
                                <li><time datetime="{{ $post->publicationDate()->toDateString() }}">{{ $post->publicationDate()->format('F j, Y') }}</time></li>
                            @endif
                            <li>{{ $categoryName }}</li>
                            @if($post->author_name)<li>By {{ $post->author_name }}</li>@endif
                        </ul>
                        @if($post->excerpt)<p class="blog-single__intro">{{ $post->excerpt }}</p>@endif
                    </header>

                    @if($featuredImage)
                        <img class="blog-single__featured" src="{{ $featuredImage }}" alt="{{ $post->featured_image_alt ?: $post->title }}" width="1100" height="620" fetchpriority="high">
                    @endif

                    <div class="blog-single__content-wrap">
                        <div class="blog-single__content">{!! $post->body_html !!}</div>

                        @if($faqs->isNotEmpty())
                            <section class="blog-single__faq" id="faqs" aria-labelledby="blog-faq-heading">
                                <span class="blog-single__section-kicker">Helpful answers</span>
                                <h2 id="blog-faq-heading">Frequently Asked Questions</h2>
                                <div class="accordion" id="blogFaqAccordion">
                                    @foreach($faqs as $faq)
                                        <div class="accordion-item">
                                            <h3 class="accordion-header" id="blogFaqHeading{{ $faq->id }}">
                                                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#blogFaqAnswer{{ $faq->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="blogFaqAnswer{{ $faq->id }}">
                                                    {{ $faq->question }}
                                                </button>
                                            </h3>
                                            <div id="blogFaqAnswer{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="blogFaqHeading{{ $faq->id }}" data-bs-parent="#blogFaqAccordion">
                                                <div class="accordion-body">{!! $faq->answer !!}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                        @endif
                    </div>
                </article>
            </main>

            <aside class="blog-single__sidebar" aria-label="Blog sidebar">
                <section class="blog-single__panel">
                    <h2 class="blog-single__panel-title">Browse by topic</h2>
                    <ul class="blog-single__categories">
                        <li>
                            <a href="{{ route('content.blog.index') }}">
                                <span>All guides</span><span class="blog-single__count">{{ $allPostsCount }}</span>
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li>
                                <a class="{{ optional($post->category)->is($category) ? 'is-active' : '' }}" href="{{ route('content.blog.index', ['category' => $category->slug]) }}">
                                    <span>{{ $category->name }}</span><span class="blog-single__count">{{ $category->published_posts_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </section>

                @if($recentPosts->isNotEmpty())
                    <section class="blog-single__panel">
                        <h2 class="blog-single__panel-title">Recent articles</h2>
                        <ul class="blog-single__recent">
                            @foreach($recentPosts as $recentPost)
                                <li>
                                    @if($recentPost->publicationDate())<time datetime="{{ $recentPost->publicationDate()->toDateString() }}">{{ $recentPost->publicationDate()->format('M j, Y') }}</time>@endif
                                    <a href="{{ route('content.blog.show', $recentPost) }}">{{ $recentPost->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endif

                <section class="blog-single__sidebar-cta">
                    <span>Explore Jordan your way</span>
                    <h2>Need a car for your journey?</h2>
                    <p>Choose a reliable vehicle suited to your route, passengers and luggage.</p>
                    <a class="blog-single__button" href="{{ route('reservation') }}">Start a Reservation</a>
                </section>
            </aside>
        </div>
    </section>

    @if($relatedPosts->isNotEmpty())
        <section class="blog-single__related" aria-labelledby="related-articles-heading">
            <div class="container-fluid">
                <div class="blog-single__related-heading">
                    <div>
                        <span class="blog-single__section-kicker">Continue reading</span>
                        <h2 id="related-articles-heading">More Jordan travel guides</h2>
                    </div>
                    <a class="blog-single__all-link" href="{{ route('content.blog.index') }}">View all articles <span aria-hidden="true">&rarr;</span></a>
                </div>
                <div class="blog-single__related-grid">
                    @foreach($relatedPosts as $relatedPost)
                        @php($relatedImage = $resolveBlogImage($relatedPost->featured_image))
                        <article class="blog-single__related-card">
                            @if($relatedImage)
                                <a href="{{ route('content.blog.show', $relatedPost) }}" aria-label="Read {{ $relatedPost->title }}">
                                    <img src="{{ $relatedImage }}" alt="{{ $relatedPost->featured_image_alt ?: $relatedPost->title }}" width="800" height="450" loading="lazy">
                                </a>
                            @endif
                            <div class="blog-single__related-card-body">
                                @if($relatedPost->publicationDate())<time datetime="{{ $relatedPost->publicationDate()->toDateString() }}">{{ $relatedPost->publicationDate()->format('F j, Y') }}</time>@endif
                                <h3><a href="{{ route('content.blog.show', $relatedPost) }}">{{ $relatedPost->title }}</a></h3>
                                <a class="blog-single__read-more" href="{{ route('content.blog.show', $relatedPost) }}">Read Full Article <span aria-hidden="true">&rarr;</span></a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>

@include('content.partials.structured-data', [
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Blog', 'url' => url('/blog')],
        ['name' => $post->title, 'url' => $post->publicUrl()],
    ],
    'faqs' => $faqs,
])
@endsection
