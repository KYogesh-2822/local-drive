<section class="managed-cta">
    <div class="container-fluid managed-cta__inner">
        <div>
            <span class="managed-eyebrow">Ready when you are</span>
            <h2>{{ $section->heading }}</h2>
            <div class="managed-rich-text">{!! $section->body_html !!}</div>
        </div>
        @foreach($section->activeItems as $item)
            @if($item->button_url && $item->button_label)
                <a class="managed-button" href="{{ url($item->button_url) }}">{{ $item->button_label }}</a>
            @endif
        @endforeach
    </div>
</section>
