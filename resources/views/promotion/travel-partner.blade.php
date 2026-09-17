@extends('layouts.main')

@section('content')

<main class="travel-partners">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('promotion.travelPartner')}}">Enterprise Partner Rewards Programs</a></li>
            </ul>
        </div>
    </div>

    <section class="travel-partners--sec pt-5">
        <div class="container">
            {!! $program->content !!}
        </div>
    </section>

    <section class="sec-p">
        <div class="container">
            <div class="travel-partners-logo">
                <div class="row">
                    @foreach($reward_images as $images)
                    <div class="col-lg-4">
                        <figure><img src="{{asset('images')}}/{{$images->image}}" alt=""></figure>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

</main>

@endsection