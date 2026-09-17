<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\BlogPost;
use App\Models\Content\ContentPage;

class SitemapController extends Controller
{
    public function __invoke()
    {
        return response()
            ->view('content.sitemap', [
                'pages' => config('content.managed_pages_live') ? ContentPage::published()->get() : collect(),
                'posts' => BlogPost::published()->get(),
            ])
            ->header('Content-Type', 'application/xml');
    }
}
