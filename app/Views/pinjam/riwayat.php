<h3>Riwayat Peminjaman</h3>

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama Alat</th>
        <th>Peminjam</th>
        <th>Jumlah</th>
        <th>Tgl Pinjam</th>
        <th>Tgl Kembali</th>
        <th>Status</th>
        <th>Denda</th>
        <th>Aksi</th>
    </tr>

    ```
    <?php $no = 1;
    foreach ($peminjaman as $p): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $p['nama_alat'] ?></td>
            <td><?= $p['nama_peminjam'] ?></td>
            <td><?= $p['jumlah'] ?></td>
            <td><?= $p['tanggal_pinjam'] ?></td>
            <td><?= $p['tanggal_kembali'] ?></td>
            <td><?= $p['status'] ?></td>
            <td>Rp <?= $p['denda'] ?></td>
            <td>
                <?php if ($p['status'] == 'dipinjam'): ?>
                    <a href="<?= base_url('kembalikan/' . $p['id_peminjaman']) ?>">
                        Kembalikan
                    </a>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    ```

</table>