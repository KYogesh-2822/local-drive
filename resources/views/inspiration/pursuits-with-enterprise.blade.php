@extends('layouts.main')

@section('content')

<main class="content">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="#">Home</a></li>
                <li><a href="#">Explore Jordan with Enterprise</a></li>
            </ul>
        </div>
    </div>

    <section class="sec-p hero-logo">
        <div class="container">
            <div class="txt text-center">
                <figure>
                    <img src="{{asset('/images')}}/{{$data->logo}}" alt="logo-hero-sec">
                </figure>
                <p><b>{{$data->banner_line ?? ''}}</b></p>
            </div>
            <div class="hero-list">
                <!-- <h1 class="mb-4">Why Jordan</h1>
                <p>Jordan, a timeless marvel that has enchanted explorers for centuries, continues to cast its spell on
                    a new generation with its blend of tradition and modernity.</p>
                <p>From the captivating expanses of Wadi Rum to the vibrant pulse of urban Amman, and the ancient ruins
                    steeped in history, Jordan offers a journey like no other. Here, you'll find awe-inspiring
                    landscapes, cozy retreats, and flavors that dance on your palate.</p>
                <p>As Jordan quietly rises to prominence in the region, luxury hotels have blossomed in Amman, Petra,
                    Aqaba, and the Dead Sea. Whether you crave the thrill of backpacking or the pampering of five-star
                    luxury, the Hashemite Kingdom welcomes all with open arms. </p>
                <p>Come, immerse yourself in the essence of Jordan, where every traveler finds their own adventure and
                    let Enterprise be your trusted companion. </p> -->
                    {!! $data->banner_text ?? '' !!}
            </div>
        </div>
    </section>


    <section class="sec-p bg-g slider-drives">
        <div class="container-fluid">
            <div class="slide">
                <div class="sec-heading inner-heading text-left">
                    {!! $data->people_heading ?? '' !!}
                </div>

                <div class="drives">
                    @foreach($images as $image)
                    <figure>
                        <img src="{{asset('images')}}/{{$image->image}}"
                            alt="image" style="height:240px;">
                            <figcaption class="text-capitalize">{{$image->name ?? ''}}</figcaption>
                    </figure>
                    @endforeach
                </div>
            </div>
        </div>

        </div>
        </div>
    </section>

    <section class="sec-p slider-drives d-none">
        <div class="container-fluid">
            <div class="slider-car">
                <div class="sec-heading inner-heading text-left">
                    <h4>People <a class="btn-txt" href="#">View all articles</a></h4>
                    <p>Intimate accounts of people and their unique bond with travel.</p>
                </div>

                <div class="drives-slider slider">
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="https://www.enterprise.com/content/dam/ent-brand/inspiration/coastal-maine/Maine_3616.jpg.wrend.640.360.jpeg"
                                    alt="image">
                            </figure>
                            <!-- <div class="txt">
                                <h5><a href="#">A Romantic Road Trip in Coastal Maine</a></h5>
                                <p>No particular plan made for the perfect vacation.</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="https://www.enterprise.com/content/dam/ecom/locations/us/az/grand-canyon-hike/rainbowx.jpg.wrend.640.360.jpeg"
                                    alt="image">
                            </figure>
                            <!-- <div class="txt">
                                <h5><a href="#">Hiking to the Bottom of the Grand Canyon</a></h5>
                                <p>Six family members immerse themselves in nature and attempt to bond.</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="https://www.enterprise.com/content/dam/ent-brand/inspiration/california-coast/california-ocean-adam-sachs-6.jpg.wrend.640.360.jpeg"
                                    alt="image">
                            </figure>
                            <!-- <div class="txt">
                                <h5><a href="#">California Coast Inspires a Love for the Ocean</a></h5>
                                <p>During a road trip up the coast, five residents share their passion for the Pacific.</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="https://www.enterprise.com/content/dam/ent-brand/inspiration/california-eastern-sierra/california-sierra-9.jpg.wrend.640.360.jpeg"
                                    alt="image">
                            </figure>
                            <!-- <div class="txt">
                                <h5><a href="#">Rediscovering California’s Eastern Sierra</a></h5>
                                <p>A photographic journey along an iconic mountain range on the West Coast brings healing and much more.</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="https://www.enterprise.com/content/dam/ent-brand/inspiration/quebec-city/quebec-city-weekend-getaway-15.jpg.wrend.640.360.jpeg"
                                    alt="image">
                            </figure>
                            <!-- <div class="txt">
                                <h5><a href="#">Quebec City is the Perfect Romantic Weekend Getaway</a></h5>
                                <p>Two empty nesters seek a new beginning in Quebec, Canada.</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="https://www.enterprise.com/content/dam/ent-brand/inspiration/yellowstone-in-winter/yellowstone-national-park-wildlife-winter-6.jpg.wrend.640.360.jpeg"
                                    alt="image">
                            </figure>
                            <!-- <div class="txt">
                                <h5><a href="#">Yellowstone National Park in Winter</a></h5>
                                <p>During the cold-weather months, the park offers spectacular scenes of wildlife.</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="https://www.enterprise.com/content/dam/ent-brand/inspiration/florida-manatees/florida-manatees-GOPR0308.jpg.wrend.640.360.jpeg"
                                    alt="image">
                            </figure>
                            <!-- <div class="txt">
                                <h5><a href="#">Swimming With Manatees in Florida</a></h5>
                                <p>A close encounter with these gentle giants makes for an unforgettable adventure.</p>
                            </div> -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="sec-p bg-g slider-drives d-none">
        <div class="container-fluid">
            <div class="slider-car">
                <div class="sec-heading inner-heading text-left">
                    <h4>Passions <a class="btn-txt" href="#">View all articles</a></h4>
                    <p>Exploring the subjects and experiences that fuel the desire to travel.</p>
                </div>

                <div class="drives-slider slider">
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="https://www.enterprise.com/content/dam/ent-brand/inspiration/pacific-coast-highway/THE-GROINS-5-WESTPORT-WA.jpg.wrend.640.360.jpeg"
                                    alt="image">
                            </figure>
                            <!-- <div class="txt">
                                <h5><a href="#">Searching for Surf and Self Along the West Coast</a></h5>
                                <p>New Brunswick’s coastal communities live with the pulse of the ocean, which provides an unforgettable experience.</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="https://www.enterprise.com/content/dam/ent-brand/inspiration/majestic-mountain-loop/MML_YosemiteTaftPoint_4.jpg.wrend.640.360.jpeg"
                                    alt="image">
                            </figure>
                            <!-- <div class="txt">
                                <h5><a href="#">Driving California’s Majestic Mountain Loop</a></h5>
                                <p>Two Californians explore three national parks in their home state.</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="https://www.enterprise.com/content/dam/ecom/locations/canada/ns/cabot-trail/cabot-trail-road.jpg.wrend.640.360.jpeg"
                                    alt="image">
                            </figure>
                            <!-- <div class="txt">
                                <h5><a href="#">Cabot Trail Drive is a Quest for the Best</a></h5>
                                <p>Rich culture, great seafood and lively music distinguish this Nova Scotia journey from all others.</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="https://www.enterprise.com/content/dam/ent-brand/inspiration/route-66/route-66-road-trip-56.jpg.wrend.640.360.jpeg"
                                    alt="image">
                            </figure>
                            <!-- <div class="txt">
                                <h5><a href="#">Nostalgic Route 66 Road Trip: Santa Monica to Albuquerque</a></h5>
                                <p>On the “Mother Road,” you’ll find welcoming smiles and the guardian angel of the trail.</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="https://www.enterprise.com/content/dam/ent-brand/inspiration/algonquin-provincial-park/algonquin-24.jpg.wrend.640.360.jpeg"
                                    alt="image">
                            </figure>
                            <!-- <div class="txt">
                                <h5><a href="#">Algonquin Park Scenic Drive</a></h5>
                                <p>Ontario’s largest provincial park influenced some of Canada’s most iconic art.</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="https://www.enterprise.com/content/dam/ent-brand/inspiration/stargazing/dark-skies-8.jpg.wrend.640.360.jpeg"
                                    alt="image">
                            </figure>
                            <!-- <div class="txt">
                                <h5><a href="#">Road Trip to Dark Sky Parks in Utah</a></h5>
                                <p>A father and daughter bond while photographing the Milky Way.</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-grid">
                            <figure>
                                <img src="https://www.enterprise.com/content/dam/ent-brand/inspiration/texas-bluebonnets/texas-bluebonnets-road-trip-27.jpg.wrend.640.360.jpeg"
                                    alt="image">
                            </figure>
                            <!-- <div class="txt">
                                <h5><a href="#">Texas Bluebonnets in Bloom</a></h5>
                                <p>Willow City Loop ranks high as a bucket-list drive for wildflower lovers.</p>
                            </div> -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>



    <section class="sec-p address pt-0 bg-transparent">
        <div class="container-fluid">

            <div class="hero-form mt-0 mb-0 border-0">
                <div class="heading">
                    <h1>Reserve a Vehicle</h1> <span>or <a href="#">View / Modify / Cancel Reservation</a></span>
                </div>
                <div class="form" id="pbk-widget">
                </div>
            </div>

        </div>
    </section>



    <section class="sec-p bg-g covid-links">
        <div class="container">
            <ul class="text-center">
                <li><a href="{{route('reservation.ourStandardCare')}}">Our standard of Care </a></li>

            </ul>
        </div>
    </section>

</main>

@endsection