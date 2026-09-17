@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/content-pages.css') }}">
@endpush

@section('content')
<div class="managed-content-page managed-home-page">
    @foreach($page->activeSections as $section)
        @if($section->section_key === 'hero')
            @include('content.sections.hero', ['section' => $section])
        @elseif($section->section_key === 'fleet')
            @include('content.sections.fleet', ['section' => $section])
        @elseif($section->section_key === 'safety')
            @include('content.sections.safety', ['section' => $section])
        @elseif($section->section_key === 'booking_process')
            @include('content.sections.booking-process', ['section' => $section])
        @elseif($section->section_key === 'destinations')
            @include('content.sections.destinations', ['section' => $section])
        @elseif($section->section_key === 'blogs')
            @include('content.sections.blog-grid', ['section' => $section])
        @elseif($section->section_key === 'cta')
            @include('content.sections.cta', ['section' => $section])
        @else
            @include('content.sections.standard', ['section' => $section])
        @endif
    @endforeach

    @include('content.sections.faq', ['heading' => 'Frequently Asked Questions'])
</div>

@include('content.partials.structured-data', [
    'breadcrumbs' => [['name' => 'Home', 'url' => url('/')]],
])
@endsection

@push('scripts')
<script>
    window.pbk = { settings: { kicker: '#pbk-widget', contentContainer: '#pbk-widget2mk', brand: 'ET' } };
    (function () {
        var d = document, l = d.createElement('link'), s = d.createElement('script');
        var u = 'https://widget-cdn.partnerbookingkit.com/bundles/82c62ca4123d9/widget.';
        l.href = u + 'css'; l.rel = 'stylesheet'; d.head.appendChild(l);
        s.src = u + 'js'; s.async = true; d.head.appendChild(s);
    })();
</script>
@endpush
