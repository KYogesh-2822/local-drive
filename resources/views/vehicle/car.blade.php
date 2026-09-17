@extends('layouts.main')

@section('content')

<main class="">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('vehicle.car')}}">All Cars in Jordan</a></li>
            </ul>
        </div>
    </div>

    <section class="hero-sec-txt" style="background-image: url('{{asset('images')}}/{{$car->banner_image}}');">
        <div class="container">
            <div class="txt">
                {!! $car->banner_content !!}
                <!-- <a class="btn btn-bdr" href="{{route('reservation')}}">{{$car->banner_button}}</a>   -->
            </div>
        </div>
    </section>

    <section class="pt-5 pb-0">
        <div class="container">
            <div class="row">
                 <div class="col-lg-6">
                  {!! $car->content !!}
                </div>
                <div class="col-lg-6">
                    <div class="btn-grid text-end">
                        <a class="btn btn-bdr" href="{{route('reservation')}}">{{$car->button}}</a>
                    </div>
                </div>
            </div>

        </div>
    </section>



    <section class="sec-p cars-sec pt-4">
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
                        @elseif($other->type == 'vans') 
                        <img src="{{asset('vehicles/')}}/{{$van}}" alt="img">
                        @else
                        <img src="{{asset('vehicles/')}}/{{$truck}}" alt="img">
                        @endif
                    </figure>
                    <div class="txt">
                        <h5><a href="#">All {{$other->type == 'pickup' ? 'Trucks' : ($other->type == 'suv' ? 'SUVs' : 'Vans')}} in Jordan</a></h5>
                        <p>
                            Our SUVs offer plenty of flexibility with seating capacity, power, and luggage room. Whether you are going on a weekend family trip or exploring the countryside we are sure to have the ideal SUV for your needs.
                        </p>
                        <div class="btn-grid">
                            <?php 
                            if($other->type == 'pickup'){
                                $route = 'vehicle.trucks';
                            }elseif($other->type == 'suv'){
                                $route = 'vehicle.suvs';
                            }else{
                                $route = 'vehicle.vans';
                            }   
                            ?>
                            <a class="btn btn-bdr" href="{{route($route)}}">View All {{$other->total}} {{$other->type == 'pickup' ? 'Trucks' : ($other->type == 'suv' ? 'SUVs' : 'Vans')}} Classes</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

</main>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <p>CAR FINDER</p>
         <h2>What is the purpose of this rental?</h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection
