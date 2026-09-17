@extends('layouts.main')

@section('content')
<main class="content">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="#">Home</a></li>
                <li><a href="#">Exotic Car Rental</a></li>
                <li><a href="#">Locations</a></li>
            </ul>
        </div>
    </div>


    <section class="hero-sec-single">
        <div class="container-fluid">
            <figure>
                <img src="images/locations-bg.jpg" alt="entertainment-production-rentals" style="object-position: bottom;">
            </figure>
        </div>
    </section>

    <section class="sec-p heading-txt-sec">
        <div class="container">
            <div class="row">
                <div class="ul-dot col-lg-9">
                    <div class="txt">
                        <h1 class="mb-3">Rent the luxury. Own the thrill.​</h1>
                        <p>From exotic sports cars to luxury sedans and SUVs, the Exotic Car Collection by Enterprise offers an exceptional selection and the trusted, personalized service of Enterprise.</p>
                        <a class="btn" href="#">Reserve Now</a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="sec-p pt-0 three-grid-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="grid">
                        <h3>Explore Our Vehicles</h3>
                        <figure>
                            <img src="images/new-img.jpg" alt="img">
                        </figure>
                        <div class="txt">
                            <p>With our impressive selection of premium luxury and performance vehicles, you’ll experience a thrill that will stay with you long after the rental return.</p>
                            <a class="btn-txt" href="#">Explore Vehicles</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="grid">
                        <h3>Our Locations</h3>
                        <figure>
                            <img src="images/new-imgg.jpg" alt="img">
                        </figure>
                        <div class="txt">
                            <p>With airport and neighborhood locations in most major cities across the US, we’re ready to get you on your way in exceptional style.</p>
                            <a class="btn-txt" href="#">Locations</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="grid">
                        <h3>Frequently Asked Questions</h3>
                        <figure>
                            <img src="images/new-imggg.jpg" alt="img">
                        </figure>
                        <div class="txt">
                            <p>Curious about renting from the Exotic Car Collection? Explore some frequently asked questions to learn how you can rent the car of your dreams.</p>
                            <a class="btn-txt" href="#">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p p-0 customer-service">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <figure>
                        <img src="images/Customer-Service.jpg" alt="img">
                    </figure>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="txt text-center">
                        <h2>Superior Customer Service</h2>
                        <p>Experience exotic car rentals from the brand known for award-winning customer service. Our goal is to meet your needs and exceed your expectations. We’ll even deliver and collect your exotic vehicle at your convenience.</p>
                        <a class="btn btn-bk-trans" href="#">Reserve Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p address car-slider-sec">
        <div class="container-fluid">
            <div class="slider-car mt-0">
                <div class="sec-heading inner-heading text-center">
                    <h4>Arrive in Style</h4>
                    <p>Choose from our prestigious collection of world-class brands:</p>
                </div>

                <div class="car-slider-2 slider">
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="images/car.png" alt="image">
                            </figure>
                            <div class="txt text-center">
                                <h4>Luxury Car</h4>
                                <p>Luxury cars can include upgraded amenities like leather seats, efficient performance and plenty of room for passengers and luggage.</p>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="images/car.png" alt="image">
                            </figure>
                            <div class="txt text-center">
                                <h4>Luxury Car</h4>
                                <p>Luxury cars can include upgraded amenities like leather seats, efficient performance and plenty of room for passengers and luggage.</p>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="images/car.png" alt="image">
                            </figure>
                            <div class="txt text-center">
                                <h4>Luxury Car</h4>
                                <p>Luxury cars can include upgraded amenities like leather seats, efficient performance and plenty of room for passengers and luggage.</p>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="images/car.png" alt="image">
                            </figure>
                            <div class="txt text-center">
                                <h4>Luxury Car</h4>
                                <p>Luxury cars can include upgraded amenities like leather seats, efficient performance and plenty of room for passengers and luggage.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="btn-grid text-center">
                <a class="btn" href="#">View All Vehicles</a>
            </div>
        </div>
    </section>


</main>
@endsection