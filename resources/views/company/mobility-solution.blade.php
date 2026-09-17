@extends('layouts.main')

@section('content')

<main class="total-mobility-solutions">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('company.about')}}">About Us</a></li>
                <li>Total Mobility Solutions</li>
            </ul>
        </div>
    </div>

    <section class="total-mobility-banner">
        <a href="#"><figure><img src="{{asset('images')}}/{{$data->image}}" alt="img"></figure></a>
    </section>

    <section class="sec pt-4">
        <div class="container">
            <div class="heading mb-5">
             {!!  $data->content  !!}
            </div>
            <div class="total-mobility-wrapper py-5">
                @foreach($cards as $key=>$card)
                <div class="card-item {{$key % 2 != '0' ? 'flex-row-reverse': ''}}">
                    <div class="card-item--content">
                      {!! $card->detail !!}
                        <a href="{{$card->link}}" class="btn">{{$card->button}}</a>
                    </div>
                    <div class="card-item--img">
                        <figure><img src="{{asset('images')}}/{{$card->image}}" alt="img"></figure>
                    </div>
                </div>
                @endforeach
            
            </div>
        </div>
    </section>

</main>

@endsection