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

    .card-form {
        border: none;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .card-header-custom {
        background-color: #334155;
        padding: 20px 30px;
        border: none;
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
    }

    .form-control,
    .form-select {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 15px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #334155;
        box-shadow: 0 0 0 3px rgba(51, 65, 85, 0.1);
    }

    .btn-save {
        background-color: #334155;
        border: none;
        color: white;
        font-weight: 600;
        padding: 10px 25px;
        border-radius: 10px;
        transition: 0.3s;
    }

    .btn-save:hover {
        background-color: #1e293b;
        transform: translateY(-1px);
    }

    .btn-cancel {
        background-color: #f1f5f9;
        color: #64748b;
        border: none;
        font-weight: 600;
        padding: 10px 25px;
        border-radius: 10px;
    }

    /* Kategori Input Group Fix */
    .input-group-custom .form-control {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .btn-add-cat {
        background-color: #334155;
        color: white;
        border: none;
        padding: 0 15px;
        border-radius: 0 10px 10px 0;
    }
</style>

<div class="container">
    <div class="form-container">

        <div class="card card-form">
            <div class="card-header-custom">
                <h4><i class="bi bi-tools me-2"></i>Tambah Alat Baru</h4>
            </div>

            <div class="card-body">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger border-0 shadow-sm small"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('alat/simpan') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <div class="mb-3">
                        <label class="form-label">Nama Alat</label>
                        <input type="text" name="nama_alat" class="form-control" placeholder="Contoh: Sapu Lidi" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Alat</label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan kondisi atau spesifikasi alat..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jumlah Stok</label>
                            <input type="number" name="persediaan" class="form-control" placeholder="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori</label>
                            <div class="input-group input-group-custom">
                                <select name="id_kategori" class="form-control" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php foreach ($kategori as $k): ?>
                                        <option value="<?= $k['id_kategori'] ?>">
                                            <?= $k['nama_kategori'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="button" class="btn btn-add-cat" data-bs-toggle="modal" data-bs-target="#modalKategori">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Unggah Foto Alat</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                        <div class="form-text small">Format: JPG, PNG. Maksimal 2MB.</div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="<?= base_url('alat') ?>" class="btn btn-cancel">Batal</a>
                        <button type="submit" class="btn btn-save shadow-sm">Simpan Alat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalKategori" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px;">
            <form id="formKategori">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body py-4">
                    <label class="form-label small text-muted">Nama Kategori Baru</label>
                    <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" placeholder="Contoh: Elektronik, Lensa, dll" required>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="submit" class="btn btn-save w-100">Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Logika Fetch tetap sama persis sesuai kode Anda
    document.getElementById('formKategori').addEventListener('submit', function(e) {
        e.preventDefault();
        let nama = document.getElementById('nama_kategori').value;
        fetch("<?= base_url('kategori/simpan') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "nama_kategori=" + nama
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    let select = document.querySelector('select[name="id_kategori"]');
                    let option = document.createElement("option");
                    option.value = data.id;
                    option.text = data.nama;
                    option.selected = true;
                    select.appendChild(option);
                    document.getElementById('formKategori').reset();
                    let modal = bootstrap.Modal.getInstance(document.getElementById('modalKategori'));
                    modal.hide();
                }
            });
    });
</script>

<?= $this->endSection() ?>