@php($afterContent = data_get($section->settings, 'after_content'))
<section class="fleet-section">
    <div class="container">
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
                <div class="col-lg-9 col-md-10 col-sm-12">
                    <div class="location-section-content location-section-content--before managed-rich-text">{!! $section->body_html !!}</div>
                </div>
            </div>
        @endif

        @if($section->activeItems->isNotEmpty())
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-7 col-sm-12">
                    <ul class="safety-list">
                        @foreach($section->activeItems as $item)
                            @php($itemText = $item->title ?: trim(strip_tags($item->body ?? '')))
                            @if($itemText !== '')
                                <li>{{ $itemText }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if($section->section_key === 'safety')
            <p class="custom_para mt-5 text-center">Our team ensures that every journey is supported by strong safety standards and worry-free from start to finish.</p>
        @endif

        @if($afterContent)
            <div class="row justify-content-center mt-4">
                <div class="col-lg-9 col-md-10 col-sm-12">
                    <div class="location-section-content location-section-content--after managed-rich-text">{!! $afterContent !!}</div>
                </div>
            </div>
        @endif
    </div>
</section>
