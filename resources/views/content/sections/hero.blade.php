@php
    $heroImage = $page->heroImageUrl();
@endphp
<section class="managed-hero" @if($heroImage) style="background-image:linear-gradient(90deg, rgba(0,0,0,.76), rgba(0,0,0,.2)),url('{{ $heroImage }}')" @endif>
    <div class="container-fluid managed-hero__inner">
        <div class="managed-hero__copy">
            <!-- <span class="managed-eyebrow">Enterprise Rent-A-Car Jordan</span> -->
            <h1>{{ $section->heading }}</h1>
            @if($section->subheading)<h2>{{ $section->subheading }}</h2>@endif
            <div class="managed-rich-text">{!! $section->body_html !!}</div>
        </div>
    </div>
</section>
<section class="managed-booking-band" aria-label="Vehicle reservation">
    <div class="container-fluid">
        <div class="hero-form" id="pbk-widget">
            <div class="heading">
                <h2>Reserve a Vehicle</h2>
                <span>or <a href="{{ route('reservation.vMc') }}">View / Modify / Cancel Reservation</a></span>
            </div>
        </div>
    </div>
</section>
