@extends('layouts.main')

@section('content')

<main class="business-car-rental">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('business.carRental')}}">Business Car Rental</a></li>
            </ul>
        </div>
    </div>

    <section class="hero-sec-txt" style="background-image: url(https://www.enterprise.com/en/\2f content\2f dam\2f ecom\2fmxo-images\2f business-car-rental\2fhomepage\2f business-car-rental-header.jpeg);">
        <div class="container-fluid">
            <div class="txt">
                {!! $data->banner_content !!}
                <!-- <h1>Join Our Business Car Rental Program</h1>
                <p>Work with a dedicated Account Manager to help your business improve efficiency, compliance, savings and more</p>
                <p><strong>Access an unparalleled network of </strong>Enterprise and National locations in 90+ countries</p>
                <p><strong>Enroll in Emerald Club </strong>for free</p> -->
                <a class="btn" href="{{route('enterprise.join')}}">Sign Up Now</a>
                <small>{{$data->signup_line}}</small>
                <div class="row mt-5">
                    <div class="col-lg-4">
                    <figure><img src="{{asset('images/')}}/{{$data->banner_image}}" alt="img"></figure>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="sec-p signup-sec bg-g img-png-wit">
        <div class="container-fluid">
            <h3 class="text-center">{{$data->today_business_heading}}</h3>
            <div class="signup-wrapper">
                @foreach($business_today as $today)
                <div class="signup-card">
                    <figure><img src="{{asset('images/')}}/{{$today->image}}" alt="img"></figure>
                    <h4>{{$today->heading}}</h4>
                    <p>{!! $today->detail !!}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="sec-p address bg-g">
        <div class="container-fluid">

            <div class="hero-form m-auto border-0 bg-transparent">
                <div class="heading">
                    <h2><span class="ps-0">Reserve a Vehicle with Your Corporate Account </span></h2> <span>or <a href="#">View / Modify / Cancel Reservation</a></span>
                </div>
                <div  id="pbk-widget"></div>
                <!-- <div class="form form-date mb-5">
                    <form>
                        <div class="form-group">
                            <label class="form-label form-label-two">
                                <div class="num"></div>Pick-up & Return Location (ZIP, City or Airport)* <cite>* Required Field</cite>
                            </label>
                            <input type="text" class="form-control" placeholder="Provide a Location">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Return to a different location <i class="fa fa-info-circle"></i></label>
                        </div>
                        <div class="date-grid date-griddd">
                            <div class="form-group">
                               
                                <label class="form-label">Return Location (Postal Code, City or Airport)*</label>
                                <input type="text" class="form-control" placeholder="Provide a Return Location">
                            </div>

                        </div>
                        <div class="form-group row mt-3">
                                <div class="col-lg-8 d-flex gap-5">
                                    <div class="date-col">
                                        <label class="form-label form-label-two">
                                            <div class="num"></div> Pick-up*
                                        </label>
                                        <div class="date d-flex">
                                            <input type="date" class="form-control">
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="date-col">
                                     
                                        <label class="form-label form-label-two">Renter*</label>
                                        <div class="date d-flex">
                                            <input type="date" class="form-control">
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="">
                                        <label class="form-label form-label-two">Renter Age*</label>
                                        <div class="">
                                            <input type="email" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                    
                                        <label class="form-label form-label-two"><em style="font-style: normal;">Corporate Account Number or Promotion Code</em></label>
                                        <input type="text" class="form-control" placeholder="ZIP, City or Airport">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label form-label-two">
                                            Vehicle Class
                                        </label>
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="date-grid date-gridd">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Travel Distance(Miles)*</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Cost of Fuel(Per Gallon)*</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="form-label">Reimbursement Rate(Per Mile)*</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-grid text-end">
                                <button class="btn" type="button">Browse Vehicles</button>
                            </div>
                    </form>
                </div> -->

                <p class="text-center"><small>Can’t Find Your Corporate Account Number? Contact Your Travel Management Team.</small></p>
                <p class="text-center"><small>Not yet enrolled?  <a href="#" class="btn-txt">Sign up now</a></small></p>
            </div>


        </div>
    </section>

    <div class="sec-p img-png-wit">
        <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-7">
                    <h3 class="text-center">{{$data->benefit_heading}}</h3>
                    <div class="benefits-wrapper">
                        @foreach($business_benifit as $benifit)
                        <div class="benefit-item">
                            <figure><img src="{{asset('images/')}}/{{$benifit->image}}" alt="img"></figure>
                            <p>{{$benifit->detail}}</p>
                        </div>
                        @endforeach

                    </div>
               </div>
            </div>
        </div>
    </div>

    <div class="sec-p">
        <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-10">
                    {!! $data->loyalty_heading !!}
                    <figure><img src="{{asset('images/')}}/{{$data->loyalty_image}}" alt="img"></figure>
                    <div class="row justify-content-around receive-wrapper">
                        {!! $data->loyalty_detail !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="sec-p rental-program-sec img-png-wit">
        <div class="container-fluid">
            <h3 class="text-center">{{$data->rentail_program_heading}}</h3>
            <div class="rental-program-wrapper">
                @foreach($business_rentail as $key=>$rentail)
                <div class="rental-program-card">
                    {!! $rentail->text !!}
                    @if($key == 2)
                    <a href="#" class="btn mt-4">Learn More</a>
                    @else
                    <a href="#" class="btn-txt">500+ Truck Locations <i class="fa fa-external-link"></i></a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        <div class="container">
            <div class="row g-5 mt-4">
                <?php $images = explode(",",$data->rentail_program_images); ?>
                @foreach($images as $image)
                <div class="col-lg-3">
                    <figure><img src="{{asset('images/')}}/{{$image}}" alt="img"></figure>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- <section class="bg-g cta-sec">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 pt-4 pb-4">
                      {!! $data->center_content !!}
                    <a href="#" class="btn">{{$data->center_button}}</a>
                </div>
                <div class="col-lg-6">
                    <figure><img src="{{asset('images/')}}/{{$data->center_image}}" alt="img"></figure>
                </div>
            </div>
        </div>
    </section> -->


    <!-- <section class="bg-g sec-p mt-4">
        <div class="container-fluid">
            <div class="heading text-center">
               {!! $data->safety_content !!}
            </div>
        </div>
    </section> -->

    <!-- <section class="sec-p management-tools-sec">
        <div class="container-fluid">
            <div class="heading mb-5"><h3 class="text-center">{{$data->tool_heading}}</h3> </div>
            <div class="management-tools-wrapper">
                @foreach($business_tool as $tool)
                <div class="tools-card">
                    <div class="card-img">
                        <figure><img src="{{asset('images/')}}/{{$tool->image}}" alt="img"></figure>
                    </div>
                     {!! $tool->detail !!}
                    <a href="#" class="btn">{{$tool->button}}</a>
                </div>
                @endforeach
            </div>
        </div>
    </section> -->

    <section>

    </section>
    <section>
        
    </section>

</main>

@endsection