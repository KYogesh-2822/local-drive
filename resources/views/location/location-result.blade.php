@extends('layouts.main')

@section('content')

<section class="enterprise_map_section">
    <div class="map_header">
        <h1>Find a Location</h1>
        <div class="content_button">
            <div class="map_buttons">
                <p><span>{{$count}} Results:</span> {{$loc->location_name ?? 'Jordan'}}</p>
                <div>
                    <!-- <button class="btn" id="changeLoc">Change Location <i class="fas fa-angle-down down" id="locArrow"></i></button>  -->
                    <button class="btn" id="filter"><?php ?>Filter <i class="fas fa-angle-down down" id="filterArrow"></i></button>
                </div>
            </div>
            <div class="hide_map">
                <button class="btn">Hide Map</button>
            </div>
        </div>
    </div>
</section>

<section class="location_header_section">
    <div class="location-header-toggle-panel location-header-toggle-panel--toggled" aria-hidden="false" role="dialog">
        <div class="location-header__toggle-panel-content">
            <div class="location-search-filter__container-filters">
                <div class="location-search-filter__container-modal-filters-block">
                    <div><label class="rs-label" for="locations-filter-trigger"><span>Location Type</span></label>
                        <div class="rs-input location-search-filter__locations-filter location-search-filter__filter-input">
                            <button class="rs-input__field rs-input__btn" type="button" name="locations-filter-trigger"
                                id="locations-filter-trigger" data-bs-toggle="modal" data-bs-target="#map-location">All Locations <i class="fas fa-angle-right"></i></button></div>
                    </div>
                    <div class="location-search-filter__checkboxes-container"><label
                            class="rs-checkbox location-search-filter__after-hours"><input type="checkbox"
                                name="location-search-after-hours-filter" id="location-search-after-hours-filter"
                                data-dtm-tracking="location|afterhours|uncheck" value=""><span
                                class="rs-checkbox__text">After-hours return</span></label></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- 
    <section class="p-0 sec-p address location_change">
        <div class="container-fluid">
            <div class="hero-form m-auto border-0 bg-transparent">
         
                <div class="form form-date">
                    <form action="https://enterprise.clientpreview.site/location-search" method="post">
                        <input type="hidden" name="_token" value="k1XSbWWA79LnMTfYQS5MKMJAPd7QIcJOKtTvoLgu" autocomplete="off">                        <div class="row">
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <label class="form-label form-label-two">
                                    <div class="num"></div>Location* <cite>* Required Field</cite>
                                    </label>

                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    <input type="text" class="form-control" id="search_location" name="search_location" placeholder="ZIP, City or Airport" required="">
                                                </div>
                                           
                                                <div class="selected_search_location d-none"></div>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                                                <div class="accordion-body">
                                                    <div class="location-btn">
                                                        <a class="btn" onclick="getCurrent();"><i class="fa fa-location-arrow"></i> Use my current location</a>
                                                    </div>
                                                    <div class="location-txt">
                                                         <div>Search and select from result list</div>

                                                    </div>
                                                    <div class="location_message"></div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="btn-grid" style="margin-top: 33px;">
                                    <button type="submit" class="btn">Continue</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section> -->

