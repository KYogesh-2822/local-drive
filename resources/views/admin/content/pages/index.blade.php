@extends('layouts.admin.header-content')

@section('content')
<section class="dashboard content-admin">
    <div class="common-heading d-flex justify-content-between align-items-center">
        <div><h1>Content Pages</h1><p class="mb-0 text-muted">Manage the homepage and reusable location landing pages.</p></div>
        <a class="btn btn-outline-success" href="{{ route('admin.content.faqs.index') }}">Manage FAQs</a>
    </div>
    @include('admin.content.partials.alerts')
    <div class="table-responsive mt-4">
        <table class="table table-striped align-middle">
            <thead><tr><th>Page</th><th>Slug / URL</th><th>Status</th><th>Sections</th><th>FAQs</th><th>Updated</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
            @foreach($pages as $page)
                <tr>
                    <td><strong>{{ $page->name }}</strong><br><small>{{ ucfirst($page->template) }} template</small></td>
                    <td><code>{{ $page->slug }}</code><br><a href="{{ route('content.review.show', $page) }}" target="_blank">{{ parse_url(route('content.review.show', $page), PHP_URL_PATH) }}</a></td>
                    <td><span class="badge {{ $page->status === 'published' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($page->status) }}</span></td>
                    <td>{{ $page->sections_count }}</td>
                    <td>{{ $page->faqs_count }}</td>
                    <td>{{ $page->updated_at->format('d M Y H:i') }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.content.pages.preview', $page) }}" target="_blank">Preview</a>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.content.pages.edit', $page) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
