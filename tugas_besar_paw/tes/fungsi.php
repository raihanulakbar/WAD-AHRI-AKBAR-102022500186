<?php

function h($teks) {
    return htmlspecialchars((string)$teks, ENT_QUOTES, 'UTF-8');
}


function upload_gambar($file, &$error) {
    if (!is_array($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        return null;
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $error = "Upload gambar gagal.";
        return false;
    }
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
        $error = "Format gambar harus JPG, PNG, atau WEBP.";
        return false;
    }
    if ($file['size'] > 2 * 1024 * 1024) {
        $error = "Ukuran gambar maksimal 2 MB.";
        return false;
    }
    if (@getimagesize($file['tmp_name']) === false) {
        $error = "File yang diunggah bukan gambar.";
        return false;
    }
    $nama = uniqid('meja_') . '.' . $ext;
    if (!move_uploaded_file($file['tmp_name'], __DIR__ . '/gambar/' . $nama)) {
        $error = "Gagal menyimpan gambar.";
        return false;
    }
    return $nama;
}

// Hapus file gambar hasil upload (gambar bawaan tidak ikut dihapus)
function hapus_gambar($nama) {
    if ($nama && strpos($nama, 'meja_') === 0) {
        $path = __DIR__ . '/gambar/' . $nama;
        if (is_file($path)) {
            unlink($path);
        }
    }
}

// Validasi input form meja. Return array pesan error (kosong = valid)
function validasi_meja($d) {
    $err = [];
    if (trim($d['nama_meja']) === '') $err[] = "Nama meja wajib diisi.";
    if (strlen($d['nama_meja']) > 50) $err[] = "Nama meja maksimal 50 karakter.";
    if (!in_array($d['lantai'], ['1', '2', '3', '4', '5'], true)) $err[] = "Lantai tidak valid.";
    if (!in_array($d['wifi'], ['Ya', 'Tidak'], true)) $err[] = "Pilihan WiFi tidak valid.";
    if (!in_array($d['stopkontak'], ['Ya', 'Tidak'], true)) $err[] = "Pilihan stopkontak tidak valid.";
    if (!in_array($d['status'], ['Tersedia', 'Digunakan'], true)) $err[] = "Status tidak valid.";
    return $err;
}
