# Toko Online

Aplikasi Web Toko Online berbasis Laravel.

---

## 📋 Prasyarat Sistem

Sebelum menjalankan proyek ini, pastikan sistem Anda memenuhi persyaratan berikut:
- **PHP**: `>= 8.1`
- **Composer**: Terinstal
- **Node.js & NPM**: Terinstal
- **Database**: MySQL / MariaDB (misal via XAMPP atau Laragon)

---

## 🚀 Panduan Instalasi & Cara Menjalankan Proyek

Ikuti langkah-langkah di bawah ini untuk menyiapkan dan menjalankan proyek dari awal:

### 1. Install Dependensi PHP (Composer)
```bash
composer install
```

### 2. Install Dependensi Frontend (NPM)
```bash
npm install
```

### 3. Konfigurasi Environment (`.env`)
Salin berkas contoh environment dan buat kunci aplikasi (Application Key):
```bash
cp .env.example .env
php artisan key:generate
```
> *Catatan (Windows PowerShell):* Jika perintah `cp` tidak didukung, gunakan `Copy-Item .env.example .env`.

### 4. Konfigurasi Database
Buka file `.env` dan atur informasi koneksi database Anda (sesuai nama database MySQL di lokal Anda):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tokoonline
DB_USERNAME=root
DB_PASSWORD=
```
> *Pastikan Anda sudah membuat database kosong (misalnya bernama `tokoonline`) di MySQL/phpMyAdmin/Laragon.*

---

## 🗄️ Migrasi Database & Seeder

Jalankan perintah berikut untuk membuat struktur tabel dan mengisi data awal (seperti akun default & kategori):

```bash
php artisan migrate --seed
```

> **Catatan:** Jika ingin mengosongkan ulang database dan menjalankan migrasi ulang dari awal beserta seeder-nya:
> ```bash
> php artisan migrate:fresh --seed
> ```

---

## 🎨 Compile Asset Frontend (Vite)

Untuk membuat asset CSS/JS siap digunakan di mode produksi:
```bash
npm run build
```

Atau jika sedang dalam tahap pengembangan (Development Mode) dengan Live Reload:
```bash
npm run dev
```

---

## 🌐 Menjalankan Server Lokal

Jalankan server pengembang Laravel:
```bash
php artisan serve
```

Aplikasi dapat diakses melalui browser:
* **Halaman Login Backend:** [http://127.0.0.1:8000/backend/login](http://127.0.0.1:8000/backend/login)

---

## 🔑 Akun Login Default (Seeder)

Setelah menjalankan `php artisan migrate --seed`, akun berikut siap digunakan untuk login:

| Role | Email | Password |
| --- | --- | --- |
| **Administrator** | `admin@gmail.com` | `password` |
| **User** | `irsyadmuhammad4321@gmail.com` | `password` |
