@extends('layouts.main')

@section('content')

<main class="">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('reservation')}}">Car Rental</a></li>
                <li><a href="{{route('promotion')}}">Deals & Promotions</a></li>
                <li>Military, Government and Veteran Car Rental Discounts</li>
            </ul>
        </div>
    </div>

    <section class="sec-p hero-logo p-0">
        <div class="container-fluid">
            <div class="cont-sm m-auto border-0 bg-transparent mt-5">
                <div class="heading">
                    <h2>{{$data->heading}}</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p address bg-transparent pt-0">
        <div class="container-fluid">


            <div class="hero-form m-auto border-0 bg-transparent">
                <div class="heading">
                    <h2><span class="ps-0">Reserve a Vehicle</span></h2> <span>or <a href="#">View / Modify / Cancel Reservation</a></span>
                </div>
                <div class="form form-date">
                    <form>
                        <div class="form-group">
                            <label class="form-label form-label-two">
                                <div class="num"></div>Pick-up Return Location* <cite>* Required Field</cite>
                            </label>
                            <input type="text" class="form-control" placeholder="ZIP, City or Airport">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Return to a different location <i class="fa fa-info-circle"></i></label>
                        </div>
                        <div class="date-grid date-griddd">
                            <div class="form-group">
                                <!-- <div class="num">2</div> -->
                                <label class="form-label">Return Location (Postal Code, City or Airport)*</label>
                                <input type="text" class="form-control" placeholder="Provide a Return Location">
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
                                        <!-- <div class="num">2</div> -->
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
                                        <!-- <div class="num">1</div> -->
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
                            <div class="btn-grid text-end">
                                <button class="btn" type="button">Browse Vehicles</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>


        </div>
    </section>

    <section class="sec-note bg-g">
        <div class="container-fluid">
            <div class="cont-sm m-auto border-0 bg-transparent">
                <p class="mb-0">{!! $data->banner_line !!}</p>
                <!-- <p class="mb-0">For military and government, active duty travels, Book <a href="#" class="btn-txt"> Official Gov Travel</a></p> -->
            </div>
        </div>
    </section>

    <section class="sec-p pt-5">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    {!! $data->serve_content !!}
                   
                </div>
                <div class="col-8">
                <iframe height="500px" class="youtube-iframe" data-cmp-data-layer="{&quot;embeddable-1c8d82864f&quot;:{&quot;@type&quot;:&quot;core/wcm/components/embed/v1/embed/embeddable&quot;,&quot;repo:modifyDate&quot;:&quot;2023-08-30T23:37:15Z&quot;,&quot;embeddableProperties&quot;:{&quot;youtubeVideoId&quot;:&quot;GMZi3tCQ1XU&quot;}}}" width="100%" height="390" src="{{$data->video_link}}" frameborder="0" allowfullscreen="" allow="autoplay; fullscreen" aria-label="YouTube Video" data-gtm-yt-inspected-59="true" id="581967455" title="Enterprise: Proud to Serve Those Who Serve" data-gtm-yt-inspected-109="true"></iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p military-faq-sec">
        <div class="container-fluid">
            <div class="cont-sm m-auto border-0 bg-transparent">
            <div class="military-faq">
                {!! $data->discount_content	 !!}
               
            </div>
            </div>
        </div>
    </section>

</main>

@endsection