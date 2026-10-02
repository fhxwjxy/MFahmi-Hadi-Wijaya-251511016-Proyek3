<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        activity::query()->insert([
            [
                'title' => 'Workshop Git Dasar', 
                'description' => 'Latihan kolaborasi repository.', 
                'activity_date' => '2026-10-05', 
                'category' => 'Workshop', 
                'status' => 'Planned', 
                'created_at' => now(), 
                'updated_at' => now(), 
            ], 
            [ 
                'title' => 'Seminar Web Quality', 
                'description' => 'Pengenalan maintainability dan testing.', 
                'activity_date' => '2026-10-12', 
                'category' => 'Seminar', 
                'status' => 'Planned', 
                'created_at' => now(), 
                'updated_at' => now(), 
            ], 
            [
                'title' => 'Pendalaman Laravel',
                'description' => 'Belajar Laravel',
                'activity_date' => '2026-09-28',
                'category' => 'Akademik',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Belajar Dasar Laravel',
                'description' => 'Mengerjakan Modul 3 Laravel',
                'activity_date' => '2026-09-21',
                'category' => 'Akademik',
                'status' => 'Ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Belajar Dasar Web (HTML, CSS, JavaScript)',
                'description' => 'Mengerjakan Modul 1 dan 2',
                'activity_date' => '2026-09-14',
                'category' => 'Akademik',
                'status' => 'Done',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
