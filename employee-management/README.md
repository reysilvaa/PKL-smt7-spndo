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

Untuk Laravel 12, ada beberapa perubahan signifikan yang perlu diperhatikan:

1. Pastikan PHP >= 8.2
2. Update dependencies di composer.json:

```bash
composer update
```

3. Jika ada dependensi yang tidak kompatibel, perbarui dengan:

```bash
composer require laravel/framework:^12.0 --update-with-dependencies
```

### Menangani Perubahan Kernel.php di Laravel 12

Laravel 12 menghapus file `app/Http/Kernel.php` dan menggunakan pendekatan yang berbeda untuk middleware. Untuk menyesuaikan aplikasi ini dengan Laravel 12, lakukan langkah-langkah berikut:

1. **Buat file Bootstrap Middleware**

Buat file `bootstrap/middleware.php`:

```php
<?php

use Illuminate\Foundation\Configuration\Middleware;

return function (Middleware $middleware) {
    // Global Middleware
    $middleware->use([
        // Middleware yang sebelumnya ada di $middleware
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ]);

    // Web Middleware
    $middleware->web([
        // Middleware yang sebelumnya ada di $middlewareGroups['web']
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ]);

    // API Middleware
    $middleware->api([
        \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ]);

    // Named Middleware
    $middleware->alias([
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ]);
    
    return $middleware;
};
```

2. **Buat file Bootstrap Routes**

Buat file `bootstrap/routes.php`:

```php
<?php

use Illuminate\Foundation\Configuration\Middleware;

return function (\Illuminate\Routing\Router $router, Middleware $middleware) {
    $router->middlewareGroup('web', $middleware->getWebMiddleware());
    $router->middlewareGroup('api', $middleware->getApiMiddleware());
    
    collect($middleware->getAliases())->each(function ($middleware, $alias) use ($router) {
        $router->aliasMiddleware($alias, $middleware);
    });
    
    return $router;
};
```

3. **Perbarui Reference Middleware di Route**

Jika Anda menggunakan `$this->middleware()` dalam controller, Anda perlu menggantinya dengan atribut PHP 8 atau mendaftarkannya di `routes/web.php`:

```php
// Contoh menggunakan route middleware dalam route/web.php
Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');
```

4. **Periksa dan Sesuaikan Provider**

Periksa service provider Anda untuk melihat apakah ada referensi ke Kernel.php:

```bash
php artisan app:provider-list
```

Sesuaikan provider yang menggunakan referensi ke Kernel dengan pendekatan baru.

5. **Jalankan Perintah Artisan untuk Validasi**

```bash
php artisan route:list
php artisan config:clear
php artisan view:clear
php artisan cache:clear
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

4. Untuk Laravel 12, jika menemui error terkait middleware:
   - Pastikan file `bootstrap/middleware.php` dan `bootstrap/routes.php` sudah dibuat
   - Periksa bahwa semua middleware yang digunakan telah didaftarkan dengan benar
   - Gunakan `php artisan route:list` untuk memverifikasi bahwa middleware sudah terdaftar

## Lisensi

[MIT License](LICENSE)
