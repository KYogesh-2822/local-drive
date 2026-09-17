<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\StoreBlogPostRequest;
use App\Models\Content\BlogCategory;
use App\Models\Content\BlogPost;
use App\Services\Content\BlogPublicationScheduler;
use App\Services\Content\HtmlSanitizer;
use App\Services\Content\ImageUploadService;

class BlogPostController extends Controller
{
    public function index()
    {
        return view('admin.content.blogs.index', [
            'posts' => BlogPost::with('category')->latest('updated_at')->paginate(20),
        ]);
    }

    public function create()
    {
        return view('admin.content.blogs.form', [
            'post' => new BlogPost(['author_name' => 'Enterprise Rent-A-Car Jordan', 'status' => 'draft']),
            'categories' => BlogCategory::where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function store(
        StoreBlogPostRequest $request,
        ImageUploadService $images,
        HtmlSanitizer $sanitizer,
        BlogPublicationScheduler $scheduler
    )
    {
        $data = $this->payload($request, $sanitizer, $scheduler);
        $data['featured_image'] = $images->store($request->file('featured_image'), 'content/blogs/'.$data['slug']);
        $data['created_by'] = auth()->id();
        $data['updated_by'] = auth()->id();
        $post = BlogPost::create($data);

        return redirect()->route('admin.content.blogs.edit', $post)->with('message', 'Blog post created successfully.');
    }

    public function edit(BlogPost $post)
    {
        return view('admin.content.blogs.form', [
            'post' => $post,
            'categories' => BlogCategory::where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function update(
        StoreBlogPostRequest $request,
        BlogPost $post,
        ImageUploadService $images,
        HtmlSanitizer $sanitizer,
        BlogPublicationScheduler $scheduler
    )
    {
        $data = $this->payload($request, $sanitizer, $scheduler, $post);
        $data['updated_by'] = auth()->id();

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $images->store($request->file('featured_image'), 'content/blogs/'.$data['slug'], $post->featured_image);
        }
        $post->update($data);

        return back()->with('message', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $post)
    {
        $post->delete();

        return redirect()->route('admin.content.blogs.index')->with('message', 'Blog post moved to trash.');
    }

    private function payload(
        StoreBlogPostRequest $request,
        HtmlSanitizer $sanitizer,
        BlogPublicationScheduler $scheduler,
        ?BlogPost $post = null
    ): array
    {
        $data = $request->safe()->except('featured_image');
        $data['body_html'] = $sanitizer->sanitize($data['body_html']);
        $data['published_at'] = $scheduler->resolve(
            $data['published_at'],
            $data['status'],
            $post
        );

        return $data;
    }
}
