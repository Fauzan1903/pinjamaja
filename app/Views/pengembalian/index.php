<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3 class="mb-4">Pengembalian Alat</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>ID Alat</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Batas Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($peminjaman as $p): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $p['id_alat'] ?></td>
                    <td><?= $p['jumlah'] ?></td>
                    <td><?= $p['data_peminjam'] ?></td>
                    <td><?= $p['data_dikembalikan'] ?></td>
                    <td><?= $p['status'] ?></td>
                    <td>
                        <?php if (session()->get('role') == 'user'): ?>
                            <a href="<?= base_url('pengembalian/kembalikan/' . $p['id_peminjam']) ?>"
                                class="btn btn-success btn-sm"
                                onclick="return confirm('Kembalikan alat ini?')">
                                Kembalikan
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>