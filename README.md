# Kasir App

Aplikasi Point of Sale (POS) berbasis web menggunakan CodeIgniter 4 dan PHP 8.3.

## Fitur

- Login multi-role (Admin & Kasir)
- Manajemen Produk, Kategori, dan Satuan
- Manajemen Supplier & Pelanggan
- Transaksi Penjualan dengan cetak nota
- Stok Masuk & Stok Keluar
- Laporan Penjualan, Stok Masuk, Stok Keluar
- Dashboard dengan grafik
- Pengaturan Toko

## Kebutuhan Sistem

- PHP >= 8.2
- MySQL / MariaDB
- Composer (https://getcomposer.org/download/)
- Extension PHP yang harus aktif: `intl`, `mbstring`, `mysqli`

## Cara Menjalankan Aplikasi

### Step 1 — Clone project dari GitHub

```bash
git clone https://github.com/USERNAME/kasir-ci4.git
cd kasir-ci4
```

### Step 2 — Install dependencies dengan Composer

```bash
composer install
```

### Step 3 — Buat file konfigurasi `.env`

Copy file `env` menjadi `.env`:

```bash
cp env .env
```

Lalu buka file `.env` dan ubah bagian berikut sesuai dengan setting database kamu:

```env
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost:8080/'
app.forceGlobalSecureRequests = false

database.default.hostname = localhost
database.default.database = kasir
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

> **Catatan:** Sesuaikan `username` dan `password` database dengan konfigurasi MySQL kamu.

### Step 4 — Buat database

Buka phpMyAdmin atau terminal MySQL, lalu buat database baru:

```sql
CREATE DATABASE kasir;
```

### Step 5 — Jalankan migration (membuat tabel)

```bash
php spark migrate
```

### Step 6 — Jalankan seeder (mengisi data awal)

```bash
php spark db:seed KasirSeeder
```

### Step 7 — Jalankan aplikasi

```bash
php spark serve
```

### Step 8 — Buka di browser

```
http://localhost:8080
```

## Akun Login

| Username | Password   | Role  |
|----------|------------|-------|
| admin    | 2511050055 | Admin |
| kasir    | kasir123   | Kasir |

## Tech Stack

- **Backend:** CodeIgniter 4.7, PHP 8.3
- **Frontend:** AdminLTE 3, Bootstrap 4, jQuery
- **Plugin:** DataTables, Select2, SweetAlert2, Chart.js, jQuery Validation

## Lisensi

MIT
