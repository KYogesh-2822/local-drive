@php
    $dark = in_array($section->section_key, ['safety', 'rental_requirements']);
    $sectionButtonLabel = data_get($section->settings, 'button_label');
    $sectionButtonUrl = data_get($section->settings, 'button_url');
@endphp
<section class="managed-section {{ $dark ? 'managed-section--dark' : '' }} managed-section--{{ $section->section_key }}">
    <div class="container-fluid">
        <header class="managed-section__header">
            <span class="managed-eyebrow">{{ config('content.section_labels.'.$section->section_key, $page->name) }}</span>
            @if($section->heading)<h2>{{ $section->heading }}</h2>@endif
            @if($section->subheading)<p class="managed-section__lead">{{ $section->subheading }}</p>@endif
            @if($section->body_html)<div class="managed-rich-text">{!! $section->body_html !!}</div>@endif
            @if($sectionButtonLabel && $sectionButtonUrl)
                <a class="managed-button" href="{{ $sectionButtonUrl }}">{{ $sectionButtonLabel }}</a>
            @endif
        </header>

        @if($section->activeItems->isNotEmpty())
            <div class="managed-card-grid managed-card-grid--{{ min($section->activeItems->count(), 4) }}">
                @foreach($section->activeItems as $item)
                    <article class="managed-card">
                        @if($item->image)
                            @php
                                $itemImage = str_starts_with($item->image, 'http') ? $item->image : (str_starts_with($item->image, 'content/') ? asset('storage/'.$item->image) : asset($item->image));
                            @endphp
                            <img src="{{ $itemImage }}" alt="{{ $item->image_alt ?: $item->title }}" loading="lazy">
                        @endif
                        @if($item->subtitle)<span class="managed-card__subtitle">{{ $item->subtitle }}</span>@endif
                        @if($item->title)<h3>{{ $item->title }}</h3>@endif
                        @if($item->body)<div class="managed-rich-text">{!! $item->body !!}</div>@endif
                        @if($item->button_url && $item->button_label)
                            <a class="managed-button managed-button--outline" href="{{ url($item->button_url) }}">{{ $item->button_label }}</a>
                        @endif
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>
