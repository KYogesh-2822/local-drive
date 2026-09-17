@extends('layouts.main')

@push('preloads')
@if($page->heroImageUrl())
<link rel="preload" as="image" href="{{ $page->heroImageUrl() }}" fetchpriority="high">
@endif
@endpush

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
