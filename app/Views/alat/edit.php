<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card shadow">
    <div class="card-header bg-warning">
        <h4 class="mb-0">Edit Alat</h4>
    </div>

    <div class="card-body">

        <form action="<?= base_url('alat/update') ?>" method="post">

            <input type="hidden" name="id_alat" value="<?= $alat['id_alat']; ?>">

            <div>
                <label>Nama Alat</label><br>
                <input type="text" name="nama_alat" value="<?= $alat['nama_alat']; ?>">
            </div>

            <div>
                <label>Deskripsi</label><br>
                <textarea name="deskripsi"><?= $alat['deskripsi']; ?></textarea>
            </div>

            <div>
                <label>Stok</label><br>
                <input type="number" name="persediaan" value="<?= $alat['persediaan']; ?>">
            </div>

            <br>
            <button type="submit">Update</button>
        </form>
    </div>

</div>

<?= $this->endSection() ?>