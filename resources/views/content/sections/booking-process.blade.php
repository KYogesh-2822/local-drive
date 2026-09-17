<section class="standard-section">
    <div class="container section-container">
        <div class="section-title text-center">
            @if($section->heading)
                <h2 class="custom_heading">{{ $section->heading }}</h2>
            @endif
            @if($section->subheading)
                <p class="custom_para">{{ $section->subheading }}</p>
            @endif
        </div>
        <div class="row justify-content-center">
            @foreach($section->activeItems as $item)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="process-item text-center">
                        <div class="step-badge">{{ $loop->iteration }}</div>
                        @if($item->title)<h4>{{ $item->title }}</h4>@endif
                        @if($item->body)<div class="process-item__description">{!! $item->body !!}</div>@endif
                    </div>
                </div>
            @endforeach
        </div>
        <p class="custom_para mt-5 text-center">This simple approach makes car hire suitable for both first-time visitors and returning travellers. </p>
    </div>
</section>
