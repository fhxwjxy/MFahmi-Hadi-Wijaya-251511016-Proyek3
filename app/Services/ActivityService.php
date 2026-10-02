<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Validation\ValidationException;

class ActivityService
{
    /**
     * BR-05: Activity hanya boleh di-publish kalau data lengkap.
     */
    public function publish(Activity $activity): Activity
    {
        if ($activity->status !== 'Draft') {
            throw ValidationException::withMessages([
                'status' => "Hanya kegiatan berstatus 'Draft' yang dapat dipublish.",
            ]);
        }

        $missing = collect([
            'title' => $activity->title,
            'code' => $activity->code,
            'category_id' => $activity->category_id,
            'activity_date' => $activity->activity_date,
        ])->filter(fn($value) => empty($value))->keys();

        if ($missing->isNotEmpty()) {
            throw ValidationException::withMessages([
                'status' => "Kegiatan belum lengkap (BR-05). Field kosong: {$missing->implode(', ')}.",
            ]);
        }

        $activity->update(['status' => 'Published']);
        return $activity;
    }

    public function complete(Activity $activity): Activity
    {
        if ($activity->status !== 'Published') {
            throw ValidationException::withMessages([
                'status' => "Hanya kegiatan berstatus 'Published' yang dapat diselesaikan (complete).",
            ]);
        }

        $activity->update(['status' => 'Completed']);
        return $activity;
    }

    public function updateActivity(Activity $activity, array $data): Activity
    {
        unset($data['status']);
        $activity->update($data);
        return $activity;
    }
}