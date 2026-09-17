@php
    $fleetCards = $section->activeItems->filter(fn ($item) => ! $item->button_label || ! $item->button_url);
    $fleetCta = $section->activeItems->first(fn ($item) => $item->button_label && $item->button_url);
    $catalogVehicles = collect($vehicles ?? [])->values();
@endphp

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
        <div class="row g-4 justify-content-center">
            @foreach($fleetCards as $item)
                @php
                    $catalogVehicle = $catalogVehicles->get($loop->index);
                    $catalogImage = data_get($catalogVehicle, 'image');
                    $image = $item->image ?: ($catalogImage ? 'vehicles/'.$catalogImage : 'vehicles/car'.$loop->iteration.'.png');
                    $imageAlt = $item->image_alt ?: data_get($catalogVehicle, 'vehicle', $item->title.' rental vehicle');

                    if ($image && ! str_starts_with($image, 'http')) {
                        $image = str_starts_with($image, 'content/')
                            ? asset('storage/'.$image)
                            : asset(ltrim($image, '/'));
                    }
                @endphp
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="fleet-card">
                        @if($image)
                            <div class="fleet-img">
                                <img src="{{ $image }}" alt="{{ $imageAlt }}" loading="lazy">
                            </div>
                        @endif
                        @if($item->title)<h4>{{ $item->title }}</h4>@endif
                        @if($item->body)<div class="fleet-card__description">{!! $item->body !!}</div>@endif
                    </div>
                </div>
            @endforeach
        </div>
        @if($fleetCta)
            <div class="text-center mt-5">
                <a href="{{ $fleetCta->button_url }}" class="fleet-btn">{{ $fleetCta->button_label }}</a>
            </div>
        @endif
    </div>
</section>
