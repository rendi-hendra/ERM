# Panduan Instalasi Project (CodeIgniter 4)

Dokumentasi ini menjelaskan langkah-langkah untuk meng-install dan menjalankan proyek CodeIgniter 4 yang ada di repository ini. Instruksi ditulis dalam Bahasa Indonesia dan disesuaikan untuk lingkungan development di Windows (PowerShell).

## Prasyarat

- PHP >= 8.1 (lihat `composer.json` yang membutuhkan `php: ^8.1`).
- Composer (https://getcomposer.org/) tersedia di PATH.
- Ekstensi PHP yang direkomendasikan: intl, mbstring, json, mysqlnd (jika menggunakan MySQL), curl/libcurl.
- Git (opsional untuk cloning repository).
- Database server (MySQL/MariaDB/PostgreSQL) jika aplikasi menggunakan database.

Catatan: file `composer.json` menunjukkan dependency utama: CodeIgniter framework dan dev tools seperti `phpunit`. Sesuaikan versi PHP dan ekstensi sesuai kebutuhan.

## Langkah-langkah instalasi (PowerShell)

1. Clone repository (jika belum ada):

```powershell
# Ganti URL dengan alamat repo Anda jika perlu
git clone https://github.com/<user>/<repo>.git ERM
cd ERM
```

2. Install dependency PHP via Composer:

```powershell
# Pastikan composer tersedia (composer atau composer.phar)
composer install
```

3. Salin `env` menjadi `.env` dan sesuaikan konfigurasi:

```powershell
Copy-Item .\env .\.env
```

Buka `.env` di editor dan perbarui setelan penting, misalnya `app.baseURL` dan setelan database. Contoh pengaturan database (MySQL):

```
app.baseURL = 'http://localhost:8080'

database.default.DBDriver = MySQLi
database.default.hostname = 127.0.0.1
database.default.database = nama_database
database.default.username = db_user
database.default.password = db_password
database.default.DBPrefix = 
```

4. Pastikan folder `writable/` memiliki permission tertulis (Linux) atau tidak read-only (Windows).

- Windows: biasanya tidak perlu mengubah permission, tetapi pastikan Antivirus/Windows Defender tidak mengunci file.
- Linux/macOS:

```bash
chmod -R 0777 writable/ # development only
```

5. Buat/migrasikan database (jika proyek menggunakan migrations):

```powershell
# Jalankan migration menggunakan spark
php spark migrate

# Jika ada seeder:
php spark db:seed NamaSeeder
```

6. Menjalankan server built-in (development):

```powershell
php spark serve --host=0.0.0.0 --port=8080
```

Lalu buka: http://localhost:8080 (atau URL sesuai `app.baseURL`).

7. Menjalankan test (opsional):

```powershell
# Cara 1: melalui composer script
composer test

# Cara 2: langsung PHPUnit (Windows)
vendor\bin\phpunit.bat
```

## Konfigurasi web server (production)

- Pastikan document root mengarah ke folder `public/` (bukan root project).
- Server seperti Apache/Nginx harus dikonfigurasi untuk menunjuk `.../path/to/project/public`.
- Jangan biarkan `app/` dan file konfigurasi sensitif dapat diakses dari web.

## Troubleshooting umum

- Error "Class ... not found" setelah `composer install`: jalankan `composer dump-autoload`.
- Jika composer kehabisan memori di Windows, jalankan:

```powershell
# naikkan memory limit sementara saat menjalankan composer (PowerShell)
php -d memory_limit=-1 C:\path\to\composer.phar install
```

- Jika ekstensi PHP hilang (mis. intl atau mbstring), tambahkan/aktifkan ekstensi tersebut pada php.ini dan restart web server / gunakan CLI PHP yang sesuai.

- Jika aplikasi tidak berjalan dan menampilkan 404, pastikan Routes dan controller sudah ada dan `app.baseURL` benar.

## Catatan developer

- `index.php` berada di dalam `public/` untuk alasan keamanan.
- Untuk update framework, jalankan `composer update` dan periksa changelog/framework upgrade guide untuk perubahan yang perlu di-merge ke folder `app/`.

## Ringkasan perintah cepat (PowerShell)

```powershell
# Clone
git clone https://github.com/<user>/<repo>.git ERM; cd ERM

# Install
composer install
Copy-Item .\env .\.env
# Edit .env sesuai kebutuhan

# Migrasi & seed (jika perlu)
php spark migrate
php spark db:seed NamaSeeder

# Jalankan dev server
php spark serve --host=0.0.0.0 --port=8080

# Test
composer test
```

Jika Anda ingin saya menambahkan contoh `.env` yang sudah diisi (template), instruksi untuk Docker, atau konfigurasi Nginx/Apache yang spesifik, beri tahu saya target environment Anda dan saya akan tambahkan contoh lengkap.
