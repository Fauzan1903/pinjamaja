<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">

<style>
    body {
        background-color: #f1f3f6;
        font-family: 'Inter', sans-serif;
        color: #334155;
    }

    .form-container {
        max-width: 700px;
        margin: 40px auto;
    }

    .card-edit {
        border: none;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    /* Header warna Slate Gray agar lebih profesional dibanding Kuning Warning */
    .card-header-custom {
        background-color: #334155;
        padding: 20px 30px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-header-custom h4 {
        color: #ffffff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        margin: 0;
        font-size: 1.15rem;
    }

    .card-body {
        padding: 30px;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        color: #475569;
        margin-bottom: 8px;
        display: block;
    }

    .form-control,
    .form-select {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 15px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-control:focus {
        border-color: #334155;
        box-shadow: 0 0 0 3px rgba(51, 65, 85, 0.1);
        outline: none;
    }

    .preview-img {
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        object-fit: cover;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .btn-update {
        background-color: #334155;
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 10px;
        transition: 0.3s;
    }

    .btn-update:hover {
        background-color: #1e293b;
        transform: translateY(-1px);
        color: white;
    }

    .btn-back {
        background-color: #f1f5f9;
        color: #64748b;
        border: none;
        font-weight: 600;
        padding: 12px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
    }

    .btn-back:hover {
        background-color: #e2e8f0;
        color: #334155;
    }
</style>

<div class="container">
    <div class="form-container">

        <?php if (isset($alat) && $alat): ?>

            <div class="card card-edit">
                <div class="card-header-custom">
                    <h4><i class="bi bi-pencil-square me-2"></i>Edit Data Alat</h4>
                    <span class="badge bg-light text-dark shadow-sm" style="font-size: 0.7rem;">ID: #<?= $alat['id_alat']; ?></span>
                </div>

                <div class="card-body">
                    <form action="<?= base_url('alat/update') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id_alat" value="<?= $alat['id_alat']; ?>">

                        <div class="mb-3">
                            <label class="form-label">Nama Alat</label>
                            <input type="text" name="nama_alat" class="form-control" value="<?= $alat['nama_alat']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4"><?= $alat['deskripsi']; ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stok / Persediaan</label>
                                <input type="number" name="persediaan" class="form-control" value="<?= $alat['persediaan']; ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="id_kategori" class="form-select">
                                    <?php if (isset($kategori) && $kategori): ?>
                                        <?php foreach ($kategori as $k): ?>
                                            <option value="<?= $k['id_kategori'] ?>"
                                                <?= $k['id_kategori'] == $alat['id_kategori'] ? 'selected' : '' ?>>
                                                <?= $k['nama_kategori'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Ubah Foto</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">

                            <?php if (!empty($alat['foto'])): ?>
                                <div class="mt-3 p-3 bg-light rounded-3 d-flex align-items-center">
                                    <img src="<?= base_url('uploads/alat/' . $alat['foto']) ?>" width="80" height="80" class="preview-img me-3" alt="Foto alat">
                                    <div>
                                        <p class="mb-0 small fw-bold text-dark">Foto Saat Ini</p>
                                        <p class="mb-0 small text-muted">Abaikan jika tidak ingin mengubah gambar.</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <a href="<?= base_url('alat') ?>" class="btn btn-back">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-update shadow-sm">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Data Tidak Ditemukan</h4>
                <p>Data alat yang Anda cari tidak tersedia atau telah dihapus.</p>
                <a href="<?= base_url('alat') ?>" class="btn btn-primary">Kembali ke Daftar Alat</a>
            </div>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>