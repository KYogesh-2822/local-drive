@extends('layouts.main')

@section('content')

<main class="content">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('reservation.oneWayEnterprise')}}">One-Way Car Rental</a></li>
            </ul>
        </div>
    </div>

    <section class="bg-g sec-p address hero-main-form" style="background-image: url('https://www.enterprise.com/content/dam/ecom/general/Homepage/inspiration-pyramid-lake-us.jpg.wrend.1280.720.jpeg');">
        <div class="container-fluid">
            <div class="hero-form m-auto">
                <div class="heading d-block">
                    <h1>Start A One-Way Reservation</h1>
                    <p>And Find Great Rates At Branches Across The Country</p>
                </div>
                <div  id="pbk-widget"></div> 
            </div>
        </div>
    </section>

    <section class="sec-p three-col-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
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
                            <h6>Unlimited Mileage</h6>
                            <p>There is no mileage limit for most vehicle classes on our one-way rentals</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="d-flex grid">
                        <figure>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 612 792" width="100%" height="100%">
                                    <title>Clock</title>
                                    <g id="Clock" data-name="Clock">
                                        <g id="Layer_1" data-name="Layer 1">
                                            <path class="cls-1" d="M323.5,255.5c0,9.7-7.9,17.6-17.6,17.6c-9.7,0-17.6-7.9-17.6-17.6s7.9-17.6,17.6-17.6			C315.6,237.9,323.5,245.8,323.5,255.5z"></path>
                                            <path class="cls-1" d="M323.5,608.1c0,9.7-7.9,17.6-17.6,17.6c-9.7,0-17.6-7.9-17.6-17.6c0-9.7,7.9-17.6,17.6-17.6			C315.6,590.4,323.5,598.3,323.5,608.1z"></path>
                                            <path class="cls-1" d="M499.8,423c0,9.7-7.9,17.6-17.6,17.6c-9.7,0-17.6-7.9-17.6-17.6s7.9-17.6,17.6-17.6C491.9,405.4,499.8,413.2,499.8,423z"></path>
                                            <path class="cls-1" d="M147.2,423c0,9.7-7.9,17.6-17.6,17.6S112,432.7,112,423s7.9-17.6,17.6-17.6S147.2,413.2,147.2,423z"></path>
                                            <path class="cls-1" d="M323.5,299.6h-35.3V423c0,4.4,1.8,8.8,5.3,12.3l87.2,87.2l24.7-24.7l-82-82L323.5,299.6L323.5,299.6z"></path>
                                            <path class="cls-1" d="M305.9,678.6c-136.6,0-246.8-110.2-246.8-246.8S169.2,185,305.9,185s246.8,110.2,246.8,246.8S442.5,678.6,305.9,678.6			L305.9,678.6z M514.8,216.7l26.4-26.4c9.7-10.6,9.7-26.4-0.9-37c-9.7-9.7-26.4-10.6-37-0.9l-30,30.9			c-42.3-28.2-90.8-45.8-141-49.4V96.9h79.3V44H200.1v52.9h79.3V133C139.3,145.3,26.5,253.8,8.8,393.9s64.3,273.2,197.4,319.9	c133.1,46.7,280.3-4.4,355.2-124.3S615.2,314.6,514.8,216.7L514.8,216.7z"></path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </figure>
                        <div class="txt">
                            <h6>Save Time</h6>
                            <p>One-way rentals are ideal for unplanned trip changes, cross-country road trips, moving and more!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p pt-0 popular">
        <div class="container">
            <div class="sec-heading inner-heading text-center">
                <h4>One-Way Rental Car Types</h4>
                <p>From compact cars to spacious SUVs and vans, we offer a wide range to suit your needs.</p>
            </div>
            <div class="grid">
                <div class="vehicles-four-up-container d-flex">
                    <div class="vehicle-content text-center"><img src="https://assets.gcs.ehi.com/content/enterprise_cros/data/vehicle/bookingCountries/US/CARS/LCAR.doi.768.high.imageSmallThreeQuarterNodePath.png/1618262778275.png" alt="Chrysler 300">
                        <h3>Cars</h3>
                    </div>
                    <div class="vehicle-content text-center"><img src="https://assets.gcs.ehi.com/content/enterprise_cros/data/vehicle/bookingCountries/US/SUVS/FFAR.doi.768.high.imageSmallThreeQuarterNodePath.png/1618262877780.png" alt="Chevrolet Tahoe">
                        <h3>SUVs</h3>
                    </div>
                    <div class="vehicle-content text-center"><img src="https://assets.gcs.ehi.com/content/enterprise_cros/data/vehicle/bookingCountries/US/TRUCKS/PPAR.doi.768.high.imageSmallThreeQuarterNodePath.png/1512427309887.png" alt="Ford F150">
                        <h3>Trucks</h3>
                    </div>
                    <div class="vehicle-content text-center"><img src="https://assets.gcs.ehi.com/content/enterprise_cros/data/vehicle/bookingCountries/US/CARS/FCAR.doi.768.high.imageSmallThreeQuarterNodePath.png/1618262777765.png" alt="Chevy Malibu">
                        <h3>Vans</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p p-0 txt-img">
        <div class="container-fluid">
            <div class="row ul-dot grey">
                <div class="col-lg-6">
                    <div class="txt">
                        <h2>Looking to Rent A Car for a One-Way Trip?</h2>
                        <p>No problem! Enterprise Rent-A-Car offers easy and convenient one-way car rentals between many of its locations worldwide. Choose from a great selection of vehicles ideal for:</p>
                        <ul class="mb-2">
                            <li>Trips across the city or country</li>
                            <li>Saving time by not returning to your original location</li>
                            <li>Airline delays and/or cancellations</li>
                            <li>Unplanned trip changes</li>
                            <li>Moving</li>
                            <li>And much more!</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <figure>
                        <img src="https://www.enterprise.com/content/dam/ecom/locations/us/fl/ft-lauderdale/FL4.jpg" alt="img">
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="sec-p blog-coloums four-col-sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="grid">
                        <figure>
                            <img src="https://www.enterprise.com/en/home/_jcr_content/root/container/container/container_962241180/sliding_carousel/teaser_391368421_cop.coreimg.82.640.png/1673887137665/ccp-homepage-tile-en.png" alt="images">
                        </figure>
                        <div class="txt">
                            <h6>Our Standard of Care</h6>
                            <p>
                                Our ongoing commitment to increase safety measures for our customers and employees
                            </p>
                            <a class="btn" href="#">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="grid">
                        <figure>
                            <img src="https://www.enterprise.com/content/dam/ecom/GettyImages-636768332-4.20-AE.jpg" alt="images">
                        </figure>
                        <div class="txt">
                            <h6>Best Road Trip Cars</h6>
                            <p>
                                Finding the right vehicle for a road trip can make all the difference.
                            </p>
                            <a class="btn" href="#">View Vehicles</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="grid">
                        <figure>
                            <img src="https://www.enterprise.com/content/dam/ecom/locations/us/ca/roadtrip-california/alcatraz-and-cable-cars-san-francisco-900x506-featured-image.png" alt="images">
                        </figure>
                        <div class="txt">
                            <h6>What to Consider When Renting a Car</h6>
                            <p>
                                We’ve compiled a list of things to keep in mind before you reserve a car and get on the road.
                            </p>
                            <a class="btn" href="#">See the List</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="grid">
                        <figure>
                            <img src="https://www.enterprise.com/content/dam/ecom/utilitarian/common/homepage-us/road-trip-essentials.png" alt="images">
                        </figure>
                        <div class="txt">
                            <h6>Plan a Road Trip</h6>
                            <p>
                                We have guides for popular destinations across Jordan with easy-to-follow itineraries.
                            </p>
                            <a class="btn" href="#">View the Guides</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="sec-p one-way-faq">
        <div class="container">
            {!! $data->full_mileage_text !!}
          

            <div class="simpletextband mt-5">
                <p class="mb-0" style="text-align: center;">For more information, please visit our <a href="/#">COVID-19 FAQs</a> page.<br>
                    For additional questions, please visit our <a href="#">main car rental FAQs</a> page.</p>
            </div>

        </div>
    </section>

</main>

@endsection