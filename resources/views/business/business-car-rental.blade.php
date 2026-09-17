@extends('layouts.main')

@section('content')

@php
    $demoteEmbeddedH1 = static fn ($html) => str_ireplace(
        ['<h1', '</h1>'],
        ['<h2', '</h2>'],
        (string) $html
    );

    $preserveFirstEmbeddedH1 = static function ($html) use ($demoteEmbeddedH1) {
        $html = (string) $html;
        $firstClosingTag = stripos($html, '</h1>');

        if ($firstClosingTag === false) {
            return $html;
        }

        $firstClosingTag += strlen('</h1>');

        return substr($html, 0, $firstClosingTag)
            . $demoteEmbeddedH1(substr($html, $firstClosingTag));
    };
@endphp

<main class="business-car-rental">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('business.carRental')}}">Business Car Rental</a></li>
            </ul>
        </div>
    </div>

    <section class="hero-sec-txt" style="background-image: url(https://www.enterprise.com/en/\2f content\2f dam\2f ecom\2fmxo-images\2f business-car-rental\2fhomepage\2f business-car-rental-header.jpeg);background-color: #fff;">
        <div class="container-fluid">
            <div class="txt">
                {!! $preserveFirstEmbeddedH1($data->banner_content) !!}
              
                <a class="btn" href="{{route('business.businessForm')}}">Enquire today</a>
             
            </div>
        </div>
    </section>


    <h3 class="text-center">{{$data->rentail_program_heading}}</h3>
    <section class="sec-p rental-program-sec img-png-wit address businessCars">
        <div class="container-fluid">
            <div class="rental-program-wrapper">
                @foreach($business_rentail as $key=>$rentail)
                <div class="rental-program-card">
                    {!! $demoteEmbeddedH1($rentail->text) !!}
                   
                    <a href="{{$rentail->link}}" class="btn-txt">{{$rentail->button}}</a>
                   
                </div>
                @endforeach
            </div>
        </div>



        <div class=""  >
            <div class="slider-car slider-vehicle">
                <div class="sec-heading inner-heading text-center">
                    <h4>Discover Our Range of Cars</h4>
                    <p>Make your trip a pleasant experience by choosing the category of vehicle that best suites your business travel needs.</p>
                </div>

                <div class="vehicle-slider slider">
                    @foreach($vehicles as $vehicle)
                    <div class="slide">
                        <div class="slide-grid img-png-wit">
                            <figure>
                                <img src="{{asset('vehicles/')}}/{{$vehicle->image}}" alt="image" style="width: 512px; height: 371px;">
                            </figure>
                            <div class="txt text-center">
                                <h4>{{$vehicle->vehicle}}</h4>
                                <!-- <p>{{$vehicle->vehicle}} can include upgraded amenities like {{trim($vehicle->features,'"')}}.</p> -->
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
            <div class="btn-grid text-center">
                <a class="btn" href="{{route('vehicle.vechicle')}}">SEE THE FILL RANGE</a>
            </div>
        </div>
    </section>

  

    <section class="choose_section">
        <div class="container-fluid">
            <h3>{{$data->enterprise_heading}}</h3>
            <div class="choose_items">
                <div class="choose_item">
                    {!! $demoteEmbeddedH1($data->choose_content1) !!}
                </div>
                <div class="choose_item">
                    {!! $demoteEmbeddedH1($data->choose_content2) !!}
                </div>
                <div class="choose_item">
                    {!! $demoteEmbeddedH1($data->choose_content3) !!}
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <section class="signup_section">
        <div class="container-fluid">

            {!! $demoteEmbeddedH1($data->signing_up_step) !!}

            <div class="enquire">
                <div class="content">
                    <h5>Enterprise Business Car Rental Programme</h5>
                    <p>Global solutions for businesses of all sizes</p>
                </div>
                <a href="{{route('business.businessForm')}}">Enquire Now</a>
            </div>
        </div>
    </section>

</main>

@endsection
