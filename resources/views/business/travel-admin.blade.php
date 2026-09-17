@extends('layouts.main')

@section('content')

<main class="travel-admin">

    <section class="traveladminheader">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-9 traveladminheader--lt">
                    {!! $data->admin_heading !!}
                </div>
                <div class="col-lg-3 traveladminheader--rt">
                    <a href="{{route('reservation')}}"> {{$data->admin_button}}</a>
                </div>
            </div>
        </div>
    </section>


    <section class="sec-p address bg-transparent">
        <div class="container-fluid">

            <div class="hero-form m-auto border-0 bg-transparent">
                <div class="heading">
                    <h1><span class="ps-0">Reserve a Vehicle</span></h1> <span>or <a href="{{route('reservation.vMc')}}">View / Modify / Cancel Reservation</a></span>
                </div>
                <div class="form form-date">
                    <form>
                        <div class="form-group">
                            <label class="form-label form-label-two">
                                <div class="num"></div>Pick-up & Return Location (ZIP, City or Airport)* <cite>* Required Field</cite>
                            </label>
                            <input type="text" class="form-control" placeholder="Provide a Location">
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
                            <div class="date-grid date-gridd">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Travel Distance(Miles)*</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Cost of Fuel(Per Gallon)*</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="form-label">Reimbursement Rate(Per Mile)*</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="form-label">Member Program</label>
                                    <select class="form-select form-select-lg" aria-label="Large select example">
                                        <option selected>National Emerald Club</option>
                                        <option value="1">Enterprise Plus</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Member Number</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Member's Last Name</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="btn-grid text-end">
                                <button class="btn" type="button">Browse Vehicles</button>
                            </div>
                    </form>
                </div>
            </div>


        </div>
    </section>

</main>

@endsection