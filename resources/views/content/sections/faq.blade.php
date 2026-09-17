@if($faqs->isNotEmpty())
<section class="managed-section managed-faq" id="faqs">
    <div class="container-fluid">
        <header class="managed-section__header">
            <span class="managed-eyebrow">Answers before you travel</span>
            <h2>{{ $heading }}</h2>
        </header>
        <div class="accordion managed-faq__list" id="managedFaqAccordion">
            @foreach($faqs as $faq)
                <div class="accordion-item">
                    <h3 class="accordion-header" id="faqHeading{{ $faq->id }}">
                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faqAnswer{{ $faq->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="faqAnswer{{ $faq->id }}">
                            {{ $faq->question }}
                        </button>
                    </h3>
                    <div id="faqAnswer{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="faqHeading{{ $faq->id }}" data-bs-parent="#managedFaqAccordion">
                        <div class="accordion-body managed-rich-text">{!! $faq->answer !!}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
