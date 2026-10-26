<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newspaper;
use App\Models\NewspaperCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class NewspaperController extends Controller
{
    public function index(): View
    {
        $newspapers = Newspaper::with('category')
            ->orderBy('sort_order')->orderBy('name')->paginate(20);

        return view('admin.newspapers.index', compact('newspapers'));
    }

    public function create(): View
    {
        return view('admin.newspapers.create', [
            'newspaper' => new Newspaper(['is_active' => true, 'sort_order' => 0, 'url' => 'https://']),
            'categories' => NewspaperCategory::orderBy('title')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        if ($request->hasFile('logo_upload')) {
            $data['logo'] = $request->file('logo_upload')->store('newspaper-logos', 'public');
        }
        unset($data['logo_upload']);
        Newspaper::create($data);

        return redirect()->route('admin.newspapers.index')->with('success', 'Newspaper added successfully.');
    }

    public function edit(Newspaper $newspaper): View
    {
        return view('admin.newspapers.edit', [
            'newspaper' => $newspaper,
            'categories' => NewspaperCategory::orderBy('title')->get(),
        ]);
    }

    public function update(Request $request, Newspaper $newspaper): RedirectResponse
    {
        $data = $this->validated($request, $newspaper);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        if ($request->hasFile('logo_upload')) {
            if ($newspaper->logo) {
                Storage::disk('public')->delete($newspaper->logo);
            }
            $data['logo'] = $request->file('logo_upload')->store('newspaper-logos', 'public');
        }
        unset($data['logo_upload']);
        $newspaper->update($data);

        return redirect()->route('admin.newspapers.index')->with('success', 'Newspaper updated successfully.');
    }

    public function destroy(Newspaper $newspaper): RedirectResponse
    {
        if ($newspaper->logo) {
            Storage::disk('public')->delete($newspaper->logo);
        }
        $newspaper->delete();

        return back()->with('success', 'Newspaper deleted successfully.');
    }

    private function validated(Request $request, ?Newspaper $newspaper = null): array
    {
        return $request->validate([
            'category_id' => ['required', 'integer', 'exists:newspaper_categories,id'],
            'name' => ['required', 'string', 'max:180'],
            'url' => ['required', 'string', 'max:2048', function ($attribute, $value, $fail) {
                if ($value !== '#' && !filter_var($value, FILTER_VALIDATE_URL)) {
                    $fail('Enter a valid full URL, or use # as a placeholder.');
                }
            }],
            'slug' => ['nullable', 'string', 'max:200', Rule::unique('newspapers', 'slug')->ignore($newspaper?->id)],
            'logo_upload' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:100000'],
            'is_active' => ['nullable', 'boolean'],
        ]) + ['is_active' => $request->boolean('is_active')];
    }
}
