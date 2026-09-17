@extends('layouts.main')

@section('content')

<main class="">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('business.carRental')}}">Car Rental</a></li>
                <li><a href="{{route('customer.contact')}}">Contact us</a></li>
            </ul>
        </div>
    </div>

    <section class="bg-white sec-p address">
        <div class="container-fluid">
            <h1 class="visually-hidden">Contact Enterprise Rent-A-Car Jordan</h1>
            <div class="sec-heading inner-heading text-center">
                {!!$data->banner_content ?? ''!!}
            </div>
            <div class="row">
                @foreach($cards as $card)
                <div class="">
                    <div class="grid">
                        <figure>
                            <img src="{{asset('images')}}/{{$card->image}}" alt="icn">
                        </figure>
                        <div class="txt">
                            <a href="{{$card->link}}">{{$card->heading}} <i class="fa fa-angle-right"></i></a>
                            {!! $card->detail !!}
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </section>

    <section class="sec-p contact-detail">
        <div class="container">
            <div class="grid">
                {!!$data->section1Content ?? ''!!}      
            </div>
            <div class="grid">
                {!!$data->section2Content ?? ''!!}                
            </div>
            <div class="grid">
                {!!$data->section3Content ?? ''!!}
            </div>
            <div class="grid">
                {!!$data->section4Content ?? ''!!}
            </div>
            <div class="grid">
               {!!$data->section5Content ?? ''!!}
            </div>
            <div class="grid">
                {!!$data->section6Content ?? ''!!}
            </div>
        </div>
    </section>

    <section class="sec-p p-0 contact-img">
        <div class="container-fluid">
            <div class="">
                <img src="{{asset('images')}}/{{$data->banner_image}}" alt="img">
            </div>
        </div>
    </section>

    <section class="sec-p cont-adress-bottm">
        <div class="container">
            {!!$data->last_section!!}
        </div>
    </section>

</main>

@endsection
