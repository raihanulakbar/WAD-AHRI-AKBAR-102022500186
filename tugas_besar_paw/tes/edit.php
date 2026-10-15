<?php
require 'koneksi.php';
require 'fungsi.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = mysqli_prepare($conn, "SELECT * FROM meja WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$data) {
    http_response_code(404);
    exit("Data meja tidak ditemukan. <a href='area.php'>Kembali</a>");
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gambarLama = $data['gambar'];
    foreach (['nama_meja', 'lantai', 'wifi', 'stopkontak', 'status'] as $f) {
        $data[$f] = trim($_POST[$f] ?? '');
    }
    $errors = validasi_meja($data);

    $gambarBaru = null;
    if (!$errors) {
        $err = '';
        $gambarBaru = upload_gambar($_FILES['gambar'] ?? null, $err);
        if ($gambarBaru === false) $errors[] = $err;
    }

    if (!$errors) {
        $gambarFinal = $gambarBaru ?? $gambarLama; // tidak upload baru = pakai gambar lama
        $lantai = (int)$data['lantai'];
        $stmt = mysqli_prepare($conn,
            "UPDATE meja SET nama_meja=?, lantai=?, wifi=?, stopkontak=?, status=?, gambar=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "sissssi", $data['nama_meja'], $lantai, $data['wifi'], $data['stopkontak'], $data['status'], $gambarFinal, $id);
        mysqli_stmt_execute($stmt);

        if ($gambarBaru !== null) hapus_gambar($gambarLama);

        header("Location: area.php?pesan=edit");
        exit;
    }
    $data['gambar'] = $gambarLama;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Meja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="kotak"><center>Perpustakaan</center></h1>
    <div class="menu kotak">
        <a href="fasilitas.html">Fasilitas</a>
        <a href="area.php">Area</a>
    </div>
    <?php
    $judul = "Edit Meja";
    $tombol = "Perbarui";
    include '_form.php';
    ?>
</body>
</html>
