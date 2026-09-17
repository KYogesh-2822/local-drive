@extends('layouts.main')

@section('content')

<main class="">

<style>
.selected_search_return {
    height: 100%;
    display: flex;
    align-items: center;
    margin-left: 10px;
    background-color: #f3f3f3;
    border-radius: 0.5rem;
}

.selected_search_return .selected_value_return {
    padding: 6px 10px;
}

.selected_search_return  i {
    padding: 10px 10px;
    width: 35px;
    border-left: 1px solid #fff;
    height: 100%;
    cursor: pointer;
    color: #169a5a;
}

.accordion.form-control {
    display: flex;
    align-items: center;  
    height:54px !important;
}
.selected_search {
    height: 100%;
    display: flex;
    align-items: center;
    margin-left: 10px;
    background-color: #f3f3f3;
    border-radius: 0.5rem;
}

.selected_search .selected_value {
    padding: 6px 10px;
}

.selected_search  i {
    padding: 10px 10px;
    width: 35px;
    border-left: 1px solid #fff;
    height: 100%;
    cursor: pointer;
    color: #169a5a;
}

.accordion.form-control {
    display: flex;
    align-items: center;  
    height:54px !important;
}
    </style>

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('reservation')}}">Car Rental</a></li>
            </ul>
        </div>
    </div>
 
    <section class="sec-p address bg-transparent">
        <div class="container-fluid">
            <div class="hero-form m-auto border-0 bg-transparent">
                <div class="heading">
                    <h1><span class="ps-0">Reserve a Vehicle</span></h1> <span>or <a href="{{route('reservation.vMc')}}">View / Modify / Cancel Reservation</a></span>
                    
                </div>
                <div class="form form-date" id="pbk-widget">
      
                    <!-- <div id="CustomErrorDiv">
                        
                    </div>
                    <form id="start_a_reservation">
                        @csrf
                        <div class="form-group">
                           
                            <label class="form-label form-label-two">
                                <div class="num"></div>Pick-up Return Location* <cite>* Required Field</cite>
                            </label>
                            <div class="accordion accordion-flush p-0 border-1 form-control" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            <input type="text" class="form-control border-0" id="search" name="search" placeholder="ZIP, City or Airport" value="">
                                        </div>  
                                    </h2>
                                    <div class="selected_search d-none"><span class="selected_value"></span><i class="fa fa-close" onclick="closeSelect();"></i></div>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="message"> </div>
                                            <div class="location-btn">
                                                <a class="btn"  onclick="getCurrent();"><i class="fa fa-location-arrow"></i> Use my current location</a>
                                            </div>
                                            <div class="location-txt ">
                                                <div class="d-flex grid-location ">
                                                    <div class="coloum coloum-location">
                                                        <div class="location-name d-flex"><i class="fa fa-plane"></i> <span>Airports</span></div>
                                                    </div>
                                                    <div class="coloum coloum-address locationFind">
                                                    </div>
                                                </div>
                                         
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input exampleCheck" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Return to a different location <i class="fa fa-info-circle"></i></label>
                        </div>
                        <div class="">
                            <div class="form-group date-griddd date-grid date-grid-off">
           
                                <div class="accordion accordion-flush-return p-0 border-1 form-control" id="accordionFlushReturn">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOneReturn">
                                        <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseReturn" aria-expanded="false" aria-controls="flush-collapseReturn">
                                            <input type="text" class="form-control border-0" id="return_search" name="return_search" placeholder="ZIP, City or Airport" value="">
                                        </div>  
                                    </h2>
                                    <div class="selected_search_return d-none"><span class="selected_value_return"></span><i class="fa fa-close" onclick="closeSelectReturn();"></i></div>
                                    <div id="flush-collapseReturn" class="accordion-collapse collapse" aria-labelledby="flush-headingOneReturn" data-bs-parent="#accordionFlushReturn">
                                        <div class="accordion-body">
                                            <div class="messageReturn"> </div>
                                            <div class="location-btn">
                                                <a class="btn"  onclick="getCurrentReturn();"><i class="fa fa-location-arrow"></i> Use my current location</a>
                                            </div>
                                            <div class="location-txt ">
                                                <div class="d-flex grid-location ">
                                                    <div class="coloum coloum-location">
                                                        <div class="location-name d-flex"><i class="fa fa-plane"></i> <span>Airports</span></div>
                                                    </div>
                                                    <div class="coloum coloum-address locationFindReturn">
                                                    </div>
                                                </div>
                                         
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="form-group row mt-3">
                                <div class="col-lg-8 d-flex gap-5">
                                    <div class="date-col">
                                        <label class="form-label form-label-two">
                                            <div class="num"></div> Pick-up*
                                        </label>
                                        <div class="date d-flex">
                                  
                                            <input type="text" name="pickUp_date" class="cal form-control" id="pick_up_date" value=""/>
                                            <input type="text" name="pickUp_time" class="form-control" value="12 AM" id="pick_up_time">
                                        </div>
                                    </div>
                                    <div class="date-col">
                                        <label class="form-label form-label-two">Renter*</label>
                                        <div class="date d-flex">
                                            <input type="text" name="return_date" class="cal form-control" value="" id="return_date">
                                            <input type="text" name="return_time" class="form-control" value="12 AM" id="return_time">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="">
                                        <label class="form-label form-label-two">Renter Age*</label>
                                        <div class="">
                                            <select class="form-select" aria-label="Default select example" name="age" id="age">
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25" selected>25+</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                   
                                        <label class="form-label form-label-two"><em style="font-style: normal;">Corporate Account Number or Promotion Code</em></label>
                                        <input type="text" class="form-control" placeholder="ZIP, City or Airport" name="promotion_code">
                                    </div>
                          
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label form-label-two">
                                            Vehicle Class <i class="fa fa-info-circle"  type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top"></i>
                                        </label>
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="btn-grid text-end">
                                <button class="btn" type="button" onclick="startReservation();">Browse Vehicles</button>
                            </div>

                        </div>
                    </form> -->
                </div>
            </div>
        </div>
    </section> 

 



    <section class="hero-sec-dealership-solutions-technology after-before-none">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="txt">
                        {!! $intro->discription!!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <figure>
                        <img src="{{asset('images')}}/{{$intro->image}}" alt="imgage">
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p ftr-upper heding-txt-h">
        <div class="container">

            <div class="row">
                @foreach($first_cards as $card)
                <div class="col-lg-4">
                    <div class="grid">
                        <div>
                        <h3>{{$card->heading}}</h3>
                        <figure>
                            <img src="{{asset('images')}}/{{$card->image}}" alt="img">
                        </figure>
                        </div>
                        <div class="txt">
                            <p>{{$card->detail}} </p>
                     
                                <a class="btn" href="{{$card->link}}">{{$card->button}} <i class="fa fa-external-link"></i></a>
                           
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="sec-p pt-0 car-rental">
        <div class="container-fluid">
            <div class="bg-transparent p-0 blog-coloums">
                <div class="row">
                    @foreach($second_cards as $s_card)
                    <div class="col-lg-4">
                        <div class="grid">
                            <figure>
                                <img src="{{asset('images')}}/{{$s_card->image}}" alt="images">
                            </figure>
                            <div class="txt">
                                <div>
                                    <h2>{{$s_card->heading}}</h2>
                                    <p>
                                       {{$s_card->detail}}
                                    </p>
                                </div>
                                <a class="btn" href="{{$s_card->link}}">{{$s_card->button}}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="sec-p hero-logo">
        <div class="container">

            <div class="hero-list">
                <div class="heading">
                    <h4>Pursuits Videos</h4>
                </div>
                <ul>
                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us.html" target="_blank">All U.S. Destinations</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us/il/chicago.html" target="_blank">Chicago Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us/co/denver.html" target="_blank">Denver Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us/tx/houston.html" target="_blank">Houston Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us/nv/las-vegas.html" target="_blank">Las Vegas Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us/ca/los-angeles.html" target="_blank">Los Angeles Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us/fl/miami.html" target="_blank">Miami Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us/ny.html" target="_blank">New York Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us/fl/orlando.html" target="_blank">Orlando Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us/ca/san-francisco.html" target="_blank">San Francisco Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us/wa/seattle.html" target="_blank">Seattle Car Rental</a></li>
                </ul>
            </div>

            <div class="hero-list">
                <div class="heading">
                    <h4>Popular US Airports</h4>
                </div>
                <ul>
                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us.html">All U.S. Airports</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us/ga/atlanta-hartsfield-jackson-intl-airport-030e.html">Atlanta Airport (ATL) Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us/co/denver-international-airport-12e1.html">Denver Airport (DEN) Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us/nv/harry-reid-international-airport-54e1.html">Las Vegas Airport (LAS) Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us/ca/los-angeles-international-airport-320l.html">Los Angeles Airport (LAX) Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us/ca/san-francisco-international-airport-23v9.html">San Francisco Airport (SFO) Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/us/fl/tampa-international-airport-42f1.html">Tampa Airport (TPA) Car Rental</a></li>
                </ul>
            </div>

            <div class="hero-list">
                <div class="heading">
                    <h4>Popular Canadian Cities</h4>
                </div>
                <ul>
                    <li><a href="https://www.enterprise.com/en/car-rental-locations/ca.html">All Canadian Cities</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/ca/ab/calgary.html">Calgary Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/ca/on/toronto.html">Toronto Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/ca/bc/vancouver.html">Vancouver Car Rental</a></li>
                </ul>
            </div>

            <div class="hero-list">
                <div class="heading">
                    <h4>Popular European Cities</h4>
                </div>
                <ul>
                    <li><a href="https://www.enterprise.com/en/car-rental-locations.html">All European Cities</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/es/barcelona.html">Barcelona Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/uk/london.html">London Car Rental</a></li>

                    <li><a href="https://www.enterprise.com/en/car-rental-locations/fr/paris.html">Paris Car Rental</a></li>
                </ul>
            </div>

        </div>
    </section> -->

    <section class="sec-p pt-0 car-rental">
        <div class="container-fluid">
            <div class="bg-transparent p-0 blog-coloums">
                <div class="row">
                    @foreach($third_cards as $t_card)
                    <div class="col-lg-4">
                        <div class="grid">
                            <figure>
                                <img src="{{asset('images')}}/{{$t_card->image}}" alt="images">
                            </figure>
                            <div class="txt">
                                <div>

                                    <h2>{{$t_card->heading}}</h2>
                                    <p>
                                       {{$t_card->detail}}
                                    </p>
                                </div>
                                <a class="btn" href="{{$t_card->link}}"> {{$t_card->button}}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

</main>
<style>

</style>




@endsection