@extends('layouts.main')

@section('content')
<style>
    .offer-container {
    box-shadow: 9px -8px 11px 21px rgba(22.000000000000007, 154, 90.00000000000006, 0.34);
    width: 90%;
    margin: 50px auto;
    padding: 25px;
    text-align: center;
    transition: background .3s, border .3s, border-radius .3s, box-shadow .3s, transform var(--e-transform-transition-duration, .4s);
}

.offer-container:hover {
    box-shadow: 0px 0px 10px 0px rgba(22.000000000000007, 154, 90.00000000000006, 0.34);
  
}

.offer-container h3 , .offer-container h2 {
    font-family: 'DN', sans-serif !important;
    font-size: 14px !important;
    font-weight: 700 !important;
    line-height: 18px !important;
    letter-spacing: 0px !important;
    font-style: normal !important;
    text-transform: uppercase !important;
    color: #000;
    margin-bottom: 15px;
}

.offer-container p {
    font-size: 17px !important;
    font-weight: 300 !important;
    line-height: 24px !important;
    letter-spacing: -0.25px !important;
    font-style: normal !important;
    margin-bottom: 15px;
}

.address .hero-form #pbk-widget {
    background-color: #F3F3F3;
    margin: 0px 0px 0px 0px;
    padding: 20px 20px 20px 20px;
    border-style: solid;
    border-width: 1px 1px 1px 1px;
    border-color: #000000;
    box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.5);
}
.hero-form #enterprise-pbk {
    padding: 0 !important;
}
.banner-deal-promotions img {
    object-fit: cover;
    height: 100%;
}
</style>
<main class="">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('reservation')}}">Car Rental</a></li>
                <li><a href="{{route('promotion')}}">Deals & Promotions</a></li>
            </ul>
        </div>
    </div>

    <section class="banner-deal-promotions">
    <img src="{{ asset('images/deal-prom-banner.png') }}" width="1920" height="331" alt="Deal Promo Banner">
    </section>

    <section class="pb-0 sec-p main-heading">
        <div class="container">
            <h1>{{$data->heading ?? ''}}</h1>
            @if (!empty($data->message))
                <div class="main-heading-grey">
                    {{ $data->message }}
                </div>
            @endif
        </div>
    </section>

    <section class="bg-white pt-3 sec-p address">
        <div class="container-fluid">


            <div class="hero-form m-auto  border-0 bg-transparent">
                <!-- <div class="heading">
                    <h2><span>Book This Special</span></h2> <span>or <a href="#">View / Modify / Cancel Reservation</a></span>
                </div> -->
                <div  id="pbk-widget">
                    <div class="heading">
                        <h2><span>Book This Special</span></h2> <span>or <a href="#">View / Modify / Cancel Reservation</a></span>
                        </div>
                    </div> 

               
                <!-- <div class="form">
                    <form>
                        <div class="form-group">
                            <div class="num">1</div>
                            <label class="form-label form-label-two">Pick-up &amp; Return Location* <cite>* Required Field</cite></label>
                            <input type="email" class="form-control" placeholder="ZIP, City or Airport">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Return to a different location <i class="fa fa-info-circle"></i></label>
                        </div>

                        <div class="date-grid">
                            <div class="form-group">
                                <div class="num">2</div>
                                <label class="form-label">Return Location (Postal Code, City or Airport)*</label>
                                <input type="email" class="form-control" placeholder="Provide a Return Location">
                            </div>
                        </div>

                    </form>
                </div> -->
            </div>

            <!-- <div class="row">
                @foreach($cards as $card)
                <div class="col-lg-4">
                    <div class="grid">
                        <figure>
                            <img src="{{asset('images')}}/{{$card->image}}" alt="icn">
                        </figure>
                        <div class="txt">
                            <a href="{{$card->link}}">{{$card->heading ?? ''}} <i class="fa fa-angle-right"></i></a>
                            <p>{{$card->detail ?? ''}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div> -->

        </div>
    </section>

    <section class="offer-sec">
    <div class="offer-container">
                    <h2>OFFER DETAILS</h2>
                    <p>This offer includes <span class="highlight">10% discount</span> + <span class="highlight">free additional driver</span> from Enterprise locations in UAE, KSA, Qatar, Jordan, Oman, and Egypt, on the daily or weekly car price when booking.</p>

                    <h3 class="section-title">AVAILABLE</h3>
                    <p>To take advantage of this offer, reservations must be made at least twenty-four (24) hours prior to the start of the expected rental period.</p>
                    <p>This offer applies to all vehicle categories and is subject to availability at the time of booking. This offer cannot be combined with any other offers, discounts, or previous or existing bookings. Enterprise reserves the right to amend or cancel this offer at any time.</p>

                    <h3 class="section-title">ELIGIBILITY AND RENTAL REQUIREMENTS</h3>
                    <p>All rentals are subject to the terms and conditions set forth upon receipt of the vehicle from the Enterprise Car Rental website. These terms are in addition to the offer details.</p>
                    <p>Bookings also require verification of driver eligibility according to the requirements specified at the time of booking, and additional fees may be imposed for young drivers.</p>
                </div>
    </section>



</main>

<!-- <script type="text/javascript">
var pbk = {
  "settings" : {
    "kicker" : "#pbk-widget",
    "contentContainer" : "#pbk-widget"
  }
};
(function(){var d=document,l=d.createElement('link'),s=d.createElement('script'),u='https://widget-cdn.partnerbookingkit.com/bundles/82c62ca4132ec/widget.';l.href=u+'css';l.rel='stylesheet';d.head.appendChild(l);s.src=u+'js';s.async=true;d.head.appendChild(s)})();
</script> -->
<script type="text/javascript">
var pbk = {
  "settings" : {
    "kicker" : "#pbk-widget",
    "contentContainer" : "#pbk-widget"
  }
};

(function(){var d=document,l=d.createElement('link'),s=d.createElement('script'),u='https://widget-cdn.partnerbookingkit.com/bundles/82c62ca4139ce/widget.';l.href=u+'css';l.rel='stylesheet';d.head.appendChild(l);s.src=u+'js';s.async=true;d.head.appendChild(s)})();
</script>
@endsection
