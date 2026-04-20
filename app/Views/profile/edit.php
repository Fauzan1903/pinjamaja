<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Styling Card dan Form */
    .edit-profile-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        background: #fff;
    }

    .card-header-modern {
        background: linear-gradient(135deg, #969696 0%, #3f3f3f 100%);
        padding: 25px;
        border: none;
    }

    .card-header-modern h5 {
        color: white;
        font-weight: 700;
        margin: 0;
        letter-spacing: 0.5px;
    }

    .form-label {
        font-weight: 600;
        color: #4a4a4a;
        font-size: 0.9rem;
    }

    .form-control {
        border-radius: 10px;
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        transition: 0.3s;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.15);
        border-color: #4e73df;
    }

    /* Preview Foto */
    .photo-preview-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: #f8f9fc;
        border-radius: 12px;
        border: 1px dashed #d1d3e2;
    }

    .img-preview-round {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 12px;
        border: 3px solid #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Tombol */
    .btn-update {
        border-radius: 10px;
        padding: 12px 25px;
        font-weight: 700;
        background: #4e73df;
        border: none;
        transition: 0.3s;
    }

    .btn-update:hover {
        background: #224abe;
        transform: translateY(-2px);
    }

    .btn-cancel {
        border-radius: 10px;
        padding: 12px 25px;
        font-weight: 600;
    }
</style>

<div class="container py-5">
    <div class="card edit-profile-card mx-auto" style="max-width: 650px;">
        <div class="card-header card-header-modern text-center">
            <h5><i class="bi bi-person-gear me-2"></i>Pengaturan Profil</h5>
        </div>
        <div class="card-body p-4 p-md-5">

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger border-0 shadow-sm mb-4">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><small><?= $error ?></small></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success border-0 shadow-sm mb-4">
                    <i class="bi bi-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('profile/update/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control shadow-none" id="nama" name="nama" value="<?= old('nama', $user['nama']) ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control shadow-none" id="username" name="username" value="<?= old('username', $user['username']) ?>" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Foto Profil</label>
                    <div class="photo-preview-wrapper">
                        <?php if ($user['foto']): ?>
                            <img src="<?= base_url('uploads/users/' . $user['foto']) ?>" class="img-preview-round">
                        <?php else: ?>
                            <div class="bg-secondary rounded text-white d-flex align-items-center justify-content-center img-preview-round" style="font-size: 0.8rem;">No Photo</div>
                        <?php endif; ?>
                        <div class="flex-grow-1">
                            <input type="file" name="foto" class="form-control form-control-sm shadow-none">
                            <small class="text-muted mt-1 d-block">Pilih file untuk mengganti foto</small>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomor WhatsApp</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-telephone text-muted"></i></span>
                        <input type="text" class="form-control border-start-0 shadow-none" id="no_hp" name="no_hp" value="<?= old('no_hp', $user['no_hp'] ?? '') ?>" placeholder="08xxxx">
                    </div>
                    <small class="form-text text-muted">Gunakan nomor aktif untuk koordinasi.</small>
                </div>

                <div class="mb-4">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                        <input type="email" name="email" value="<?= $user['email'] ?? '' ?>" class="form-control border-start-0 shadow-none" placeholder="anda@example.com">
                    </div>
                    <small class="text-muted">Email akan digunakan untuk notifikasi sistem.</small>
                </div>

                <div class="d-flex gap-2 pt-2">
                    <button type="submit" class="btn btn-primary btn-update flex-grow-1 shadow-sm">Simpan Perubahan</button>
                    <a href="<?= base_url('profile') ?>" class="btn btn-light btn-cancel border">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>