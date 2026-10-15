# Tugas Besar PAW - CRUD Data Meja Perpustakaan

CRUD (Create, Read, Update, Delete) data meja pada website Perpustakaan, memakai PHP + MySQL (phpMyAdmin).

## Cara menjalankan (Laragon / XAMPP)
1. Taruh folder project di `C:\laragon\www\` (Laragon) atau `C:\xampp\htdocs\` (XAMPP).
2. Nyalakan Apache + MySQL.
3. Buka phpMyAdmin -> tab **Import** -> pilih `tes/database.sql` -> **Import**
   (otomatis membuat database `db_perpustakaan` + tabel `meja` + 4 data awal).
4. Buka `http://localhost/tugas_besar_paw/tes/area.php`

## Struktur file (folder `tes/`)
| File | Fungsi |
|---|---|
| `koneksi.php` | Koneksi ke MySQL |
| `area.php` | **Read** - tampil semua meja + tombol Edit/Hapus |
| `tambah.php` | **Create** - form tambah meja |
| `edit.php` | **Update** - form ubah meja |
| `hapus.php` | **Delete** - hapus meja |
| `fungsi.php`, `_form.php` | Fungsi bantu (validasi, upload) dan form bersama |
| `database.sql` | Struktur + data awal database |
