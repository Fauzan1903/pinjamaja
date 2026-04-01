<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap CSS Lokal -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow" style="width: 380px;">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">Login</h4>
            </div>

            <div class="card-body">

                <!-- Pesan Error -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('salahpw')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('salahpw') ?></div>
                <?php endif; ?>

                <!-- Form Login -->
                <form action="<?= base_url('/proses-login') ?>" method="post">

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    </div>

                    <button class="btn btn-primary w-100">
                        <i class="bi bi-box-arrow-in-right"></i> Sign In
                    </button>

                </form>

                <!-- Tombol Tambah User -->
                <div class="text-center mt-3">
                    <a href="<?= base_url('users/create') ?>" class="btn btn-outline-success btn-sm">
                        <i class="bi bi-person-plus"></i> Daftar Baru
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>