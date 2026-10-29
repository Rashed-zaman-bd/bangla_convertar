<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    /**
     * Display all advertisements.
     */
     public function index()
    {
        $advertisements = Advertisement::latest()->paginate(10);

        return view(
            'admin.advertisements.index',
            compact('advertisements')
        );
    }

    /**
     * Show the form to create an advertisement.
     */
    public function create()
    {
        return view('admin.advertisements.create');
    }

    /**
     * Store a new advertisement.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
            'url' => ['nullable', 'url', 'max:2048'],
            'position' => ['required', 'string', 'max:100'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        // Handle image upload.
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('advertisements', 'public');
        }

        // Handle unchecked checkbox and optional order.
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Advertisement::create($data);

        return redirect()
            ->route('admin.advertisements.index')
            ->with('success', 'Advertisement created successfully.');
    }

    /**
     * Show the form to edit an advertisement.
     */
    public function edit(Advertisement $advertisement)
    {
        return view('admin.advertisements.edit', compact('advertisement'));
    }

    /**
     * Update an existing advertisement.
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
            'url' => ['nullable', 'url', 'max:2048'],
            'position' => ['required', 'string', 'max:100'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        // Replace the old image if a new one is uploaded.
        if ($request->hasFile('image')) {
            if ($advertisement->image) {
                Storage::disk('public')->delete($advertisement->image);
            }

            $data['image'] = $request->file('image')
                ->store('advertisements', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $advertisement->update($data);

        return redirect()
            ->route('admin.advertisements.index')
            ->with('success', 'Advertisement updated successfully.');
    }

    /**
     * Delete an advertisement.
     */
    public function destroy(Advertisement $advertisement)
    {
        if ($advertisement->image) {
            Storage::disk('public')->delete($advertisement->image);
        }

        $advertisement->delete();

        return redirect()
            ->route('admin.advertisements.index')
            ->with('success', 'Advertisement deleted successfully.');
    }
}