<section class="location_map">
    <div class="location">
        @foreach($location as $key=>$loc)
        <div class="location_content location_content{{$loc->id}} pt-2" onclick="detail({{$loc->id}}); filterMarkersByTag('{{$loc->location_name}}');return false;" >
            <div class="content">
                <p><button class=" count">{{$key+1}}</button>{{$loc->location_name}}</p>
                <p><span>{{$loc->address}}</span></p>
                <!-- <p><span>Clarksdale, MS 38614</span></p> -->
            </div>
            <div class="services">
                <p>Hours & Services <i class="fas fa-angle-left" id="service_icon{{$loc->id}}"></i></p>
                <a href="#" class="btn">All Locations Details</a>
            </div>
        </div>

        <div class="hours_services hours_services{{$loc->id}}">
            <div class="services_heading">
                <h5>Hours & Services</h5> <i class="fas fa-times" id="cross{{$loc->id}}"></i>
            </div>
            <div>
                <div></div>
                <h6>{{$loc->location_name}}</h6>
                <!-- <p><i class="fas fa-globe-americas"></i> 713 Desoto Ave <br> Clarksdale, MS 38614</p> -->
                <p><i class="fas fa-globe-americas"></i>{{$loc->address}}</p>
                <p>Get Directions <i class="fas fa-external-link-alt"></i> <br> <i class="fas fa-phone-alt"></i> {{$loc->phone}}</p>
                <p><i class="fas fa-map-marker-alt"></i> Pick-Up Service Available</p>
                <p><i class="fas fa-ban"></i> After-Hours Returns Unavailable</p>
            </div>
            <div class="date_selector">
                <!-- <i class="fas fa-arrow-left"></i> -->
                <p>{{date('F d,Y')}}</p> 
                <!-- <i class="fas fa-arrow-right"></i> -->
            </div>

            <?php    
                $hours = DB::table('hours_services')->where('location_id',$loc->id)->first();
                $data = json_decode($hours->hours, TRUE);
            
            ?>
            
            <div class="table">
                <table class="availability-datatable" aria-labelledby="weekLabel">
                    <tbody>
                        
                        <tr class="availability-wrapper">
                            <th scope="row" class="location-date">Sunday</th>
                            <td>
                                <span class="location-hour-item">
                                      <span class="location-hour">{{$data !== null ? ($data['sun_24_service'] ?? ($data['sun_open'] . ' AM') . ' - ' . ($data['sun_close'] . ' PM')) : 'No data available'}}</span></br>
                                      @if(isset($data['sun_open_2']) && $data['sun_open_2'] != '' && isset($data['sun_close_2']) && $data['sun_close_2'] !='')
                                          <span class="location-hour">{{$data['sun_open_2']}} AM - {{$data['sun_close_2']}} PM</span>
                                      @endif
                                </span>
                            </td>
                        </tr>
                        <tr class="availability-wrapper">
                            <th scope="row" class="location-date">Monday</th>
                            <td>
                                <span class="location-hour-item">
                                    <span class="location-hour">{{$data !== null ? ($data['mon_24_service'] ?? ($data['mon_open'] . ' AM') . ' - ' . ($data['mon_close'] . ' PM')) : 'No data available'}}</span></br>
                                     @if(isset($data['mon_open_2']) && $data['mon_open_2'] != '' && isset($data['mon_close_2']) && $data['mon_close_2'] !='')
                                          <span class="location-hour">{{$data['mon_open_2']}} AM - {{$data['mon_close_2']}} PM</span>
                                      @endif
                                </span>
                            </td>
                        </tr>
                        <tr class="availability-wrapper">
                            <th scope="row" class="location-date">Tuesday</th>
                            <td>
                                <span class="location-hour-item">
                                    <span class="location-hour">{{$data !== null ? ($data['tues_24_service'] ?? ($data['tues_open'] . ' AM') . ' - ' . ($data['tues_close'] . ' PM')) : 'No data available'}}</span></br>
                                    @if(isset($data['tues_open_2']) && $data['tues_open_2'] != '' && isset($data['tues_close_2']) && $data['tues_close_2'] !='')
                                          <span class="location-hour">{{$data['tues_open_2']}} AM - {{$data['tues_close_2']}} PM</span>
                                      @endif
                                </span>
                            </td>
                        </tr>
                        <tr class="availability-wrapper">
                            <th scope="row" class="location-date">Wednesday</th>
                            <td>
                                <span class="location-hour-item">
                                    <span class="location-hour">{{$data !== null ? ($data['wed_24_service'] ?? ($data['wed_open'] . ' AM') . ' - ' . ($data['wed_close'] . ' PM')) : 'No data available'}}</span></br>
                                    @if(isset($data['wed_open_2']) && $data['wed_open_2'] != '' && isset($data['wed_close_2']) && $data['wed_close_2'] !='')
                                          <span class="location-hour">{{$data['wed_open_2']}} AM - {{$data['wed_close_2']}} PM</span>
                                      @endif
                                </span>
                            </td>
                        </tr>
                        <tr class="availability-wrapper">
                            <th scope="row" class="location-date">Thursday</th>
                            <td>
                                <span class="location-hour-item">
                                    <span class="location-hour">{{$data !== null ? ($data['thur_24_service'] ?? ($data['thur_open'] . ' AM') . ' - ' . ($data['thur_close'] . ' PM')) : 'No data available'}}</span></br>
                                    @if(isset($data['thur_open_2']) && $data['thur_open_2'] != '' && isset($data['thur_close_2']) && $data['thur_close_2'] !='')
                                          <span class="location-hour">{{$data['thur_open_2']}} AM - {{$data['thur_close_2']}} PM</span>
                                      @endif
                                </span>
                            </td>
                        </tr>
                        <tr class="availability-wrapper">
                            <th scope="row" class="location-date">Friday</th>
                            <td>
                                <span class="location-hour-item">
                                    <span class="location-hour">{{$data !== null ? ($data['fri_24_service'] ?? ($data['fri_open'] . ' AM') . ' - ' . ($data['fri_close'] . 'PM')) : 'No data available'}}</span></br>
                                    @if(isset($data['fri_open_2']) && $data['fri_open_2'] != '' && isset($data['fri_close_2']) && $data['fri_close_2'] !='')
                                          <span class="location-hour">{{$data['fri_open_2']}} AM - {{$data['fri_close_2']}} PM</span>
                                      @endif
                                </span>
                            </td>
                        </tr>
                        <tr class="availability-wrapper">
                            <th scope="row" class="location-date">Saturday</th>
                            <td>
                                <span class="location-hour-item">
                                    <span class="location-hour">{{$data !== null ? ($data['sat_24_service'] ?? ($data['sat_open'] . 'AM') . ' - ' . ($data['sat_close'] . 'PM')) : 'No data available'}}</span><br>
                                    @if(isset($data['sat_open_2']) && $data['sat_open_2'] != '' && isset($data['sat_close_2']) && $data['sat_close_2'] !='')
                                          <span class="location-hour">{{$data['sat_open_2']}} AM - {{$data['sat_close_2']}} PM</span>
                                      @endif
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="{{route('location.singleLocation')}}/{{$loc->id}}" class="cta cta--secondary cta--large cta--fullWidth cta--noMargin location-item__cta">Start a Reservation</a>
        </div>
        @endforeach
    </div>
    <div class="map">
    <div id="map-canvas" style="width: 1530px; height: 950px;">
    
      
    </div>
