<?php
require 'koneksi.php';
require 'fungsi.php';

$errors = [];
$data = ['nama_meja' => '', 'lantai' => '1', 'wifi' => 'Ya', 'stopkontak' => 'Tidak', 'status' => 'Tersedia', 'gambar' => null];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach (['nama_meja', 'lantai', 'wifi', 'stopkontak', 'status'] as $f) {
        $data[$f] = trim($_POST[$f] ?? '');
    }
    $errors = validasi_meja($data);

    $gambar = null;
    if (!$errors) {
        $err = '';
        $gambar = upload_gambar($_FILES['gambar'] ?? null, $err);
        if ($gambar === false) $errors[] = $err;
    }

    if (!$errors) {
        $stmt = mysqli_prepare($conn,
            "INSERT INTO meja (nama_meja, lantai, wifi, stopkontak, status, gambar) VALUES (?, ?, ?, ?, ?, ?)");
        $lantai = (int)$data['lantai'];
        mysqli_stmt_bind_param($stmt, "sissss", $data['nama_meja'], $lantai, $data['wifi'], $data['stopkontak'], $data['status'], $gambar);
        mysqli_stmt_execute($stmt);
        header("Location: area.php?pesan=tambah");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Meja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="kotak"><center>Perpustakaan</center></h1>
    <div class="menu kotak">
        <a href="fasilitas.html">Fasilitas</a>
        <a href="area.php">Area</a>
    </div>
    <?php
    $judul = "Tambah Meja";
    $tombol = "Simpan";
    include '_form.php';
    ?>
</body>
</html>
