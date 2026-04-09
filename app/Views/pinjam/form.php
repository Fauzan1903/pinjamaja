<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow">
    <div class="card-header bg-warning">
        <h4 class="mb-0">Pinjam Alat</h4>
    </div>

    <div class="card-body">

        <p>Nama Alat: <?= esc($alat['nama_alat']); ?></p>
        <p>Stok tersedia: <?= esc($alat['persediaan']); ?></p>

        <?php if (session()->getFlashdata('error')): ?>
            <div style="color: #b00020; margin-bottom: 10px;">
                <?= esc(session()->getFlashdata('error')); ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('pinjam/simpan') ?>" method="post">
            <?= csrf_field(); ?>

            <input type="hidden" name="id_alat" value="<?= esc($alat['id_alat']); ?>">

            <div>
                <label>Nama Peminjam</label><br>
                <input type="text" name="nama" value="<?= old('nama'); ?>" maxlength="30" required>
            </div>

            <div>
                <label>Jumlah Pinjam</label><br>
                <input type="number" name="jumlah" value="<?= old('jumlah', 1); ?>" min="1" max="<?= esc($alat['persediaan']); ?>" required>
            </div>

            <br>
            <button type="submit" class="btn btn-primary btn-lg">Pinjam</button>
            <a href="<?= base_url('alat') ?>" class="btn btn-secondary btn-lg">Kembali</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>