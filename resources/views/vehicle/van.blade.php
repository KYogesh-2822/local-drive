@extends('layouts.main')

@section('content')

<main class="">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('vehicle.vans')}}">All Vans in Jordan</a></li>
            </ul>
        </div>
    </div>

    <section class="hero-sec-txt" style="background-image: url('{{asset('images')}}/{{$van->banner_image}}');">
        <div class="container">
            <div class="txt">
                {!! $van->banner_content !!}
                <!-- <a class="btn" href="{{route('vehicle.car')}}">{{$van->banner_button}}</a> -->
            </div>
        </div>
    </section>

    <section class="pt-4 pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    {!! $van->content !!}
                </div>
                <div class="col-lg-6">
                    <div class="btn-grid text-end">
                        <a class="btn btn-bdr" href="{{route('reservation')}}">{{$van->button}}</a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="sec-p cars-sec pt-5">
        <div class="container">
            <div class="d-flex cars-detail">
            @foreach($vehicles as $vehicle)
                <div class="grid img-png-wit">
                    <a href="#">
                        <h4>{{$vehicle->vehicle}}</h4>
                    </a>
                    <span>{{$vehicle->model}}</span>
                    <figure>
                        <img src="{{asset('vehicles/')}}/{{$vehicle->image}}" alt="">
                    </figure>
                    <div class="txt">
                        <ul class="d-flex vehicle-specs-list">
                            @if($vehicle->transmission != '')
                            <li class="vehicle-class-card__specs-item">
                                <i class="icon icon-specs-transmission-gray"></i>
                                <span>{{$vehicle->transmission}}</span>
                            </li>
                            @endif
                            @if($vehicle->passengers != '')
                            <li class="vehicle-class-card__specs-item">
                                <i class="icon icon-specs-passenger-gray"></i>
                                <span>{{$vehicle->passengers}} People</span>
                            </li>
                            @endif
                            @if($vehicle->bags != '')
                            <li class="vehicle-class-card__specs-item">
                                <i class="icon icon-specs-bags-gray"></i>
                                <span>{{$vehicle->bags}} Bags</span>
                            </li>
                            @endif
                        </ul>
                        <a class="btn" href="{{route('vehicle.detail')}}/{{$vehicle->id}}">View details</a>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>

    <section class="sec-p bg-g find-location">
        <div class="container-fluid">



            <div class="hero-form m-auto border-0 bg-transparent">
                <div class="heading">
                    <h2><span class="ps-0">Find a Location</span></h2>
                </div>
                <div  id="pbk-widget"></div> 

            </div>


        </div>
    </section>

    <section class="sec-p other-vehicle-types">
        <div class="container">
            <div class="sec-heading inner-heading">
                <h3>Other Vehicle Types</h3>
            </div>

            <div class="d-flex vehicle-types-main-grid img-png-wit">
                @foreach($others as $other)
                <div class="vehicle-grid">
                    <figure>
                        @if($other->type == 'suv')
                        <img src="{{asset('vehicles/')}}/{{$suv}}" alt="img">
                        @elseif($other->type == 'pickup') 
                        <img src="{{asset('vehicles/')}}/{{$truck}}" alt="img">
                        @else
                        <img src="{{asset('vehicles/')}}/{{$car}}" alt="img">
                        @endif
                    </figure>
                    <div class="txt">
                        <h5><a href="#">All {{$other->type == 'car' ? 'Cars' : ($other->type == 'suv' ? 'SUVs' : 'Truck')}} in Jordan</a></h5>
                        <p>
                            Our SUVs offer plenty of flexibility with seating capacity, power, and luggage room. Whether you are going on a weekend family trip or exploring the countryside we are sure to have the ideal SUV for your needs.
                        </p>
                        <div class="btn-grid">
                            <?php 
                            if($other->type == 'car'){
                                $route = 'vehicle.car';
                            }elseif($other->type == 'suv'){
                                $route = 'vehicle.suvs';
                            }else{
                                $route = 'vehicle.trucks';
                            }   
                            ?>
                            <a class="btn btn-bdr" href="{{route($route)}}">View All {{$other->total}} {{$other->type == 'car' ? 'Cars' : ($other->type == 'suv' ? 'SUVs' : 'Truck')}} Classes</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

</main>

@endsection