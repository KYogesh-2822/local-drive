@extends('layouts.admin.header-content')

@section('content')
<section class="dashboard content-admin">
    <div class="common-heading d-flex justify-content-between align-items-center">
        <div>
            <h1>Blog Posts</h1>
            <p class="text-muted mb-0">Create, edit, preview and publish travel guides.</p>
        </div>
        <div>
            <a class="btn btn-outline-secondary" href="{{ route('admin.content.categories.index') }}">Categories</a>
            <a class="btn btn-success" href="{{ route('admin.content.blogs.create') }}">New Blog Post</a>
        </div>
    </div>

    @include('admin.content.partials.alerts')

    <div class="table-responsive mt-4">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Publish date</th>
                    <th>Updated</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td><strong>{{ $post->title }}</strong><br><code>{{ $post->slug }}</code></td>
                        <td>{{ optional($post->category)->name ?: '?' }}</td>
                        <td>
                            <span class="badge {{ $post->isPubliclyAvailable() ? 'bg-success' : ($post->isScheduled() ? 'bg-warning text-dark' : 'bg-secondary') }}">
                                {{ $post->isScheduled() ? 'Scheduled' : ucfirst($post->status) }}
                            </span>
                        </td>
                        <td>{{ $post->publicationDate()?->format('d M Y') ?: '?' }}</td>
                        <td>{{ $post->updated_at->format('d M Y H:i') }}</td>
                        <td class="text-end">
                            @if($post->isPubliclyAvailable())
                                <a class="btn btn-sm btn-outline-secondary" target="_blank" href="{{ route('content.blog.show', $post) }}">View</a>
                            @endif
                            <a class="btn btn-sm btn-success" href="{{ route('admin.content.blogs.edit', $post) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $posts->links() }}
</section>
@endsection
