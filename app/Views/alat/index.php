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

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card-alat {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
        }

        .card-alat:hover {
            transform: translateY(-5px);
        }

        .img-alat {
            height: 180px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
    </style>

</head>

<body>
    <div class="container mt-5">


        <h3 class="mb-4 fw-bold text-primary">Data Alat</h3>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success shadow-sm">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->get('role') == 'admin') : ?>
            <a href="<?= base_url('alat/tambah') ?>" class="btn btn-success mb-4 shadow-sm">
                <i class="bi bi-plus-circle"></i> Tambah Alat
            </a>
        <?php endif; ?>

        <form method="get" class="mb-4">
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" name="keyword" class="form-control" placeholder="Cari nama alat..." value="<?= $_GET['keyword'] ?? '' ?>">
                <button class="btn btn-primary">Cari</button>
            </div>
        </form>

        <div class="row g-4">
            <?php if (!empty($alat)): ?>
                <?php foreach ($alat as $a): ?>
                    <div class="col-md-4 col-lg-3">
                        <div class="card card-alat shadow-sm h-100">

                            <!-- Gambar -->
                            <?php if ($a['foto']): ?>
                                <img src="<?= base_url('uploads/alat/' . $a['foto']) ?>" class="img-alat w-100">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/300x180?text=No+Image" class="img-alat w-100">
                            <?php endif; ?>

                            <div class="card-body d-flex flex-column">

                                <!-- Nama -->
                                <h6 class="fw-bold"><?= $a['nama_alat'] ?></h6>

                                <!-- Kategori -->
                                <small class="text-muted mb-1"><?= $a['nama_kategori'] ?></small>

                                <!-- Deskripsi -->
                                <p class="text-muted small mb-2">
                                    <?= substr($a['deskripsi'], 0, 60) ?>...
                                </p>

                                <!-- Stok -->
                                <?php if ($a['persediaan'] > 0): ?>
                                    <span class="badge bg-success mb-2">Tersedia (<?= $a['persediaan'] ?>)</span>
                                <?php else: ?>
                                    <span class="badge bg-danger mb-2">Habis</span>
                                <?php endif; ?>

                                <!-- Tombol -->
                                <div class="mt-auto">

                                    <?php if (session()->get('role') == 'admin') : ?>
                                        <a href="<?= base_url('alat/edit/' . $a['id_alat']) ?>" class="btn btn-warning btn-sm w-100 mb-1">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <a href="<?= base_url('alat/delete/' . $a['id_alat']) ?>" onclick="return confirm('Hapus alat ini?')" class="btn btn-danger btn-sm w-100">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>

                                    <?php elseif (session()->get('role') == 'user') : ?>
                                        <?php if ($a['persediaan'] > 0): ?>
                                            <a href="<?= base_url('pinjam/' . $a['id_alat']) ?>" class="btn btn-primary btn-sm w-100">
                                                <i class="bi bi-cart"></i> Pinjam
                                            </a>
                                        <?php else: ?>
                                            <button class="btn btn-secondary btn-sm w-100" disabled>Habis</button>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <!-- Share -->
                                    <div class="d-flex justify-content-center mt-2 gap-2">
                                        <a href="https://wa.me/6282125969243?text=<?= urlencode('Cek alat ini: ' . base_url('pinjam/' . $a['id_alat'])) ?>" target="_blank" class="btn btn-success btn-sm">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                        <a href="https://www.instagram.com/sharer/sharer.php?u=<?= urlencode(base_url('pinjam/' . $a['id_alat'])) ?>" target="_blank" class="btn btn-primary btn-sm">
                                            <i class="bi bi-instagram"></i>
                                        </a>
                                        <button onclick="copyLink('<?= base_url('pinjam/' . $a['id_alat']) ?>')" class="btn btn-secondary btn-sm">
                                            <i class="bi bi-link-45deg"></i>
                                        </button>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center text-muted">Belum ada data alat</div>
            <?php endif; ?>
        </div>

    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        function copyLink(link) {
            navigator.clipboard.writeText(link);
            alert("Link berhasil disalin!");
        }
    </script>
    ```

</body>

<?= $this->endSection() ?>

</html>