# ☁️ Panduan Integrasi Cloudinary di Laravel (untuk Deployment Vercel)

Panduan ini menjelaskan cara mengonfigurasi **Cloudinary** untuk menyimpan file unggahan (gambar menu) secara permanen saat aplikasi Anda dideploy di Vercel.

---

## 🔑 Langkah 1: Registrasi & Dapatkan API Key Cloudinary
1. Daftar atau masuk ke akun Anda di [Cloudinary](https://cloudinary.com).
2. Di Dashboard Cloudinary Anda, cari bagian **Product Environment Credentials**.
3. Salin nilai **`CLOUDINARY_URL`** (berformat `cloudinary://<API_KEY>:<API_SECRET>@<CLOUD_NAME>`).
   * *Pastikan Anda menyalin seluruh baris tautan tersebut.*

---

## 📥 Langkah 2: Instalasi Package Cloudinary di Laravel
Jalankan perintah berikut di terminal proyek lokal Anda untuk menginstal package driver Cloudinary:
```bash
composer require cloudinary-labs/cloudinary-laravel
```

---

## ⚙️ Langkah 3: Konfigurasi Environment (.env & Vercel)

### 1. Konfigurasi Lokal (`.env`)
Buka file `.env` di komputer Anda, lalu tambahkan baris berikut di bagian paling bawah:
```env
CLOUDINARY_URL=cloudinary://API_KEY:API_SECRET@CLOUD_NAME
```
*(Ganti nilai di atas dengan `CLOUDINARY_URL` asli yang Anda salin dari dashboard Cloudinary).*

### 2. Konfigurasi di Vercel
1. Buka dashboard proyek Anda di **Vercel**.
2. Masuk ke menu **Settings** -> **Environment Variables**.
3. Tambahkan variabel baru:
   * **Key**: `CLOUDINARY_URL`
   * **Value**: *Tautan `CLOUDINARY_URL` Anda.*
4. Simpan perubahan tersebut.

### 3. Daftarkan Disk Cloudinary di `config/filesystems.php`
Buka file [config/filesystems.php](file:///c:/xampp/htdocs/ProjectSkripsi/config/filesystems.php) dan tambahkan konfigurasi disk `cloudinary` di dalam array `'disks'`:
```php
'cloudinary' => [
    'driver' => 'cloudinary',
    'url' => env('CLOUDINARY_URL'),
],
```

---

## 💻 Langkah 4: Penyesuaian Kode Proyek

Agar aplikasi Anda bisa menyimpan gambar ke Cloudinary di internet sekaligus tetap bisa membaca gambar lokal bawaan (dari seeder), ikuti penyesuaian kode berikut:

### 1. Update Model `Menu.php`
Buka file [app/Models/Menu.php](file:///c:/xampp/htdocs/ProjectSkripsi/app/Models/Menu.php) dan ubah fungsi `getImageUrlAttribute` agar mendeteksi apakah gambar berupa URL Cloudinary (dimulai dengan `http`/`https`) atau file lokal:

```php
public function getImageUrlAttribute()
{
    if ($this->image) {
        // Jika kolom image berisi URL lengkap (Cloudinary)
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }
        // Jika file lokal biasa (seeder)
        return asset('images/menus/' . $this->image);
    }
    return asset('images/default-menu.jpg');
}
```

### 2. Update Controller `MenuController.php`
Buka file [app/Http/Controllers/Admin/MenuController.php](file:///c:/xampp/htdocs/ProjectSkripsi/app/Http/Controllers/Admin/MenuController.php) dan sesuaikan method **`store`** serta **`update`** untuk mengunggah gambar ke Cloudinary:

#### Di bagian atas file Controller, impor Facade Cloudinary:
```php
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
```

#### Ubah method `store()` pada bagian penanganan gambar:
```php
if ($request->hasFile('image')) {
    // Unggah langsung ke Cloudinary dan simpan URL aman-nya
    $result = Cloudinary::uploadApi()->upload($request->file('image')->getRealPath(), [
        'folder' => 'warkop-menus',
    ]);
    $data['image'] = $result['secure_url'];
}
```

#### Ubah method `update()` pada bagian penanganan gambar:
```php
if ($request->hasFile('image')) {
    // (Opsional) Jika ingin menghapus gambar lama di Cloudinary:
    if ($menu->image && filter_var($menu->image, FILTER_VALIDATE_URL)) {
        // Logika hapus dari Cloudinary menggunakan public_id jika diperlukan
    } else if ($menu->image && file_exists(public_path('images/menus/' . $menu->image))) {
        // Hapus file lokal lama jika ada
        unlink(public_path('images/menus/' . $menu->image));
    }

    // Unggah gambar baru ke Cloudinary
    $result = Cloudinary::uploadApi()->upload($request->file('image')->getRealPath(), [
        'folder' => 'warkop-menus',
    ]);
    $data['image'] = $result['secure_url'];
}
```

#### Ubah method `destroy()` untuk menghapus data menu:
```php
public function destroy(Menu $menu)
{
    if ($menu->image && !filter_var($menu->image, FILTER_VALIDATE_URL)) {
        // Hapus file lokal jika bukan Cloudinary
        if (file_exists(public_path('images/menus/' . $menu->image))) {
            unlink(public_path('images/menus/' . $menu->image));
        }
    }
    
    $menu->delete();
    return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
}
```

---

## 🚀 Langkah 5: Push Perubahan ke GitHub
Setelah semua kode disesuaikan dan diuji secara lokal, lakukan commit dan push perubahan Anda ke GitHub:
```bash
git add .
git commit -m "feat: integrate Cloudinary for menu image uploads"
git push origin master
```

Vercel akan otomatis melakukan redeploy dan sistem upload gambar menu Anda akan berfungsi 100% permanen!
