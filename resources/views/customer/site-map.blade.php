@extends('layouts.main')

@section('content')

<main class=" sitemap">

    <section class="sec-sitemap">
        <div class="container">
            <h1 class="visually-hidden">Enterprise Rent-A-Car Jordan Site Map</h1>
            @foreach($datas as $data)
            <div class="sitemap-content">
                <h2>{{$data->heading}}</h2>
                <div class="row">
                    <?php $headings = DB::table('site_map')->where('site_id',$data->id)->get(); ?>
                    @foreach($headings as $head)
                    <div class="col-xl-3 col-sm-6">
                        <h4>{{$head->heading}}</h4>
                        <ul>
                            <?php $sub_headings = DB::table('site_map_link')->where('subheading_id',$head->id)->get(); ?> 
                            @foreach($sub_headings as $sub)
                            <li><a href="{{$sub->link}}" class="btn-txt">{{$sub->detail}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach 
                </div>
            </div>
            @endforeach
        </div>
    </section>

</main>

@endsection
