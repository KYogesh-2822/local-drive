<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\StoreContentFaqRequest;
use App\Models\Content\BlogPost;
use App\Models\Content\ContentFaq;
use App\Models\Content\ContentPage;
use App\Services\Content\HtmlSanitizer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $pages = ContentPage::orderBy('id')->get();
        $posts = BlogPost::orderBy('title')->get();
        $targetKey = $request->string('target')->toString() ?: 'page:'.optional($pages->first())->slug;
        $target = $this->resolveTarget($targetKey);

        return view('admin.content.faqs.index', [
            'pages' => $pages,
            'posts' => $posts,
            'targetKey' => $targetKey,
            'target' => $target,
            'faqs' => $target ? $target->faqs()->get() : collect(),
        ]);
    }

    public function store(StoreContentFaqRequest $request, HtmlSanitizer $sanitizer)
    {
        $target = $this->resolveTarget($request->validated('target'));
        abort_unless($target, 404);

        $target->faqs()->create([
            'question' => $request->validated('question'),
            'answer' => $sanitizer->sanitize($request->validated('answer')),
            'sort_order' => $request->integer('sort_order', $target->faqs()->count()),
            'is_active' => $request->boolean('is_active', true),
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return back()->with('message', 'FAQ added successfully.');
    }

    public function update(StoreContentFaqRequest $request, ContentFaq $faq, HtmlSanitizer $sanitizer)
    {
        $faq->update([
            'question' => $request->validated('question'),
            'answer' => $sanitizer->sanitize($request->validated('answer')),
            'sort_order' => $request->integer('sort_order', 0),
            'is_active' => $request->boolean('is_active'),
            'updated_by' => auth()->id(),
        ]);

        return back()->with('message', 'FAQ updated successfully.');
    }

    public function destroy(ContentFaq $faq)
    {
        $faq->delete();

        return back()->with('message', 'FAQ deleted successfully.');
    }

    private function resolveTarget(?string $key): ?Model
    {
        if (!$key || !str_contains($key, ':')) {
            return null;
        }

        [$type, $slug] = explode(':', $key, 2);

        return match ($type) {
            'page' => ContentPage::where('slug', $slug)->first(),
            'blog' => BlogPost::where('slug', $slug)->first(),
            default => null,
        };
    }
}
