<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = [
            ['title' => 'Membaca Modul 3', 'description' => 'Mempelajari arsitektur Laravel', 'status' => 'Done'],
            ['title' => 'Menyiapkan Environment', 'description' => 'Konfigurasi PHP dan MySQL Laragon', 'status' => 'Done'],
            ['title' => 'Pengerjaan Task 1', 'description' => 'Membuat skeleton dan router', 'status' => 'Ongoing'],
            ['title' => 'Implementasi Task 2', 'description' => 'Menyiapkan CRUD kegiatan', 'status' => 'Planned'],
            ['title' => 'Penyusunan Dokumentasi', 'description' => 'Mengisi worksheet dan commit git', 'status' => 'Planned'],
        ];

        foreach ($data as $item) {
            Activity::create($item);
        }
    }
}
