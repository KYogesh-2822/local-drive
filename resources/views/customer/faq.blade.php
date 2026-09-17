@extends('layouts.main')

@section('content')

<main class="">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('customer.faq')}}">Help & FAQ's</a></li>
            </ul>
        </div>
    </div>

    <section class="sec-p hero-logo">
        <div class="container">
            <div class="mt-5 hero-list">
                <h1 class="mb-4">{{$faq->heading}}</h1>
                {!! $faq->sub_heading !!}
            </div>
            <h4>Topics</h4>
            <ul>
                @foreach($topics as $topic)
                <li><a class="btn-txt" href="#{{$topic->topic}}">{{$topic->topic}}</a></li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="sec-p ">
        <div class="container">
           @foreach($topics as $topic)
           <div class="mb-5">
           <h4 id="{{$topic->topic}}">{{$topic->topic}}</h4>
            <?php  $question = DB::table('faq_questions')->where('topic_id',$topic->id)->get(); ?>
            <ul>
                @foreach($question as $ques)
                <li><a class="btn-txt" href="{{route('customer.faqPickup')}}/{{$ques->id}}">{{$ques->question}}</a></li>
                @endforeach
            </ul>
            </div>
           @endforeach
        </div>
    </section>

</main>

@endsection