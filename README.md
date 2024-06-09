# Monitoring Kendaraan Tambang App

Aplikasi ini digunakan untuk memonitoring kendaraan di tambang, dengan pengguna yang terdiri dari admin dan penjabat.

## User Login

- **Admin**
  - Username: `admin`
  - Password: `admin`

- **Penjabat**
  - Username: `penjabat-1`
  - Password: `penjabat`

## Teknologi yang Digunakan

- **Database**: MySQL
- **PHP Version**: 8.1
- **Laravel Version**: 10

## Cara Menggunakan Aplikasi

1. Clone repository ini:
2. Buka terminal dan jalankan: composer update atau composer install
3. Ubah nama file `.env.example.copy` menjadi `.env`:
4. Konfigurasi/buat database di MySQL dan update file `.env` dengan pengaturan database Anda.
5. Jalankan perintah berikut untuk menghasilkan key aplikasi dan membersihkan konfigurasi cache: php artisan key & php artisan config
6. Jalankan migrasi dan seeding database untuk membuat tabel dan memasukkan data user default: php artisan migrate:fresh --seed. 
7. Jalankan server aplikasi: php artisan serve
8. Buka browser dan ketik: http://localhost:8000

### Login sebagai Admin

1. Buat data perusahaan
2. Buat data kendaraan
3. Buat data driver
4. Buat pengajuan peminjaman kendaraan
5. Export data pengajuan ke Excel
6. Lihat statistik data di dashboard

### Login sebagai Penjabat

1. Masuk ke pengajuan kendaraan
2. Approve atau unapprove pengajuan
3. Export data pengajuan ke Excel
4. Lihat statistik data di dashboard




