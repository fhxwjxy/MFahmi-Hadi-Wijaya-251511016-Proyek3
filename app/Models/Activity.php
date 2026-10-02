<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'code',
        'description',
        'activity_date',
        'category_id',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'activity_date' => 'date',
            'deleted_at' => 'datetime'
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilterStatus(Builder $query, ?string $status): Builder
    {
        return $query->when(in_array($status, ['Draft', 'Published', 'Completed'], true), function ($q) use ($status) {
            $q->where('status', $status);
        });
    }

    public function scopeFilterCategory(Builder $query, ?string $categoryId): Builder
    {
        return $query->when($categoryId, function ($q) use ($categoryId) {
            $q->where('category_id', $categoryId);
        });
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        return $query->when($term, function ($q) use ($term) {
            $q->where(function ($sub) use ($term) {
                $sub->where('title', 'like', "%{$term}%")
                    ->orWhere('code', 'like', "%{$term}%");
            });
        });
    }

    public function scopeSortByDate(Builder $query, ?string $direction = null): Builder
    {
        $direction = in_array($direction, ['asc', 'desc'], true) ? $direction : 'desc';
        return $query->orderBy('activity_date', $direction);
    }
}