<!doctype html>
<html lang="id">
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link rel="icon" href="<?= base_url('assets/img/Logo.png') ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Alat - PinjaminAja</title>
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h3 class="mb-4">Data Alat</h3>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (session()->get('role') == 'admin') : ?>
            <a href="<?= base_url('alat/tambah') ?>" class="btn btn-success mb-3">
                + Tambah Alat
            </a>
        <?php endif; ?>

        <form method="get" class="mb-3">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="Cari nama alat..." value="<?= $_GET['keyword'] ?? '' ?>">
                <button class="btn btn-primary">Cari</button>
            </div>
        </form>

        <table id="tableAlat" class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr class="text-center">
                    <th width="50">No</th>
                    <th>Nama Alat</th>
                    <th>Deskripsi</th>
                    <th>Stok</th>
                    <th>Foto</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                    <th>Bagikan</th>
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
                            <td class="text-center"><?= $a['foto'] ? '<img src="' . base_url('uploads/alat/' . $a['foto']) . '" width="50" class="d-block mx-auto">' : 'Tidak ada gambar' ?></td>
                            <td><?= $a['nama_kategori'] ?></td>
                            <td class="text-center">
                                <?php if (session()->get('role') == 'admin') : ?>
                                    <a href="<?= base_url('alat/edit/' . $a['id_alat']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('alat/delete/' . $a['id_alat']) ?>" onclick="return confirm('Hapus alat ini?')" class="btn btn-danger btn-sm">Hapus</a>
                                <?php elseif (session()->get('role') == 'user') : ?>
                                    <?php if ($a['persediaan'] > 0): ?>
                                        <a href="<?= base_url('pinjam/' . $a['id_alat']) ?>" class="btn btn-primary btn-sm">Pinjam</a>
                                    <?php else: ?>
                                        <button class="btn btn-secondary btn-sm" disabled>Habis</button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="https://wa.me/6282125969243?text=<?= urlencode('Cek alat ini: ' . base_url('pinjam/' . $a['id_alat'])) ?>" target="_blank" class="btn btn-success btn-sm"><i class="bi bi-whatsapp"></i></a>
                                <a href="https://www.instagram.com/sharer/sharer.php?u=<?= urlencode(base_url('pinjam/' . $a['id_alat'])) ?>" target="_blank" class="btn btn-primary btn-sm"><i class="bi bi-instagram"></i></a>
                                <button type="button" onclick="copyLink('<?= base_url('pinjam/' . $a['id_alat']) ?>')" class="btn btn-secondary btn-sm"><i class="bi bi-link-45deg"></i></button>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada data alat</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        function copyLink(link) {
            navigator.clipboard.writeText(link);
            alert("Link berhasil disalin!");
        }
    </script>
</body>
<?= $this->endSection() ?>

</html>