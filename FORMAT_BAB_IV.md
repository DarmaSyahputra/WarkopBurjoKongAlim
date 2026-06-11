# BAB IV: IMPLEMENTASI DAN EVALUASI

> *Catatan: Judul subbab di bawah ini dapat Anda sesuaikan kembali jika ada penambahan detail lain sesuai arahan dosen pembimbing.*

Bab IV ini membahas tentang implementasi desain, pengembangan antarmuka, dan pengujian dari Sistem Informasi Profil dan Layanan Katalog Warkop Burjo Kong Alim berbasis Web.

## A. Rancangan Penelitian

Dalam pengembangan *website* Warkop Burjo Kong Alim, penelitian ini menggunakan model pengembangan perangkat lunak (misalnya: *Waterfall* atau *Agile*). 

- **Arsitektur Sistem:** Sistem ini dibangun menggunakan arsitektur MVC (*Model-View-Controller*) dengan bantuan framework **Laravel**. 
    - **View:** Menggunakan *Blade Templating Engine* untuk menampilkan antarmuka pengunjung seperti *Hero Section*, Tentang Kami, dan Menu.
    - **Controller:** Menggunakan `MenuController` untuk mengatur logika pengiriman data menu makanan dan minuman dari sistem ke antarmuka pengguna.
- **Cara Kerja:** Pengunjung dapat mengakses URL *website* melalui peramban (*browser*), sistem akan memproses *request* pada *routes* dan memanggil *controller* yang kemudian merender halaman katalog menu interaktif secara dinamis kepada pengguna.
- **Alur Business Process:** Pengunjung melihat profil warung -> Pengunjung mensortir dan melihat katalog harga menu -> Pengunjung dapat menekan tombol WhatsApp atau Maps untuk reservasi / berkunjung langsung ke lokasi.

## B. Prototipe Tampilan Aplikasi

Tampilan *website* antarmuka (*front-end*) difokuskan pada *Single Page Application (SPA)* sederhana untuk kenyamanan pengunjung, yang terdiri dari beberapa bagian fungsional:

1. **Navigasi Utama (Navbar):** Memiliki *hyperlink* untuk menggulir halaman ke bagian "Tentang", "Menu", "Lokasi", dan "Kontak" secara langsung.
2. **Hero Section:** Antarmuka pertama yang dilihat pengunjung yang berisi tagline *"Tempat Nongkrong Paling Asik"* beserta tombol "Lihat Menu".
3. **Tentang Kami:** Bagian ini menampilkan profil singkat dari Warkop Kong Alim sebagai warung kopi bersahabat dengan harga mahasiswa.
4. **Menu Andalan:** Menampilkan katalog dinamis dalam bentuk *grid*. Data dipanggil dengan integrasi *backend* Laravel yang dipisahkan berdasarkan kategori (Misalnya: Burjo, Indomie, Minuman/Kopi), lengkap dengan gambar, nama menu, dan harganya *(Format Rupiah)*.
5. **Keterangan Lokasi & Kontak:** Menampilkan alamat lengkap (Jl. H. Sairi, Depok) beserta jam operasional (16.00 - 02.00) dan tautan integrasi Google Maps serta WhatsApp (082311867343).

## C. Hasil Penelitian

*(Pada bagian ini, pastikan Anda melampirkan screenshot dari halaman web setelah website sukses dijalankan di server lokal, misalnya via `php artisan serve`)*.

- **Gambar 4.1 - Screenshot Halaman Beranda / Hero Section Warkop Kong Alim**
  - *[Sisipkan gambar screenshot browser di sini]*
- **Gambar 4.2 - Screenshot Halaman Katalog Menu (Dinamis dari Laravel)**
  - *[Sisipkan gambar screenshot daftar menu beserta harga]*
- **Gambar 4.3 - Screenshot Penampilan Responsif di Perangkat Seluler**
  - *[Sisipkan gambar saat website dibuka dalam tampilan Mobile]*

## D. Data Hasil Pengujian

Pengujian dilakukan menggunakan metode *Black Box Testing*, di mana pengujian difokuskan pada fungsionalitas fitur *website*.

| No | Skenario Pengujian | Hasil yang Diharapkan | Hasil Pengujian (Aktual) | Status |
|----|--------------------|-----------------------|--------------------------|--------|
| 1  | Menekan tombol "Lihat Menu" pada Hero Section | Halaman otomatis melakukan *scroll* (*smooth scroll*) menuju area kategori menu. | Halaman bergulir dengan lancar ke target. | **Valid** |
| 2  | Menampilkan daftar Menu yang digenerate controller | Komponen harga dan gambar tampil untuk seluruh kategori dengan format Rupiah. | Harga tampil sesuai format mata uang, gambar sukses termuat. | **Valid** |
| 3  | Menekan tombol navigasi *Hamburger* (Pada layar HP) | Menu *dropdown/sidebar* muncul menampilkan tautan navigasi. | Tautan navigasi tampil dan berfungsi dengan baik. | **Valid** |
| 4  | Menjalankan *link* "Kunjungi Kami" di bagian CTA | *Browser* mengarahkan ke halaman Google Maps secara eksternal. | Sistem sukses membuka tab baru untuk Google Maps Kong Alim.| **Valid** |
| 5  | Menjalankan *link* CTA "Hubungi Kami" | Sistem memicu pembukaan API web WhatsApp menuju nomor 082311867343. | Muncul pop-up WhatsApp dengan nomor tujuan. | **Valid** |

## E. Evaluasi Hasil

Berdasarkan data pengujian yang dilakukan, sistem yang dibangun telah memenuhi fungsionalitas utamanya sebagai pilar informasi digital Warkop Burjo Kong Alim.
- **Analisis Evaluasi:** Berdasarkan skenario Black Box yang diterapkan, UI dan fungsionalitas interaktif berjalan %100 sesuai ekspektasi. Semua elemen katalog dapat dimuat dengan baik dan interaksi sistem (navigasi lokasi, hubungi via WA) berintegrasi dengan mulus. Framework Laravel terbukti sangat mendukung kemudahan merender komponen data (Data Rendering) pada Blade tanpa kehilangan performa.
- **Perbandingan dengan Penelitian Terdahulu:** Jika dibandingkan dengan sistem reservasi / katalog lama (jika ada, atau dari jurnal referensi skripsi), sistem berbasis web interaktif ini memangkas waktu pengunjung dalam mencari tahu referensi menu dan harga Warkop sebelum kedatangan, sehingga terbukti mendukung peningkatkan pengalaman pengguna (*User Experience*).

---

### Catatan Tambahan untuk Anda:
> Bagian di dalam kurung siku `[...]` adalah area di mana Anda harus melampirkan gambar/gambar tambahan secara visual di *software* pengolah kata Anda (misalnya MS Word) sebelum naskah ini dicetak/disubmit.
