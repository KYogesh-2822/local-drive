@extends('layouts.main')

@section('content')
<main class="">

    <section class="hero-sec" style="background-image:url('./images/{{$banner->image}}')">   
        <!-- heropic.jpg -->
        <!-- <div class="container">
            <div class="register-row">
                <p><b><i class="fa fa-tags"></i> Plus Your Points:</b> You can earn double points on qualifying rentals through 1/31/2023. Terms apply. <a href="{{route('enterprise.join')}}">Register Now</a></p>
            </div>
        </div> -->
    </section>
    
    <section class="sec-p address">
        <div class="container-fluid"  >

            <div class="hero-form" id="pbk-widget">
                 <div class="heading">
                    <h1>Reserve a Vehicle</h1> <span>or <a href="{{route('reservation.vMc')}}">View / Modify / Cancel Reservation</a></span>
                </div>
                <!-- <div class="heading">
                    <h1>Reserve a Vehicle</h1> <span>or <a href="{{route('reservation.vMc')}}">View / Modify / Cancel Reservation</a></span>
                </div>
                <div class="form">
                    <form>
                        <div class="form-group">
                            <div class="num">1</div>
                            <label class="form-label form-label-two">Pick-up & Return Location* <cite>* Required Field</cite></label>
                            <input type="email" class="form-control" placeholder="ZIP, City or Airport">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck11">
                            <label class="form-check-label" for="exampleCheck11">Return to a different location <i class="fa fa-info-circle"></i></label>
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
       

            <div class="row">
                @foreach($offers as $offer)
                <div class="col-lg-6">
                    <div class="grid">
                        <figure>
                            <img src="images/{{$offer->icon_image}}" alt="icn">
                        </figure>
                        <div class="txt">
                            <a href="{{$offer->link}}"> {{$offer->heading}} <i class="fa fa-angle-right"></i></a>
                            <p>{{$offer->discription}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="slider-car">
                <div class="sec-heading inner-heading text-center">
                    <h4>Meet the Fleet.</h4>
                    <p>From SUVs to pickup trucks, wherever you go, we’ve got your ride.</p>
                </div>

                <div class="car-slider slider">
                    @foreach($vehicles as $vehicle)
                    <div class="slide">
                        <div class="slide-grid img-png-wit">
                            <figure>
                                <img src="{{asset('vehicles/')}}/{{$vehicle->image}}" alt="image" style="width: 512px; height: 371px;">
                            </figure>
                            <div class="txt text-center">
                                <h4>{{$vehicle->vehicle}}</h4>
                                <p></p>
                                <!-- <p>{{$vehicle->vehicle}} can include upgraded amenities like {{trim($vehicle->features,'"')}}.</p> -->
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
            <div class="btn-grid text-center">
                <a class="btn" href="{{route('vehicle.vechicle')}}">View All Vehicles</a>
            </div>
        </div>
    </section>
{{-- 
    <section class="sec-p locations">
        <div class="container">
            <div class="mb-2 sec-heading inner-heading">
                <h3>Popular US Locations</h3>
            </div>
            <div class="location-grid">
                <div class="row">
                    <div class="col-lg-3">
                        <ul>
                            <li><a href="{{route('location.us')}}">Los Angeles, CA</a></li>
                            <li><a href="{{route('location.us')}}">Orlando, FL</a></li>
                            <li><a href="{{route('location.us')}}">Atlanta, GA</a></li>
                            <li><a href="{{route('location.us')}}">San Diego, CA</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3">
                        <ul>
                            <li><a href="{{route('location.us')}}">Denver, CO</a></li>
                            <li><a href="{{route('location.us')}}">Miami, FL</a></li>
                            <li><a href="{{route('location.us')}}">Tampa, FL</a></li>
                            <li><a href="{{route('location.us')}}">Ft. Lauderdale, FL</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3">
                        <ul>
                            <li><a href="{{route('location.us')}}">Phoenix, AZ</a></li>
                            <li><a href="{{route('location.us')}}">Las Vegas, NV</a></li>
                            <li><a href="{{route('location.us')}}">Seattle, WA</a></li>
                            <li><a href="{{route('location.us')}}">Detroit, MI</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3">
                        <ul>
                            <li><a href="{{route('location.us')}}">San Francisco, CA</a></li>
                            <li><a href="{{route('location.us')}}">Boston, MA</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
 
     <section class="sec-p blog-coloums">
        <div class="container-fluid">
            <div class="row justify-content-center">
                @foreach($blogs as $blog)
                <div class="col-lg-3">
                    <div class="grid">
                        <figure>
                            <img src="{{asset('images')}}/{{$blog->image}}" alt="images">
                        </figure>
                        <div class="txt">
                            <h6>{{$blog->heading}}</h6>
                            <p>
                              {{$blog->discription}}
                            </p>
                            <a class="btn" href="{{$blog->link}}">{{$blog->button}} <i class="fa fa-external-link"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

  <!--  <section class="sec-p blog-coloums">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <div class="col-lg-3">
                    <div class="grid">
                        <figure>
                            <img src="images/ENT-SOC-Home-Page.png" alt="images">
                        </figure>
                        <div class="txt">
                            <h6>Our Standard of Care</h6>
                            <p>
                                Our commitment to ensure that you always
                                have a clean, well-maintained vehicle.
                            </p>
                            <a class="btn" href="#">Learn More</a>
                        </div>
                    </div>
                </div>
             
            </div>
        </div>
    </section> -->
    

    <section class="sec-p car-rental">
        <div class="container-fluid">
            <div class="sec-heading inner-heading text-center">
                <h3>{{$carHead->heading ?? ''}}</h3>
                <!-- <p>Enterprise Rent-A-Car provides more than just traditional car rental. We're your <a href="#">global transportation solution.</a></p> -->
                <p>{{$carHead->detail ?? ''}}</a></p>
            </div>
            <div class="pb-0 bg-transparent row address">
                @foreach($carsOffres as $offer)
                <div class="col-lg-12">
                    <div class="grid">
                        <div class="txt">
                            <a href="/{{$offer->offer_link}}">{{$offer->offer_heading}} <i class="fa fa-angle-right"></i></a>
                            <p>{{$offer->offer_detail}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="bg-transparent p-0 blog-coloums">
                <div class="row">
                    @foreach($cards as $card)
                    <div class="col-lg-4">
                        <div class="grid">
                            <figure>
                                <img src="{{asset('images/')}}/{{$card->card_image}}" alt="images">
                            </figure>
                            <div class="txt">
                                <div>
                                    <b>{{$card->image_title}}</b>
                                    <h2>{{$card->card_heading}}</h2>
                                    <p>
                                        {{$card->card_detail}}
                                    </p>
                                </div>
                                <a class="btn" href="{{$card->card_link}}">{{$card->button}}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>                            
            </div>
        </div>
    </section>

</main>
<script type="text/javascript">
var pbk = {
  "settings" : {
    "kicker" : "#pbk-widget",
    "contentContainer" : "#pbk-widget2mk",
    "brand" : "ET"
  }

};

(function(){
    var d=document,
    l=d.createElement('link'),
    s=d.createElement('script'),
    u='https://widget-cdn.partnerbookingkit.com/bundles/82c62ca4123d9/widget.';
    l.href=u+'css';
    l.rel='stylesheet';
    d.head.appendChild(l);
    s.src=u+'js';
    s.async=true;d.head.appendChild(s)
    })();

 </script> 

@endsection