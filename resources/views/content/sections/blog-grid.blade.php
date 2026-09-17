<section class="managed-section managed-section--blogs">
    <div class="container-fluid">
        <header class="managed-section__header">
            <span class="managed-eyebrow">Travel advice</span>
            <h2>{{ $section->heading ?: 'Helpful Travel Guides' }}</h2>
            @if($section->body_html)<div class="managed-rich-text">{!! $section->body_html !!}</div>@endif
        </header>

        <div class="managed-blog-grid">
            @forelse($blogs as $post)
                @php
                    $image = $post->featured_image;
                    if ($image && !str_starts_with($image, 'http')) {
                        $image = str_starts_with($image, 'content/') ? asset('storage/'.$image) : asset(ltrim($image, '/'));
                    }
                @endphp
                <article class="managed-blog-card">
                    @if($image)<a href="{{ route('content.blog.show', $post) }}"><img src="{{ $image }}" alt="{{ $post->featured_image_alt }}" loading="lazy"></a>@endif
                    <div class="managed-blog-card__content">
                        <span>{{ optional($post->category)->name ?: 'Travel Guide' }}</span>
                        <h3><a href="{{ route('content.blog.show', $post) }}">{{ $post->title }}</a></h3>
                        <p>{{ $post->excerpt }}</p>
                        <a class="managed-text-link" href="{{ route('content.blog.show', $post) }}">Read guide &rarr;</a>
                    </div>
                </article>
            @empty
                <p>No travel guides have been published yet.</p>
            @endforelse
        </div>
    </div>
</section>
