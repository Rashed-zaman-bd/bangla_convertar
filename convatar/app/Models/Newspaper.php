<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Newspaper extends Model
{
    protected $fillable = [
        'category_id', 'name', 'url', 'slug', 'logo', 'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(NewspaperCategory::class, 'category_id');
    }

    public function getLogoUrlAttribute(): string
    {
        return $this->logo
            ? asset('storage/' . ltrim($this->logo, '/'))
            : asset('images/logos/' . $this->slug . '.png');
    }
}
