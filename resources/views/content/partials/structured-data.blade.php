@php
    $schemaGraph = [];
    $schemaGraph[] = [
        '@type' => 'BreadcrumbList',
        'itemListElement' => collect($breadcrumbs ?? [
            ['name' => 'Home', 'url' => url('/')],
        ])->values()->map(fn ($item, $index) => [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $item['name'],
            'item' => $item['url'],
        ])->all(),
    ];

    if (isset($post)) {
        $schemaGraph[] = [
            '@type' => 'BlogPosting',
            'headline' => $post->title,
            'description' => $post->meta_description ?: $post->excerpt,
            'datePublished' => optional($post->published_at)->toIso8601String(),
            'dateModified' => optional($post->updated_at)->toIso8601String(),
            'author' => ['@type' => 'Organization', 'name' => $post->author_name],
            'publisher' => ['@type' => 'Organization', 'name' => 'Enterprise Rent-A-Car Jordan'],
            'mainEntityOfPage' => $post->publicUrl(),
        ];
    }

    if (($faqs ?? collect())->isNotEmpty()) {
        $schemaGraph[] = [
            '@type' => 'FAQPage',
            'mainEntity' => $faqs->map(fn ($faq) => [
                '@type' => 'Question',
                'name' => $faq->question,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => trim(strip_tags($faq->answer)),
                ],
            ])->values()->all(),
        ];
    }

    $structuredData = [
        '@context' => 'https://schema.org',
        '@graph' => $schemaGraph,
    ];
@endphp
@push('structured-data')
<script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>
@endpush
