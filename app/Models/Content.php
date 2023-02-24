<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'thumbnail_url',
        'trailer_url',
        'description',
        'rating',
        'category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeWithFilter($query, ?string $keyword, ?string $type)
    {
        return $query
            ->when($keyword, fn($q) => $q->where('title', 'LIKE', "%$keyword"))
            ->when($type, fn($q) => $q->whereHas('category', fn($q) => $q->where('name', "$type")));
    }

    public function scopeTopRating($query)
    {
        return $query->orderBy('rating', 'DESC');
    }
}
