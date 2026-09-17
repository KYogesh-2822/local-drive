@php
    $seoTitle = $seo['title'] ?? 'Enterprise Rent-A-Car Jordan';
    $seoDescription = $seo['description'] ?? 'Enterprise Rent-A-Car Jordan provides dependable vehicles and flexible rental options.';
    $seoCanonical = $seo['canonical'] ?? url()->current();
    $seoImage = $seo['image'] ?? null;
    if ($seoImage && !str_starts_with($seoImage, 'http')) {
        $seoImage = str_starts_with($seoImage, 'content/') ? asset('storage/'.$seoImage) : asset($seoImage);
    }
@endphp
<title>{{ $seoTitle }}</title>
<meta name="description" content="{{ $seoDescription }}">
<link rel="canonical" href="{{ $seoCanonical }}">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:type" content="{{ $seo['type'] ?? 'website' }}">
<meta property="og:url" content="{{ $seoCanonical }}">
@if($seoImage)<meta property="og:image" content="{{ $seoImage }}">@endif
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDescription }}">
@if($seoImage)<meta name="twitter:image" content="{{ $seoImage }}">@endif
@if(!empty($isPreview))<meta name="robots" content="noindex, nofollow">@endif
