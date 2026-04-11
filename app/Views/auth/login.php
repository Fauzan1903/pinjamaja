<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="icon" href="<?= base_url('assets/img/Logo.png') ?>">

    <!-- Bootstrap CSS Lokal -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <style>
        .dark-mode {
            background-color: #121212 !important;
            color: white !important;
        }

        .dark-mode .card {
            background-color: #1e1e1e;
            color: white;
        }

        .dark-mode .form-control {
            background-color: #2c2c2c;
            color: white;
            border: 1px solid #444;
        }

        .dark-mode .form-control::placeholder {
            color: #aaa;
        }

        .dark-mode .card-header {
            background-color: #0d6efd !important;
        }
    </style>
</head>

<body id="body" class="bg-light">

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

                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>

                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()" id="eyeBtn">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
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

                    <button onclick="toggleTheme()" class="btn btn-dark btn-sm" id="themeBtn">
                        ☾
                    </button>
                </div>
            </div>
        </div>

        <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
        <script>
            function togglePassword() {
                var input = document.getElementById("password");
                var icon = document.getElementById("eyeBtn").querySelector("i");

                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove("bi-eye");
                    icon.classList.add("bi-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.remove("bi-eye-slash");
                    icon.classList.add("bi-eye");
                }
            }
        </script>
        <script>
            function toggleTheme() {
                let body = document.getElementById("body");
                let btn = document.getElementById("themeBtn");

                body.classList.toggle("dark-mode");

                // Simpan ke localStorage
                if (body.classList.contains("dark-mode")) {
                    localStorage.setItem("theme", "dark");
                    btn.innerHTML = "🔅";
                } else {
                    localStorage.setItem("theme", "light");
                    btn.innerHTML = "☾";
                }
            }

            // Load saat halaman dibuka
            window.onload = function() {
                let theme = localStorage.getItem("theme");
                let body = document.getElementById("body");
                let btn = document.getElementById("themeBtn");

                if (theme === "dark") {
                    body.classList.add("dark-mode");
                    btn.innerHTML = "☀️";
                }
            };
        </script>
</body>

</html>