<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card shadow">
    <div class="card-header bg-warning">
        <h4 class="mb-0">Edit Alat</h4>
    </div>

    <div class="card-body">

        <form action="<?= base_url('alat/update') ?>" method="post" enctype="multipart/form-data">

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
            <div>
                <div>
                    <label>Kategori</label><br>
                    <select name="id_kategori" class="form-control">
                        <?php foreach ($kategori as $k): ?>
                            <option value="<?= $k['id_kategori'] ?>"
                                <?= $k['id_kategori'] == $alat['id_kategori'] ? 'selected' : '' ?>>
                                <?= $k['nama_kategori'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label>Foto</label><br>
                    <input type="file" name="foto">
                    <?php if (!empty($alat['foto'])): ?>
                        <div class="mt-2">
                            <img src="<?= base_url('uploads/alat/' . $alat['foto']) ?>" width="100" alt="Foto alat">
                        </div>
                    <?php endif; ?>
                </div>

                <br>
                <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>

</div>

<?= $this->endSection() ?>