<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/vaficon.png') ?>">

    <style>
        body {
            background-color: #f1f3f6;
            font-family: 'Inter', sans-serif;
            color: #334155;
        }

        .form-container {
            max-width: 850px;
            margin: 50px auto;
        }

        .card-custom {
            border: none;
            border-radius: 20px;
            background: #ffffff;
            box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }

        .card-header-custom {
            background-color: #334155;
            padding: 25px 35px;
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
            gap: 12px;
        }

        .card-body {
            padding: 40px;
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
            border-radius: 12px;
            padding: 12px 18px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #fff;
            border-color: #334155;
            box-shadow: 0 0 0 4px rgba(51, 65, 85, 0.1);
        }

        .section-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::after {
            content: "";
            height: 1px;
            flex-grow: 1;
            background-color: #e2e8f0;
        }

        .btn-save {
            background-color: #334155;
            border: none;
            color: white;
            font-weight: 600;
            padding: 14px 30px;
            border-radius: 12px;
            transition: 0.3s;
        }

        .btn-save:hover {
            background-color: #1e293b;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(51, 65, 85, 0.2);
            color: white;
        }

        .btn-login-link {
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: 0.2s;
        }

        .btn-login-link:hover {
            color: #334155;
        }

        .helper-text {
            font-size: 0.75rem;
            color: #94a3b8;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="form-container">
            <div class="card card-custom">
                <div class="card-header-custom">
                    <h4><i class="bi bi-person-plus"></i> Pendaftaran User Baru</h4>
                </div>

                <div class="card-body">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger border-0 rounded-4 shadow-sm py-3 mb-4">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>

                        <div class="section-title">Informasi Akun</div>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama sesuai KTP" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Contoh: user_vaf" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Role Akses</label>
                                <select name="role" class="form-select" required>
                                    <option value="" disabled selected>-- Pilih Role --</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>

                        <div class="section-title">Kontak & Profil</div>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Aktif</label>
                                <input type="email" name="email" class="form-control" placeholder="user@example.com">
                                <div class="helper-text">Digunakan untuk reset password & notifikasi</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor HP / WhatsApp</label>
                                <input type="text" name="no_hp" class="form-control" placeholder="0812xxxxxxxx">
                                <div class="helper-text">Untuk koordinasi peminjaman alat</div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Foto Profil</label>
                                <input type="file" name="foto" class="form-control" accept="image/*">
                                <div class="helper-text">Format: JPG, PNG (Max 2MB). Kosongkan jika tidak upload.</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
                            <a href="<?= base_url('login') ?>" class="btn-login-link">
                                <i class="bi bi-arrow-left me-1"></i> Sudah punya akun? Login di sini
                            </a>
                            <button type="submit" class="btn btn-save shadow-sm px-5">
                                Simpan User Baru
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

</body>

</html>