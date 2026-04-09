<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3 class="mb-4">Riwayat Peminjaman</h3>

    <table class="table table-bordered">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>ID Alat</th>
                <th>Jumlah</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($riwayat as $r): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $r['id_alat'] ?></td>
                    <td><?= $r['jumlah'] ?></td>
                    <td><?= $r['data_peminjam'] ?></td>
                    <td><?= $r['data_dikembalikan'] ?></td>
                    <td>
                        <span class="badge bg-<?= $r['status'] == 'dikembalikan' ? 'success' : 'warning' ?>">
                            <?= $r['status'] ?>
                        </span>
                    </td>
                    <td>Rp <?= $r['denda'] ?? 0 ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>