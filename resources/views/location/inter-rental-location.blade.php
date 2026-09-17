@extends('layouts.main')

@section('content')

<main class="">


    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('location.inter')}}">Car Rental Locations</a></li>
            </ul>
        </div>
    </div>

    <section class="px-0 txt-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1>{{$data->heading}}</h1>
                </div>
                <div class="col-lg-6">
                    <div class="btn-grid text-end">
                        <a class="btn btn-bdr" href="{{route('reservation')}}">{{$data->button}}</a>
                    </div>
                </div>
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
                <!-- <div class="form">
                    <form>
                        <div class="form-group">
                            <label class="form-label form-label-two">
                                <div class="num"></div>Location* <cite>* Required Field</cite>
                            </label>
                            <input type="text" class="form-control" placeholder="ZIP, City or Airport">
                        </div>

                        <div class="btn-grid">
                            <button class="btn" type="button">Continue</button>
                        </div>

                    </form>
                </div> -->
            </div>


        </div>
    </section>

    <section class="sec-p heading-txt-sec">
        <div class="container">
            {!! $data->content !!}
        </div>
    </section>

    <section class="sec-p pt-0 pb-0 locations-sec-2">
        <div class="container">

            <div class="locations-outer-grid">
      
            @foreach($regions as $region)
            <div class="locations-outer-grid">
                <div class="heading">
                    <h3>{{$region->name}}</h3>
                </div>
                <div class="grid">
                    <ul class="city-list d-flex locations-grid">
                        <?php  $ids = json_decode($region->countries);
                            $name = DB::table('countries')->select('id','name')->whereIn('id',$ids)->get(); 
                        ?>
                         @foreach($name as $nam)
                        <li>{{$nam->name}}</li>
                         @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
          

          

        </div>
    </section>
<!-- 
    <section class="sec-p car-rental">
        <div class="container-fluid">
            <div class="bg-transparent p-0 m-0 blog-coloums blog-coloums-logo">
                <div class="row">
                    @foreach($cards as $card)
                    <div class="col-lg-4">
                        <div class="grid">
                            <figure>
                                <img src="{{asset('images')}}/{{$card->image}}" alt="images">
                            </figure>
                            <div class="txt">
                                <div>
                                    <p>
                                        {{$card->detail}}
                                    </p>
                                </div>
                                <a class="btn" href="#">{{$card->button}}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                  

                </div>
            </div>
        </div>
    </section> -->

</main>

@endsection