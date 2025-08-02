# 📚 Aplikasi Perpustakaan Sederhana (Laravel 12)

Aplikasi ini adalah proyek **CRUD** (Create, Read, Update, Delete) sederhana untuk mengelola data buku. Dibangun menggunakan **Laravel 12**, **Tailwind CSS** untuk tampilan antarmuka, dan menggunakan **phpMyAdmin** sebagai antarmuka basis data.

## 🔧 Fitur

- Menampilkan daftar buku dengan pagination
- Menambahkan buku baru
- Mengedit data buku
- Menghapus satu buku
- Menghapus seluruh data buku

## 💻 Teknologi yang Digunakan

- **Laravel 12**
- **Tailwind CSS**
- **phpMyAdmin** (MySQL)

## 🧱 Struktur Database

Tabel: `buku`

| Kolom         | Tipe Data      | Keterangan                   |
|---------------|----------------|------------------------------|
| id            | BIGINT         | Primary key (auto-increment) |
| judul         | VARCHAR(255)   | Wajib, minimal 3 karakter    |
| pengarang     | VARCHAR(100)   | Wajib, minimal 3 karakter    |
| tahun_terbit  | INTEGER        | Wajib, 4 digit               |
| timestamps    | TIMESTAMP      | Diatur otomatis Laravel      |

## 🚀 Instalasi dan Menjalankan Aplikasi

1. **Clone Repository**

   ```bash
   git clone https://github.com/MFadhliAlHafizh/crud-laravel.git
   cd cd crud-laravel

2. **Install Dependency Laravel**

   ```bash
   composer install

3. **Salin dan Atur File Environment**

   - Salin file `.env.example` dan ubah namanya menjadi `.env`:
     ```bash
     cp .env.example .env
     ```

   - Buka file `.env`, lalu sesuaikan konfigurasi database Anda:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=crud-laravel
     DB_USERNAME=root
     DB_PASSWORD=
     ```

4. **Akses Database melalui phpMyAdmin**

   - Buka **phpMyAdmin** di browser Anda:
     ```
     http://localhost/phpmyadmin
     ```

   - Buat database baru dengan nama **`crud-laravel`**, sesuai dengan nilai `DB_DATABASE` di file `.env`.

5. **Generate Key Aplikasi**

   Jalankan perintah berikut untuk menghasilkan application key:
   ```bash
   php artisan key:generate

6. **Migrasi Tabel ke Database**

   Jalankan migrasi untuk membuat tabel `buku` di Database:
   ```bash
   php artisan migrate

7. **Jalankan Server**

   Untuk menjalankan server lokal Laravel, gunakan perintah:
   ```bash
   php artisan serve

## 🧭 Routing

| Method   | URL            | Aksi                    | Route Name       |
|----------|----------------|-------------------------|------------------|
| GET      | /              | Menampilkan semua buku  | buku.index       |
| POST     | /              | Menambahkan buku        | buku.store       |
| GET      | /{id}/edit     | Menampilkan form edit   | buku.edit        |
| PUT      | /{id}/update   | Memperbarui data buku   | buku.update      |
| DELETE   | /{id}/delete   | Menghapus satu buku     | buku.delete      |
| DELETE   | /deleteAll     | Menghapus semua buku    | buku.deleteAll   |


## 📁 Struktur Folder Penting

Struktur direktori utama dalam proyek ini:

```
CRUD-LARAVEL/
├── app/
|   ├── Http/
|       └── Controllers/
|           └── BukuController.php
├── Models/
|   └── Buku.php
├── database/
|   └── migrations/
|       └── 2025_07_31_100735_create_buku_table.php
├── resources/
|   └── views/
|       └── index.blade.php
├── routes/
    └── web.php
```