
@php
    $advertisement = $advertisement ?? null;
@endphp

<div class="form-group">
    <label for="title">Advertisement Title</label>
    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title', $advertisement?->title) }}"
        required
    >
</div>

<div class="form-group">
    <label for="image">Advertisement Image</label>
    <input
        type="file"
        id="image"
        name="image"
        accept="image/jpeg,image/png,image/webp"
    >

    @if ($advertisement?->image)
        <p>Current image:</p>
        <img
            src="{{ asset('storage/' . $advertisement->image) }}"
            alt="Current advertisement"
            style="max-width: 300px; height: auto;"
        >
    @endif
</div>

<div class="form-group">
    <label for="url">Advertisement Link (optional)</label>
    <input
        type="url"
        id="url"
        name="url"
        value="{{ old('url', $advertisement?->url) }}"
        placeholder="https://example.com"
    >
</div>

<div class="form-group">
    <label for="position">Position</label>
    <select id="position" name="position" required>
        <option
            value="category_bottom"
            @selected(old('position', $advertisement?->position ?? 'category_bottom') === 'category_bottom')
        >
            Below category
        </option>
    </select>
</div>

<div class="form-group">
    <label for="sort_order">Display Order</label>
    <input
        type="number"
        id="sort_order"
        name="sort_order"
        min="0"
        value="{{ old('sort_order', $advertisement?->sort_order ?? 0) }}"
        required
    >
</div>

<div class="form-group">
    <label>
        <input
            type="checkbox"
            name="is_active"
            value="1"
            @checked(old('is_active', $advertisement?->is_active ?? true))
        >
        Active
    </label>
</div>

<button type="submit">Save Advertisement</button>
