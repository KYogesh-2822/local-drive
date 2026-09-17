@extends('layouts.main')

@section('content')


<main class="content">
  
    <div class="vehicle-select__header">
        <div class="vehicle-header">
            <div class="vehicle-header__title">
                <h1 class="vehicle-header__sub-title">Choose a Vehicle Class</h1>
                <div class="vehicle-header__details">
                    <span class="vehicle-header__details-group">
                        <p class="vehicle-header__result-total">{{$count}} Results</p>
                    </span>
                </div>
            </div>
            <div class="vehicle-header__info">
                <div class="vehicle-header__info-group">
                    <div class="vehicle-header__sort-by form-group">
                        <label class="rs-label" for="vehicleSortBy"><b>Sort By</b></label>
                        <div class="rs-input">
                            <select class="form-select vehicle-filter" name="vehicleSortBy" aria-required="false" id="vehicleSortBy">
                                <option value="">Featured</option>
                                <option value="low-to-high">Price: Low to High</option>
                                <option value="high-to-low">Price: High to Low</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="sec-p vehicle-filter-sec">
        <div class="container">
            <div class="d-flex vehicle-filter-grid active-filter">
                <aside class="rs-tooltip--label">
                    <span>
                        <div class="vehicle-redemption">
                            <span class="vehicle-redemption__title vehicle-redemption__title-margin">
                                <span class="vehicle-redemption__title-brand-eplus">
                                    <i class="icon icon-eplus-logo-vr"></i>
                                       <span>Enterprise Plus®</span>,</br>  
                                    </span>
                                </span>
                                @if(Auth::check())
                                <div class="vehicle-redemption__points">
                                    <span class="vehicle-redemption__points-text">Total Points</span>
                                        <div class="vehicle-redemption__points-total">
                                            <span>{{auth()->user()->points}}</span>
                                        </div>
                                </div>
                                @endif
                                <ul class="vehicle-redemption__options" role="tablist">
                                    <li class="v-pay vehicle-redemption__options-item vehicle-redemption__options-item--active"
                                        role="presentation">
                                        <button role="tab" aria-selected="true" type="button"
                                            class="vehicle-redemption__options-cta">Pay in $ </button>
                                    </li>
                                    <li class="v-point vehicle-redemption__options-item" role="presentation">
                                        <button role="tab" aria-selected="false" type="button"
                                            class="vehicle-redemption__options-cta">Pay in Points</button>
                                    </li>
                                </ul>
                            </div>
                            <nav class="ehi-nav-tabs ehi-nav-tabs__inverted">
                                <div class="ehi-nav-tabs__item"><button
                                        class="ehi-nav-tabs__link ehi-nav-tabs__link--active" role="tab">Pay in $ </button>
                                </div>
                                <div class="ehi-nav-tabs__item"><button class="ehi-nav-tabs__link" role="tab">Pay in
                                        Points</button></div>
                            </nav>
                        </span>
                    <div class="mt-4 vehicle-filter">
                        <!-- Pay -->
                        <div class="vehicle-filter__content">
                            <div class="vehicle-filter__header-border">
                                <div class="vehicle-filter__header-main">
                                    <h3 class="vehicle-filter__header-title">Filters</h3>
                                </div>
                            </div>
                            <!-- <div class="vehicle-filter__filter">
                                <div class="vehicle-filter__filter-header"><span class="vehicle-filter__title" id="mileage">Mileage</span><span class="vehicle-filter__price-indicator">Total from</span></div>
                                <div class="vehicle-filter__accordion-content">
                                    <div class="vehicle-filter__list-content">
                                        <ul class="vehicle-filter__filter-list" role="group" aria-labelledby="mileage">
                                            <li class="vehicle-filter__filter-list-item">
                                                <div class="" style="display: inline;"><label class="rs-checkbox" data-dtm-tracking="car_filters|Unlimited Mileage|unchecked">
                                                        <input type="checkbox" value="unlimited_mileage"><span class="rs-checkbox__text">Unlimited Mileage</span>
                                                    </label>
                                                </div>
                                                <span class="vehicle-filter__price-indicator">$50</span>
                                            </li>
                                            <li class="vehicle-filter__filter-list-item">
                                                <div class="" data-tooltipped="" aria-describedby="tippy-tooltip-2" style="display: inline;"><label class="rs-checkbox" data-dtm-tracking="car_filters|Limited Mileage|unchecked"><input type="checkbox" data-dtm-tracking="car_filters|Limited Mileage|unchecked" value="limited_mileage"><span class="rs-checkbox__text">Limited Mileage</span></label></div><span class="vehicle-filter__price-indicator">-</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                            <div class="vehicle-filter__filter">
                                <div class="vehicle-filter__filter-header"><span class="vehicle-filter__title"
                                        id="class">Vehicle Type</span><span
                                        class="vehicle-filter__price-indicator">Total from</span></div>
                                <div class="vehicle-filter__accordion-content">
                                    <div class="vehicle-filter__list-content">
                                        <ul class="vehicle-filter__filter-list" role="group" aria-labelledby="class">
                                            @foreach($types as $type)
                                            <li class="vehicle-filter__filter-list-item">
                                                <div class="" data-tooltipped="" aria-describedby="tippy-tooltip-3"
                                                    style="display: inline;">
                                                    <label class="rs-checkbox"
                                                        data-dtm-tracking="car_filters|Cars|unchecked">
                                                        <input type="checkbox"
                                                            data-dtm-tracking="car_filters|Cars|unchecked"
                                                            class="seletedType" value="{{$type->type}}">
                                                        <span class="rs-checkbox__text">{{$type->type}}</span>
                                                    </label>
                                                </div>
                                                <span class="vehicle-filter__price-indicator">$50</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="vehicle-filter__filter">
                                <div class="vehicle-filter__filter-header"><span class="vehicle-filter__title"
                                        id="fuel">Fuel Type</span><span class="vehicle-filter__price-indicator">Total
                                        from</span></div>
                                <div class="vehicle-filter__accordion-content">
                                    <div class="vehicle-filter__list-content">
                                        <ul class="vehicle-filter__filter-list" role="group" aria-labelledby="fuel">
                                            @foreach($fuels as $fuel)
                                            <li class="vehicle-filter__filter-list-item">
                                                <div class="" data-tooltipped="" aria-describedby="tippy-tooltip-12"
                                                    style="display: inline;">
                                                    <label class="rs-checkbox"
                                                        data-dtm-tracking="car_filters|{{$fuel->fuel_type}} Vehicle|unchecked">
                                                        <input type="checkbox"
                                                            data-dtm-tracking="car_filters|{{$fuel->fuel_type}} Vehicle|unchecked"
                                                            class="fuelType" value="{{$fuel->fuel_type}}">
                                                        <span class="rs-checkbox__text">{{$fuel->fuel_type}}
                                                            Vehicle</span>
                                                    </label>
                                                </div>
                                                <span class="vehicle-filter__price-indicator">$50</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="vehicle-filter__filter">
                                <div class="vehicle-filter__filter-header"><span class="vehicle-filter__title"
                                        id="passengers">Number of Passengers</span><span
                                        class="vehicle-filter__price-indicator">Total from</span></div>
                                <div class="vehicle-filter__accordion-content">
                                    <div class="vehicle-filter__list-content">
                                        <ul class="vehicle-filter__filter-list" role="group"
                                            aria-labelledby="passengers">
                                            <li class="vehicle-filter__filter-list-item">
                                                <div class="" data-tooltipped="" aria-describedby="tippy-tooltip-14"
                                                    style="display: inline;">
                                                    <label class="rs-checkbox"
                                                        data-dtm-tracking="car_filters|2+|unchecked">
                                                        <input type="checkbox"
                                                            data-dtm-tracking="car_filters|2+|unchecked" class="pass"
                                                            value=2>
                                                        <span class="rs-checkbox__text">2+</span>
                                                    </label>
                                                </div>
                                                <span class="vehicle-filter__price-indicator">$50</span>
                                            </li>
                                            <li class="vehicle-filter__filter-list-item">
                                                <div class="" data-tooltipped="" aria-describedby="tippy-tooltip-15"
                                                    style="display: inline;">
                                                    <label class="rs-checkbox"
                                                        data-dtm-tracking="car_filters|4+|unchecked">
                                                        <input type="checkbox"
                                                            data-dtm-tracking="car_filters|4+|unchecked" class="pass"
                                                            value=4>
                                                        <span class="rs-checkbox__text">4+</span>
                                                    </label>
                                                </div>
                                                <span class="vehicle-filter__price-indicator">$50</span>
                                            </li>
                                            <li class="vehicle-filter__filter-list-item">
                                                <div class="" data-tooltipped="" aria-describedby="tippy-tooltip-16"
                                                    style="display: inline;">
                                                    <label class="rs-checkbox"
                                                        data-dtm-tracking="car_filters|5+|unchecked">
                                                        <input type="checkbox"
                                                            data-dtm-tracking="car_filters|5+|unchecked" class="pass"
                                                            value=5>
                                                        <span class="rs-checkbox__text">5+</span>
                                                    </label>
                                                </div>
                                                <span class="vehicle-filter__price-indicator">$50</span>
                                            </li>
                                            <li class="vehicle-filter__filter-list-item">
                                                <div class="" data-tooltipped="" aria-describedby="tippy-tooltip-17"
                                                    style="display: inline;">
                                                    <label class="rs-checkbox"
                                                        data-dtm-tracking="car_filters|7+|unchecked">
                                                        <input type="checkbox"
                                                            data-dtm-tracking="car_filters|7+|unchecked" class="pass"
                                                            value=7>
                                                        <span class="rs-checkbox__text">7+</span>
                                                    </label>
                                                </div>
                                                <span class="vehicle-filter__price-indicator">$64</span>
                                            </li>
                                            <li class="vehicle-filter__filter-list-item">
                                                <div class="" data-tooltipped="" aria-describedby="tippy-tooltip-18"
                                                    style="display: inline;">
                                                    <label class="rs-checkbox"
                                                        data-dtm-tracking="car_filters|8+|unchecked">
                                                        <input type="checkbox"
                                                            data-dtm-tracking="car_filters|8+|unchecked" class="pass"
                                                            value=8>
                                                        <span class="rs-checkbox__text">8+</span>
                                                    </label>
                                                </div>
                                                <span class="vehicle-filter__price-indicator">$146</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </aside>


                <!-- Pay -->
                <div class="vehicle-filter-coloum " id="vechile_append">
                    @if(auth()->check())
                    <input type="hidden" value="{{auth()->user()->points}}" id="user_points">
                    @else
                    <input type="hidden" value="0" id="user_points">
                    @endif
                    @foreach($vehicles as $vehicle)
                    <div class="inner-grid">
                        <div class="d-flex grid">
                            <div class="vehicle-item-image">
                                <img src="{{asset('vehicles/')}}/{{$vehicle->image}}" height="135" width="200" alt="">
                            </div>
                            <div class="vehicle-item-summary-container">
                                <h4 class="vehicle-item-title">{{$vehicle->vehicle}}</h4>
                                <p class="m-0 vehicle-item-models">{{$vehicle->model}}</p>
                                <ul class="d-flex vehicle-specs-list">
                                    <li class="vehicle-class-card__specs-item">
                                        <i class="icon icon-specs-transmission-gray"></i>
                                        <span>{{$vehicle->transmission}}</span>
                                    </li>
                                    <li class="vehicle-class-card__specs-item">
                                        <i class="icon icon-specs-passenger-gray"></i>
                                        <span>{{$vehicle->passengers}} People</span>
                                    </li>
                                    <li class="vehicle-class-card__specs-item">
                                        <i class="icon icon-specs-bags-gray"></i>
                                        <span>{{$vehicle->bags}} Bags</span>
                                    </li>
                                </ul>
                                <div class="drop-grid">
                                    <a class="btn-txt" onclick="clickBtn({{$vehicle->id}});">Features & Price Details <i
                                            class="fa fa-angle-down"></i></a>
                                </div>
                            </div>


                            <div class="vehicle-item-pricing pay-grid">
                                <div class="vehicle-price-header">
                                    <span>PAY LATER</span>
                                </div>
                                <?php $price = explode(".",$vehicle->price); 
                                    $before = $price[0];
                                    $after = $price[1];
                                    $tax_price = ($vehicle->price*$days) + $vehicle->tax;
                                    $total = explode(".",$tax_price);
                                    $total_before = $total[0];
                                    $total_after = $total[1];

                                ?>
                                <div class="d-flex price">
                                    <div>
                                        <h3><sup>$</sup>{{$before}}<sup>.{{$after}}</sup></h3>
                                        <span>Per Day</span>
                                    </div>
                                    <div>
                                        <h3><sup>$</sup>{{$total_before}}<sup>.{{$total_after}}</sup></h3>
                                        <span>Total</span>
                                    </div>
                                </div>
                                <div class="btn-grid btn-grid{{$vehicle->id}}">
                                    <a class="btn"  onclick="selectVehicle({{$vehicle->id}},{{$days}},'price');">Select</a>
                                </div>
                            </div>
                            <div class="vehicle-item-pricing point-grid">
                                <div class="vehicle-price-header">
                                    <span>REDEEM POINTS</span>
                                </div>
                                <div class="d-flex price">
                                    <h3>{{$vehicle->points}}</h3>
                                    <span>Per Day</span>
                                </div>
                                <div class="btn-grid btn-grid{{$vehicle->id}}">
                                    @if (Auth::check())
                                       @if(auth()->user()->points >= $vehicle->points)
                                       <button class="btn" onclick="selectVehicle({{$vehicle->id}},{{$days}},'points');">select</button>
                                       @else
                                       <button class="btn btn-secondary" disabled>Not Enough Points for a Free Day</button>
                                       @endif
                                       @else
                                       <!-- <a class="btn" href="{{route('login')}}">Sign In to Reserve in Points</a> -->
                                        <a class="btn btn-txt" data-bs-toggle="modal" data-bs-target="#select-car-point" href="javascript:void(0)">Sign In to Reserve in Points</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="price-detail carDetail{{$vehicle->id}}">

                            <div class="d-flex vehicle-details is-expanded">
                                <div class="vehicle-details__features">
                                    <h3 class="vehicle-details__heading">Vehicle Features</h3>
                                    <ul class="vehicle-details__feature-list">
                                        <?php $a = trim($vehicle->features, '"');
                                        $feature = explode(",", $a); ?>
                                        @foreach($feature as $data)
                                        <li class="vehicle-details__feature-item">{{$data}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="vehicle-details__price">
                                    <h3 class="vehicle-details__heading" id="ECAR-vehicle-details-heading-h3">Price
                                        Details</h3>
                                    <div class="pricing-details cf">
                                        <div class="pricing-details__loading-error"></div>
                                        <ul class="pricing-details__list">
                                            <li class="cf"><span class="left">{{$days}} Day(s)</span><span class="right">$
                                                    {{$vehicle->price * $days}}*</span></li>
                                            <li class="cf"><span class="left">Unlimited Mileage</span><span
                                                    class="right">Included</span></li>
                                            <li class="cf"><span class="left"><a class="btn-txt" data-bs-toggle="modal"
                                                        data-bs-target="#Tax-Fee-Details" href="javascript:void(0)">Tax
                                                        Fee Details</a></span><span class="right">$
                                                    {{$vehicle->tax}}</span></li>
                                        </ul>
                                        <div class="pricing-details__bottom-area">
                                            <div class="cf">
                                                <div class="pricing-details__total-pricing-title">Estimated Total</div>
                                                <div class="pricing-details__price-total">$ {{$tax_price}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="currencyConversationText">Estimated total converted to your local
                                        currency. Pay later charges will be in <span class="text-bold">CAD
                                            (CAD46.26)</span>.</div>
                                </div>
                                <div class="vehicle-details__footer">
                                    <p class="vehicle-details__footer-text"><a href=""
                                            aria-label="Back to Price Details" id="ECAR-legal-rateTaxFee-footer-id"
                                            style="color: black;"><span class="is-hidden">Back to Price
                                                Details</span></a>*Rates, taxes and fees do not reflect rates, taxes and
                                        fees applicable to non-included optional coverages or extras added later.</p>
                                    <p class="vehicle-details__footer-learn-more">**Converted amounts are estimates and
                                        are subject to changes as exchange rates vary. <a class="btn-txt"
                                            data-bs-toggle="modal" data-bs-target="#View-Currency-Conversion-Details"
                                            href="javascript:void(0)">View Currency Conversion Details</a></p>
                                </div>
                            </div>


                        </div>
                        <!-- Modal Tax Fee Details -->
                        <div class="modal modal-1 fade" id="Tax-Fee-Details" tabindex="-1" aria-labelledby="Tax-Fee-Details-Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                       
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <h2 class="rs-modal__modal-title" id="rs-modal-heading">Taxes &amp; Fees</h2>
                                            <ul class="cf taxes-and-fees">
                                                <li class="cf">
                                                    <span class="left">CONCESSION FEE RECOVERY 16.62 PCT (16.62%)</span>
                                                    <span class="right">$ 13.59*</span>
                                                </li>
                                                <li class="cf">
                                                    <span class="left">VLF REC 0.80/DAY</span>
                                                    <span class="right">$ 1.19*</span>
                                                </li>
                                                <li class="cf">
                                                    <span class="left">GOODS AND SERVICES TAX (5.0%)</span>
                                                    <span class="right">$ 4.77*</span>
                                                </li>
                                                <li class="cf">
                                                    <span class="left">PROVINCIAL SALES TAX (7.0%)</span>
                                                    <span class="right">$ 6.68*</span>
                                                </li>
                                            </ul>
                                        
                                            <div class="taxes-copy taxes-clear">*Rates, taxes and fees do not reflect rates, taxes and fees applicable to non-included optional coverages or extras added later.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Tax Fee Details -->
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        {!! $vehicles->withQueryString()->links('pagination::bootstrap-5') !!}
    </section>
    
</main>
<!-- Modal select car with points -->
<div class="modal modal-2 fade" id="select-car-point" tabindex="-1" aria-labelledby="select-car-point-Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="select-car-point-Label"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <section class="sec-p signin-tabs">
                <div class="container-fluid">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Enterprise Plus</button>
                        </div>
                    </nav>
                    <div class="tab-content card" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="tab-form ">
                                <div class="mt-4 form">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label">Email or Member Number</label>
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label">Password</label>
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>

                                                <div class="form-check mt-4">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="remember">Keep me signed in</label>
                                                </div>

                                            </div>



                                            <div class="col-lg-12">
                                                <div class="btn-grid mt-4 text-end">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                                                    <button type="submit" class="btn btn-primary">Sign In</button>
                                                  
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </section>
            </div>
            <div class="modal-footer">
           
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js"></script>
<script>
function clickBtn($id) {
    $(".carDetail" + $id).toggleClass("show");
}

//filter
$(document).ready(function() {
    var upoints = $('#user_points').val();

    var days = {{$days}};
 
    var type = [];
    var fuel = [];
    var passenger = [];
    $('.vehicle-filter').on('click change',function() {
       var sort =  $('#vehicleSortBy').val();
        $('.seletedType:checked').each(function(i) {
            type[i] = $(this).val();
        });

        $('.fuelType:checked').each(function(i) {
            fuel[i] = $(this).val();
        });

        $('.pass:checked').each(function(i) {
            passenger[i] = $(this).val();
        });

        $.ajax({
            url: "{{route('reservation.filter')}}",
            data: {
                'type': type,
                'fuel': fuel,
                'passenger': passenger,
                'sort': sort
            },
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
            },
            success: function(response) {
              
                $('#vechile_append').html('');
                $.each(response.data, function(i, v) {
                    var totalPrice = (parseFloat(v.price)*days)+parseFloat(v.tax);
                    var totalsubstr = String(totalPrice.toFixed(2)).split(".");
                    var totalbeforedot = totalsubstr[0];
                    var totalafterdot = totalsubstr[1];
                    var price = v.price;
                    var substr = price.split('.');
                    var beforedot = substr[0];
                    var afterdot = substr[1];
                    var tax = v.tax; 
                    var substr1 = tax.split('.');
                    var taxbeforedot = substr1[0];
                    var taxafterdot = substr1[1];
                    var v_id = v.points;
                    if(upoints >= v_id){
                       var points_con = `<button class="btn" onclick="selectVehicle({{$vehicle->id}},{{$days}},'points');">select</button>`;
                    }else{
                       var points_con = `<button class="btn btn-secondary" disabled>Not Enough Points for a Free Day</button>`;
                    }
                                   

                    $('#vechile_append').append(`<div class="inner-grid">
                        <div class="d-flex grid">
                            <div class="vehicle-item-image">
                                <img src="{{asset('vehicles/')}}/${v.image}" height="135" width="200" alt="">
                            </div>
                            <div class="vehicle-item-summary-container">
                                <h4 class="vehicle-item-title">${v.vehicle}</h4>
                                <p class="m-0 vehicle-item-models">${v.model}</p>
                                <ul class="d-flex vehicle-specs-list">
                                    <li class="vehicle-class-card__specs-item">
                                        <i class="icon icon-specs-transmission-gray"></i>
                                        <span>${v.transmission}</span>
                                    </li>
                                    <li class="vehicle-class-card__specs-item">
                                        <i class="icon icon-specs-passenger-gray"></i>
                                        <span>${v.passengers} People</span>
                                    </li>
                                    <li class="vehicle-class-card__specs-item">
                                        <i class="icon icon-specs-bags-gray"></i>
                                        <span>${v.bags} Bags</span>
                                    </li>
                                </ul>
                                <div class="drop-grid">
                                    <a class="btn-txt" onclick="clickBtn(${v.id});">Features & Price Details <i class="fa fa-angle-down"></i></a>
                                </div>
                            </div>


                            <div class="vehicle-item-pricing pay-grid">
                            <div class="vehicle-price-header">
                                    <span>PAY LATER</span>
                                </div>
                        
                                <div class="d-flex price">
                                    <div>
                                        <h3><sup>$</sup>${beforedot}<sup>.${afterdot}</sup></h3>
                                        <span>Per Day</span>
                                    </div>
                                    <div>
                                        <h3><sup>$</sup>${totalbeforedot}<sup>.${totalafterdot}</sup></h3>
                                        <span>Total</span>
                                    </div>
                                </div>

                                <div class="btn-grid btn-grid${v.id}">
                                    <a class="btn" onclick="selectVehicle(${v.id},${days},'price');">Select</a>
                                </div>
                            </div>


                            <div class="vehicle-item-pricing point-grid">
                                <div class="vehicle-price-header">
                                    <span>REDEEM POINTS</span>
                                </div>
                                <div class="d-flex price">
                                    <h3>${v.points}</h3>
                                    <span>Per Day</span>
                                </div>
                                <div class="btn-grid btn-grid${v.id}">
                                    @if (Auth::check())
                                      ${points_con}
                                       @else
                                        <a class="btn btn-txt" data-bs-toggle="modal" data-bs-target="#select-car-point" href="javascript:void(0)">Sign In to Reserve in Points</a>
                                    @endif
                                  
                                </div>
                            </div>



                        </div>
                        <div class="price-detail carDetail${v.id}">

                            <div class="d-flex vehicle-details is-expanded">
                                <div class="vehicle-details__features">
                                    <h3 class="vehicle-details__heading">Vehicle Features</h3>
                                    <ul class="vehicle-details__feature-list">
                                        <?php $a = trim($vehicle->features, '"');
                                        $feature = explode(",", $a); ?>
                                        @foreach($feature as $data)
                                        <li class="vehicle-details__feature-item">{{$data}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="vehicle-details__price">
                                    <h3 class="vehicle-details__heading" id="ECAR-vehicle-details-heading-h3">Price Details</h3>
                                    <div class="pricing-details cf">
                                        <div class="pricing-details__loading-error"></div>
                                        <ul class="pricing-details__list">
                                            <li class="cf"><span class="left">${days} Day(s)</span><span class="right">$ ${price * days}*</span></li>
                                            <li class="cf"><span class="left">Unlimited Mileage</span><span class="right">Included</span></li>
                                            <li class="cf"><span class="left"><a class="btn-txt" data-bs-toggle="modal" data-bs-target="#Tax-Fee-Details" href="javascript:void(0)">Tax Fee Details</a></span><span class="right">$ ${tax}</span></li>
                                        </ul>
                                        <div class="pricing-details__bottom-area">
                                            <div class="cf">
                                                <div class="pricing-details__total-pricing-title">Estimated Total</div>
                                                <div class="pricing-details__price-total">$ ${totalPrice.toFixed(2)}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="currencyConversationText">Estimated total converted to your local currency. Pay later charges will be in <span class="text-bold">CAD (CAD46.26)</span>.</div>
                                </div>
                                <div class="vehicle-details__footer">
                                    <p class="vehicle-details__footer-text"><a href="" aria-label="Back to Price Details" id="ECAR-legal-rateTaxFee-footer-id" style="color: black;"><span class="is-hidden">Back to Price Details</span></a>*Rates, taxes and fees do not reflect rates, taxes and fees applicable to non-included optional coverages or extras added later.</p>
                                    <p class="vehicle-details__footer-learn-more">**Converted amounts are estimates and are subject to changes as exchange rates vary. <a class="btn-txt" data-bs-toggle="modal" data-bs-target="#View-Currency-Conversion-Details" href="javascript:void(0)">View Currency Conversion Details</a></p>
                                </div>
                            </div>


                        </div>
                    </div>
                        `);
                });

            }
        });
    });
});

</script>
@endsection