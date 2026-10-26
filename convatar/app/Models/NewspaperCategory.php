<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewspaperCategory extends Model
{
    protected $fillable = ['title', 'slug', 'note', 'sort_order', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function newspapers(): HasMany
    {
        return $this->hasMany(Newspaper::class, 'category_id');
    }
}
