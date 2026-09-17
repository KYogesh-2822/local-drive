@extends('layouts.main')

@section('content')

<main class="">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('company.about')}}">About Us</a></li>
            </ul>
        </div>
    </div>

    <section class="sec-p about-heading">
        <div class="container">
           {!! $data->heading !!}
        </div>
    </section>

    <section class="pt-0 sec-p three-coloum about-three-coloum">
        <div class="container">
            <div class="cust-row">
                <div class="coloum coloum-left">
                    <div class="txt">
                        <div class="icn">
                            <img src="{{asset('images/')}}/{{$data->left_column}}" alt="img">
                        </div>
                    </div>
                </div>
                <div class="coloum coloum-center">
                    <div class="">
                         {!! $data->center_column !!}
                    </div>
                </div>
                <div class="coloum coloum-right">
                    <div class="">
                         {!! $data->right_column !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="colage">
        <div class="container-fluid">
            <div class="row">
                @foreach($images as $image)
                <div class="col-lg-3">
                    <div class="grid">
                        <figure>
                            <img src="{{asset('images/')}}/{{$image->image}}" alt="img">
                        </figure>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="sec-p three-coloum about-three-coloum">
        <div class="container">
            <div class="cust-row">
                <div class="coloum coloum-left">
                    <div class="txt text-center">
                        <h4>{{$data->value_heading}}</h4>
                    </div>
                </div>
                <div class="coloum coloum-center">
                    <div class="">

                        {!! $data->value_content !!}

                    </div>
                </div>
                <div class="coloum coloum-right">
                    <div class="txt">
                        <figure>
                            <img src="{{asset('images/')}}/{{$data->value_image}}" alt="img">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p slider-mileston">
        <div class="container-fluid">

            <div class="slider-mileston-grid slider">
                @foreach($sliders as $slider)
                <div class="slide">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="txt">
                               {!! $slider->content !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <figure>
                                <img src="{{asset('images/')}}/{{$slider->image}}" alt="img">
                            </figure>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- <section class="sec-p ftr-upper">
        <div class="container">
            <div class="row">
                @foreach($cards as $card)
                <div class="col-lg-4">
                    <div class="grid">
                        <h3>{{$card->heading}}</h3>
                        <figure>
                            <img src="{{asset('images/')}}/{{$card->image}}" alt="img">
                        </figure>
                        <div class="txt">
                            <p>{{$card->detail}}</p>
                            <a class="btn" href="{{$card->link}}">{{$card->button}}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section> -->

    <!-- <section class="sec-p take-the-road" style="background-image: url('{{asset('images/')}}/{{$data->banner_image}}');">
        <div class="container">
            <div class="txt">
                {!! $data->banner_content !!}
                <a class="btn" href="https://www.enterprise.com/en/inspiration.html">{{$data->banner_button}} </a>
            </div>
        </div>
    </section> -->

</main>

@endsection