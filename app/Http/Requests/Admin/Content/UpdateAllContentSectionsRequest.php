<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAllContentSectionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role != 1;
    }

    public function rules(): array
    {
        return [
            'sections' => ['required', 'array'],
            'sections.*' => ['required', 'array'],
            'sections.*.heading' => ['nullable', 'string', 'max:255'],
            'sections.*.subheading' => ['nullable', 'string', 'max:255'],
            'sections.*.body_html' => ['nullable', 'string'],
            'sections.*.after_content' => ['nullable', 'string'],
            'sections.*.button_label' => ['nullable', 'string', 'max:100'],
            'sections.*.button_url' => ['nullable', 'string', 'max:500'],
            'sections.*.is_enabled' => ['nullable', 'boolean'],
        ];
    }
}
