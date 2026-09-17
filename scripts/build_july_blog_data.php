<?php

declare(strict_types=1);

if ($argc !== 3) {
    fwrite(STDERR, "Usage: php scripts/build_july_blog_data.php <source-directory> <output-directory>\n");
    exit(1);
}

$sourceDirectory = rtrim($argv[1], DIRECTORY_SEPARATOR);
$outputDirectory = rtrim($argv[2], DIRECTORY_SEPARATOR);

$blogs = [
    'fvqER94IPt7VbIa7SOcDBQ' => [
        'published_at' => '2026-07-29 06:00:00',
        'featured_image' => 'images/content/blogs/common-airport-car-rental-mistakes-and-how-to-avoid-them.webp',
        'featured_image_alt' => 'Traveller reviewing an airport car rental before starting a journey',
        'focus_keyword' => 'airport car rental mistakes',
    ],
    'SuxALtaFDh3JoCn9SO5gIw' => [
        'published_at' => '2026-07-30 06:00:00',
        'featured_image' => 'images/content/blogs/rental-car-guide-suv-vs-sedan-for-travel-in-jordan.webp',
        'featured_image_alt' => 'SUV and sedan rental car comparison for travel in Jordan',
        'focus_keyword' => 'rental car Jordan',
    ],
    'ht1aU4YXF4t8u96PV8wc9A' => [
        'published_at' => '2026-07-31 06:00:00',
        'featured_image' => 'images/content/blogs/car-hire-guide-private-driver-tips-for-travel-in-jordan.webp',
        'featured_image_alt' => 'Private driver providing comfortable car hire travel in Jordan',
        'focus_keyword' => 'private driver Jordan',
    ],
];

if (! is_dir($outputDirectory) && ! mkdir($outputDirectory, 0775, true) && ! is_dir($outputDirectory)) {
    throw new RuntimeException("Unable to create output directory: {$outputDirectory}");
}

foreach ($blogs as $documentId => $settings) {
    $sourcePath = $sourceDirectory.DIRECTORY_SEPARATOR.$documentId.'.json';
    $source = json_decode((string) file_get_contents($sourcePath), true, 512, JSON_THROW_ON_ERROR);
    $document = json_decode($source['content'], true, 512, JSON_THROW_ON_ERROR);
    $nodes = $document['content'] ?? [];

    $metaTitle = metadataValue($nodes[0] ?? []);
    $metaDescription = metadataValue($nodes[1] ?? []);
    $slug = metadataValue($nodes[2] ?? []);
    $articleHeadingIndex = findFirstHeadingIndex($nodes);
    $faqHeadingIndex = findFaqHeadingIndex($nodes);

    if ($articleHeadingIndex === null || $faqHeadingIndex === null || $faqHeadingIndex <= $articleHeadingIndex) {
        throw new RuntimeException("Unable to identify article or FAQ boundaries for {$documentId}");
    }

    $title = trim(plainText($nodes[$articleHeadingIndex]));
    $bodyNodes = array_slice($nodes, $articleHeadingIndex + 1, $faqHeadingIndex - $articleHeadingIndex - 1);
    $bodyHtml = renderNodes($bodyNodes);
    $faqs = extractFaqs(array_slice($nodes, $faqHeadingIndex + 1));

    if ($title === '' || $slug === '' || $bodyHtml === '' || count($faqs) !== 5) {
        throw new RuntimeException("Incomplete converted blog data for {$documentId}");
    }

    $data = [
        'source_document_id' => $documentId,
        'title' => $title,
        'slug' => $slug,
        'excerpt' => $metaDescription,
        'body_html' => $bodyHtml,
        'featured_image' => $settings['featured_image'],
        'featured_image_alt' => $settings['featured_image_alt'],
        'author_name' => 'Enterprise Rent-A-Car Jordan',
        'status' => 'published',
        'published_at' => $settings['published_at'],
        'meta_title' => $metaTitle,
        'meta_description' => $metaDescription,
        'focus_keyword' => $settings['focus_keyword'],
        'faqs' => $faqs,
    ];

    $outputPath = $outputDirectory.DIRECTORY_SEPARATOR.$slug.'.json';
    file_put_contents(
        $outputPath,
        json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE).PHP_EOL
    );

    fwrite(STDOUT, "Created {$outputPath}\n");
}

function metadataValue(array $node): string
{
    $lines = array_values(array_filter(
        array_map('trim', preg_split('/\R/u', plainText($node)) ?: []),
        static fn (string $line): bool => $line !== ''
    ));

    return $lines === [] ? '' : end($lines);
}

function findFirstHeadingIndex(array $nodes): ?int
{
    foreach ($nodes as $index => $node) {
        if (($node['type'] ?? null) === 'heading') {
            return $index;
        }
    }

    return null;
}

