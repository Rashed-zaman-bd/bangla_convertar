<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewspaperCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class NewspaperCategoryController extends Controller
{
    public function index(): View
    {
        $categories = NewspaperCategory::withCount('newspapers')
            ->orderBy('sort_order')->orderBy('title')->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create', [
            'category' => new NewspaperCategory(['is_active' => true, 'sort_order' => 0]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        NewspaperCategory::create($data);

        return redirect()->route('admin.newspaper-categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(NewspaperCategory $newspaper_category): View
    {
        return view('admin.categories.edit', ['category' => $newspaper_category]);
    }

    public function update(Request $request, NewspaperCategory $newspaper_category): RedirectResponse
    {
        $data = $this->validated($request, $newspaper_category);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $newspaper_category->update($data);

        return redirect()->route('admin.newspaper-categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(NewspaperCategory $newspaper_category): RedirectResponse
    {
        $newspaper_category->delete();

        return back()->with('success', 'Category deleted successfully.');
    }

    private function validated(Request $request, ?NewspaperCategory $category = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:200', Rule::unique('newspaper_categories', 'slug')->ignore($category?->id)],
            'note' => ['nullable', 'string', 'max:2000'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:100000'],
            'is_active' => ['nullable', 'boolean'],
        ]) + ['is_active' => $request->boolean('is_active')];
    }
}
