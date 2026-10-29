
@php
    $advertisement = $advertisement ?? new \App\Models\Advertisement();

    $positions = [
        'home-top' => 'Homepage — Top',
        'home-bottom' => 'Homepage — Bottom',
    ];

    for ($i = 1; $i <= 30; $i++) {
        $positions['home-feed-' . $i] = 'Below Category ' . $i;
    }

    $selectedPosition = old(
        'position',
        $advertisement->position ?? 'home-feed-1'
    );
@endphp

<div class="form-group">
    <label for="title">Advertisement Title</label>
    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title', $advertisement->title) }}"
        placeholder="Enter advertisement title"
    >
    @error('title')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="image">Advertisement Image</label>
    <input
        type="file"
        id="image"
        name="image"
        accept="image/jpeg,image/png,image/webp,image/gif"
    >
    <small>Allowed: JPG, PNG, WEBP or GIF. Maximum size: 2 MB.</small>

    @error('image')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    @if ($advertisement->image)
        <p>Current image:</p>
        <img
            src="{{ asset('storage/' . $advertisement->image) }}"
            alt="Current advertisement"
            style="display:block; max-width:300px; height:auto; margin-top:10px;"
        >
    @endif
</div>

<div class="form-group">
    <label for="url">Advertisement Link (optional)</label>
    <input
        type="url"
        id="url"
        name="url"
        value="{{ old('url', $advertisement->url) }}"
        placeholder="https://example.com"
    >
    @error('url')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="position">Advertisement Position</label>
    <select id="position" name="position" required>
        @foreach ($positions as $value => $label)
            <option
                value="{{ $value }}"
                @selected($selectedPosition === $value)
            >
                {{ $label }}
            </option>
        @endforeach
    </select>

    @error('position')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="sort_order">Display Order</label>
    <input
        type="number"
        id="sort_order"
        name="sort_order"
        min="0"
        value="{{ old('sort_order', $advertisement->sort_order ?? 0) }}"
        required
    >
    @error('sort_order')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label>
        <input
            type="checkbox"
            name="is_active"
            value="1"
            @checked((bool) old('is_active', $advertisement->exists
                ? $advertisement->is_active
                : true))
        >
        Active
    </label>
</div>

<button type="submit">
    {{ $advertisement->exists ? 'Update Advertisement' : 'Save Advertisement' }}
</button>
