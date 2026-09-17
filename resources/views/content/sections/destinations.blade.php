@php($afterContent = data_get($section->settings, 'after_content'))
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

        @if($section->body_html)
            <div class="row justify-content-center mb-4">
                <div class="col-lg-10 col-md-11 col-sm-12">
                    <div class="location-section-content location-section-content--before managed-rich-text">{!! $section->body_html !!}</div>
                </div>
            </div>
        @endif

        @if($section->section_key === 'rental_requirements')
            <div class="row justify-content-start">
                @foreach($section->activeItems as $item)
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="destination-card">
                            @if($item->title)<h4>{{ $item->title }}</h4>@endif
                            @if($item->subtitle)<p class="destination-card__subtitle">{{ $item->subtitle }}</p>@endif
                            @if($item->body)<div class="destination-card__description">{!! $item->body !!}</div>@endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            @foreach($section->activeItems->chunk(2) as $row)
                <div class="row justify-content-start {{ $loop->first ? '' : 'mt-4' }}">
                    @foreach($row as $item)
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="destination-card">
                                @if($item->title)<h4>{{ $item->title }}</h4>@endif
                                @if($item->subtitle)<p class="destination-card__subtitle">{{ $item->subtitle }}</p>@endif
                                @if($item->body)<div class="destination-card__description">{!! $item->body !!}</div>@endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endif

        @if($afterContent)
            <div class="row justify-content-center mt-4">
                <div class="col-lg-10 col-md-11 col-sm-12">
                    <div class="location-section-content location-section-content--after managed-rich-text">{!! $afterContent !!}</div>
                </div>
            </div>
        @endif
    </div>
</section>
