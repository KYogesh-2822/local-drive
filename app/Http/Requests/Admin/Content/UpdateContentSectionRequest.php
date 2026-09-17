<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContentSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role != 1;
    }

    public function rules(): array
    {
        $itemRules = [
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'button_label' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_enabled' => ['nullable', 'boolean'],
        ];

        $rules = [
            'heading' => ['nullable', 'string', 'max:255'],
            'subheading' => ['nullable', 'string', 'max:255'],
            'body_html' => ['nullable', 'string'],
            'after_content' => ['nullable', 'string'],
            'button_label' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'string', 'max:500'],
            'layout' => ['nullable', 'string', 'max:40'],
            'is_enabled' => ['nullable', 'boolean'],
            'items' => ['nullable', 'array'],
            'new_items' => ['nullable', 'array'],
        ];

        foreach ($itemRules as $field => $validation) {
            $rules['items.*.'.$field] = $validation;
            $rules['new_items.*.'.$field] = $validation;
        }

        $rules['items.*.delete'] = ['nullable', 'boolean'];

        return $rules;
    }
}
