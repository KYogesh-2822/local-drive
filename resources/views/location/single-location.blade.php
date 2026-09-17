@extends('layouts.main')

@section('content')

<main class="business-car-rental airport_box">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('business.carRental')}}">Business Car Rental</a></li>

            </ul>
        </div>
    </div>


    <div class="airport_heading">
        <div class="container">
            <h2>{{$data->location_name}}</h2>
        </div>
    </div>

    <section class="nav_section">
        <div class="container">
            <!-- <h3>Queen Beatrix Intl. Airport (AUA) Car Rental</h3> -->
            <div class="nav_items">
                <ul>
                    <li><a href="#">Reserve</a></li>
                    <li><a href="#airportSection">Contact & Hours</a></li>
                    <li><a href="#direction">Additional Info</a></li>
                    <li><a href="#policySection">Policies</a></li>
                    <li><a href="#exploreSection">Nearby Locations</a></li>
                    <li><a href="#queenAirport">FAQs</a></li>
                </ul>
            </div>
        </div>
    </section>
    <section class="sec-p address bg-transparent">
        <div class="container-fluid">
            <div class="hero-form m-auto border-0 bg-transparent">
                <div class="heading">
                    <h3><span class="ps-0">Reserve a Vehicle</span></h3> <span>or <a href="{{route('reservation.vMc')}}">View / Modify / Cancel Reservation</a></span>
                </div>
                <div class="form form-date" id="pbk-widget"></div>
            </div>
        </div>
    </section> 
    
    <section class="airport_section" id="airportSection">
        <div class="container">
            <h4>{{$data->location_name}}</h4>
            <div class="map_schedule">
                <div class="map">
                    <h5>Location Details</h5>
                    <div id="single-map" style="height: 310px; width: 100%;"></div>
        
                    <div class="airport_details">
                        <p>{{$data->location_name}}</p>
                        <p>{{$data->address}}</p>
                        <p><a href="https://www.google.com/maps/place/Enterprise+Rent-A-Car/@44.8008089,-93.5123906,17z/data=!3m1!4b1!4m6!3m5!1s0x87f610b7e8c45281:0x646c21210652c14!8m2!3d44.8008089!4d-93.5123906!16s%2Fg%2F1td3s1b9?entry=ttu">Get Directions <i class="fas fa-external-link-alt"></i></a> <br>
                            {{$data->phone}}</p>
                    </div>
                </div>
                <?php    
                    $hours = DB::table('hours_services')->where('location_id',$data->id)->first();
                    $datas = json_decode($hours->hours, TRUE);
                ?>
              
                <div class="schedule">
                    <h5>Hours & Services</h5>
                    <div class="table">
                        <div class="date_selector">
                            <!-- <i class="fas fa-long-arrow-alt-left"></i> -->
                            <p>{{date('F d,Y')}}</p>
                            <!-- <i class="fas fa-long-arrow-alt-right"></i> -->
                        </div>
                        <table class="availability-datatable" aria-labelledby="weekLabel">
                            <tbody>

                                <tr class="availability-wrapper">
                                    <th scope="row" class="location-date">Sunday</th>
                                    <td>
                                    <span class="location-hour-item">
                                      <span class="location-hour">{{$datas !== null ? ($datas['sun_24_service'] ?? ($datas['sun_open'] . ' AM') . ' - ' . ($datas['sun_close'] . ' PM')) : 'No datas available'}}</span></br>
                                      @if(isset($datas['sun_open_2']) && $datas['sun_open_2'] != '' && isset($datas['sun_close_2']) && $datas['sun_close_2'] !='')
                                          <span class="location-hour">{{$datas['sun_open_2']}} AM - {{$datas['sun_close_2']}} PM</span>
                                      @endif
                                    </span>
                                    </td>
                                </tr>
                                <tr class="availability-wrapper">
                                    <th scope="row" class="location-date">Monday</th>
                                    <td>
                                    <span class="location-hour-item">
                                        <span class="location-hour">{{$datas !== null ? ($datas['mon_24_service'] ?? ($datas['mon_open'] . ' AM') . ' - ' . ($datas['mon_close'] . ' PM')) : 'No datas available'}}</span></br>
                                        @if(isset($datas['mon_open_2']) && $datas['mon_open_2'] != '' && isset($datas['mon_close_2']) && $datas['mon_close_2'] !='')
                                            <span class="location-hour">{{$datas['mon_open_2']}} AM - {{$datas['mon_close_2']}} PM</span>
                                        @endif
                                    </span>
                                    </td>
                                </tr>
                                <tr class="availability-wrapper">
                                    <th scope="row" class="location-date">Tuesday</th>
                                    <td>
                                    <span class="location-hour-item">
                                        <span class="location-hour">{{$datas !== null ? ($datas['tues_24_service'] ?? ($datas['tues_open'] . ' AM') . ' - ' . ($datas['tues_close'] . ' PM')) : 'No datas available'}}</span></br>
                                        @if(isset($datas['tues_open_2']) && $datas['tues_open_2'] != '' && isset($datas['tues_close_2']) && $datas['tues_close_2'] !='')
                                            <span class="location-hour">{{$datas['tues_open_2']}} AM - {{$datas['tues_close_2']}} PM</span>
                                        @endif
                                    </span>
                                    </td>
                                </tr>
                                <tr class="availability-wrapper">
                                    <th scope="row" class="location-date">Wednesday</th>
                                    <td>
                                    <span class="location-hour-item">
                                        <span class="location-hour">{{$datas !== null ? ($datas['wed_24_service'] ?? ($datas['wed_open'] . ' AM') . ' - ' . ($datas['wed_close'] . ' PM')) : 'No datas available'}}</span></br>
                                        @if(isset($datas['wed_open_2']) && $datas['wed_open_2'] != '' && isset($datas['wed_close_2']) && $datas['wed_close_2'] !='')
                                            <span class="location-hour">{{$datas['wed_open_2']}} AM - {{$datas['wed_close_2']}} PM</span>
                                        @endif
                                    </span>
                                    </td>
                                </tr>
                                <tr class="availability-wrapper">
                                    <th scope="row" class="location-date">Thursday</th>
                                    <td>
                                    <span class="location-hour-item">
                                        <span class="location-hour">{{$datas !== null ? ($datas['thur_24_service'] ?? ($datas['thur_open'] . ' AM') . ' - ' . ($datas['thur_close'] . ' PM')) : 'No datas available'}}</span></br>
                                        @if(isset($datas['thur_open_2']) && $datas['thur_open_2'] != '' && isset($datas['thur_close_2']) && $datas['thur_close_2'] !='')
                                            <span class="location-hour">{{$datas['thur_open_2']}} AM - {{$datas['thur_close_2']}} PM</span>
                                        @endif
                                    </span>
                                    </td>
                                </tr>
                                <tr class="availability-wrapper">
                                    <th scope="row" class="location-date">Friday</th>
                                    <td>
                                    <span class="location-hour-item">
                                        <span class="location-hour">{{$datas !== null ? ($datas['fri_24_service'] ?? ($datas['fri_open'] . ' AM') . ' - ' . ($datas['fri_close'] . 'PM')) : 'No datas available'}}</span></br>
                                        @if(isset($datas['fri_open_2']) && $datas['fri_open_2'] != '' && isset($datas['fri_close_2']) && $datas['fri_close_2'] !='')
                                            <span class="location-hour">{{$datas['fri_open_2']}} AM - {{$datas['fri_close_2']}} PM</span>
                                        @endif
                                    </span>
                                    </td>
                                </tr>
                                <tr class="availability-wrapper">
                                    <th scope="row" class="location-date">Saturday</th>
                                    <td>
                                    <span class="location-hour-item">
                                        <span class="location-hour">{{$datas !== null ? ($datas['sat_24_service'] ?? ($datas['sat_open'] . 'AM') . ' - ' . ($datas['sat_close'] . 'PM')) : 'No datas available'}}</span><br>
                                        @if(isset($datas['sat_open_2']) && $datas['sat_open_2'] != '' && isset($datas['sat_close_2']) && $datas['sat_close_2'] !='')
                                            <span class="location-hour">{{$datas['sat_open_2']}} AM - {{$datas['sat_close_2']}} PM</span>
                                        @endif
                                    </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <p><i class="fas fa-map-marker-alt"></i> Pick-Up Service Available</p>
                        <p><i class="fas fa-ban"></i> After-Hours Returns Unavailable</p>
                    </div>
                </div>
            </div>

            <div id="direction">
                <h4>Directions from Terminal</h4>
                <p>Customers will exit customs to the arrivals hall. The rental counter is located 60 feet straight
                    ahead.</p>
            </div>
        </div>
    </section>

    <section class="policy_section" id="policySection">
        <div class="container">
        <h4>Rental Policies</h4>
            <div class="accordion" id="accordionExample">
                @foreach($policies as $policy)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne{{$policy->id}}" aria-expanded="true" aria-controls="collapseOne{{$policy->id}}">
                            {{$policy->heading}}
                        </button>
                    </h2>
                    <div id="collapseOne{{$policy->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p> {!! $policy->detail !!}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    </section>

    <section class="explore_section" id="exploreSection">
        <div class="container">
        <h4>Explore Nearby Locations</h4>
            <div class="row">
                @foreach($near as $loc)
                <div class="col-lg-6 col-md-6">
                    <div class="explore_item">
                        @if($loc->location_type == "airpot")
                        <figure>
                            <img src="https://www.enterprise.com/etc.clientlibs/ecom/clientlibs/clientlib-ecom/resources/img/vector-icons/gmaps/icon-map-pin-small-airport.svg" alt="">
                        </figure>
                        @else
                        <figure>
                            <img src="https://www.enterprise.com/etc.clientlibs/ecom/clientlibs/clientlib-ecom/resources/img/vector-icons/gmaps/icon-map-pin-small-enterprise.svg" alt="">
                        </figure>
                        @endif
                        <div class="content">
                            <h6>{{$loc->location_name}}</h6>
                            <p>{{$loc->address}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="queen_section" id="queenAirport">
        <div class="container">
            <h4>{{$data->location_name}} Car Rental FAQs</h4>
            <p>For additional questions, please visit our <a href="{{route('customer.faq')}}"> main car rental FAQs</a> page.</p>
        </div>
    </section>


</main>
<script async defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyAh6O2YAnv3LACvI9JMjQ-CcR7Jh0g1kJQ&callback=initMap&libraries=geometry"></script>
<script type="text/javascript">

const lati =  <?php echo $data->lat; ?>;
const lngi = <?php echo $data->lng; ?>;
const title = '<?php echo $data->location_name; ?>';
function initMap() {

  const myLatLng = { lat: lati, lng: lngi };

  const map = new google.maps.Map(document.getElementById("single-map"), {
    zoom: 5,
    center: myLatLng,
  });

  new google.maps.Marker({
    position: myLatLng,
    map,
    title: title,
  });

}
window.initMap = initMap;



</script>
@endsection