@extends('layouts.admin.header-content')

@section('content')
@php
    $sectionsTabActive = session('active_tab') === 'sections' || old('_content_sections') === '1';
    $openSectionId = session('open_section', old('_open_section'));
@endphp
<section class="dashboard content-admin">
    <div class="common-heading d-flex justify-content-between align-items-center">
        <div><h1>Edit {{ $page->name }}</h1><p class="mb-0"><code>{{ $page->slug }}</code> · Review URL: {{ route('content.review.show', $page) }}</p></div>
        <div>
            <a class="btn btn-outline-secondary" href="{{ route('admin.content.pages.index') }}">Back</a>
            <a class="btn btn-outline-success" href="{{ route('admin.content.pages.preview', ['page' => $page->slug]) }}" target="_blank">Preview</a>
        </div>
    </div>
    @include('admin.content.partials.alerts')

    <ul class="nav nav-tabs mt-4" role="tablist">
        <li class="nav-item"><button class="nav-link {{ $sectionsTabActive ? '' : 'active' }}" data-bs-toggle="tab" data-bs-target="#pageSettings" type="button">Page & SEO</button></li>
        <li class="nav-item"><button class="nav-link {{ $sectionsTabActive ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#pageSections" type="button">Content Sections</button></li>
    </ul>

    <div class="tab-content pt-4">
        <div class="tab-pane fade {{ $sectionsTabActive ? '' : 'show active' }}" id="pageSettings">
            <form action="{{ route('admin.content.pages.update', ['page' => $page->slug]) }}" method="post" enctype="multipart/form-data" class="card card-body">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-8 mb-3"><label class="form-label">Admin page name</label><input class="form-control" name="name" value="{{ old('name', $page->name) }}" required></div>
                    <div class="col-md-4 mb-3"><label class="form-label">Status</label><select class="form-select" name="status"><option value="draft" @selected($page->status === 'draft')>Draft</option><option value="published" @selected($page->status === 'published')>Published</option></select></div>
                    <div class="col-md-6 mb-3"><label class="form-label">Hero image</label><input class="form-control" type="file" name="hero_image" accept="image/jpeg,image/png,image/webp">@if($page->hero_image)<small class="text-muted">Current: {{ $page->hero_image }}</small>@endif</div>
                    <div class="col-md-6 mb-3"><label class="form-label">Hero image alt text</label><input class="form-control" name="hero_image_alt" value="{{ old('hero_image_alt', $page->hero_image_alt) }}"></div>
                    <div class="col-12"><hr><h3 class="h5">Search engine metadata</h3></div>
                    <div class="col-12 mb-3"><label class="form-label">Meta title</label><input class="form-control" name="meta_title" maxlength="255" value="{{ old('meta_title', $page->meta_title) }}" required></div>
                    <div class="col-12 mb-3"><label class="form-label">Meta description</label><textarea class="form-control" name="meta_description" rows="3" required>{{ old('meta_description', $page->meta_description) }}</textarea></div>
                    <div class="col-md-6 mb-3"><label class="form-label">Focus keyword</label><input class="form-control" name="focus_keyword" value="{{ old('focus_keyword', $page->focus_keyword) }}"></div>
                    <div class="col-md-6 mb-3"><label class="form-label">Canonical URL</label><input class="form-control" type="url" name="canonical_url" value="{{ old('canonical_url', $page->canonical_url) }}"></div>
                    <div class="col-12"><hr><h3 class="h5">Blogs displayed on this page</h3></div>
                    @php $selectedBlogs = old('blog_ids', $page->blogPosts->pluck('id')->all()); @endphp
                    @forelse($posts as $post)
                        <div class="col-md-6 mb-2"><label class="form-check"><input class="form-check-input" type="checkbox" name="blog_ids[]" value="{{ $post->id }}" @checked(in_array($post->id, $selectedBlogs))><span class="form-check-label">{{ $post->title }} <small>({{ $post->status }})</small></span></label></div>
                    @empty
                        <div class="col-12"><p class="text-muted">No blog posts are available yet.</p></div>
                    @endforelse
                </div>
                <div><button class="btn btn-success" type="submit">Save Page Settings</button></div>
            </form>
        </div>

        <div class="tab-pane fade {{ $sectionsTabActive ? 'show active' : '' }}" id="pageSections">
            <p class="text-muted mb-3">Each button saves the section content, its existing items, removals and the optional new item together.</p>
            <div class="accordion" id="sectionAccordion">
                @foreach($page->sections as $section)
                    @php
                        $isChecklistSection = $section->section_key === 'safety' || $section->layout === 'safety-list';
                        $isCardGridSection = in_array($section->layout, ['destination-grid', 'booking-process']);
                        $supportsBeforeAfter = $section->section_key !== 'safety' && ($section->layout === 'safety-list' || $section->section_key === 'rental_requirements');
                        $isOpenSection = (string) $openSectionId === (string) $section->id;
                    @endphp
                    <div class="accordion-item mb-3 border">
                        <h2 class="accordion-header" id="sectionHeading{{ $section->id }}">
                            <button class="accordion-button {{ $isOpenSection ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#section{{ $section->id }}" aria-expanded="{{ $isOpenSection ? 'true' : 'false' }}">
                                {{ $sectionLabels[$section->section_key] ?? $section->section_key }}
                                <span class="badge ms-2 {{ $section->is_enabled ? 'bg-success' : 'bg-secondary' }}">{{ $section->is_enabled ? 'Enabled' : 'Hidden' }}</span>
                            </button>
                        </h2>
                        <div id="section{{ $section->id }}" class="accordion-collapse collapse {{ $isOpenSection ? 'show' : '' }}" data-bs-parent="#sectionAccordion">
                            <div class="accordion-body">
                                <form action="{{ route('admin.content.sections.update', ['page' => $page->slug, 'section' => $section->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="_content_sections" value="1">
                                    <input type="hidden" name="_open_section" value="{{ $section->id }}">

                                    <div class="row">
                                        <div class="col-md-6 mb-3"><label class="form-label">Heading</label><input class="form-control" name="heading" value="{{ old('heading', $section->heading) }}"></div>
                                        <div class="col-md-6 mb-3"><label class="form-label">Subheading</label><input class="form-control" name="subheading" value="{{ old('subheading', $section->subheading) }}"></div>
                                        @if($section->section_key !== 'safety')
                                            <div class="col-12 mb-3">
                                                <label class="form-label">{{ $supportsBeforeAfter ? 'Content before cards/list (optional)' : 'Section content' }}</label>
                                                <textarea class="form-control summernote" name="body_html" rows="5">{{ old('body_html', $section->body_html) }}</textarea>
                                            </div>
                                        @endif
                                        @if($supportsBeforeAfter)
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Content after cards/list (optional)</label>
                                                <textarea class="form-control summernote" name="after_content" rows="5">{{ old('after_content', data_get($section->settings, 'after_content')) }}</textarea>
                                                <small class="text-muted">Leave this empty when no closing content is required.</small>
                                            </div>
                                        @endif
                                        @if($section->section_key === 'introduction')
                                            <div class="col-md-6 mb-3"><label class="form-label">Button label</label><input class="form-control" name="button_label" value="{{ old('button_label', data_get($section->settings, 'button_label', 'Contact Us')) }}"></div>
                                            <div class="col-md-6 mb-3"><label class="form-label">Button URL</label><input class="form-control" name="button_url" value="{{ old('button_url', data_get($section->settings, 'button_url', '/contact')) }}"><small class="text-muted">Use <code>/contact</code> for the contact page.</small></div>
                                        @endif
                                        <div class="col-12 mb-3"><label class="form-check"><input type="hidden" name="is_enabled" value="0"><input class="form-check-input" type="checkbox" name="is_enabled" value="1" @checked((bool) old('is_enabled', $section->is_enabled))><span class="form-check-label">Display this section</span></label></div>
                                    </div>

                                    @if(!in_array($section->section_key, ['blogs', 'introduction']))
                                        <hr class="my-4"><h3 class="h5">Section items</h3>
                                        @foreach($section->items as $item)
                                            @php($itemPrefix = 'items.'.$item->id)
                                            <div class="border rounded p-3 mb-3 bg-light">
                                                <div class="row">
                                                    <div class="col-md-6 mb-2"><label class="form-label">Heading</label><input class="form-control" name="items[{{ $item->id }}][title]" value="{{ old($itemPrefix.'.title', $item->title) }}"></div>
                                                    @if(! $isChecklistSection)
                                                        <div class="col-md-6 mb-2"><label class="form-label">Subheading (optional)</label><input class="form-control" name="items[{{ $item->id }}][subtitle]" value="{{ old($itemPrefix.'.subtitle', $item->subtitle) }}"></div>
                                                    @endif
                                                    <div class="col-md-3 mb-2"><label class="form-label">Display order</label><input class="form-control" type="number" min="0" name="items[{{ $item->id }}][sort_order]" value="{{ old($itemPrefix.'.sort_order', $item->sort_order) }}"></div>
                                                    @if(! $isChecklistSection)
                                                        <div class="col-12 mb-2"><label class="form-label">Content (optional)</label><textarea class="form-control" name="items[{{ $item->id }}][body]" rows="3">{{ old($itemPrefix.'.body', $item->body) }}</textarea></div>
                                                    @endif
                                                    @if(! $isChecklistSection && ! $isCardGridSection)
                                                        <div class="col-md-6 mb-2"><label class="form-label">Button label</label><input class="form-control" name="items[{{ $item->id }}][button_label]" value="{{ old($itemPrefix.'.button_label', $item->button_label) }}"></div>
                                                        <div class="col-md-6 mb-2"><label class="form-label">Button URL</label><input class="form-control" name="items[{{ $item->id }}][button_url]" value="{{ old($itemPrefix.'.button_url', $item->button_url) }}"></div>
                                                        <div class="col-md-6 mb-2"><label class="form-label">Image</label><input class="form-control" type="file" name="items[{{ $item->id }}][image]" accept="image/jpeg,image/png,image/webp"></div>
                                                        <div class="col-md-6 mb-2"><label class="form-label">Image alt text</label><input class="form-control" name="items[{{ $item->id }}][image_alt]" value="{{ old($itemPrefix.'.image_alt', $item->image_alt) }}"></div>
                                                    @endif
                                                    <div class="col-md-6 mb-2"><label class="form-check"><input type="hidden" name="items[{{ $item->id }}][is_enabled]" value="0"><input class="form-check-input" type="checkbox" name="items[{{ $item->id }}][is_enabled]" value="1" @checked((bool) old($itemPrefix.'.is_enabled', $item->is_enabled))><span class="form-check-label">Display item</span></label></div>
                                                    <div class="col-md-6 mb-2"><label class="form-check text-danger"><input class="form-check-input" type="checkbox" name="items[{{ $item->id }}][delete]" value="1"><span class="form-check-label">Remove this item when saving</span></label></div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <details class="border rounded p-3 mb-4">
                                            <summary class="fw-bold">Add new section item (optional)</summary>
                                            <div class="row mt-3">
                                                <div class="col-md-6 mb-2"><label class="form-label">Heading</label><input class="form-control" name="new_items[0][title]" value="{{ old('new_items.0.title') }}"></div>
                                                @if(! $isChecklistSection)
                                                    <div class="col-md-6 mb-2"><label class="form-label">Subheading (optional)</label><input class="form-control" name="new_items[0][subtitle]" value="{{ old('new_items.0.subtitle') }}"></div>
                                                @endif
                                                <div class="col-md-3 mb-2"><label class="form-label">Display order (optional)</label><input class="form-control" type="number" min="0" name="new_items[0][sort_order]" value="{{ old('new_items.0.sort_order') }}"></div>
                                                @if(! $isChecklistSection)
                                                    <div class="col-12 mb-2"><label class="form-label">Content (optional)</label><textarea class="form-control" name="new_items[0][body]" rows="3">{{ old('new_items.0.body') }}</textarea></div>
                                                @endif
                                                @if(! $isChecklistSection && ! $isCardGridSection)
                                                    <div class="col-md-6 mb-2"><label class="form-label">Button label</label><input class="form-control" name="new_items[0][button_label]" value="{{ old('new_items.0.button_label') }}"></div>
                                                    <div class="col-md-6 mb-2"><label class="form-label">Button URL</label><input class="form-control" name="new_items[0][button_url]" value="{{ old('new_items.0.button_url') }}"></div>
                                                    <div class="col-md-6 mb-2"><label class="form-label">Image</label><input class="form-control" type="file" name="new_items[0][image]" accept="image/jpeg,image/png,image/webp"></div>
                                                    <div class="col-md-6 mb-2"><label class="form-label">Image alt text</label><input class="form-control" name="new_items[0][image_alt]" value="{{ old('new_items.0.image_alt') }}"></div>
                                                @endif
                                                <input type="hidden" name="new_items[0][is_enabled]" value="1">
                                            </div>
                                        </details>
                                    @endif

                                    <div class="border-top pt-3 mt-3">
                                        <button class="btn btn-success" type="submit">Save Section and Items</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
