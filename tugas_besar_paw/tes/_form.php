<?php /* Form bersama untuk tambah.php dan edit.php. Butuh: $data, $errors, $judul, $tombol */ ?>
<h2><?= h($judul) ?></h2>

<?php if (!empty($errors)): ?>
    <div class="alert alert-error">
        <?php foreach ($errors as $e): ?>
            <div><?= h($e) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data" class="form kotak">
    <label>Nama Meja</label>
    <input type="text" name="nama_meja" maxlength="50" value="<?= h($data['nama_meja']) ?>" required>

    <label>Lantai</label>
    <select name="lantai">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <option value="<?= $i ?>" <?= (string)$data['lantai'] === (string)$i ? 'selected' : '' ?>>Lantai <?= $i ?></option>
        <?php endfor; ?>
    </select>

    <label>WiFi</label>
    <select name="wifi">
        <?php foreach (['Ya', 'Tidak'] as $o): ?>
            <option value="<?= $o ?>" <?= $data['wifi'] === $o ? 'selected' : '' ?>><?= $o ?></option>
        <?php endforeach; ?>
    </select>

    <label>Stopkontak</label>
    <select name="stopkontak">
        <?php foreach (['Ya', 'Tidak'] as $o): ?>
            <option value="<?= $o ?>" <?= $data['stopkontak'] === $o ? 'selected' : '' ?>><?= $o ?></option>
        <?php endforeach; ?>
    </select>

    <label>Status</label>
    <select name="status">
        <?php foreach (['Tersedia', 'Digunakan'] as $o): ?>
            <option value="<?= $o ?>" <?= $data['status'] === $o ? 'selected' : '' ?>><?= $o ?></option>
        <?php endforeach; ?>
    </select>

    <label>Gambar (JPG/PNG/WEBP, maks 2 MB)</label>
    <?php if (!empty($data['gambar'])): ?>
        <img src="gambar/<?= rawurlencode($data['gambar']) ?>" class="preview kotak" alt="Gambar saat ini">
        <small>Kosongkan jika tidak ingin mengganti gambar.</small>
    <?php endif; ?>
    <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp">

    <div class="aksi-form">
        <button type="submit"><?= h($tombol) ?></button>
        <a href="area.php" class="btn-batal">Batal</a>
    </div>
</form>
