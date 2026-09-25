<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'description',
        'activity_date',
        'category',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'activity_date' => 'date',
        ];
    }

    public function scopeFilterStatus(Builder $query, ?string $status): Builder
    {
        return $query->when(in_array($status, ['Planned', 'Ongoing', 'Done'], true), function ($q) use ($status) {
            $q->where('status', $status);
        });
    }
}