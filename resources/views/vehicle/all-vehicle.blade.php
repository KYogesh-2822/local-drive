@extends('layouts.main')

@section('content')

<main class="">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('vehicle.vans')}}">All Vehicles in Jordan </a></li>
            </ul>
        </div>
    </div>
    <section class="greece_section">
        <div class="container">
            <div class="country">
                <h2>Rental Car Classes in Jordan</h2>
                <div class="form-group">
                    <label for="subject">Country</label>
                    <select id="cars" name="cars" class="form-control form-select">
                        <option value="Jordan">Jordan</option>
                    </select>
                </div>
            </div>
            @foreach($data as $vehicle)
             <?php 
             if($vehicle->type == 'car'){
                $route = 'vehicle.car';
             }elseif($vehicle->type == 'suv'){
                $route = 'vehicle.suvs';
             }elseif($vehicle->type == 'vans'){
                $route = 'vehicle.vans';
             }else{
                $route = 'vehicle.trucks';
             }
             ?>
            <div class="car_desc">
                <div>
                    <div class="content">
                        <a href="{{route($route)}}" class="text-capitalize">{{$vehicle->type}} for Hire</a>
                        <p>4 - 5 People</p>
                        <p>2 - 3 Bags</p>
                    </div>
                    <a href="{{route($route)}}" class="view">View All {{$vehicle->type}}</a>
                </div>
                <div class="img-png-wit">
                    <figure>
                    <img src="{{asset('vehicles/')}}/{{$vehicle->image}}" alt="image" >
                    </figure>
                </div>
            </div>
            @endforeach

            <!-- <div class="car_desc">
                <div>
                    <div class="content">
                        <a href="#">SUVs for Hire</a>
                        <p>4 - 5 People</p>
                        <p>2 - 3 Bags</p>
                    </div>
                    <a href="#" class="view">View All Cars</a>
                </div>
                <div>
                    <figure>
                    <img src="https://www.enterprise.gr/content/dam/global-vehicle-images/suvs/SUZU_GRAN_VITA_2014.png" alt="image" >
                    </figure>
                </div>
            </div>

            <div class="car_desc">
                <div>
                    <div class="content">
                        <a href="#">Vans for Hire</a>
                        <p>4 - 5 People</p>
                        <p>3 Bags</p>
                    </div>
                    <a href="#" class="view">View All Cars</a>
                </div>
                <div>
                    <figure>
                    <img src="https://www.enterprise.gr/content/dam/global-vehicle-images/vans/VOLK_TRAN_2014.png" alt="image" >
                    </figure>
                </div>
            </div> -->
        </div>
    </section>
    <section class="p-0 sec-p address">
        <div class="container-fluid">

        <div class="hero-form m-auto border-0 bg-transparent">
                <div class="heading">
                    <h1><span class="ps-0">Reserve a Vehicle</span></h1> <span>or <a href="{{route('reservation.vMc')}}">View / Modify / Cancel Reservation</a></span>
                    
                </div>
                <div class="form form-date" id="pbk-widget">
      
               
                </div>
            </div>


        </div>
    </section>
</main>
@endsection