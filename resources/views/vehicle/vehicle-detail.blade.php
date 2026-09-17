@extends('layouts.main')

@section('content')

<main class="content">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="#">Home</a></li>
                <li><a href="#">All Cars in Jordan</a></li>
            </ul>
        </div>
    </div>


    <section class="px-0 pb-0 txt-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-capitalize">{{$data->vehicle}} Rental</h1>
                    <div class="txt mt-3">
                        <p class="text-start">Rent an economy car for driving in crowded, downtown areas with busy traffic and tight parking spaces. Economy car rentals typically offer the best fuel efficiency. Reserve now and get low rates on an economy car rental from Enterprise Rent-A-Car.
                        </p>
                    </div>
                    <div class="txt mt-3">
                        <b>What is an economy car rental?</b>
                        <p class="text-start">Economy cars are smaller vehicles that typically seat up to four passengers. Their high fuel economy makes them great for city driving, while their size makes them easy to maneuver through traffic.</p>
                    </div>
                    <div class="txt mt-3">
                        <b>What is the difference between economy and compact car rental?</b>
                        <p class="text-start">The main difference between an economy car and a compact car is the size of the vehicle. Compact cars are a bit smaller than economy cars. Both of these vehicle classes are very fuel efficient. </p>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <section class="sec-p cars-sec sec-car-detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="txt cars-detail">
                        <h3 class="car-name">{{$data->model ?? ''}}</h3>

                        <hr style="background: #000; opacity: 1; height: 5px;">

                        <div class="d-flex">

                            <ul class="vehicle-specs-list">
                                <li><b>DETAILS</b></li>
                                <li class="vehicle-class-card__specs-item">
                                    <i class="icon icon-specs-transmission-gray"></i>
                                    <span>{{$data->transmission ?? '' }}</span>
                                </li>
                                <li class="vehicle-class-card__specs-item">
                                    <i class="icon icon-specs-passenger-gray"></i>
                                    <span>{{$data->passengers ?? '' }} People</span>
                                </li>
                                <li class="vehicle-class-card__specs-item">
                                    <i class="icon icon-specs-bags-gray"></i>
                                    <span>{{$data->bags ?? '' }} Bags</span>
                                </li>
                            </ul>

                             <?php
                                 $features = trim($data->features,'"');
                                 $feature = explode(",",$features);
                             ?>
                         
                            <ul class="car-features__list">
                                <li><b>FEATURES</b></li>
                                @foreach($feature as $fea)
                                <li class="car-features__list-item">{{$fea}}</li>
                                @endforeach
                            </ul>


                        </div>
                    </div>
                </div>

                <div class="col-lg-6 img-png-wit">
                    <figure class="text-center">
                        <img src="{{asset('vehicles/')}}/{{$data->image}}" alt="">
                    </figure>
                </div>

            </div>
        </div>
    </section>


    <section class="p-0 sec-p address">
        <div class="container-fluid">

        <div class="hero-form m-auto border-0 bg-transparent">
                <div class="heading">
                    <h2><span class="ps-0">Reserve a Vehicle</span></h2> <span>or <a href="{{route('reservation.vMc')}}">View / Modify / Cancel Reservation</a></span>
                    
                </div>
                <div class="form form-date" id="pbk-widget">
      
               
                </div>
            </div>


        </div>
    </section>


    <section class="sec-p cars-sec cars-sec-economy">
        <div class="container">

            <div class="heading">
                <h3>Explore Similar Vehicle Classes</h3>
            </div>

            <div class="d-flex cars-detail">
                @foreach($others as $other)
                <div class="border-0 grid img-png-wit">
                    <a href="#">
                        <h4>{{$other->vehicle ?? ''}}</h4>
                    </a>
                    <span>{{$other->model ?? ''}}</span>
                    <figure>
                        <img src="{{asset('vehicles/')}}/{{$other->image}}" alt="">
                    </figure>
                    <div class="txt">
                        <ul class="d-flex vehicle-specs-list">
                            <li class="vehicle-class-card__specs-item">
                                <i class="icon icon-specs-transmission-gray"></i>
                                <span>{{$other->transmission ?? ''}}</span>
                            </li>
                            <li class="vehicle-class-card__specs-item">
                                <i class="icon icon-specs-passenger-gray"></i>
                                <span>{{$other->passengers ?? ''}} People</span>
                            </li>
                            <li class="vehicle-class-card__specs-item">
                                <i class="icon icon-specs-bags-gray"></i>
                                <span>{{$other->bags ?? ''}} Bags</span>
                            </li>
                        </ul>

                        <div class="mb-3 accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$other->id}}" aria-expanded="false" aria-controls="flush-collapseOne{{$other->id}}">
                                        Vehicle Features
                                    </button>
                                </h2>
                                <div id="flush-collapseOne{{$other->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <?php
                                            $features1 = trim($other->features,'"');
                                            $feature1 = explode(",",$features1);
                                        ?>
                                        <ul class="car-card__features-list car-card__features-list--open">
                                            @foreach($feature1 as $feat)
                                            <li class="car-card__features-list-item">{{$feat}}</li>
                                            @endforeach
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <a class="btn" href="{{route('vehicle.detail')}}/{{$other->id}}">Book a {{$other->vehicle ?? ''}}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>



</main>
@endsection
