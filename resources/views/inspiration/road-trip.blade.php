@extends('layouts.main')

@section('content')

<main class="">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('inspiration.trip')}}">Road Trips and Driving Guides</a></li>
            </ul>
        </div>
    </div>

    <section class="sec-p hero-logo">
        <div class="container">
            <div class="mt-5 hero-list">
                {!! $data->banner_content !!}
            </div>
        </div>
    </section>

    <section class="sec-p address bg-g">
        <div class="container-fluid">

            <div class="hero-form bg-g mt-0 mb-0 border-0">
                <div class="heading">
                    <h2>Reserve a Vehicle</h2><span> or <a href="{{route('reservation.vMc')}}">View / Modify / Cancel Reservation</a></span>
                </div>
                <div  id="pbk-widget"></div>
             
            </div>

        </div>
    </section>

    <section class="hero-sec-dealership-solutions-technology long-term-car-sec road-trips-sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <figure>
                        <img src="{{asset('images')}}/{{$data->planning_image}}" alt="imgage" style="height:536px">
                    </figure>
                </div>
                <div class="col-lg-6 ul-dot">
                    <div class="txt position-relative">
                        {!! $data->	planning_detail !!}
                        <!-- <a href="https://www.enterprise.com/en/road-trips/planning.html" class="btn">{{$data->planning_button}}</a> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="hero-sec-dealership-solutions-technology long-term-car-sec road-trips-sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0 order-2">
                    <figure>
                        <img src="{{asset('images')}}/{{$data->destination_image}}" alt="imgage" style="height:536px"> 
                    </figure>
                </div>
                <div class="col-lg-6 ul-dot">
                    <div class="txt position-relative">
                         {!! $data->destination_detail !!}
                        <!-- <a href="https://www.enterprise.com/en/road-trips/destinations.html" class="btn">{{$data->destination_button}}</a> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="hero-sec-dealership-solutions-technology long-term-car-sec road-trips-sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <figure>
                        <img src="{{asset('images')}}/{{$data->best_trip_image}}" alt="imgage" style="height:536px">
                    </figure>
                </div>
                <div class="col-lg-6 ul-dot">
                    <div class="txt position-relative">
                        {!! $data->best_trip_detail !!}
                        <!-- <a href="/car" class="btn">{{$data->best_trip_button}}</a> -->
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="road-trips">
        <div class="container">
        <h2 class="mb-5 text-center">{{$data->feature_heading}}</h2>
            <div class="bg-transparent p-0">
                <div class="row">
                    @foreach($cards as $card)
                    <div class="col-lg-6">
                        <div class="grid">
                            <a href="#">                            
                                <figure>
                                    <img src="{{asset('images')}}/{{$card->image}}" alt="images">
                                </figure>
                            </a>
                            <div class="txt">
                                <div>
                                   {!! $card->detail !!}
                                </div>
                                <!-- <a class="btn" href="{{$card->link}}">{{$card->button}}</a> -->
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p cta-sec">
        <div class="container">
            <div class="cta">
                <div class="cta-txt">
                 {!! $data->faq_message !!}
                </div>
                <a href="{{$data->faq_link}}" class="btn">{{$data->faq_button}}</a>
            </div>
        </div>
    </section>

</main>

@endsection
