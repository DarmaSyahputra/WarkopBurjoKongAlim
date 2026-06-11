# Sistem Informasi Profil dan Katalog Warkop Burjo Kong Alim

Aplikasi ini adalah Sistem Informasi Profil dan Layanan Katalog berbasis Web untuk **Warkop Burjo Kong Alim** yang dibangun menggunakan framework **Laravel** dan **Tailwind CSS**. Sistem ini memfasilitasi pengunjung untuk melihat informasi warkop, daftar menu secara dinamis, lokasi, serta mengirim pesan, sekaligus menyediakan panel admin bagi pengelola warkop untuk mengelola data kategori, menu, pesan masuk, dan pengaturan informasi warkop.

---

## 🚀 Persyaratan Sistem
Sebelum menjalankan aplikasi, pastikan perangkat Anda telah terpasang:
- PHP >= 8.2 (Direkomendasikan menggunakan PHP dari XAMPP)
- Composer
- MySQL Server (Bisa dijalankan melalui XAMPP Control Panel)
- Node.js & npm (Untuk kompilasi aset frontend)

---

## 🛠️ Langkah Instalasi & Menjalankan Aplikasi

Jika Anda baru pertama kali mengunduh proyek ini atau ingin menjalankannya kembali:

1. **Aktifkan MySQL Database:**
   Buka **XAMPP Control Panel** dan klik **Start** pada modul **MySQL** (dan **Apache** jika diperlukan).

2. **Instal Dependensi PHP (Composer):**
   ```bash
   composer install
   ```

3. **Instal Dependensi Frontend (npm):**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment (.env):**
   Pastikan file `.env` sudah dikonfigurasi dengan database yang sesuai. Berikut adalah konfigurasi default:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=warkop_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Buat Database & Jalankan Migrasi + Seeder:**
   Jalankan perintah berikut untuk membuat tabel database dan mengisi data awal (kategori, menu default, pengaturan warkop, dan akun admin):
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Kompilasi Aset Frontend (Vite):**
   Untuk lingkungan produksi:
   ```bash
   npm run build
   ```
   Atau untuk lingkungan pengembangan secara real-time:
   ```bash
   npm run dev
   ```

7. **Jalankan Laravel Development Server:**
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses di browser melalui URL: [http://localhost:8000](http://localhost:8000)

---

## 🔑 Akun Administrator Default
Untuk mengelola warkop, Anda dapat masuk ke panel admin dengan akun berikut:
- **Email:** `adminwarkop@gmail.com`
- **Password:** `burjokongalim`

---

## 📖 Panduan Penggunaan: Dari Login hingga Menambahkan Produk (Menu)

Berikut adalah panduan alur kerja untuk masuk sebagai admin dan menambahkan menu baru ke dalam katalog warkop secara dinamis:

### 1. Proses Login Admin
1. Buka browser dan akses halaman login melalui URL: [http://localhost:8000/login](http://localhost:8000/login)
2. Masukkan kredensial admin:
   - **Email:** `adminwarkop@gmail.com`
   - **Password:** `burjokongalim`
3. Klik tombol **Log in**.
4. Anda akan otomatis dialihkan ke halaman **Dashboard Admin** (`http://localhost:8000/admin/dashboard`).

### 2. Memahami Dashboard Admin
Halaman dashboard admin menampilkan ringkasan data penting warkop secara real-time:
- **Total Menu:** Jumlah menu yang saat ini terdaftar.
- **Kategori:** Jumlah kategori menu (seperti Kopi, Non Kopi, Burjo, dll.).
- **Total Pesan & Pesan Baru:** Jumlah kontak/masukan yang dikirim oleh pengunjung melalui formulir kontak di landing page.
- **Pesan Terbaru:** Daftar 5 pesan terbaru dari pelanggan.

### 3. Mengelola Kategori (Opsional)
Sebelum menambahkan menu, pastikan kategori menu tersebut sudah ada. Anda dapat mengelolanya di menu **Kategori Menu** (`/admin/categories`):
- Klik **Kategori Menu** di sidebar.
- Anda dapat menambah kategori baru (misalnya: *Cemilan*), mengedit kategori yang sudah ada, atau menghapusnya.

### 4. Menambahkan Produk / Menu Baru
Untuk menambahkan menu makanan atau minuman baru ke dalam katalog warkop:
1. Klik menu **Menu Warkop** di sidebar sebelah kiri atau akses URL: [http://localhost:8000/admin/menus](http://localhost:8000/admin/menus).
2. Klik tombol **Tambah Menu** di sudut kanan atas.
3. Isi formulir penambahan menu dengan data berikut:
   - **Kategori:** Pilih kategori menu yang sesuai (misalnya: *Burjo*, *Kopi*, *Indomie*).
   - **Nama Menu:** Masukkan nama menu (misalnya: *Indomie Keju Pedas*).
   - **Deskripsi:** Berikan penjelasan singkat tentang hidangan/minuman tersebut (misalnya: *Indomie goreng dengan parutan keju cheddar melimpah dan irisan cabai rawit*).
   - **Harga (Rp):** Masukkan nominal harga dalam angka saja tanpa titik/koma (misalnya: `12000`).
   - **Gambar:** Unggah foto menu dalam format JPEG, PNG, atau JPG (maksimal 2MB).
   - **Status Ketersediaan:** Centang pilihan **Tersedia** agar menu langsung aktif dan muncul di katalog halaman utama.
4. Klik tombol **Simpan Menu**.
5. Sistem akan menyimpan data ke database dan mengunggah gambar ke direktori `public/storage/menus`. Anda akan dialihkan kembali ke daftar menu dengan pesan sukses *"Menu berhasil ditambahkan."*

### 5. Memverifikasi Hasil di Halaman Utama (Landing Page)
1. Klik tautan **Lihat Website** di bagian header kanan panel admin, atau buka tab baru dan akses [http://localhost:8000](http://localhost:8000).
2. Scroll ke bagian **Menu Andalan**.
3. Cari kategori yang Anda pilih tadi (misalnya: *Indomie*).
4. Pastikan menu yang baru Anda tambahkan sudah tampil secara dinamis lengkap dengan gambar, nama, deskripsi, dan format harga Rupiah (`Rp 12.000`).
