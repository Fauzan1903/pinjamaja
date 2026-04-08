<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    ```
    <h3 class="mb-4">Data Alat</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->get('role') == 'admin') : ?>
        <a href="<?= base_url('alat/tambah') ?>" class="btn btn-success mb-3">
            + Tambah Alat
        </a>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr class="text-center">
                <th width="50">No</th>
                <th>Nama Alat</th>
                <th>Deskripsi</th>
                <th>Stok</th>
                <th>Aksi</th>
                <?php if (session()->get('role') == '$allrole') : ?>
                    <th width="200">Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>

        <tbody>

            <?php if (!empty($alat)): ?>
                <?php $no = 1;
                foreach ($alat as $a): ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $a['nama_alat'] ?></td>
                        <td><?= $a['deskripsi'] ?></td>
                        <td class="text-center"><?= $a['persediaan'] ?></td>

                        <?php if (session()->get('role') == 'admin') : ?>
                            <td class="text-center">



                                <a href="<?= base_url('alat/edit/' . $a['id_alat']) ?>" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <a href="<?= base_url('alat/delete/' . $a['id_alat']) ?>"
                                    onclick="return confirm('Hapus alat ini?')"
                                    class="btn btn-danger btn-sm">
                                    Hapus
                                </a>

                            </td>
                        <?php endif; ?>
                        <?php if (session()->get('role') == 'user') : ?>
                            <td class="text-center">

                                <?php if ($a['persediaan'] > 0): ?>
                                    <a href="<?= base_url('pinjam/' . $a['id_alat']) ?>" class="btn btn-primary btn-sm">
                                        Pinjam
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-secondary btn-sm" disabled>
                                        Habis
                                    </button>
                                <?php endif; ?>


                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada data alat</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    ```

</div>

<?= $this->endSection() ?>