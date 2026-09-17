<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogCategoryController extends Controller
{
    public function index()
    {
        return view('admin.content.categories.index', [
            'categories' => BlogCategory::withCount('posts')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:255', 'unique:blog_categories,name']]);
        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = true;
        BlogCategory::create($data);

        return back()->with('message', 'Blog category created successfully.');
    }

    public function update(Request $request, BlogCategory $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('blog_categories', 'name')->ignore($category->id)],
            'is_active' => ['nullable', 'boolean'],
        ]);
        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');
        $category->update($data);

        return back()->with('message', 'Blog category updated successfully.');
    }
}
