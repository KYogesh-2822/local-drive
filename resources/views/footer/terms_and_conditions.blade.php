@extends('layouts.main')



@section('content')



<main class="">

<div class="breadcrumb">

        <div class="container-fluid">

            <ul class="d-flex breadcrumb-list">

                <li><a href="#">Home</a></li>

                <li><a href="#">Terms And Conditions</a></li>

            </ul>

        </div>

    </div>

    <section class="sec-p about-heading">
        <div class="container">
            <h1>Rental Terms and Conditions</h1>
        </div>
    </section>

    <section class="term_section">

    <div class="container">

        {!! $condition->paragraph !!}



        </div>

        </div>

    </section>

</main>

@endsection
