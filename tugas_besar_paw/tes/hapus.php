<?php
require 'koneksi.php';
require 'fungsi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: area.php");
    exit;
}

$id = (int)($_POST['id'] ?? 0);

$stmt = mysqli_prepare($conn, "SELECT gambar FROM meja WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if ($row) {
    $stmt = mysqli_prepare($conn, "DELETE FROM meja WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    hapus_gambar($row['gambar']);
}

header("Location: area.php?pesan=hapus");
exit;
