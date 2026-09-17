@extends('layouts.main')



@section('content')



<main class="">

<div class="breadcrumb">

        <div class="container-fluid">

            <ul class="d-flex breadcrumb-list">

                <li><a href="#">Home</a></li>

                <li><a href="#">Cookie Policy</a></li>

            </ul>

        </div>

    </div>

    <section class="sec-p about-heading">

</div>

        </div>

    </section>

    <section class="term_section">

    <div class="container">

        <h1 class="visually-hidden">Cookie Policy</h1>

        {!! $policy->contents !!}

        </div>

        </div>

    </section>

</main>

@endsection
