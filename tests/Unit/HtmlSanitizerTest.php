<?php

namespace Tests\Unit;

use App\Services\Content\HtmlSanitizer;
use PHPUnit\Framework\TestCase;

class HtmlSanitizerTest extends TestCase
{
    public function test_it_removes_executable_markup_and_unsafe_urls(): void
    {
        $html = '<p style="color:red" onclick="alert(1)">Safe text</p>'
            .'<script>alert("unsafe")</script>'
            .'<a href=javascript:alert(2)>Unsafe link</a>'
            .'<a href="https://enterprise.jo">Safe link</a>';

        $clean = (new HtmlSanitizer())->sanitize($html);

        $this->assertStringNotContainsString('<script', $clean);
        $this->assertStringNotContainsString('alert("unsafe")', $clean);
        $this->assertStringNotContainsString('onclick=', $clean);
        $this->assertStringNotContainsString('style=', $clean);
        $this->assertStringContainsString('href="#"', $clean);
        $this->assertStringContainsString('href="https://enterprise.jo"', $clean);
    }
}
