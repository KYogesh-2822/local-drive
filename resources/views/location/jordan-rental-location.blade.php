@extends('layouts.main')

@section('content')

<main class="">


    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('location.jordan')}}">Jordan</a></li>
            </ul>
        </div>
    </div>

    <section class="px-0 txt-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1>{{$data->heading}}</h1>
                </div>
                <div class="col-lg-6">
                    <div class="btn-grid text-end">
                        <a class="btn btn-bdr" href="{{route('reservation')}}">{{$data->button}}</a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- <section class="sec-p bg-g find-location">
        <div class="container-fluid">
            <div class="hero-form m-auto border-0 bg-transparent">
                <div class="heading">
                    <h2><span class="ps-0">Find a Location</span></h2>
                </div>
                <div class="form">
                    <form>
                        <div class="form-group">
                            <label class="form-label form-label-two">
                                <div class="num"></div>Location* <cite>* Required Field</cite>
                            </label>
                            <input type="text" class="form-control" placeholder="ZIP, City or Airport">
                        </div>
                      
                        <div class="btn-grid">
                            <button class="btn" type="button">Continue</button>
                        </div>

                    </form>
                    
                    

                </div>
            </div>
        </div>
        
    </section> -->
    <section class="p-0 sec-p address">
        <div class="container-fluid">
            <div class="hero-form m-auto border-0 bg-transparent">
                <div class="heading">
                <h2><span class="ps-0">Find a Location</span></h2>
                </div>
                <div class="form form-date">
                    <form action="{{route('location.locationSearch')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <label class="form-label form-label-two">
                                    <div class="num"></div>Location* <cite>* Required Field</cite>
                                    </label>

                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    <input type="text" class="form-control" id="search_location" name="search_location"  placeholder="ZIP, City or Airport" required>
                                                </div>
                                                <!-- <div class="selected_search_location d-none"><span class="selected_value_location"></span><i class="fa fa-close" onclick="closeSelectLoc();"></i></div> -->
                                                <div class="selected_search_location d-none"></div>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="location-btn">
                                                        <a class="btn"  onclick="getCurrent();"><i class="fa fa-location-arrow"></i> Use my current location</a>
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
                                    <button type="submit" class="btn" type="button">Continue</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-p pt-0 heading-txt-sec">
        <div class="container">
            {!! $data->content !!}
        </div>
    </section>


</main>
<script src="https://code.jquery.com/jquery-3.7.1.slim.js"></script>
<script>
$('#search_location').keyup(function(){
    var text = $(this).val();
    $.ajax({
        type: "get",
        url: "/autocomplete",
        data: {text:text},
        success: function(response){
            $('.location-txt').html('');
            $('.location_message').html('');
            if(response.data.length <= 0){
                $('.location_message').append(`<small>Sorry, we couldn't find any locations matching "${text}"
                                     Try searching using only a city name, ZIP or airport code.</small>`); 
            }
            $.each(response.data, function (i, v) { 
                $('.location-txt').append(`
                    <div class="d-flex grid-location">
                        <div class="coloum coloum-location">
                            <div class="location-name d-flex"><i class="fa fa-plane"></i> <span>Airports</span></div>
                        </div>
                        <div class="coloum coloum-address">
                            <ul class="address-list">
                                <li>
                                    <h6>${v.location_name}<em>${v.address}</em></h6>
                                    <a class="btn" onclick="selectLoc(${v.id})">Select</a>
                                </li>
                            </ul>
                        </div>
                    </div>`);
            });
          
        }
    });
});

function selectLoc($id){
    var loc_id = $id;
    $.ajax({
        type: "get",
        url: "/select-location",
        data: {loc_id:loc_id},
        success: function(response){
            $('#search_location').val(response.name);
            $('.selected_search_location').html('');
            $('#search_location').hide();
            $('.selected_search_location').append(`<span style="font-size: 23px;">${response.name}</span><i class="fa fa-close" style="font-size:20px;" onclick="closeSelectLoc();"></i>`);
            $('.selected_search_location').removeClass('d-none');
         
            $('#flush-collapseOne').removeClass("show");
        }
    });
}

function closeSelectLoc(){
    $('#search_location').attr('value', '');  
    $('#search_location').show();
    $('#search_location').val('');
    $('.selected_search_location').addClass('d-none');
}
</script>
@endsection