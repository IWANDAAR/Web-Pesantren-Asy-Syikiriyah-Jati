# PANDUAN INSTALASI & PENGGUNAAN APLIKASI
## Sistem Informasi Kepegawaian (SIMPEG) Pondok Pesantren Asy-Syakiriyah Jati

Aplikasi SIMPEG berbasis Laravel 10 dan MySQL ini siap digunakan dan dipresentasikan untuk Tugas Akhir/Sidang Skripsi.

---

### Prasyarat System (Prerequisites)
1. **PHP >= 8.2** (sudah aktif di XAMPP Anda)
2. **Composer** (sudah terpasang di sistem)
3. **Node.js & NPM** (sudah terpasang di sistem)
4. **MySQL / MariaDB** (sudah terpasang di XAMPP Anda)

---

### Langkah Menjalankan Aplikasi

1. **Aktifkan Apache dan MySQL di XAMPP Control Panel**:
   Atau jika ingin mengaktifkan MySQL langsung dari terminal, jalankan perintah:
   ```powershell
   C:\xampp\mysql_start.bat
   ```

2. **Periksa Konfigurasi Database**:
   - Database: `db_kepegawaian` (telah dibuat secara otomatis)
   - Konfigurasi database tersimpan di file [.env](.env).
   - Dump database SQL terbaru telah berhasil diekspor di [db_kepegawaian.sql](db_kepegawaian.sql) sebagai cadangan.

3. **Jalankan Laravel Development Server**:
   Buka Command Prompt atau PowerShell di dalam folder proyek ini (`C:\xampp\htdocs\AI PESANTREN ASY-SYIKIRIYAH JATI`), lalu jalankan:
   ```bash
   php artisan serve
   ```
   Aplikasi Anda sekarang dapat diakses secara lokal di alamat:  
   👉 **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

### Akun Login Pengujian (Default Credentials)

Sistem ini memiliki **2 Role Pengguna** dengan batasan akses yang ketat:

1. **Role ADMIN** (Akses Penuh - CRUD & Settings)
   - **Email**: `admin@syakiriyah.sch.id`
   - **Password**: `password`
   - *Fungsi*: Manajemen Pegawai (CRUD), Manajemen Jabatan (CRUD), Manajemen Riwayat (CRUD), Manajemen User Pengguna (CRUD), Laporan & Ekspor PDF.

2. **Role PIMPINAN** (Akses Lihat - View Only & Print)
   - **Email**: `pimpinan@syakiriyah.sch.id`
   - **Password**: `password`
   - *Fungsi*: Dashboard Statistik, Melihat Data Pegawai & Detail, Melihat Jabatan, Melihat Riwayat Pekerjaan, Melihat Laporan, dan Cetak PDF. (Tombol Tambah/Edit/Hapus dinonaktifkan secara visual dan dilarang lewat Route Middleware).

---

### Daftar Fitur Utama Aplikasi

- **Dashboard**: Panel HRD modern dengan grafik interaktif Chart.js (Pegawai per Jabatan dan Status Pegawai) dan statistik kepegawaian.
- **Data Pegawai**: Kelola data pegawai lengkap (NIP, Nama, Email, No HP, Alamat, Jenis Kelamin, Foto Profil, Status Pegawai, Jabatan).
- **Mutasi Jabatan**: Sistem melacak dan mencatat log mutasi jabatan secara otomatis ketika jabatan pegawai di-edit oleh Admin.
- **Laporan Kepegawaian**: Halaman filter dinamis berdasarkan Status Pegawai dan Jabatan yang terintegrasi dengan ekspor PDF profesional (DomPDF) lengkap dengan Kop Surat resmi Pesantren, tabel landscape, tanggal cetak, dan kolom tanda tangan pimpinan.
- **Manajemen User**: Pengelolaan akun Administrator dan Pimpinan.
- **Keamanan Ketat**: Autentikasi Laravel Breeze, pembatasan middleware role, proteksi CSRF, dan validasi input yang aman.
