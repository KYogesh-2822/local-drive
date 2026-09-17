<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\UpdateAllContentSectionsRequest;
use App\Http\Requests\Admin\Content\UpdateContentSectionRequest;
use App\Models\Content\ContentPage;
use App\Models\Content\ContentPageSection;
use App\Models\Content\ContentSectionItem;
use App\Services\Content\HtmlSanitizer;
use App\Services\Content\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PageSectionController extends Controller
{
    public function update(
        UpdateContentSectionRequest $request,
        ContentPage $page,
        ContentPageSection $section,
        ImageUploadService $images,
        HtmlSanitizer $sanitizer
    ) {
        $this->assertBelongsToPage($page, $section);
        $validated = $request->validated();

        DB::transaction(function () use ($validated, $page, $section, $images, $sanitizer) {
            $section->update($this->prepareSectionData($validated, $section, $sanitizer));

            foreach ($validated['items'] ?? [] as $itemId => $itemInput) {
                $item = $section->items()->whereKey($itemId)->firstOrFail();

                if (filter_var($itemInput['delete'] ?? false, FILTER_VALIDATE_BOOL)) {
                    $this->deleteItemImage($item);
                    $item->delete();
                    continue;
                }

                $item->update($this->prepareItemData($itemInput, $page, $section, $images, $sanitizer, $item));
            }

            foreach ($validated['new_items'] ?? [] as $itemInput) {
                if (! $this->hasNewItemContent($itemInput)) {
                    continue;
                }

                $itemData = $this->prepareItemData($itemInput, $page, $section, $images, $sanitizer);
                $itemData['sort_order'] = isset($itemInput['sort_order'])
                    ? (int) $itemInput['sort_order']
                    : ((int) $section->items()->max('sort_order')) + 1;
                $section->items()->create($itemData);
            }
        });

        return back()
            ->with('message', 'Section and its items updated successfully.')
            ->with('active_tab', 'sections')
            ->with('open_section', $section->id);
    }

    public function updateAll(UpdateAllContentSectionsRequest $request, ContentPage $page, HtmlSanitizer $sanitizer)
    {
        $sections = $page->sections()->get()->keyBy(fn (ContentPageSection $section) => (string) $section->id);
        $submittedSections = $request->validated()['sections'];

        DB::transaction(function () use ($sections, $submittedSections, $sanitizer) {
            foreach ($submittedSections as $sectionId => $input) {
                $section = $sections->get((string) $sectionId);
                abort_unless($section, 404);
                $section->update($this->prepareSectionData($input, $section, $sanitizer));
            }
        });

        return back()
            ->with('message', 'All content sections updated successfully.')
            ->with('active_tab', 'sections');
    }

    public function storeItem(Request $request, ContentPage $page, ContentPageSection $section, ImageUploadService $images, HtmlSanitizer $sanitizer)
    {
        $this->assertBelongsToPage($page, $section);
        $data = $this->prepareItemData($this->validateItem($request), $page, $section, $images, $sanitizer);
        $data['sort_order'] = ((int) $section->items()->max('sort_order')) + 1;
        $section->items()->create($data);

        return back()
            ->with('message', 'Section item added successfully.')
            ->with('active_tab', 'sections')
            ->with('open_section', $section->id);
    }

    public function updateItem(Request $request, ContentPage $page, ContentPageSection $section, ContentSectionItem $item, ImageUploadService $images, HtmlSanitizer $sanitizer)
    {
        $this->assertBelongsToPage($page, $section);
        abort_unless($item->content_page_section_id === $section->id, 404);
        $item->update($this->prepareItemData($this->validateItem($request), $page, $section, $images, $sanitizer, $item));

        return back()
            ->with('message', 'Section item updated successfully.')
            ->with('active_tab', 'sections')
            ->with('open_section', $section->id);
    }

    public function destroyItem(ContentPage $page, ContentPageSection $section, ContentSectionItem $item)
    {
        $this->assertBelongsToPage($page, $section);
        abort_unless($item->content_page_section_id === $section->id, 404);
        $this->deleteItemImage($item);
        $item->delete();

        return back()
            ->with('message', 'Section item removed successfully.')
            ->with('active_tab', 'sections')
            ->with('open_section', $section->id);
    }

    private function prepareSectionData(array $input, ContentPageSection $section, HtmlSanitizer $sanitizer): array
    {
        $data = [];

        foreach (['heading', 'subheading'] as $field) {
            if (array_key_exists($field, $input)) {
                $data[$field] = $input[$field];
            }
        }

        if (array_key_exists('body_html', $input)) {
            $data['body_html'] = $sanitizer->sanitize($input['body_html']);
        }

        $data['is_enabled'] = filter_var($input['is_enabled'] ?? false, FILTER_VALIDATE_BOOL);
        $settings = $section->settings ?? [];
        $settingsChanged = false;

        if ($section->section_key === 'introduction') {
            $buttonLabel = trim((string) ($input['button_label'] ?? ''));
            $buttonUrl = $this->normalizeSectionButtonUrl($input['button_url'] ?? null);

            if ($buttonLabel !== '') {
                $settings['button_label'] = $buttonLabel;
            } else {
                unset($settings['button_label']);
            }

            if ($buttonUrl !== null) {
                $settings['button_url'] = $buttonUrl;
            } else {
                unset($settings['button_url']);
            }

            $settingsChanged = true;
        }

        if (array_key_exists('after_content', $input)) {
            $afterContent = $sanitizer->sanitize($input['after_content']);

            if ($afterContent !== null && $afterContent !== '') {
                $settings['after_content'] = $afterContent;
            } else {
                unset($settings['after_content']);
            }

            $settingsChanged = true;
        }

        if ($settingsChanged) {
            $data['settings'] = $settings === [] ? null : $settings;
        }

        return $data;
    }

    private function prepareItemData(
        array $input,
        ContentPage $page,
        ContentPageSection $section,
        ImageUploadService $images,
        HtmlSanitizer $sanitizer,
        ?ContentSectionItem $item = null
    ): array {
        $data = [];

        foreach (['title', 'subtitle', 'image_alt', 'button_label', 'button_url'] as $field) {
            if (array_key_exists($field, $input)) {
                $data[$field] = $input[$field];
            }
        }

        if (array_key_exists('body', $input)) {
            $data['body'] = $sanitizer->sanitize($input['body']);
        }

        if (array_key_exists('sort_order', $input) && $input['sort_order'] !== null) {
            $data['sort_order'] = (int) $input['sort_order'];
        }

        $data['is_enabled'] = filter_var($input['is_enabled'] ?? true, FILTER_VALIDATE_BOOL);

        if (isset($input['image'])) {
            $data['image'] = $images->store(
                $input['image'],
                'content/pages/'.$page->slug.'/items',
                $item?->image
            );
        }

        return $data;
    }

    private function hasNewItemContent(array $input): bool
    {
        foreach (['title', 'subtitle', 'body', 'button_label', 'button_url'] as $field) {
            if (trim((string) ($input[$field] ?? '')) !== '') {
                return true;
            }
        }

        return isset($input['image']);
    }

    private function validateItem(Request $request): array
    {
        return $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'button_label' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_enabled' => ['nullable', 'boolean'],
        ]);
    }

    private function deleteItemImage(ContentSectionItem $item): void
    {
        if ($item->image && str_starts_with($item->image, 'content/')) {
            Storage::disk('public')->delete($item->image);
        }
    }

    private function normalizeSectionButtonUrl(?string $url): ?string
    {
        $url = trim((string) $url);

        if ($url === '') {
            return null;
        }

        if (str_starts_with($url, '/') ||
            str_starts_with($url, '#') ||
            str_starts_with($url, 'https://') ||
            str_starts_with($url, 'http://')) {
            return $url;
        }

        return '/'.ltrim($url, '/');
    }

    private function assertBelongsToPage(ContentPage $page, ContentPageSection $section): void
    {
        abort_unless($section->content_page_id === $page->id, 404);
    }
}