function findFaqHeadingIndex(array $nodes): ?int
{
    foreach ($nodes as $index => $node) {
        if (($node['type'] ?? null) === 'heading' && strcasecmp(trim(plainText($node)), 'Frequently Asked Questions') === 0) {
            return $index;
        }
    }

    return null;
}

function plainText(array $node): string
{
    if (($node['type'] ?? null) === 'text') {
        return (string) ($node['text'] ?? '');
    }

    if (($node['type'] ?? null) === 'hardBreak') {
        return "\n";
    }

    $text = '';
    foreach ($node['content'] ?? [] as $child) {
        $text .= plainText($child);
    }

    return $text;
}

function renderNodes(array $nodes): string
{
    $html = [];

    foreach ($nodes as $node) {
        $plain = trim(plainText($node));

        // The source editor contains this hand-off note between two generated parts; it is not article copy.
        if (str_starts_with($plain, 'Great, I’ll continue with the full blog as Part 2')) {
            continue;
        }

        $rendered = renderBlock($node);
        if ($rendered !== '') {
            $html[] = $rendered;
        }
    }

    return implode("\n", $html);
}

function renderBlock(array $node): string
{
    return match ($node['type'] ?? '') {
        'paragraph' => '<p>'.renderInlineChildren($node['content'] ?? []).'</p>',
        'heading' => renderHeading($node),
        'bulletList' => '<ul>'.renderListItems($node['content'] ?? []).'</ul>',
        'orderedList' => '<ol>'.renderListItems($node['content'] ?? []).'</ol>',
        'blockquote' => '<blockquote>'.renderNodes($node['content'] ?? []).'</blockquote>',
        'horizontalRule' => '<hr>',
        default => '',
    };
}

function renderHeading(array $node): string
{
    $sourceLevel = (int) ($node['attrs']['level'] ?? 2);
    $level = $sourceLevel >= 3 ? 3 : 2;

    return "<h{$level}>".renderInlineChildren($node['content'] ?? [])."</h{$level}>";
}

function renderListItems(array $items): string
{
    $html = '';

    foreach ($items as $item) {
        $inner = '';
        foreach ($item['content'] ?? [] as $child) {
            if (($child['type'] ?? null) === 'paragraph') {
                $inner .= renderInlineChildren($child['content'] ?? []);
            } else {
                $inner .= renderBlock($child);
            }
        }
        $html .= '<li>'.$inner.'</li>';
    }

    return $html;
}

function renderInlineChildren(array $children): string
{
    $html = '';

    foreach ($children as $child) {
        if (($child['type'] ?? null) === 'hardBreak') {
            $html .= '<br>';
            continue;
        }

        if (($child['type'] ?? null) !== 'text') {
            $html .= renderInlineChildren($child['content'] ?? []);
            continue;
        }

        $value = htmlspecialchars((string) ($child['text'] ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $marks = $child['marks'] ?? [];

        foreach ($marks as $mark) {
            $value = match ($mark['type'] ?? '') {
                'bold' => '<strong>'.$value.'</strong>',
                'italic' => '<em>'.$value.'</em>',
                'underline' => '<u>'.$value.'</u>',
                'link' => renderLink($value, (string) ($mark['attrs']['href'] ?? '')),
                default => $value,
            };
        }

        $html .= $value;
    }

    return $html;
}

function renderLink(string $label, string $href): string
{
    if (! preg_match('#^https://enterprise\.jo(?:/|$)#i', $href)) {
        return $label;
    }

    return '<a href="'.htmlspecialchars($href, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8').'">'.$label.'</a>';
}

function extractFaqs(array $nodes): array
{
    $faqs = [];

    for ($index = 0; $index < count($nodes); $index++) {
        $node = $nodes[$index];

        if (($node['type'] ?? null) === 'heading') {
            $question = cleanQuestion(plainText($node));
            $answerNode = $nodes[$index + 1] ?? null;

            if ($question !== '' && is_array($answerNode) && ($answerNode['type'] ?? null) === 'paragraph') {
                $answer = trim(plainText($answerNode));
                if ($answer !== '') {
                    $faqs[] = ['question' => $question, 'answer' => '<p>'.escapePlainText($answer).'</p>'];
                    $index++;
                }
            }

            continue;
        }

        if (($node['type'] ?? null) === 'paragraph') {
            $lines = array_values(array_filter(
                array_map('trim', preg_split('/\R/u', plainText($node)) ?: []),
                static fn (string $line): bool => $line !== ''
            ));

            if (count($lines) >= 2) {
                $question = cleanQuestion(array_shift($lines));
                $answer = trim(implode(' ', $lines));

                if ($question !== '' && $answer !== '') {
                    $faqs[] = ['question' => $question, 'answer' => '<p>'.escapePlainText($answer).'</p>'];
                }
            }
        }
    }

    return $faqs;
}

function cleanQuestion(string $question): string
{
    return trim((string) preg_replace('/^\s*\d+\.\s*/u', '', trim($question)));
}

function escapePlainText(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