</section>




<!-- location modal -->
<div class="modal modal-2 fade" id="map-location" tabindex="-1" aria-labelledby="map-location-Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="map-location-Label"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-4 date_time_msg">
                    <h3>Location Type</h3>
                    <?php $array = array_unique($pluck); ?>
                    <form action="{{route('location.locationSearch')}}" method="post">
                        @csrf
                        <div class="locations-filter-modal-content__filters" id="rs-modal-content">
                            <p>Select the location type(s) you want to search by.</p>
                            <label class="rs-checkbox">
                                <input type="checkbox" name="loc_type[]" id="AIRPORT" value="airport" {{ in_array('airport', $array) ? 'checked' : '' }}>
                               
                                <span class="rs-checkbox__text">
                                    <span class="locations-filter-modal-content__checkbox-text">Airport Locations <i class="icon icon-location-airport"></i></span>
                                </span>
                            </label>
                            <label class="rs-checkbox">
                                <input type="checkbox" name="loc_type[]" id="CITY" value="city" {{ in_array('city', $array) ? 'checked' : '' }}>
                                <span class="rs-checkbox__text">
                                    <span class="locations-filter-modal-content__checkbox-text">City Locations <i class="icon icon-location-city"></i></span>
                                </span>
                            </label>
                            <label class="rs-checkbox">
                                <input type="checkbox" name="loc_type[]" id="EXOTICS" value="exotic" {{ in_array('exotic', $array) ? 'checked' : '' }}>
                                <span class="rs-checkbox__text">
                                    <span class="locations-filter-modal-content__checkbox-text">Exotics Locations <i class="icon icon-location-exotics"></i></span>
                                </span>
                            </label>
                            <label  class="rs-checkbox">
                                <input type="checkbox" name="loc_type[]" id="PORT_OF_CALL" value="post" {{ in_array('post', $array) ? 'checked' : '' }}>
                                <span class="rs-checkbox__text">
                                    <span class="locations-filter-modal-content__checkbox-text">Port Locations <i class="icon icon-location-port_of_call"></i></span>
                                </span>
                            </label>
                            <label class="rs-checkbox">
                                <input type="checkbox" name="loc_type[]" id="RAIL" value="rail" {{ in_array('rail', $array) ? 'checked' : '' }}>
                                <span class="rs-checkbox__text">
                                    <span class="locations-filter-modal-content__checkbox-text">Train Station Locations <i class="icon icon-location-rail"></i></span>
                                </span>
                            </label>
                        </div>
                        <div class="cta-container cta-container--align-center rs-modal__buttons-container">
                            <button class="cta cta--secondary cta--large cta--noMargin cancel_button" type="clear">Cancel</button>
                            <button class="cta cta--primary cta--large cta--noMargin apply_button" type="submit">Apply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script async defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyAh6O2YAnv3LACvI9JMjQ-CcR7Jh0g1kJQ&callback=initialize&libraries=geometry"></script>

  <script>
    var map;
    var infoWindow;
    var markers = [];
    var markersData = <?php echo $location; ?>;

    function initialize() {
        var mapOptions = {
            center: new google.maps.LatLng(30.5852, 36.2384),
            zoom: 9,
            mapTypeId: 'roadmap',
        };

        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        infoWindow = new google.maps.InfoWindow();
        google.maps.event.addListener(map, 'click', function () {
            infoWindow.close();
        });
        displayMarkers();
    }

    function displayMarkers() {
     
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0; i < markersData.length; i++) {
            var latlng = new google.maps.LatLng(markersData[i].lat, markersData[i].lng);
            var name = markersData[i].location_name;
            var address = markersData[i].address;
            var phone = markersData[i].phone;
            var postalCode = markersData[i].postalCode;
            createMarker(latlng, name, address, phone, postalCode,i);
            bounds.extend(latlng);
        }
        map.fitBounds(bounds);
    }

    function createMarker(latlng, name, address, phone, postalCode,i) {
        var label_count = {
        text: (i + 1).toString(), // Increment index by 1 to start from 1 instead of 0
        fontWeight: "bold",
        color: '#fff',
        fontSize: '15px'
       };
    
        var square = {
            path: 'M -2,-2 2,-2 2,2 -2,2 z', // 'M -2,0 0,-2 2,0 0,2 z',
    
            strokeColor: '#006639',
            fillColor: '#006639',
            fillOpacity: 1,
            scale: 6,
       
        };
        var marker = new google.maps.Marker({
            map: map,
            position: latlng,
            title: name,
            icon: {
            path: square.path,
            fillColor: square.fillColor,
            fillOpacity: square.fillOpacity,
            strokeColor: square.strokeColor,
            scale: square.scale
            },
            label: label_count

        });


        marker.tag = name;
        markers.push(marker);

        google.maps.event.addListener(marker, 'click', function () {
            var iwContent = '<div id="iw_container">' +
                '<div class="iw_title">' + name + '</div>' +
                '<div class="iw_content">' + address + '<br />' +
                phone + '<br />' +
                postalCode + '</div></div>';
            infoWindow.setContent(iwContent);
            infoWindow.open(map, marker);
            map.panTo(this.getPosition());
        });
    }


    function filterMarkersByTag(tagName) {
        var bounds = new google.maps.LatLngBounds();
        markers.forEach(function (marker) {
            bounds.extend(marker.getPosition());
        });
        map.fitBounds(bounds);

        markers.forEach(function (marker) {
            if (marker.tag === tagName) {
                if (!marker.maximized) {
                    marker.setIcon({
                        path: marker.getIcon().path,
                        fillColor: marker.getIcon().fillColor,
                        fillOpacity: marker.getIcon().fillOpacity,
                        strokeColor: marker.getIcon().strokeColor,
                        scale: marker.getIcon().scale * 2 // Increase the scale by 2 times
                    });
                    marker.maximized = true;
                }
            } else {
                if (marker.maximized) {
                    marker.setIcon({
                        path: marker.getIcon().path,
                        fillColor: marker.getIcon().fillColor,
                        fillOpacity: marker.getIcon().fillOpacity,
                        strokeColor: marker.getIcon().strokeColor,
                        scale: marker.getIcon().scale / 2 // Decrease the scale by 2 times
                    });
                    marker.maximized = false;
                }
            }
        });
    }
</script> 
<script>
      function detail(id){
        let services = document.getElementsByClassName('hours_services'+id);
        let mYlocation = document.getElementsByClassName('location_content'+id);
        let cross = document.getElementById('cross'+id);
        let spin = document.getElementById('service_icon'+id)

        if(services[0].style.display === 'block' && spin.style.rotate === "360deg"){
            services[0].style.display = "none";
            spin.style.rotate = "180deg"
        }
        else{
            services[0].style.display = "block";
            spin.style.rotate = "360deg"
        }
   

        cross.addEventListener('click', ()=>{
        if(services[0].style.display === 'block' && spin.style.rotate === "360deg"){
            services[0].style.display = "none";
            spin.style.rotate = "180deg"
        }
        else{
            services[0].style.display = "block";
            spin.style.rotate = "360deg"
        }
        })
    }
</script>

@endsection