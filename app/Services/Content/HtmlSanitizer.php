<?php

namespace App\Services\Content;

class HtmlSanitizer
{
    private const ALLOWED_TAGS = '<p><br><strong><b><em><i><u><ul><ol><li><h2><h3><h4><blockquote><a><table><thead><tbody><tr><th><td><hr>';

    public function sanitize(?string $html): ?string
    {
        if ($html === null) {
            return null;
        }

        // Remove executable/embedded elements together with their contents before allowing formatting tags.
        $html = preg_replace('#<(script|style|iframe|object|embed)\b[^>]*>.*?</\1>#is', '', $html);
        $clean = strip_tags($html, self::ALLOWED_TAGS);
        $clean = preg_replace('/\s+on\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $clean);
        $clean = preg_replace('/\s+style\s*=\s*("[^"]*"|\'[^\']*\')/i', '', $clean);
        $clean = preg_replace('/(href|src)\s*=\s*(["\'])\s*(?:javascript|data|vbscript):.*?\2/i', '$1="#"', $clean);
        $clean = preg_replace('/(href|src)\s*=\s*(?:javascript|data|vbscript):[^\s>]*/i', '$1="#"', $clean);

        return trim($clean);
    }
}
