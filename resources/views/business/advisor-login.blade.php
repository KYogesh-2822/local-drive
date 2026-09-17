@extends('layouts.main')

@section('content')

<main class="travel-advisor">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('business.advisorLogin')}}">Travel Advisor Login</a></li>
            </ul>
        </div>
    </div>

    <section class="sec-p welcome-sec">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-8">
                    {!! $data->advisor_banner !!}
                </div>
                <div class="col-lg-4">
                    <form class="login-form" style="background-color: black;">
                        <h4 class="mb-4">Current User Login</h4>
                        <div class="form-group">
                            <label class="form-label">IATA, ARC, CLIA or TRUE Number*</label>
                            <input type="text" class="form-control">
                        </div>
                        <a class="btn btn-w" href="#">Login</a>
                        <div class="welcome-signup">
                            <h3 class="mb-0">IATA Not Registered?</h3>
                            <a class="btn-txt" href="#">Sign Up</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="logo-cta-sec">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <figure><img src="{{asset('images/')}}/{{$data->pledge_image}}" alt="img"></figure>
            </div>
            <div class="col-lg-6">
                <div class="logo-cta-desc">
                    {!! $data->pledge_detail !!}
                    <a href="#" class="btn">{{$data->pledge_button}}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p pb-0">
        <div class="container">
            {!! $data->policy_content !!}
        </div>
    </section>

    <section class="sec-p">
        <div class="container">
            <h2 class="mb-4">{{$data->guide_heading}}</h2>
            <ul>
                @foreach($guides as $guide)
                <li>
                    <a href="{{$guide->link}}" class="btn-txt">{{$guide->heading}}<i class="fa fa-external-link"></i></a>
                </li>
                @endforeach
            </ul>
        </div>
    </section>

</main>

@endsection