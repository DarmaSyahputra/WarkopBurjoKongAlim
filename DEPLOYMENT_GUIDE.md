# 🚀 Panduan Lengkap Deploy Laravel ke Vercel & Supabase

Dokumen ini menjelaskan langkah-langkah untuk mendeploy aplikasi Laravel Anda ke **Vercel** (sebagai host aplikasi) dan **Supabase** (sebagai database PostgreSQL).

---

## 💾 BAGIAN 1: Konfigurasi Database Supabase

Karena Vercel adalah platform serverless, Anda memerlukan database cloud. Supabase menyediakan database PostgreSQL gratis yang sangat cocok untuk ini.

### 1. Buat Project Baru di Supabase
1. Daftar atau masuk ke [Supabase](https://supabase.com).
2. Klik **New Project** dan pilih organisasi Anda.
3. Isi detail proyek:
   - **Name**: Nama proyek Anda (misal: `warkop-burjo`).
   - **Database Password**: Buat password yang kuat dan **catat password ini**.
   - **Region**: Pilih region terdekat (misal: `Singapore (ap-southeast-1)`).
4. Klik **Create new project** dan tunggu beberapa menit sampai database selesai disiapkan.

### 2. Dapatkan Kredensial Database
1. Setelah proyek aktif, buka menu **Settings** (ikon gerigi) -> **Database**.
2. Gulir ke bawah ke bagian **Connection parameters**.
3. Catat informasi berikut:
   - **Host** (biasanya formatnya `aws-0-...pooler.supabase.com` - *Disarankan menggunakan Transaction Pooler port 5432 atau Session Pooler*)
   - **Database name** (biasanya `postgres`)
   - **Port** (biasanya `5432` atau `6543`)
   - **User** (biasanya `postgres.your-project-id`)
   - **Password** (password yang Anda buat di langkah pertama)

---

## 🖥️ BAGIAN 2: Migrasi Database ke Supabase

Karena Vercel tidak menyediakan akses terminal SSH untuk menjalankan perintah artisan seperti `php artisan migrate` secara langsung, cara termudah dan teraman untuk melakukan migrasi adalah **menjalankannya dari komputer lokal Anda yang diarahkan ke Supabase**.

### Langkah-langkah Migrasi dari Lokal:
1. Buka file `.env` di komputer lokal Anda.
2. Backup konfigurasi database lokal Anda saat ini.
3. Ubah konfigurasi database di `.env` menjadi kredensial Supabase Anda:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=aws-0-ap-southeast-1.pooler.supabase.com # Masukkan host Supabase Anda
   DB_PORT=5432
   DB_DATABASE=postgres
   DB_USERNAME=postgres.[project-id] # Masukkan username Supabase Anda
   DB_PASSWORD=PasswordSupabaseAnda
   ```
4. Jalankan perintah migrasi dan seeder di terminal komputer lokal Anda:
   ```bash
   php artisan migrate:fresh --seed
   ```
5. **Penting:** Setelah proses migrasi selesai dan data berhasil masuk ke Supabase, **kembalikan/ubah kembali file `.env` lokal Anda** ke database MySQL lokal agar Anda bisa melanjutkan development lokal dengan normal.

---

## ☁️ BAGIAN 3: Deployment ke Vercel

### 1. Buat Repositori Git (jika belum)
Pastikan proyek Anda sudah di-commit ke Git (GitHub, GitLab, atau Bitbucket).
```bash
git init
git add .
git commit -m "Siap deploy ke vercel"
```
*Pastikan file `vercel.json` dan folder `api/` yang telah dibuat ikut ter-commit.*

### 2. Hubungkan Proyek ke Vercel
1. Masuk ke dashboard [Vercel](https://vercel.com).
2. Klik **Add New...** -> **Project**.
3. Hubungkan akun GitHub Anda dan pilih repositori proyek ini.
4. Pada halaman konfigurasi **Configure Project**:
   - **Framework Preset**: Biarkan **Other** (karena kita menggunakan konfigurasi `vercel.json` kustom).
   - **Root Directory**: `./` (default).

### 3. Masukkan Environment Variables (Sangat Penting!)
Buka tab **Environment Variables** di Vercel dan tambahkan variabel-variabel berikut dari file `.env` Anda:

| Key | Value | Keterangan |
| :--- | :--- | :--- |
| `APP_NAME` | `Warkop Burjo Kong Alim` | Nama aplikasi |
| `APP_ENV` | `production` | Set ke production |
| `APP_KEY` | `base64:RoQgEAee9j42nbNyyEhnW71MdUMAnHdXrz/8Yz4LUuE=` | Ambil dari `.env` lokal Anda |
| `APP_DEBUG` | `false` | Nonaktifkan debug untuk keamanan |
| `APP_URL` | `https://nama-project-anda.vercel.app` | URL vercel Anda nanti |
| `DB_CONNECTION` | `pgsql` | Gunakan driver PostgreSQL |
| `DB_HOST` | *Host Supabase Anda* | Contoh: `aws-0-...pooler.supabase.com` |
| `DB_PORT` | `5432` | Port pgsql |
| `DB_DATABASE` | `postgres` | Nama database Supabase |
| `DB_USERNAME` | *Username Supabase Anda* | Format: `postgres.project-id` |
| `DB_PASSWORD` | *Password Supabase Anda* | Password database Supabase |
| `SESSION_DRIVER` | `cookie` | Sangat disarankan untuk Serverless Vercel |
| `CACHE_STORE` | `database` / `file` | Jika menggunakan database, pastikan tabel cache sudah dibuat |

5. Klik tombol **Deploy** dan tunggu proses build selesai.

---

## ⚠️ Tantangan Serverless (Penting Diketahui)

Vercel menggunakan sistem serverless yang memiliki **Read-Only File System** (sistem file hanya bisa dibaca, kecuali folder `/tmp` yang bersifat sementara).

### Masalah Gambar Menu Warkop:
* Jika Anda mengunggah gambar menu melalui panel admin di Vercel, gambar tersebut akan disimpan secara lokal di serverless. Namun, karena sifat serverless yang dinamis, **gambar tersebut akan hilang dalam hitungan menit/jam** setelah server instansi mati atau di-restart oleh Vercel.
* **Solusi Terbaik**: Gunakan layanan penyimpanan cloud eksternal seperti **Supabase Storage** (gratis), **Cloudinary**, atau **AWS S3** untuk menyimpan aset gambar menu secara permanen. Anda dapat menggunakan library pihak ketiga seperti `league/flysystem` untuk menghubungkan Laravel langsung ke penyimpanan cloud tersebut.

---

Selamat mencoba! Jika Anda mengalami error atau kendala selama proses deployment, silakan tanyakan kembali di sini.
