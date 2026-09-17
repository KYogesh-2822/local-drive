<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class StoreContentFaqRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role != 1;
    }

    public function rules(): array
    {
        return [
            'target' => ['required', 'string', 'max:300'],
            'question' => ['required', 'string', 'max:1000'],
            'answer' => ['required', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
