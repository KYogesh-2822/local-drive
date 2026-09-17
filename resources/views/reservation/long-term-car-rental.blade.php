@extends('layouts.main')

@section('content')

<main class="content">

    <section class="hero-sec hero-sec-long-term" style="background-image:url('./images/{{$data->banner_image}}')">
        <div class="container">
            <div class="big-heading">
                {!! $data->heading !!}
            </div>
        </div>
    </section>

    <section class="sec-p pb-0 bg-white address">
        <div class="container-fluid">
            <div class="hero-form hero-form-long ">
                <div class="heading">
                    <h1>Start a Long-Term Reservation</h1> <span>or <a href="#">View / Modify / Cancel Reservation</a></span>
                </div>
                <div class="form">
                    <form>
                        <div class="form-group">
                            <div class="num">1</div>
                            <label class="form-label form-label-two">Pick-up & Return Location* <cite>* Required Field</cite></label>
                            <input type="email" class="form-control" placeholder="ZIP, City or Airport">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck11">
                            <label class="form-check-label" for="exampleCheck11">Return to a different location <i class="fa fa-info-circle"></i></label>
                        </div>

                        <div class="date-grid">
                            <div class="form-group">
                                <div class="num">2</div>
                                <label class="form-label">Return Location (Postal Code, City or Airport)*</label>
                                <input type="email" class="form-control" placeholder="Provide a Return Location">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p three-col-sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="d-flex grid">
                        <figure>
                            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.67 15.67" width="100%" height="100%">
                                    <title>calendar_1</title>
                                    <g id="Camada_2" data-name="Camada 2">
                                        <g id="Layer_1" data-name="Layer 1">
                                            <path class="cls-1" d="M6.37,9.09H3.31A1,1,0,0,1,2.39,8V6.64H3.7V7.78H6V6.64h1.3V8A1,1,0,0,1,6.37,9.09Z"></path>
                                            <path class="cls-1" d="M12.62,15.67H3.05a3.05,3.05,0,0,1-3-3V5.44A1.25,1.25,0,0,1,1.25,4.19H14.37V3.05a1.75,1.75,0,0,0-1.75-1.74H3.05A1.74,1.74,0,0,0,1.31,3.05H0A3.06,3.06,0,0,1,3.05,0h9.57a3.06,3.06,0,0,1,3.05,3.05V4.24A1.26,1.26,0,0,1,14.42,5.5H1.31v7.13a1.75,1.75,0,0,0,1.74,1.74h9.57a1.76,1.76,0,0,0,1.75-1.74v-6h1.3v6A3.05,3.05,0,0,1,12.62,15.67Z"></path>
                                            <path class="cls-1" d="M6.37,13.28H3.31a1,1,0,0,1-.92-1v-1.4H3.7V12H6V10.83h1.3v1.4A1,1,0,0,1,6.37,13.28Z"></path>
                                            <path class="cls-1" d="M12.36,9.09H9.3A1,1,0,0,1,8.38,8V6.64H9.69V7.78H12V6.64h1.31V8A1,1,0,0,1,12.36,9.09Z"></path>
                                            <path class="cls-1" d="M12.36,13.28H9.3a1,1,0,0,1-.92-1v-1.4H9.69V12H12V10.83h1.31v1.4A1,1,0,0,1,12.36,13.28Z"></path>
                                        </g>
                                    </g>
                                </svg></div>
                        </figure>
                        <div class="txt">
                            {!! $data->rate_text !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex grid">
                        <figure>

                            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.65 13.2" width="100%" height="100%">
                                    <title>Gas Mileage_5</title>
                                    <g id="Camada_2" data-name="Camada 2">
                                        <g id="Layer_1" data-name="Layer 1">
                                            <path class="cls-1" d="M7.83,13.2a2.21,2.21,0,0,1-1.27-.39,2.25,2.25,0,0,1-.95-1.64,2.22,2.22,0,0,1,.64-1.76l.93.92a.94.94,0,0,0-.27.73,1,1,0,0,0,.4.68.92.92,0,0,0,1,0,.91.91,0,0,0,.4-.68.93.93,0,0,0-.26-.73,1,1,0,0,0-.2-.15A2.09,2.09,0,0,1,7.16,8.37V2.48H8.47V8.37A.8.8,0,0,0,8.92,9a1.92,1.92,0,0,1,.48.37A2.22,2.22,0,0,1,10,11.17a2.25,2.25,0,0,1-.95,1.64A2.21,2.21,0,0,1,7.83,13.2Z"></path>
                                            <path class="cls-1" d="M7.83,3.75a4.62,4.62,0,0,0-.65.06V5.14a2.75,2.75,0,0,1,.65-.08,2.84,2.84,0,0,1,.66.09V3.81a4.91,4.91,0,0,0-.66-.06"></path>
                                            <path class="cls-1" d="M15.58,6.71A7.88,7.88,0,0,0,8.75.05c-.31,0-.62,0-.92,0A7.83,7.83,0,0,0,0,7.43,1,1,0,0,0,1,8.49H4.06a1,1,0,0,0,1-.93,2.66,2.66,0,0,1,.81-1.69V4.26A4,4,0,0,0,3.8,7.18H1.33a6.52,6.52,0,0,1,6.5-5.87,6.74,6.74,0,0,1,.77,0,6.57,6.57,0,0,1,5.69,5.54,2.66,2.66,0,0,1,0,.28H11.86A4.06,4.06,0,0,0,9.8,4.27V5.89a2.79,2.79,0,0,1,.79,1.67,1,1,0,0,0,1,.93h3a1.07,1.07,0,0,0,.74-.32,1,1,0,0,0,.27-.74,5.69,5.69,0,0,0-.07-.71"></path>
                                        </g>
                                    </g>
                                </svg></div>

                        </figure>
                        <div class="txt">
                            {!! $data->mileage_text !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex grid">
                        <figure><img src="https://www.enterprise.com/content/dam/ecom/sem-testing/Pins_0002_standard%20(002).png" alt=""></figure>
                        <div class="txt">
                            {!! $data->location_text !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p popular">
        <div class="container">
            <div class="sec-heading inner-heading text-center">

                {!! $data->popular_text !!}
                <a class="btn" href="#">  {!! $data->popular_button !!}	</a>
            </div>
            <div class="grid">
                <div class="vehicles-four-up-container d-flex">
                    <div class="vehicle-content"><img src="https://assets.gcs.ehi.com/content/enterprise_cros/data/vehicle/bookingCountries/US/CARS/LCAR.doi.768.high.imageSmallThreeQuarterNodePath.png/1618262778275.png" alt="Chrysler 300"></div>
                    <!-- <div class="vehicle-content"><img src="https://assets.gcs.ehi.com/content/enterprise_cros/data/vehicle/bookingCountries/US/CARS/LCAR.doi.768.high.imageSmallThreeQuarterNodePath.png/1618262778275.png" alt="Chrysler 300"></div>
                    <div class="vehicle-content"><img src="https://assets.gcs.ehi.com/content/enterprise_cros/data/vehicle/bookingCountries/US/SUVS/FFAR.doi.768.high.imageSmallThreeQuarterNodePath.png/1618262877780.png" alt="Chevrolet Tahoe"></div>
                    <div class="vehicle-content"><img src="https://assets.gcs.ehi.com/content/enterprise_cros/data/vehicle/bookingCountries/US/TRUCKS/PPAR.doi.768.high.imageSmallThreeQuarterNodePath.png/1512427309887.png" alt="Ford F150"></div>
                    <div class="vehicle-content"><img src="https://assets.gcs.ehi.com/content/enterprise_cros/data/vehicle/bookingCountries/US/CARS/FCAR.doi.768.high.imageSmallThreeQuarterNodePath.png/1618262777765.png" alt="Chevy Malibu"></div> -->
                </div>
            </div>
        </div>
    </section>

    <section class="hero-sec-dealership-solutions-technology long-term-car-sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="txt">
                        {!! $data->reason_text!!}
                        <a class="btn" href="#">{{ $data->reason_button }}</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <figure>
                        <img src="{{asset('images/')}}/{{$data->reason_image}}" alt="imgage">
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p heading-txt-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="txt">
                       {!! $data->lease_rental !!}
                    </div>
                </div>
            </div>

        </div>
    </section>


</main>
@endsection