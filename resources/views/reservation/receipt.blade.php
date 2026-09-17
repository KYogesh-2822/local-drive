@extends('layouts.main')

@section('content')

<main class="">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('reservation.receipt')}}">Get a Receipt</a></li>
            </ul>
        </div>
    </div>



    <section class="bg-white pt-3 sec-p address">
        <div class="container-fluid">


            <div class="hero-form hero-form-long m-auto mb-5 border-0 bg-transparent">



                <div class="heading">
                    <h1>{{$receipts->heading ?? ''}}</h1>
                </div>

                <p>{{$receipts->discription ?? ''}}</p>

                <span>*Required to look up a receipt</span>

                <div class="mt-4 form">
                    <form>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Last Name<sup>*</sup></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Driver's License Number<sup>*</sup></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="btn-grid text-end">
                                    <a class="btn" href="#">Search</a>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </section>



</main>

@endsection