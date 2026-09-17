@extends('layouts.main')

@section('content')

<section class="txt-heading top-bar-heading" style="border-bottom: 0.0625rem solid #c3c3c3;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="selectedVehicle"></h1>
                </div>
                <div class="col-lg-6">
                    <div class="btn-grid">
                        <a class="btn" href="{{route('reservation.reviewReserve')}}">Continue to Review</a>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <section class="sec-p sec-reserve">
        <div class="container">
            <div class="heading">
                <h3 >Equipment</h3>
            </div>
            <div class="sec-reserve-grid">
                @foreach($datas as $key=>$data)
                <div class="inner-grid inner-grid{{$data->id}}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="heading">
                                <h6>{{$data->heading}}</h6>
                                <div class="d-flex icn-grid">
                                    <figure>
                                        <img src="{{asset('images/')}}/{{$key == 0 ? 'ico-sirius-xm.svg' :($key == 1 ? 'ico-greenhouse.svg' :($key == 2 ? 'ico-child-seat.svg' : 'ico-gps.svg'))}}" alt="icn">
                                    </figure>
                                    <p>{{$data->sub_heading}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="center-grid">
                                <span>
                                    $ {{$data->price}} / month</span>
                            </div>
                        </div>
                    
                  
                     
                        <div class="col-lg-4">
                            <div class="btn-grid">

                                 <a class="btn-txt click-btn open-div" href="javascript:void(0);" onclick="equipment({{$data->id}});">Details <i class="fa fa-angle-down"></i></a>
                                 
                                 <a class="btn remove_equ{{$data->id}} d-none" id="remove_equ" onclick="deleteEquipment({{$data->id}});">+ Remove</a>
                            
                                 <a class="btn add_equ{{$data->id}}" id="add_equ" onclick="addEquipment({{$data->id}});">+ Add</a>
                          
                            </div>
                        </div>
                    </div>
                    <div class="open-grid " id="open-grid{{$data->id}}" style="display:none">
                        <p>{{$data->detail}}</p>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="btn-div">
                <a class="btn" href="{{route('reservation.reviewReserve')}}">Continue to Review</a>
            </div>
        </div>
    </section>



<script src="https://code.jquery.com/jquery-3.7.1.js" ></script>
<script>


   function equipment(id){
    $("#open-grid"+id).toggle();
   }
   



</script>
@endsection