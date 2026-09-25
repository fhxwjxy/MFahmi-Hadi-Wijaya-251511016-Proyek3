<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Validation\ValidationException;

class ActivityService
{
    /**
     * Aturan transisi status yang diizinkan.
     */
    private array $allowedTransitions = [
        'Planned' => ['Planned', 'Ongoing'],
        'Ongoing' => ['Ongoing', 'Done'],
        'Done'    => ['Done'],
    ];

    /**
     * Validasi transisi status bisnis.
     */
    public function validateStatusTransition(Activity $activity, string $newStatus): void
    {
        $allowed = $this->allowedTransitions[$activity->status] ?? [];

        if (!in_array($newStatus, $allowed, true)) {
            throw ValidationException::withMessages([
                'status' => "Perubahan status dari '{$activity->status}' ke '{$newStatus}' tidak diizinkan.",
            ]);
        }
    }

    /**
     * Memperbarui activity dengan validasi transisi status.
     */
    public function updateActivity(Activity $activity, array $data): Activity
    {
        if (isset($data['status'])) {
            $this->validateStatusTransition($activity, $data['status']);
        }

        $activity->update($data);
        return $activity;
    }
}