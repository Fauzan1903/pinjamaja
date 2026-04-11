<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3 class="mb-4">Pengembalian Alat</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <form method="get" class="mb-3">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Cari nama user / alat...">
            <button class="btn btn-primary">Cari</button>
        </div>
    </form>
    <table class="table table-bordered">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>Nama Alat</th>
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
                    <td><?= $p['nama_alat'] ?></td>
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
                        <a href="<?= base_url('pengembalian/export') ?>" target="_blank" class="btn btn-info btn-sm">
                            Export PDF
                        </a>
                        <!-- Tombol Hapus (admin saja) -->
                        <?php if (session()->get('role') == 'admin'): ?>
                            <a href="<?= base_url('pengembalian/delete/' . $p['id_peminjam']) ?>"
                                class="btn btn-danger mb-3"
                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                Hapus
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>