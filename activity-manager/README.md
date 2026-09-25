# Activity Management App

Dibangun dengan [Laravel](https://laravel.com).

Aplikasi CRUD sederhana untuk mengelola data kegiatan (activities) menggunakan Laravel — mendukung pembuatan, pengeditan, penghapusan, dan filter berdasarkan status, dengan validasi transisi status bisnis (`Planned → Ongoing → Done`).

## Requirement

Pastikan sudah terinstall di komputer kamu:

- PHP >= 8.2
- Composer
- Node.js & NPM (kalau project pakai Vite/asset compilation)
- MySQL / MariaDB / PostgreSQL / SQLite (salah satu, sesuaikan dengan konfigurasi)
- Git

## 1. Clone Repository

```bash
git clone <url-repo-kamu>
cd <nama-folder-project>
```

## 2. Install Dependency

```bash
composer install
```

Kalau project juga pakai asset frontend (CSS/JS via Vite):

```bash
npm install
```

## 3. Setup Environment File

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

> Di Windows PowerShell, kalau `cp` tidak dikenali, gunakan:
> ```powershell
> Copy-Item .env.example .env
> ```

Generate application key:

```bash
php artisan key:generate
```

## 4. Konfigurasi Database

Buka file `.env`, sesuaikan bagian koneksi database dengan setup lokal kamu. Contoh untuk MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_kamu
DB_USERNAME=root
DB_PASSWORD=
```

Atau kalau mau pakai SQLite (lebih simpel untuk development):

```env
DB_CONNECTION=sqlite
```

Lalu buat file databasenya:

```bash
# Linux/Mac/Git Bash
touch database/database.sqlite

# Windows PowerShell
New-Item -ItemType File -Path database/database.sqlite
```

Pastikan database dengan nama yang sesuai `.env` sudah dibuat di MySQL/PostgreSQL kamu sebelum lanjut ke langkah migrate (kecuali pakai SQLite).

## 5. Migrate & Seed Database

Jalankan migration untuk membuat struktur tabel:

```bash
php artisan migrate
```

Kalau ada data awal (seeder) untuk testing:

```bash
php artisan db:seed
```

Atau jalankan keduanya sekaligus, sekalian reset database dari awal kalau perlu:

```bash
php artisan migrate:fresh --seed
```

## 6. Jalankan Project

Jalankan development server bawaan Laravel:

```bash
php artisan serve
```

Secara default aplikasi bisa diakses di:

```
http://127.0.0.1:8000
```

Kalau project pakai Vite untuk compile asset (CSS/JS), jalankan di terminal terpisah:

```bash
npm run dev
```

## URL Route Utama

| Method | URL | Deskripsi |
|---|---|---|
| GET | `/activities` | Daftar semua kegiatan (bisa difilter via `?status=Planned/Ongoing/Done`) |
| GET | `/activities/create` | Form tambah kegiatan baru |
| POST | `/activities` | Simpan kegiatan baru |
| GET | `/activities/{id}` | Detail satu kegiatan |
| GET | `/activities/{id}/edit` | Form edit kegiatan |
| PUT/PATCH | `/activities/{id}` | Update kegiatan (dengan validasi transisi status) |
| DELETE | `/activities/{id}` | Hapus kegiatan |

Buka `http://127.0.0.1:8000/activities` di browser setelah server jalan untuk mulai menggunakan aplikasi.

## Aturan Transisi Status

Status kegiatan hanya bisa berubah mengikuti alur berikut (divalidasi di `ActivityService`):

```
Planned  → Planned, Ongoing
Ongoing  → Ongoing, Done
Done     → Done
```

Perubahan status di luar alur ini (misal `Planned` langsung ke `Done`) akan ditolak dan menampilkan pesan error di form edit.

## Struktur Kode Penting

```
app/
├── Http/
│   ├── Controllers/
│   │   └── ActivityController.php     # Orkestrasi HTTP request
│   └── Requests/
│       ├── StoreActivityRequest.php   # Validasi input saat create
│       └── UpdateActivityRequest.php  # Validasi input saat update
├── Models/
│   └── Activity.php                   # Eloquent model + scope filter status
└── Services/
    └── ActivityService.php            # Business rule transisi status

resources/views/activities/
├── index.blade.php    # Daftar kegiatan + filter status
├── show.blade.php     # Detail kegiatan
├── create.blade.php   # Form tambah
├── edit.blade.php     # Form edit
└── _form.blade.php    # Partial form (dipakai create & edit)
```

## Troubleshooting

- **Error `SQLSTATE[HY000] [1049] Unknown database`** → pastikan nama database di `.env` sudah dibuat manual di MySQL/PostgreSQL sebelum migrate.
- **Error `No application encryption key has been specified`** → jalankan ulang `php artisan key:generate`.
- **Halaman blank/500 error** → cek log di `storage/logs/laravel.log` untuk detail error.
- **CSS/JS tidak muncul** → pastikan `npm run dev` atau `npm run build` sudah dijalankan.

## Referensi Laravel

Project ini dibangun di atas framework [Laravel](https://laravel.com). Beberapa referensi yang mungkin berguna:

- [Dokumentasi resmi Laravel](https://laravel.com/docs)
- [Laracasts](https://laracasts.com) — video tutorial Laravel & PHP
- [Laravel Boost](https://laravel.com/docs/ai) — tool untuk membantu AI coding agent (Claude Code, Cursor, dll.) bekerja dengan konvensi Laravel:
  ```bash
  composer require laravel/boost --dev
  php artisan boost:install
  ```

Laravel framework sendiri berlisensi [MIT](https://opensource.org/licenses/MIT).