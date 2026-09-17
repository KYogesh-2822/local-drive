@extends('layouts.main')

@section('content')


<main class="">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('reservation.subscribeEnterprise')}}">Subscribe with Enterprise</a></li>
            </ul>
        </div>
    </div>


    <section class="hero-sec-single position-relative">
        <div class="container-fluid">

            <figure class="hero-sec-logo">
                <img src="https://www.enterprise.com/content/dam/ent-brand/Brand/subscribe_logo_wh.PNG" alt="hero-sec-logo">
            </figure>

            <figure>
                <img src="{{asset('images')}}/{{$subscribe->banner_image}}" alt="entertainment-production-rentals">
            </figure>
        </div>
    </section>

    <section class="sec-p heading-txt-sec">
        <div class="container">
            <div class="">
                <div class="hero-list">
                    <div class="txt">
                        {!! $subscribe->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p pt-0 ftr-upper heding-txt-h">
        <div class="container">

            <div class="row">
                @foreach($subscribe_cards as $card)
                <div class="col-lg-4">
                    <div class="grid">
                        <h3>{{$card->heading ?? ''}}</h3>
                        <figure>
                            <img src="{{asset('images')}}/{{$card->image ?? ''}}" alt="img">
                        </figure>
                        <div class="txt">
                            <p>{{$card->detail ?? ''}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="sec-p bg-g how-it-work-icn">
        <div class="container">
            <div class="sec-heading inner-heading text-center">
                <h3>{{$subscribe->work_heading}}</h3>
            </div>
            <div class="row">
                @foreach($subscribe_works as $work)
                <div class="col-lg-3">
                    <div class="grid text-center">
                        <figure>
                            <img src="{{asset('images')}}/{{$work->image ?? ''}}" alt="icn">
                        </figure>
                        <div class="txt">
                            <h6>{{$work->heading ?? ''}}</h6>
                            <p>
                               {{$work->detail ?? ''}}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="sec-p bg-g car-rental py-3">
        <div class="container-fluid">
            <div class="pb-0 bg-transparent row address">
                <div class="col-lg-4">
                    <div class="grid">
                        <div class="txt">
                            <a href="{{route('customer.faq')}}">{{$subscribe_link->heading ?? ''}} <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="grid">
                        <div class="txt">
                            <a href="https://www.enterprise.com/en/car-rental-by-month-subscription/how-it-works.html?icid=carrentalbymonthsubscription-_-howitworks-_-ENUS.NULL">{{$subscribe_link->heading1 ?? ''}}<i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="grid">
                        <div class="txt">
                            <a href="{{route('customer.faq')}}">{{$subscribe_link->heading2 ?? ''}} <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p heading-txt-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="txt">
                        {!! $subscribe->last_content !!}
                    </div>
                </div>
            </div>

        </div>
    </section>

</main>
@endsection