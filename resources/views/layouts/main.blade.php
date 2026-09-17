<!doctype html>
<html>

<head>
  
    @include("layouts.links")
    
    

    <!-- Google Tag Manager --> 

    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': 

    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], 

    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 

    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); 

    })(window,document,'script','dataLayer','GTM-XXX');</script> 

    <!-- End Google Tag Manager --> 

    <!-- New GTM Script -->

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-C2TMCKPPSP"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-C2TMCKPPSP');
    </script>
    
    
    <!--Start Microsoft Clarity-->
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "xg4b36fyth");
    </script>
    <!--End Microsoft Clarity-->
    

    
    
    <!-- Organization Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Enterprise Rent-A-Car Jordan",
      "url": "https://enterprise.jo/",
      "logo": "https://enterprise.jo/assets/images/logo.png",
      "description": "Enterprise Rent-A-Car Jordan is a trusted car rental provider offering reliable mobility solutions across Jordan. With a diverse fleet of well-maintained vehicles, convenient rental locations, and flexible short and long-term rental options, Enterprise serves both leisure and business travellers. Customers can enjoy transparent pricing, exceptional customer service, and seamless booking for airport and city rentals."
    }
    </script>
    
    <!-- Car Rental Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "CarRental",
      "name": "Enterprise Rent-A-Car Jordan",
      "url": "https://enterprise.jo/",
      "description": "Enterprise Jordan offers professional car rental services with a wide selection of economy cars, sedans, SUVs, luxury vehicles, and vans to suit every travel need. Whether you require a vehicle for a business trip, family holiday, airport transfer, or long-term mobility, Enterprise provides flexible rental periods, quality vehicles, and dependable customer support throughout Jordan."
    }
    </script>

    <!-- Website Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "Enterprise Rent-A-Car Jordan",
      "url": "https://enterprise.jo/",
      "description": "https://enterprise.jo is the official website of Enterprise Rent-A-Car Jordan, allowing customers to easily browse available vehicles, compare rental options, make online reservations, manage bookings, and access rental policies. The website provides information on car hire services, airport rentals, business rentals, special offers, and rental locations throughout Jordan."
    }
    </script>

    @stack('styles')
    @stack('structured-data')
</head>

<body>
    
    <!-- Google Tag Manager (noscript) --> 

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-XXX" 

    height="0" width="0" class="gtm-noscript-frame"></iframe></noscript> 

    <!-- End Google Tag Manager (noscript) --> 

    @if(Route::is('reservation.carSelect') || Route::is('reservation.addExtras') || Route::is('reservation.reviewReserve'))
       @include("partials.header-inner")
     @else
      @include("partials.header")
    @endif
        <main class="content">
        @yield('content')
        </main>

    @include("partials.footer")

    @include("layouts.scripts")
    @stack('scripts')
</body>

</html>
