<div class="form-grid">
    <label>Category title <input name="title" required maxlength="180"
            value="{{ old('title', $category->title) }}"></label>
    <label>Slug (optional) <input name="slug" maxlength="200" value="{{ old('slug', $category->slug) }}"
            placeholder="auto-generated-from-title"></label>
    <label>Sort order <input type="number" name="sort_order" min="0"
            value="{{ old('sort_order', $category->sort_order ?? 0) }}" required></label>
    <label class="full-width">Note (optional)
        <textarea name="note" rows="3">{{ old('note', $category->note) }}</textarea>
    </label>
    <label class="checkbox-label"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active))>
        Active (visible on public page)</label>
</div>
<div class="form-actions"><button class="button" type="submit">Save category</button><a class="button secondary"
        href="{{ route('admin.newspaper-categories.index') }}">Cancel</a></div>
