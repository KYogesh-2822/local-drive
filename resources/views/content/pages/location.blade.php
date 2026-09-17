@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/content-pages.css') }}">
@endpush

@section('content')
<div class="managed-content-page managed-location-page">
    @foreach($page->activeSections as $section)
        @if($section->section_key === 'hero')
            @include('content.sections.hero', ['section' => $section])
        @elseif($section->layout === 'fleet-cards')
            @include('content.sections.fleet', ['section' => $section])
        @elseif($section->layout === 'safety-list')
            @include('content.sections.safety', ['section' => $section])
        @elseif($section->layout === 'destination-grid')
            @include('content.sections.destinations', ['section' => $section])
        @elseif($section->layout === 'booking-process')
            @include('content.sections.booking-process', ['section' => $section])
        @elseif($section->section_key === 'blogs')
            @include('content.sections.blog-grid', ['section' => $section])
        @elseif($section->section_key === 'cta')
            @include('content.sections.cta', ['section' => $section])
        @else
            @include('content.sections.standard', ['section' => $section])
        @endif
    @endforeach

    @include('content.sections.faq', ['heading' => $page->name.' Car Rental FAQs'])
</div>

@include('content.partials.structured-data', [
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Locations', 'url' => url('/jordan-car-rental-locations')],
        ['name' => $page->name, 'url' => $page->publicUrl()],
    ],
])
@endsection
