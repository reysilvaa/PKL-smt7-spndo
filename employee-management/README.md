# Sistem Manajemen Karyawan

Aplikasi manajemen karyawan berbasis Laravel untuk mengelola data karyawan dan departemen dengan fitur laporan.

## Persyaratan Sistem

- PHP >= 8.1
- Composer
- MySQL atau MariaDB
- Node.js & NPM (opsional - untuk pengembangan frontend)

## Langkah-langkah Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/employee-management.git
cd employee-management
```

Atau download dan ekstrak zip ke direktori proyek Anda.

### 2. Instal Dependensi

```bash
composer install
```

### 3. Setup Environment

Salin file environment:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=employee_management
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrasi dan Seeding Database

Jalankan migrasi untuk membuat struktur database:

```bash
php artisan migrate
```

Jalankan seeder untuk mengisi data awal:

```bash
php artisan db:seed
```

Atau gunakan perintah berikut untuk me-refresh database dan langsung seed:

```bash
php artisan migrate:fresh --seed
```

### 6. Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi akan berjalan di http://127.0.0.1:8000

## Kompatibilitas dengan Laravel 12

Untuk Laravel 12, ada beberapa perubahan yang perlu diperhatikan:

1. Pastikan PHP >= 8.2
2. Update dependencies di composer.json:

```bash
composer update
```

3. Jika ada dependensi yang tidak kompatibel, perbarui dengan:

```bash
composer require laravel/framework:^12.0 --update-with-dependencies
```

4. Periksa perubahan struktur DB dan route jika ada:

```bash
php artisan route:list
php artisan migrate:status
```

5. Sesuaikan namespace jika diperlukan (beberapa namespace mungkin berubah di Laravel 12)

## Informasi Login

### Admin
- Username: admin
- Password: admin123

### Guest
- Username: guest
- Password: guest123

## Fitur Aplikasi

1. Manajemen Karyawan (CRUD)
2. Manajemen Departemen (CRUD)
3. Perbedaan hak akses antara admin dan guest
4. Laporan:
   - Daftar Karyawan
   - Ringkasan Status Karyawan
   - Status Karyawan per Departemen

## Struktur Database

### Departments
- id (int, primary key)
- name (varchar(100))
- timestamps

### Employees
- id (int, primary key)
- firstname (varchar(100))
- lastname (varchar(100), nullable)
- gender (enum: male, female)
- address (varchar(100))
- dob (date)
- dept_id (foreign key)
- status (enum: cont, emp, not_act)
- timestamps

### Users
- id (int, primary key)
- name (varchar)
- username (varchar, unique)
- password (varchar)
- role (enum: admin, guest)
- timestamps

## Troubleshooting

1. Jika terjadi error saat migrasi, pastikan database telah dibuat dan konfigurasi di .env sudah benar.

2. Jika mendapat error permission, pastikan direktori storage dan bootstrap/cache memiliki izin tulis.

```bash
chmod -R 775 storage bootstrap/cache
```

3. Jika ada masalah dengan seeder, pastikan data di seeder sesuai dengan struktur tabel.

4. Untuk Laravel 12, jika ada perubahan API, sesuaikan kode yang menggunakan API tersebut.

## Lisensi

[MIT License](LICENSE)
