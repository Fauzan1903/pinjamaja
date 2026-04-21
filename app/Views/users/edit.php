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
        max-width: 800px;
        margin: 40px auto;
    }

    .card-edit-user {
        border: none;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .card-header-custom {
        background-color: #334155;
        padding: 25px 30px;
        border: none;
    }

    .card-header-custom h4 {
        color: #ffffff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        margin: 0;
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-body {
        padding: 35px;
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

    .user-preview-box {
        background: #f8fafc;
        border-radius: 12px;
        padding: 15px;
        border: 1px dashed #cbd5e1;
    }

    .img-preview {
        border-radius: 10px;
        object-fit: cover;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 2px solid white;
    }

    .btn-update {
        background-color: #334155;
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px 25px;
        border-radius: 10px;
        transition: 0.3s;
    }

    .btn-update:hover {
        background-color: #1e293b;
        transform: translateY(-1px);
        color: white;
    }

    .btn-cancel {
        background-color: #f1f5f9;
        color: #64748b;
        border: none;
        font-weight: 600;
        padding: 12px 25px;
        border-radius: 10px;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-cancel:hover {
        background-color: #e2e8f0;
        color: #334155;
    }

    .helper-text {
        font-size: 0.75rem;
        color: #94a3b8;
        margin-top: 4px;
        display: block;
    }
</style>

<div class="container">
    <div class="form-container">
        <div class="card card-edit-user">
            <div class="card-header-custom">
                <h4><i class="bi bi-person-gear"></i> Edit Profil Pengguna</h4>
            </div>

            <div class="card-body">
                <form action="<?= base_url('users/update/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" value="<?= $user['nama'] ?>" class="form-control" placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" value="<?= $user['username'] ?>" class="form-control" placeholder="Username unik" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hak Akses (Role)</label>
                            <select name="role" class="form-select">
                                <option value="Petugas" <?= $user['role'] == 'Petugas' ? 'selected' : '' ?>>Petugas</option>
                                <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User (Peminjam)</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ganti Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••">
                            <span class="helper-text">*Kosongkan jika tidak ingin mengubah password</span>
                        </div>
                    </div>

                    <hr class="my-4" style="opacity: 0.1;">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Alamat Email</label>
                            <input type="email" name="email" value="<?= $user['email'] ?? '' ?>" class="form-control" placeholder="email@contoh.com">
                            <span class="helper-text">Digunakan untuk notifikasi sistem</span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nomor WhatsApp</label>
                            <input type="text" name="no_hp" value="<?= $user['no_hp'] ?? '' ?>" class="form-control" placeholder="0812xxxx">
                            <span class="helper-text">Nomor aktif yang bisa dihubungi</span>
                        </div>
                    </div>

                    <div class="mb-4 mt-2">
                        <label class="form-label">Foto Profil</label>
                        <div class="user-preview-box d-flex align-items-center gap-4">
                            <div class="text-center">
                                <?php if ($user['foto']): ?>
                                    <img src="<?= base_url('uploads/users/' . $user['foto']) ?>" width="80" height="80" class="img-preview mb-1">
                                    <p class="mb-0 small text-muted fw-bold">Foto Saat Ini</p>
                                <?php else: ?>
                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center text-white" style="width:80px; height:80px;">
                                        <i class="bi bi-person text-white-50" style="font-size: 2rem;"></i>
                                    </div>
                                    <p class="mb-0 small text-muted fw-bold">Tanpa Foto</p>
                                <?php endif; ?>
                            </div>
                            <div class="flex-grow-1">
                                <input type="file" name="foto" class="form-control">
                                <span class="helper-text">Format: JPG, PNG (Maks. 2MB)</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                        <a href="<?= base_url('users') ?>" class="btn btn-cancel">Batal</a>
                        <button type="submit" class="btn btn-update shadow-sm px-4">Update Data Pengguna</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>