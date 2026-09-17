<footer id="footer" class="footer">

    <div class="container-fluid">
        <div class="ftr-logo">
            <a href="{{url('/')}}">
                <img src="{{asset('images/logo.png')}}" alt="ftr-logo">
            </a>
        </div>
        <div class="row">
            @if(config('content.managed_pages_live'))
            <div class="col-lg-3">
                <div class="ftr-grid">
                    <h6><span>JORDAN CAR RENTAL</span></h6>
                    <ul>
                        <li><a href="{{ route('content.locations.show', 'car-rental-amman-airport') }}">Amman Airport <i class="fa fa-angle-right"></i></a></li>
                        <li><a href="{{ route('content.locations.show', 'car-rental-aqaba-airport') }}">Aqaba Airport <i class="fa fa-angle-right"></i></a></li>
                        <li><a href="{{ route('content.locations.show', 'car-rental-amman') }}">Amman <i class="fa fa-angle-right"></i></a></li>
                        <li><a href="{{ route('content.locations.show', 'car-rental-aqaba') }}">Aqaba <i class="fa fa-angle-right"></i></a></li>
                        <li><a href="{{ route('content.blog.index') }}">Travel Guides <i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
            @endif
            <?php $heading = DB::table('nav_headings')->take(8)->get(); ?>
             @foreach($heading as $head)
            <div class="col-lg-3">
                <div class="ftr-grid">
                   
                    <h6><span>{{$head->heading}}</span></h6>
                    <ul>
                        <?php    $sub_heading = DB::table('nav_sub_headings')->where('nav_id', $head->id)->where('status', 1)->get();?> 
                        @foreach($sub_heading as $sub)
                        @if($sub->id == 13)
                        {{--<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#car-sales-model">{{$sub->sub_heading}} <i class="{{$head->heading == 'INTERNATIONAL WEBSITES' ? 'fa fa-external-link' : 'fa fa-angle-right'}}"></i></a></li>--}}
                        
                        <li><a class="dropdown-item" data-bs-toggle="modal" >{{$sub->sub_heading}} <i class="{{$head->heading == 'INTERNATIONAL WEBSITES' ? 'fa fa-external-link' : 'fa fa-angle-right'}}"></i></a></li>
                       
                        @else
                        <li><a class="dropdown-item" href="{{$sub->link}}">{{$sub->sub_heading}} <i class="{{$head->heading == 'INTERNATIONAL WEBSITES' ? 'fa fa-external-link' : 'fa fa-angle-right'}}"></i></a></li>
                        @endif
                        @endforeach
                    </ul>
                
                </div>
            </div>
            @endforeach
            <!-- <div class="col-lg-3 ">
                <div class="ftr-grid">
                    <div class="app-link">
                        <ul class="d-flex">
                            <li><a href="https://apps.apple.com/us/app/enterprise-rent-a-car/id1020641417"><img src="{{asset('images/apple.png')}}" alt="app-icn"></a></li>
                            <li><a href="https://play.google.com/store/apps/details?id=com.ehi.enterprise.android&utm%20source=Web%20LP&utm%20campaign=EeApp"><img src="{{asset('images/android.png')}}" alt="app-icn"></a></li>
                        </ul>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

    <div class="ftr-bottom">
        <div class="container-fluid">
            <div class="ftr-bottom-inner">
                <ul class="d-flex ftr-social-icn">
                    <li class="fb"><a target="_blank" href="https://www.facebook.com/enterprisejo"><i class="fab fa-facebook"></i></a></li>
                    <li class="yt"><a target="_blank" href="https://www.instagram.com/enterprisecarjo"><i class="fab fa-instagram"></i></a></li>
                    <li class="tw"><a target="_blank" href="https://x.com/enterprisecarjo">
                        <svg xmlns="http://www.w3.org/2000/svg" class="footer-x-icon" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
                           <path d="M 6.9199219 6 L 21.136719 26.726562 L 6.2285156 44 L 9.40625 44 L 22.544922 28.777344 L 32.986328 44 L 43 44 L 28.123047 22.3125 L 42.203125 6 L 39.027344 6 L 26.716797 20.261719 L 16.933594 6 L 6.9199219 6 z"></path>
                        </svg></a>
                    </li>
                    <li class="tw"><a target="_blank" href="https://www.linkedin.com/company/enterprisecarjo"><i class="fab fa-linkedin"></i></a></li>
                </ul>
                <ul class="d-flex ftr-links">
                    <li>
                        <!-- <a target="_blank" href="{{asset('/en/help/terms-and-conditions.html?icid=footer.legal-_-terms-_-ENGB.NULL')}}"> -->
                        <a target="_blank" href="{{ route('terms_of_use') }}">
                            Terms of Use
                            <i class="icon none"></i>
                        </a>
                    </li>

                    <li>
                        <!-- <a target="_blank" href="https://privacy.ehi.com/en-us/home.html"> -->
                        <a target="_blank" href="{{ route('privacy_policy') }}">
                            Privacy Policy
                            <i class="icon icon-nav-external-link"></i>
                        </a>
                    </li>

                    <li>
                        <!-- <a target="_blank" href="https://privacy.ehi.com/en-gb/home/cookie-policy.html"> -->
                        <a target="_blank" href="{{ route('cookie_policy') }}">
                            Cookie Policy
                            <i class="icon icon-nav-external-link"></i>
                        </a>
                    </li>

                    <li>
                        <!-- <a target="_blank" href="https://privacy.ehi.com/en-gb/home/cookie-policy.html"> -->
                        <a target="_blank" href="{{ route('terms_conditions') }}">
                           Terms And Conditions
                            <i class="icon icon-nav-external-link"></i>
                        </a>
                    </li>

                    <!-- <li>
                        <a href="#one_trust" onclick="event.preventDefault();">
                            Cookie Settings / AdChoices
                            <i class="icon icon-ad-choices"></i>
                        </a>
                    </li> -->

                    <li>
                        © <?php echo date('Y'); ?> AL AMAL TOURIST CAR RENTAL.
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- popups -->




<!-- Modal View Currency Conversion Details -->
<div class="modal modal-2 fade" id="View-Currency-Conversion-Details" tabindex="-1" aria-labelledby="View-Currency-Conversion-Details-Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header mb-2">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5 pt-5">
                <h2 >Currency Conversion Details</h2>
                <p>For reservations booked in a foreign destination, the prices shown may be converted to your local currency or an alternative currency that you have otherwise selected, in addition to the prices in your destination's currency. Conversions into your local or selected currency are for your reference only. As you are booking into a destination that uses a currency other than your local currency, you will be charged in that destination currency in the amounts shown. All amounts converted into your local or selected currency are subject to change due to fluctuations in currency exchange rates.</p>
            </div>
            <div class="modal-footer" >
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal View CAR SALES Details -->
<div class="modal modal-2 fade" id="car-sales-model" tabindex="-1" aria-labelledby="car-sales-model-Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header mb-2">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5 pt-5">
                <h2 >Would you like to visit the Car Sales website?</h2>
                <p class="external-site-modal-copy">By clicking on this link, you acknowledge that you are leaving
                    this website and being redirected to https://www.enterprisecarsales.com/?utm_source=Enterprise&utm_medium=Referral&utm_campaign=FooterHP&cm_mmc=EnterpriseWebsite-_-Footer-_-buy.carsales-_-EN_US, which
                    is (i) subject to its own terms and conditions, (ii) hosted by
                    Enterprise in Jordan, and (iii) not
                    owned or operated by Enterprise Mobility, owner of the
                    Enterprise Rent A Car, National Car Rental and Alamo Rent A
                    Car brands. Enterprise car sales is affiliated with Enterprise and not
                    Enterprise Mobility</p>
            </div>
            <div class="modal-footer modal-footer--no-border">
                <button type="button" class="btn btn-outline-secondary external-site-stay-button" data-bs-dismiss="modal">No, Stay Here</button>
               <a href="https://www.enterprisecarsales.com/?utm_source=Enterprise&utm_medium=Referral&utm_campaign=FooterHP&cm_mmc=EnterpriseWebsite-_-Footer-_-buy.carsales-_-EN_JORDAN" type="button" class="btn btn-secondary" >Yes, Go to Car Sales</a>
            </div>
        </div>
    </div>
</div>



<!-- Modal time/date -->
<div class="modal modal-2 fade" id="time-date" tabindex="-1" aria-labelledby="time-date-Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="time-date-Label"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                 <div class="p-4 date_time_msg">
                    <h6>Sold Out Location</h6>
                    <h4 class="" id="">No Availability At This Location During Your Selected Date/Time</h4>
                    <p id="pt-2">View nearby locations to find the closest available vehicles.</p>
                    <div class="float-end">
                        <button class="btn btn-primary ad_date_time">Adjust Date/Time</button>
                        <span class="">or</span>
                        <button class="btn btn-primary" type="button">See Nearby Locations</button>
                    </div>
                </div>
                 <div class="p-4 date_time_form d-none">
                    <h4 class="" id="">Change Your Selection</h4>
                        <div class="d-flex gap-5">
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
                    <div class="float-end mt-3">
                        <button class="btn" type="button" onclick="startReservation();">Browse Vehicles</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



  <!-- <input type="text" name='range' class="cal form-control" value="" id="pick_up_date"> -->

  
</footer>
