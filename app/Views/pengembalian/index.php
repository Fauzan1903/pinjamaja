<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="icon" href="<?= base_url('assets/img/Logo.png') ?>">

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
                <th>Peminjam</th>
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Batas Kembali</th>
                <th>Status</th>
                <th>Denda</th>
                <th>Aksi</th>
                <th>Bagikan</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($peminjaman as $p): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $p['nama_user'] ?? $p['nama_peminjam'] ?? 'N/A' ?></td>
                    <td><?= $p['nama_alat'] ?></td>
                    <td><?= $p['jumlah'] ?></td>
                    <td><?= $p['data_peminjam'] ?></td>
                    <td><?= $p['data_dikembalikan'] ?></td>
                    <td><?= $p['status'] ?></td>
                    <td>
                        <?php if ($p['status'] == 'dikembalikan' && isset($p['denda'])): ?>
                            <?php if ($p['denda'] > 0): ?>
                                <span class="text-danger fw-bold">Rp <?= number_format($p['denda'], 0, ',', '.') ?></span>
                            <?php else: ?>
                                <span class="text-success">Rp 0</span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (session()->get('role') == 'user' && $p['status'] != 'dikembalikan'): ?>
                            <a href="<?= base_url('pengembalian/kembalikan/' . $p['id_peminjam']) ?>"
                                class="btn btn-success btn-sm"
                                onclick="return confirm('Kembalikan alat ini?')">
                                Kembalikan
                            </a>
                        <?php elseif (session()->get('role') == 'user' && $p['status'] != 'dikembalikan'): ?>
                            <a href="<?= base_url('pengembalian/kembalikan/' . $p['id_peminjam']) ?>"
                                class="btn btn-success btn-sm"
                                onclick="return confirm('Kembalikan alat ini?')">
                                Kembalikan
                            </a>
                        <?php endif; ?>

                        <!-- Tombol Hapus (admin saja) -->
                        <?php if (session()->get('role') == 'admin'): ?>
                            <a href="<?= base_url('pengembalian/delete/' . $p['id_peminjam']) ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                Hapus
                            </a>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">

                        <!-- 🔥 SHARE WHATSAPP -->
                        <a href="https://wa.me/?081234567890=<?= urlencode(
                                                                    'Pengembalian alat ID: ' . $p['id_alat'] .
                                                                        ' | Jumlah: ' . $p['jumlah'] .
                                                                        ' | Status: ' . $p['status']
                                                                ) ?>"
                            target="_blank"
                            class="btn btn-success btn-sm">
                            <i class="bi bi-whatsapp"></i>
                        </a>

                        <!-- 🔥 SHARE instagram -->
                        <a href="https://www.instagram.com/hafidz_sundara/hafidz_sundara.php?u=<?= base_url('pengembalian') ?>"
                            target="_blank"
                            class="btn btn-primary btn-sm">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a>
                            <!-- 🔥 COPY LINK -->
                            <button onclick="copyLink('<?= base_url('pengembalian') ?>')"
                                class="btn btn-secondary btn-sm">
                                <i class="bi bi-link-45deg"></i>
                            </button>

                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function copyLink(link) {
        navigator.clipboard.writeText(link);
        alert("Link berhasil disalin!");
    }
</script>

<?= $this->endSection() ?>