<!doctype html>
<html lang="id">
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link rel="icon" href="<?= base_url('assets/img/vaficon.png') ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Alat - PinjaminAja</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            background-color: #f1f3f6;
            font-family: 'Inter', sans-serif;
            color: #334155;
        }

        /* Compact Header */
        .page-header {
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        /* Search Bar Kecil */
        .search-container .input-group {
            background: #ffffff;
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            padding: 2px;
        }

        .search-container input {
            border: none !important;
            box-shadow: none !important;
            font-size: 0.85rem;
        }

        .btn-search {
            background-color: #334155 !important;
            color: white !important;
            border-radius: 8px !important;
            padding: 5px 15px !important;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Card Compact */
        .card-alat {
            border: none;
            border-radius: 12px;
            background: #ffffff;
            transition: transform 0.3s ease;
        }

        .card-alat:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px -10px rgba(0, 0, 0, 0.1) !important;
        }

        /* Gambar Lebih Kecil */
        .img-wrapper {
            position: relative;
            height: 150px;
            /* Ukuran dikurangi */
            overflow: hidden;
            border-radius: 12px 12px 0 0;
        }

        .img-alat {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(10%);
        }

        /* Badge Kecil */
        .badge-stock {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(2px);
        }

        /* Font & Spasi Compact */
        .card-body {
            padding: 0.9rem !important;
        }

        .alat-category {
            font-size: 0.65rem;
            font-weight: 700;
            color: #94a3b8;
            letter-spacing: 0.5px;
        }

        .alat-title {
            font-size: 0.95rem;
            /* Lebih kecil */
            font-weight: 700;
            color: #1e293b;
            margin: 2px 0 8px 0;
            line-height: 1.2;
        }

        .deskripsi-singkat {
            font-size: 0.8rem;
            color: #64748b;
            margin-bottom: 12px;
            height: 35px;
            overflow: hidden;
        }

        /* Button Action Compact */
        .btn-compact {
            font-size: 0.75rem;
            padding: 6px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-main {
            background-color: #334155;
            color: white;
            border: none;
        }

        .btn-main:hover {
            background-color: #0f172a;
            color: white;
        }

        .btn-outline-custom {
            background-color: #f8fafc;
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        .share-section {
            border-top: 1px solid #f1f5f9;
            margin-top: 10px;
            padding-top: 10px;
        }

        .btn-share-sm {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            font-size: 0.8rem;
            background: #f1f5f9;
            color: #64748b;
            border: none;
        }
    </style>
</head>

<body>
    <div class="container py-4">

        <div class="page-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-0">Inventaris Alat</h4>
                <p class="text-muted small mb-0 d-none d-md-block">Manajemen peminjaman alat PinjaminAja</p>
            </div>
            <?php if (session()->get('role') == 'admin') : ?>
                <a href="<?= base_url('alat/tambah') ?>" class="btn btn-dark btn-compact px-3 py-2">
                    <i class="bi bi-plus-lg me-1"></i> Baru
                </a>
            <?php endif; ?>
        </div>

        <div class="row mb-4">
            <div class="col-md-4 search-container">
                <form method="get" action="<?= base_url('alat') ?>">
                    <div class="input-group shadow-sm">
                        <span class="text-group-text bg-transparent border-0 pe-0 ps-2">
                            <i class="bi bi-search text-muted small"></i>
                        </span>
                        <input type="text" name="keyword" class="form-control" placeholder="Cari..." value="<?= $_GET['keyword'] ?? '' ?>">
                        <button type="submit" class="btn btn-search">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
            <?php if (!empty($alat)): ?>
                <?php foreach ($alat as $a): ?>
                    <div class="col">
                        <div class="card card-alat shadow-sm h-100">

                            <div class="img-wrapper">
                                <?php if ($a['foto']): ?>
                                    <img src="<?= base_url('uploads/alat/' . $a['foto']) ?>" class="img-alat">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/300x200?text=No+Image" class="img-alat">
                                <?php endif; ?>

                                <span class="badge-stock <?= $a['persediaan'] > 0 ? 'text-success' : 'text-danger' ?>">
                                    <?= $a['persediaan'] > 0 ? 'Tersedia' : 'Habis' ?>
                                </span>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <span class="alat-category"><?= $a['nama_kategori'] ?></span>
                                <h6 class="alat-title text-truncate" title="<?= $a['nama_alat'] ?>"><?= $a['nama_alat'] ?></h6>

                                <p class="deskripsi-singkat">
                                    <?= mb_strimwidth($a['deskripsi'], 0, 50, "...") ?>
                                </p>

                                <div class="mt-auto">
                                    <div class="d-grid gap-1">
                                        <?php if (session()->get('role') == 'admin') : ?>
                                            <a href="<?= base_url('alat/edit/' . $a['id_alat']) ?>" class="btn btn-outline-custom btn-compact">
                                                <i class="bi bi-pencil me-1"></i> Edit
                                            </a>
                                            <a href="<?= base_url('alat/delete/' . $a['id_alat']) ?>" onclick="return confirm('Hapus?')" class="btn btn-link text-danger btn-sm text-decoration-none fw-bold py-0" style="font-size: 0.7rem;">
                                                Hapus
                                            </a>
                                        <?php elseif (session()->get('role') == 'user') : ?>
                                            <?php if ($a['persediaan'] > 0): ?>
                                                <a href="<?= base_url('pinjam/' . $a['id_alat']) ?>" class="btn btn-main btn-compact">
                                                    Pinjam <i class="bi bi-chevron-right ms-1"></i>
                                                </a>
                                            <?php else: ?>
                                                <button class="btn btn-light btn-compact text-muted border-0" disabled>Habis</button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="share-section d-flex align-items-center justify-content-between">
                                        <small class="text-muted fw-bold" style="font-size: 0.7rem;">Stok: <?= $a['persediaan'] ?></small>
                                        <div class="d-flex gap-1">
                                            <a href="https://wa.me/6282125969243?text=<?= urlencode('Cek alat: ' . base_url('pinjam/' . $a['id_alat'])) ?>" target="_blank" class="btn-share-sm">
                                                <i class="bi bi-whatsapp"></i>
                                            </a>
                                            <button onclick="copyLink('<?= base_url('pinjam/' . $a['id_alat']) ?>')" class="btn-share-sm">
                                                <i class="bi bi-link-45deg"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted small">Data tidak tersedia.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        function copyLink(link) {
            navigator.clipboard.writeText(link);
            alert("Link disalin!");
        }
    </script>
</body>

<?= $this->endSection() ?>

</html>