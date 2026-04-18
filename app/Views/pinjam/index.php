<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="icon" href="<?= base_url('assets/img/Logo.png') ?>">

<div class="card shadow">
    <div class="card-header bg-warning">
        <h4 class="mb-0">Edit Alat</h4>
    </div>

    <div class="card-body">

        <p><?= esc($alat['nama_alat']); ?></p>

        <form action="<?= base_url('pinjam/simpan') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="id_alat" value="<?= esc($alat['id_alat']); ?>">

            <input type="text" name="nama" placeholder="Nama Peminjam" value="<?= old('nama'); ?>" required><br>
            <input type="number" name="jumlah" placeholder="Jumlah" value="<?= old('jumlah', 1); ?>" min="1" required><br>

            <button type="submit">Pinjam</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>