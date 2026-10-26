<div class="form-grid">
    <label>Category
        <select name="category_id" required>
            <option value="">Choose category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $newspaper->category_id) == $category->id)>{{ $category->title }}</option>
            @endforeach
        </select>
    </label>
    <label>Newspaper / website name <input name="name" required maxlength="180" value="{{ old('name', $newspaper->name) }}"></label>
    <label class="full-width">Website URL <input name="url" required maxlength="2048" value="{{ old('url', $newspaper->url) }}" placeholder="https://example.com or #"></label>
    <label>Slug (optional) <input name="slug" maxlength="200" value="{{ old('slug', $newspaper->slug) }}" placeholder="auto-generated-from-name"></label>
    <label>Sort order <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $newspaper->sort_order ?? 0) }}" required></label>
    <label>Logo image (PNG, JPG, WEBP, max 2MB)
        <input type="file" name="logo_upload" accept=".png,.jpg,.jpeg,.webp,.svg,image/png,image/jpeg,image/webp,image/svg+xml">
    </label>
    @if ($newspaper->exists && $newspaper->logo)
        <div class="current-logo"><span>Current logo</span><img src="{{ $newspaper->logo_url }}" alt="Current logo" width="90"></div>
    @endif
    <label class="checkbox-label"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $newspaper->is_active))> Active (visible on public page)</label>
</div>
<div class="form-actions"><button class="button" type="submit">Save newspaper</button><a class="button secondary" href="{{ route('admin.newspapers.index') }}">Cancel</a></div>
