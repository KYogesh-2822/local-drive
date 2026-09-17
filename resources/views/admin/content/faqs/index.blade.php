@extends('layouts.admin.header-content')

@section('content')
<section class="dashboard content-admin">
    <div class="common-heading"><h1>Central FAQ Manager</h1><p class="text-muted">Manage page and blog FAQs from one screen. The selected slug determines where each FAQ appears.</p></div>
    @include('admin.content.partials.alerts')

    <form action="{{ route('admin.content.faqs.index') }}" method="get" class="card card-body mb-4">
        <label class="form-label fw-bold">Select page or blog</label>
        <div class="d-flex gap-2">
            <select class="form-select" name="target" onchange="this.form.submit()">
                <optgroup label="Managed pages">@foreach($pages as $page)<option value="page:{{ $page->slug }}" @selected($targetKey === 'page:'.$page->slug)>{{ $page->name }} — {{ $page->slug }}</option>@endforeach</optgroup>
                <optgroup label="Blog posts">@foreach($posts as $post)<option value="blog:{{ $post->slug }}" @selected($targetKey === 'blog:'.$post->slug)>{{ $post->title }}</option>@endforeach</optgroup>
            </select>
            <button class="btn btn-success" type="submit">Load</button>
        </div>
    </form>

    @if($target)
        <div class="d-flex justify-content-between align-items-center mb-3"><h2 class="h4 mb-0">FAQs for {{ $target->name ?? $target->title }}</h2><code>{{ $target->slug }}</code></div>
        @foreach($faqs as $faq)
            <div class="card card-body mb-3">
                <form action="{{ route('admin.content.faqs.update', $faq) }}" method="post">
                    @csrf @method('PUT')
                    <input type="hidden" name="target" value="{{ $targetKey }}">
                    <div class="mb-2"><label class="form-label">Question</label><input class="form-control" name="question" value="{{ $faq->question }}" required></div>
                    <div class="mb-2"><label class="form-label">Answer</label><textarea class="form-control summernote" name="answer" rows="3" required>{{ $faq->answer }}</textarea></div>
                    <div class="row align-items-end"><div class="col-md-3"><label class="form-label">Order</label><input class="form-control" type="number" min="0" name="sort_order" value="{{ $faq->sort_order }}"></div><div class="col-md-4"><label class="form-check mb-2"><input type="hidden" name="is_active" value="0"><input class="form-check-input" type="checkbox" name="is_active" value="1" @checked($faq->is_active)><span class="form-check-label">Active</span></label></div><div class="col-md-5 text-end"><button class="btn btn-success" type="submit">Update FAQ</button></div></div>
                </form>
                <form action="{{ route('admin.content.faqs.destroy', $faq) }}" method="post" class="mt-2 text-end" onsubmit="return confirm('Delete this FAQ?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" type="submit">Delete</button></form>
            </div>
        @endforeach

        <div class="card card-body border-success mt-4">
            <h2 class="h5">Add FAQ</h2>
            <form action="{{ route('admin.content.faqs.store') }}" method="post">
                @csrf
                <input type="hidden" name="target" value="{{ $targetKey }}"><input type="hidden" name="is_active" value="1">
                <div class="mb-2"><label class="form-label">Question</label><input class="form-control" name="question" required></div>
                <div class="mb-2"><label class="form-label">Answer</label><textarea class="form-control summernote" name="answer" rows="4" required></textarea></div>
                <button class="btn btn-success" type="submit">Add FAQ</button>
            </form>
        </div>
    @endif
</section>
@endsection
