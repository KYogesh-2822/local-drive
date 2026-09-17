@extends('layouts.main')

@section('content')

@php
    $demoteEmbeddedH1 = static fn ($html) => str_ireplace(
        ['<h1', '</h1>'],
        ['<h2', '</h2>'],
        (string) $html
    );
@endphp

<main class="meet-our-people">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('company.about')}}">About Us</a></li>
                <li><a href="{{route('company.meetPeople')}}">Life at Enterprise</a></li>
            </ul>
        </div>
    </div>


    <section class="pb-0 sec-p main-heading">
        <div class="container">
            {!! $data->heading !!}
        </div>
    </section>

    <section class="py-5 sec-p">
        <div class="container">
            <div class="row px-4">
                <div class="col-lg-6">
                    {!! $demoteEmbeddedH1($data->content) !!}
                </div>
                <div class="col-lg-6">
                    {!! $demoteEmbeddedH1($data->content_right) !!}
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="sec-p our-people-slider pt-0">
        <div id="carouselExampleFade" class="carousel slide carousel-fade">
            <div class="carousel-inner">
                @foreach($slider_cards as $key=>$slider)
                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                    <div class="our-people-card">
                        <div class="people-img">
                            <figure><img src="{{asset('images')}}/{{$slider->image ?? ''}}" alt="img"></figure>
                        </div>
                        <div class="people-details">
                            {!! $demoteEmbeddedH1($slider->detail ?? '') !!}
                        </div>
                    </div>
                </div>
                @endforeach
             
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section> -->

    <section class="sec-p our-culture">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>{{$data->culture_heading}}</h3>
                </div>
                <div class="col-md-8">
                    {!! $demoteEmbeddedH1($data->culture_content) !!}
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="sec-p people-yt-video">
        <div class="container-fluid">
            <div class="row justify-content-evenly">
                @foreach($data_review as $review)
                <div class="col-lg-5">
                    <div class="video-card">
                        <h5 class="sub-title">{{$review->name ?? ''}}</h5>
                        <div class="yt-img">
                            <figure><img src="{{asset('images')}}/{{$review->image}}" alt="img"></figure>
                        </div>
                        <p class="yt-desc mt-4">{{$review->detail ?? ''}}</p>
                        <a href="{{$review->video ?? ''}}" class="card-link"></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section> -->

    <!-- <section class="sec-grid">
        <div class="container-fluid">
            @foreach($data_card as $key=>$card)
            <div class="card-item {{$key % 2 != 0 ? 'flex-row-reverse' : ''}}">
                <div class="card-item-img order-lg-2">
                    <figure>
                        <img src="{{asset('images')}}/{{$card->image}}" alt="img">
                    </figure>
                </div>
                <div class="card-item-content">
                    {!! $demoteEmbeddedH1($card->detail ?? '') !!}
                    <a href="{{$card->link}}" class="btn btn-arrow">{{$card->button}} <i class="fa fa-external-link"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </section> -->

    <section class="sec-p">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h3>{{$data->road_heading ?? ''}}</h3>
                </div>
                <div class="col-lg-8">
                    {!! $demoteEmbeddedH1($data->road_content) !!}
                    <a href="{{url('career-form')}}" class="btn btn-arrow">{{$data->road_button}}</a>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection
