<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Styling Card Utama */
    .borrow-card {
        border: none;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05) !important;
        overflow: hidden;
        max-width: 600px;
        margin: 20px auto;
    }

    .borrow-header {
        /* Warna Abu-abu Profesional (Neutral Grayscale) */
        background: linear-gradient(135deg, #6b7280 0%, #374151 100%);
        padding: 30px;
        border: none;
    }

    .borrow-header h4 {
        color: white;
        font-weight: 700;
        letter-spacing: -0.5px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Informasi Alat */
    .tool-info-box {
        background: #f9fafb;
        /* Abu-abu sangat muda */
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 15px 20px;
        margin-bottom: 25px;
    }

    .info-label {
        font-size: 0.8rem;
        color: #6b7280;
        /* Text abu-abu */
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 2px;
        display: block;
    }

    .info-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #111827;
    }

    /* Form Styling */
    .form-group-custom {
        margin-bottom: 20px;
    }

    .form-label-custom {
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 8px;
        display: block;
    }

    .form-control-custom {
        border-radius: 10px;
        padding: 12px 15px;
        border: 2px solid #f3f4f6;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-control-custom:focus {
        border-color: #9ca3af;
        /* Fokus warna abu-abu */
        box-shadow: 0 0 0 4px rgba(156, 163, 175, 0.1);
        outline: none;
    }

    /* Tombol */
    .btn-action {
        border-radius: 12px;
        padding: 12px 25px;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .btn-submit {
        background: #374151;
        /* Tombol abu-abu gelap */
        border: none;
        color: white;
    }

    .btn-submit:hover {
        background: #6f6f77;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(179, 178, 178, 0.1);
    }

    /* Custom Badge */
    .badge-gray {
        background-color: #374151;
        color: white;
    }
</style>

<div class="container py-4">
    <div class="card borrow-card">
        <div class="card-header borrow-header">
            <h4 class="mb-0"><i class="bi bi-box-seam"></i> Pinjam Alat</h4>
        </div>

        <div class="card-body p-4">
            <div class="tool-info-box d-flex justify-content-between align-items-center">
                <div>
                    <span class="info-label">Nama Alat</span>
                    <span class="info-value"><?= esc('nama_alat'); ?></span>
                </div>
                <div class="text-end">
                    <span class="info-label">Stok Tersedia</span>
                    <span class="badge badge-gray rounded-pill px-3">
                        <?= esc('persediaan'); ?> Unit
                    </span>
                </div>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div><?= esc(session()->getFlashdata('error')); ?></div>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('pinjam/simpan') ?>" method="post">
                <?= csrf_field(); ?>

                <input type="hidden" name="id_alat" value="<?= esc('id_alat'); ?>">

                <div class="form-group-custom">
                    <label class="form-label-custom">Nama Peminjam</label>
                    <input type="text" name="nama" class="form-control-custom" value="<?= esc(old('nama', session()->get('nama'))); ?>" maxlength="30" readonly>
                </div>

                <div class="form-group-custom">
                    <label class="form-label-custom">Jumlah Pinjam</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-3" style="border: 2px solid #f3f4f6;">
                            <i class="bi bi-plus-minus text-muted"></i>
                        </span>
                        <input type="number" name="jumlah" class="form-control-custom rounded-start-0" value="<?= esc('jumlah'); ?>" min="1">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-action btn-submit flex-grow-1">
                        <i class="bi bi-check-circle-fill me-2"></i>Konfirmasi Pinjam
                    </button>
                    <a href="<?= base_url('alat') ?>" class="btn btn-action btn-light flex-grow-1 border">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>