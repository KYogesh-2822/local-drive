@extends('layouts.main')

@section('content')

<main class="content">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="#">Home</a></li>
                <li><a href="#">Our Standard of Care</a></li>
            </ul>
        </div>
    </div>


    <section class="hero-sec-single" style="background: #00a664;">
        <div class="container-fluid">
            <h1 class="visually-hidden">Our Standard of Care</h1>
            <figure>
                <img src="{{asset('images/')}}/{{$data->banner_logo}}" alt="our-standard-care" style="object-position: center;">
            </figure>
        </div>
    </section>




    <section class="sec-p two-coloum about-two-coloum">
        <div class="container">
            <div class="cust-row normal-p">
                <div class="coloum coloum-center w-100">
                    <div class="txt">
                        {!! $data->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="sec-p pt-0 logo-txt">
        <div class="container">
            @foreach($cards as $card)
            <div class="row">
                <div class="col-lg-3">
                    <figure>
                        <img src="{{asset('images/')}}/{{$card->logo}}" width="150" height="150" alt="img">
                    </figure>
                </div>
                <div class="col-lg-9">
                    {!! $card->content !!}
   
                </div>
            </div>
            @endforeach

        </div>
    </section>



</main>

@endsection
