@extends('layouts.main')

@section('content')

<main class="">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('reservation.shortTermRental')}}">Short-Term Car Rental</a></li>
            </ul>
        </div>
    </div>

    <section class="hero-sec-dealership-solutions-technology after-before-none">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="txt">
                        <h1>{{$short_term->heading}}</h1>
                        <p>{{$short_term->discription}}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <figure>
                        <img src="{{asset('images')}}/{{$short_term->image}}" alt="imgage">
                    </figure>
                </div>
            </div>
        </div>
    </section>



    <section class="bg-white p-0 sec-p address">
        <div class="container-fluid">
            <div class="hero-form m-auto border-0 bg-transparent">
                <div class="heading">
                    <h2><span>Reserve a Vehicle</span></h2> <span>or <a href="{{route('reservation.vMc')}}">View / Modify / Cancel Reservation</a></span>
                </div>
                <div class="form">
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
                </div>
            </div>
        </div>
    </section>


    <section class="sec-p bg-g ul-dot points">
        <div class="container">
            <div class="row gap-10">
                <div class="col-lg-6">
                    <div class="txt">
                        {!! $short_term->shortTerm_benefit !!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="txt">
                        {!! $short_term->why_shortTerm !!}
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="sec-p ftr-upper heding-txt-h">
        <div class="container">
            <div class="row">
               @foreach($short_term_cards as $term_card)
               <div class="col-lg-3">
                    <div class="grid">
                        <h3>{{$term_card->heading}}</h3>
                        <figure>
                            <img src="{{asset('images')}}/{{$term_card->image}}" alt="img">
                        </figure>
                        <div class="txt">
                            <p>{{$term_card->detail}}</p>
                            <a class="btn" href="{{$term_card->link}}">{{$term_card->button}}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <section class="hero-sec-dealership-solutions-technology long-term-car-sec">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-6 p-0">
                    <figure>
                        <img src="{{asset('images')}}/{{$short_term->business_image}}" alt="imgage">
                    </figure>
                </div>
                <div class="col-lg-6 ul-dot">
                    <div class="txt position-relative">
                        {!! $short_term->business_text !!}
                        <a href="" class="btn">{{$short_term->business_button}}</a>

                    </div>
                </div>

            </div>
        </div>
    </section>





</main>

@endsection