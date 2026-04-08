<h3>Form Pinjam Alat</h3>

<p>Nama Alat: <?= $alat['nama_alat']; ?></p>

<form action="<?= base_url('pinjam/simpan') ?>" method="post">
    <?= csrf_field(); ?>

    <input type="hidden" name="id_alat" value="<?= $alat['id_alat']; ?>">

    <div>
        <label>Nama Peminjam</label><br>
        <input type="text" name="nama" required>
    </div>

    <div>
        <label>Jumlah Pinjam</label><br>
        <input type="number" name="jumlah" required>
    </div>

    <br>
    <button type="submit">Pinjam</button>
</form>