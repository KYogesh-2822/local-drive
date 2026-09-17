@extends('layouts.main')

@section('content')
<main class="">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="#">Home</a></li>
                <li><a href="#">Enterprise Plus® Program</a></li>
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
                            <img style="background: #fff;" src="{{asset('images/')}}/{{$data->left_column}}" alt="img">
                        </div>
                    </div>
                </div>
                <div class="coloum coloum-center">
                    <div class="txt">
                        {!! $data->center_column !!}
                    </div>
                </div>
                <div class="coloum coloum-right">
                    <div class="login-form" style="background-color: black;">
                        <h3 class="m-0">Enterprise Plus</h3>
                        <h2>Member Login</h2>
                        <figure>
                            <img src="images/eplus-logo.svg" alt="icn-eplus">
                        </figure>
                        <a class="btn btn-w" href="#">Login</a>
                        <a class="btn-txt" href="#">Forgot Password</a>
                        <p>Not a member? <a class="btn-txt" href="#">Join Now</a></p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p bg-g plans">
        <div class="container-fluid">

            <div class="sec-heading inner-heading text-center">
                <h3>Reward Tiers at a Glance</h3>
            </div>

            <div class="row">
                @foreach($rewards as $key=>$reward)
                <div class="col-lg-3">
                    <div class="plan-grid  {{$key == 0 ? 'plus' :($key == 1 ? 'silver' : ($key == 2 ? 'gold' : 'Platinum'))}}">
                        <h3>{{$reward->heading}}</h3>
                        {!! $reward->points !!}
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    <section class="txt-img">
        <div class="container-fluid">
            <div class="row green">
                <div class="col-lg-6">
                    <div class="txt">
                        {!! $data->reward_detail !!}
                        <a class="btn btn-w " href="#">{{$data->reward_button}}</a>
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <figure>
                        <img src="{{asset('images/')}}/{{$data->reward_image}}" alt="img">
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p benefits">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <h3>{{$data->benifit_heading}}</h3>
                </div>
                <div class="col-lg-9">
                    <div class="grid">
                    {!! $data->benifit_detail !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection