<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\UpdateContentPageRequest;
use App\Models\Content\BlogPost;
use App\Models\Content\ContentPage;
use App\Services\Content\ImageUploadService;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.content.pages.index', [
            'pages' => ContentPage::withCount(['sections', 'faqs'])->orderBy('id')->get(),
        ]);
    }

    public function edit(ContentPage $page)
    {
        $page->load(['sections.items', 'blogPosts']);

        return view('admin.content.pages.edit', [
            'page' => $page,
            'sectionLabels' => config('content.section_labels'),
            'posts' => BlogPost::orderByDesc('published_at')->orderBy('title')->get(),
        ]);
    }

    public function update(UpdateContentPageRequest $request, ContentPage $page, ImageUploadService $images)
    {
        $data = $request->safe()->except(['hero_image', 'blog_ids']);
        $data['updated_by'] = auth()->id();

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $images->store(
                $request->file('hero_image'),
                'content/pages/'.$page->slug,
                $page->hero_image
            );
        }

        if ($data['status'] === 'published' && !$page->published_at) {
            $data['published_at'] = now();
        }

        DB::transaction(function () use ($page, $data, $request) {
            $page->update($data);
            $sync = [];
            foreach ($request->input('blog_ids', []) as $order => $blogId) {
                $sync[$blogId] = ['sort_order' => $order];
            }
            $page->blogPosts()->sync($sync);
        });

        return back()->with('message', 'Page settings updated successfully.');
    }
}
