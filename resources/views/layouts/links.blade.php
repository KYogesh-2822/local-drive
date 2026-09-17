    <meta charset="utf-8">
    @if(isset($seo))
        @include('content.partials.seo')
    @else
        <title>Car Rental Jordan | Best Car Hire & Airport Car Rentals</title>
        <meta name="description" content="Enterprise offers car rental in Jordan with premium, luxury and economy vehicles. Enjoy airport pickup, flexible booking and great value rates.">
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(filled(config('services.bing.webmaster_verification')))
        <meta name="msvalidate.01" content="{{ config('services.bing.webmaster_verification') }}">
    @endif
    @stack('preloads')
    <link rel="preload" href="{{ asset('fonts/site-fonts/DIN2014-Regular.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/site-fonts/DIN2014-Bold.woff2') }}" as="font" type="font/woff2" crossorigin>
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.png" sizes="32x32" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> 
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/ProjectName.css')}}">
    <link rel="stylesheet" href="{{asset('css/developer.css')}}">
    <link rel="stylesheet" href="{{asset('css/reservation.css')}}">
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom_developer.css')}}">
  
