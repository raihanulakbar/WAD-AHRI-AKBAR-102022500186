<?php
require 'koneksi.php';
require 'fungsi.php';

// READ: ambil semua data meja
$hasil = mysqli_query($conn, "SELECT * FROM meja ORDER BY lantai, nama_meja");

$pesan = [
    'tambah' => 'Data meja berhasil ditambahkan.',
    'edit'   => 'Data meja berhasil diperbarui.',
    'hapus'  => 'Data meja berhasil dihapus.',
];
$notif = $pesan[$_GET['pesan'] ?? ''] ?? null;

if(isset($_POST['klik'])){
    $tampung = $_POST['cari'];

    $hasil = mysqli_query($conn, "SELECT * FROM meja WHERE nama_meja LIKE '%$tampung%' ");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Area</title>
    <link rel="stylesheet" href="style.css">

    
</head>

<body>

    <h1 class="kotak"><center>Perpustakaan</center></h1>

    <div class="menu kotak">
        <a href="fasilitas.html">Fasilitas</a>
        <a href="area.php">Area</a>
    </div>

    <h2>Area Perpustakaan</h2>

    <?php if ($notif): ?>
        <div class="alert alert-ok"><?= h($notif) ?></div>
    <?php endif; ?>

    <a href="tambah.php" class="btn">+ Tambah Meja</a>
    <br><br>

    <form action="" method="post">

    <input type="text" name="cari">
    <button type"submit" name="klik">Cari</button>


    </form>
    <div class="area">
        <?php if (mysqli_num_rows($hasil) === 0): ?>
            <p>Belum ada data meja.</p>
        <?php endif; ?>

        <?php while ($row = mysqli_fetch_assoc($hasil)): ?>
            <div class="kotak card">
                <?php if ($row['gambar']): ?>
                    <img src="gambar/<?= rawurlencode($row['gambar']) ?>" class="kotak" alt="<?= h($row['nama_meja']) ?>">
                <?php else: ?>
                    <div class="noimg kotak">Tanpa gambar</div>
                <?php endif; ?>

                <h3><?= h($row['nama_meja']) ?></h3>
                <p>Lantai <?= h($row['lantai']) ?></p>
                <p>WiFi : <?= h($row['wifi']) ?></p>
                <p>Stopkontak : <?= h($row['stopkontak']) ?></p>
                <p class="<?= $row['status'] === 'Tersedia' ? 'tersedia' : 'tidak' ?>"><?= h($row['status']) ?></p>

                <div class="aksi">
                    <a href="edit.php?id=<?= (int)$row['id'] ?>" class="btn btn-kecil">Edit</a>

                    <!-- DELETE lewat POST + konfirmasi -->
                    <form method="post" action="hapus.php" onsubmit="return confirm('Hapus <?= h($row['nama_meja']) ?>?');">
                        <input type="hidden" name="id" value="<?= (int)$row['id'] ?>">
                        <button type="submit" class="btn-hapus">Hapus</button>
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <br>

    <a href="fasilitas.html" class="kotak">
        <button>Kembali ke Fasilitas</button>
    </a>

</body>
</html>
