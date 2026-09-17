
<header class="header header-inner">
        <div class="container-fluid">
            <div class="top-bar">
                <div class="logo">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{asset('images/logo.png')}}" alt="logo">
                    </a>
                </div>
                <div class="top-links">
                    <ul class="d-flex">
                        <li><a class="btn" data-bs-toggle="modal" data-bs-target="#Terms-Conditions-Policies" href="javascript:void(0)">Terms & Conditions / Policies</a></li>
                    </ul>
                </div>
                <button type="button" class="full-amount ">
                    <span class="amount header-prise">
                        <p class="price-label">Total</p>
                        <sup class="sup-price">$</sup>
                        <div class="regular-price header_total_price">0</div>
                        <sup>.<sup>
                        <sup class="sup-rate afterDot">00</sup>
                    </span>
                    <span class="amount header-points d-none">
                        <p class="price-label">Total</p>
                        <span class="header_total_points text-white">0</span>
                    </span>
                </button>
            </div>
        </div>
    </header> 

    
    <section class="top-filter">
        <div class="accordionn accordion-flush d-flex" id="accordion-Filter">
            <div class="accordion-item m">
                <h2 class="accordion-header r" id="flush-headingOnee">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOnee" aria-expanded="false" aria-controls="flush-collapseOnee">
                        <span>
                            <figure>
                                <img src="{{asset('images/checked.png')}}" alt="checked">
                            </figure> Completed Reservation Step
                        </span>
                        <ul>
                            <li class="pickup_time_date"></li>
                            <li class="return_time_date"></li>
                        </ul>
                    </button>
                </h2>
                <div id="flush-collapseOnee" class="e accordion-collapse collapse" aria-labelledby="flush-headingOnee" data-bs-parent="#accordion-Filter">
                    <div class="accordion-body">
                        <div class="hero-form m-auto border-0 bg-transparent">
                            <div class="heading">
                                <h3>Change Your Date & Time</h3>     
                            </div>
                            <div class="form form-date">
                                <form id="start_a_reservation-select">
                                    @csrf
                                    <div class="">
                                        <div class="form-group date-griddd date-grid date-grid-off">
                                            <label class="form-label">Return Location (Postal Code, City or Airport)*</label>
                                            <input type="text" class="form-control" placeholder="Provide a Return Location" >
                                        </div>

                                        <div class="form-group row mt-3">
                                            <div class="col-lg-8 d-flex gap-5">
                                                <div class="date-col">
                                                    <label class="form-label form-label-two">
                                                        <div class="num"></div> Pick-up*
                                                    </label>
                                                    <div class="date d-flex">
                                                        <!-- <input type="text" name='range' class="cal form-control" value="" id="pick_up_date"> -->
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
                                            <div class="col-lg-4 header-inner-update-action">
                                               <button class="btn btn-primary" type="submit" onclick="location.reload();">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item m">
                <h2 class="accordion-header r" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <span><figure>
                                <img src="{{asset('images/checked.png')}}" alt="checked">
                            </figure> Pick-up & Return
                        </span>
                        <ul>
                            <li class="loc_name"></li>
                        </ul>
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="e accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordion-Filter">
                    <div class="accordion-body">
                        <div class="address">
                            <div class="hero-form m-auto border-0 bg-transparent">
                                <div class="heading">
                                     <h3>Change Your Location</h3>
                                </div>
                                <div class="form form-date">
                                    <form id="start_a_reservation">
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
                                                <label class="form-label">Return Location (Postal Code, City or Airport)*</label>
                                                <input type="text" class="form-control" placeholder="Provide a Return Location" >
                                            </div>
                                        </div>
                                        <div><button class="btn btn-primary" type="button" onclick="updateLocation();">Update</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item m">
                <h2 class="accordion-header r" id="flush-headingThree">
                    <a class="accordion-button collapsed" href="{{route('reservation.carSelect')}}">
                        <span><figure class="append_checked_icon">
                                
                            </figure>Vehicle</span>
                        <ul>
                            <li class="selected_vehicle">Select</li>
                        </ul>
                    </a>
                </h2>
            </div>
            <div class="accordion-item m">
                <h2 class="accordion-header r" id="flush-headingFour">
                    <button class="accordion-button collapsed" type="button">
                        <span> Extras</span>
                        <ul>
                            <li class="selected_extras"></li>
                        </ul>
                    </button>
                </h2>
            </div>
            <div class="accordion-item m">
                <h2 class="accordion-header r" id="flush-headingFive">
                    <button class="accordion-button collapsed" type="button" >
                        <span>Review & Reserve</span>
                    </button>
                </h2>
            </div>

        </div>
    </section>
