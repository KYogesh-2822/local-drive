@extends('layouts.main')

@section('content')

<main class="">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('reservation.vMc')}}">View Modify Cancel</a></li>
            </ul>
        </div>
    </div>


    <section class="pb-0 sec-p main-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 m-auto">
                    <h1 class="mb-2">{{$vmc->heading ?? ''}}</h1>

                    <p>{{$vmc->discription}}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white pt-3 sec-p address">
        <div class="container-fluid">


            <div class="hero-form hero-form-long m-auto mb-5 border-0 bg-transparent" >



                <div class="heading">
                    <h2><span>View / Modify / Cancel Reservation
                        </span></h2> <span>or <a href="{{route('reservation')}}">Reserve a Vehicle</a></span>
                </div>

                <h5>Look up a reservation</h5>
                <span>*Required to look up a reservation</span>

                <div class="mt-4 form" id="pbk-widget">
                    <!-- <form>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Confirmation Number<sup>*</sup></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">First Name<sup>*</sup></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Last Name<sup>*</sup></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="btn-grid text-end">
                                    <a class="btn" href="#">Search</a>
                                </div>
                            </div>
                        </div>

                    </form> -->
                </div>
            </div>

        </div>
    </section>



</main>
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->

<script type="text/javascript">
var pbk = {
  "settings" : {
    "kicker" : "#pbk-widget",
    "contentContainer" : "#pbk-widget2mk",
    "modifyOnly": true 
  }
};

(function(){
    var d=document,
    l=d.createElement('link'),
    s=d.createElement('script'),
    u='https://widget-cdn.partnerbookingkit.com/bundles/82c62ca4123d9/widget.';
    l.href=u+'css';
    l.rel='stylesheet';
    d.head.appendChild(l);
    s.src=u+'js';
    s.async=true;d.head.appendChild(s)
    })();

 </script>  
@endsection