@extends('layouts.admin.header-content')

@section('content')
@php
    $publishDate = old(
        'published_at',
        $post->publicationDate()?->toDateString()
            ?? now(config('content.publishing_timezone', 'Asia/Amman'))->toDateString()
    );
@endphp
<section class="dashboard content-admin">
    <div class="common-heading d-flex justify-content-between"><div><h1>{{ $post->exists ? 'Edit Blog Post' : 'Create Blog Post' }}</h1></div><a class="btn btn-outline-secondary" href="{{ route('admin.content.blogs.index') }}">Back to Blogs</a></div>
    @include('admin.content.partials.alerts')
    <form action="{{ $post->exists ? route('admin.content.blogs.update', $post) : route('admin.content.blogs.store') }}" method="post" enctype="multipart/form-data" class="card card-body mt-4">
        @csrf @if($post->exists) @method('PUT') @endif
        <div class="row">
            <div class="col-12 mb-3"><label class="form-label">Title</label><input class="form-control" name="title" value="{{ old('title', $post->title) }}" required></div>
            <div class="col-md-8 mb-3"><label class="form-label">Slug</label><div class="input-group"><span class="input-group-text">/blog/</span><input class="form-control" name="slug" value="{{ old('slug', $post->slug) }}" required></div></div>
            <div class="col-md-4 mb-3"><label class="form-label">Category</label><select class="form-select" name="blog_category_id"><option value="">No category</option>@foreach($categories as $category)<option value="{{ $category->id }}" @selected(old('blog_category_id', $post->blog_category_id) == $category->id)>{{ $category->name }}</option>@endforeach</select></div>
            <div class="col-12 mb-3"><label class="form-label">Excerpt</label><textarea class="form-control" name="excerpt" rows="3" required>{{ old('excerpt', $post->excerpt) }}</textarea></div>
            <div class="col-12 mb-3"><label class="form-label" for="blog-content-editor">Article content</label><textarea class="form-control" id="blog-content-editor" data-rich-text-editor name="body_html" rows="18" required>{{ old('body_html', $post->body_html) }}</textarea></div>
            <div class="col-md-6 mb-3"><label class="form-label">Featured image</label><input class="form-control" type="file" name="featured_image" accept="image/jpeg,image/png,image/webp" {{ $post->exists ? '' : 'required' }}>@if($post->featured_image)<small class="text-muted">Current: {{ $post->featured_image }}</small>@endif</div>
            <div class="col-md-6 mb-3"><label class="form-label">Featured image alt text</label><input class="form-control" name="featured_image_alt" value="{{ old('featured_image_alt', $post->featured_image_alt) }}" required></div>
            <div class="col-md-6 mb-3"><label class="form-label">Author</label><input class="form-control" name="author_name" value="{{ old('author_name', $post->author_name) }}" required></div>
            <div class="col-md-3 mb-3"><label class="form-label">Status</label><select class="form-select" name="status"><option value="draft" @selected(old('status', $post->status) === 'draft')>Draft</option><option value="published" @selected(old('status', $post->status) === 'published')>Published</option></select></div>
            <div class="col-md-3 mb-3"><label class="form-label" for="blog-publish-date">Publish date</label><input class="form-control" id="blog-publish-date" type="date" name="published_at" value="{{ $publishDate }}" required><small class="text-muted">Today publishes immediately. Future dates publish automatically in Jordan time.</small></div>
            <div class="col-12"><hr><h2 class="h5">Search engine metadata</h2></div>
            <div class="col-12 mb-3"><label class="form-label">Meta title</label><input class="form-control" name="meta_title" value="{{ old('meta_title', $post->meta_title) }}" required></div>
            <div class="col-12 mb-3"><label class="form-label">Meta description</label><textarea class="form-control" name="meta_description" rows="3" required>{{ old('meta_description', $post->meta_description) }}</textarea></div>
            <div class="col-md-6 mb-3"><label class="form-label">Focus keyword</label><input class="form-control" name="focus_keyword" value="{{ old('focus_keyword', $post->focus_keyword) }}"></div>
            <div class="col-md-6 mb-3"><label class="form-label">Canonical URL</label><input class="form-control" type="url" name="canonical_url" value="{{ old('canonical_url', $post->canonical_url) }}"></div>
        </div>
        <div><button class="btn btn-success" type="submit">{{ $post->exists ? 'Update Blog Post' : 'Create Blog Post' }}</button></div>
    </form>
    @if($post->exists)<form class="mt-3" action="{{ route('admin.content.blogs.destroy', $post) }}" method="post" onsubmit="return confirm('Move this blog post to trash?')">@csrf @method('DELETE')<button class="btn btn-outline-danger" type="submit">Move to Trash</button></form>@endif
</section>
<style>
    .content-admin .ck-editor__editable_inline { min-height: 420px; }
</style>
@endsection
