@extends('layouts.admin.header-content')

@section('content')
<section class="dashboard content-admin">
    <div class="common-heading d-flex justify-content-between"><h1>Blog Categories</h1><a class="btn btn-outline-secondary" href="{{ route('admin.content.blogs.index') }}">Back to Blogs</a></div>
    @include('admin.content.partials.alerts')
    <div class="card card-body mb-4"><h2 class="h5">Add Category</h2><form class="d-flex gap-2" action="{{ route('admin.content.categories.store') }}" method="post">@csrf<input class="form-control" name="name" placeholder="Category name" required><button class="btn btn-success" type="submit">Add</button></form></div>
    @foreach($categories as $category)<div class="card card-body mb-2"><form class="row align-items-end" action="{{ route('admin.content.categories.update', $category) }}" method="post">@csrf @method('PUT')<div class="col-md-6"><label class="form-label">Name</label><input class="form-control" name="name" value="{{ $category->name }}" required></div><div class="col-md-3"><label class="form-check mb-2"><input type="hidden" name="is_active" value="0"><input class="form-check-input" type="checkbox" name="is_active" value="1" @checked($category->is_active)><span class="form-check-label">Active</span></label></div><div class="col-md-3 text-end"><span class="me-3 text-muted">{{ $category->posts_count }} posts</span><button class="btn btn-success" type="submit">Update</button></div></form></div>@endforeach
</section>
@endsection
