<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBlogPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role != 1;
    }

    public function rules(): array
    {
        $post = $this->route('post');

        return [
            'blog_category_id' => ['nullable', 'exists:blog_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required', 'alpha_dash', 'max:255',
                Rule::unique('blog_posts', 'slug')->ignore($post?->id),
            ],
            'excerpt' => ['required', 'string', 'max:1000'],
            'body_html' => ['required', 'string'],
            'featured_image' => [$post ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'featured_image_alt' => ['required', 'string', 'max:255'],
            'author_name' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'published_at' => ['required', 'date_format:Y-m-d'],
            'meta_title' => ['required', 'string', 'max:255'],
            'meta_description' => ['required', 'string', 'max:500'],
            'focus_keyword' => ['nullable', 'string', 'max:255'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
        ];
    }
}
