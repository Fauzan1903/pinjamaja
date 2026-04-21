<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Akses Restore - PinjaminAja</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="icon" href="<?= base_url('assets/img/vaficon.png') ?>">

    <style>
        :root {
            --slate-dark: #1e293b;
            --slate-gray: #334155;
            --glass-white: rgba(255, 255, 255, 0.1);
        }

        body {
            background: radial-gradient(circle at top right, #475569, #1e293b);
            height: 100vh;
            font-family: 'Inter', sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: var(--glass-white);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            color: #ffffff;
            overflow: hidden;
        }

        .card-header {
            background: none;
            border-bottom: none;
            padding-top: 40px;
            text-align: center;
        }

        .title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        .text-muted {
            color: #94a3b8 !important;
        }

        .form-control {
            background: rgba(0, 0, 0, 0.2) !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #ffffff !important;
            padding: 12px 15px;
            height: auto;
        }

        .form-control:focus {
            border-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.3) !important;
        }

        .btn-custom {
            background: #ffffff;
            color: var(--slate-dark);
            border-radius: 12px;
            padding: 12px;
            font-weight: 700;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: #f1f5f9;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
            color: var(--slate-dark);
        }

        .icon-box {
            background: rgba(255, 255, 255, 0.1);
            width: 70px;
            height: 70px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 30px;
        }

        .form-check-label {
            font-size: 0.85rem;
            color: #cbd5e1;
            cursor: pointer;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.2);
            border: none;
            color: #fca5a5;
            border-radius: 12px;
            font-size: 0.85rem;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center">
        <div class="col-md-5 col-lg-4">

            <div class="card p-3">

                <div class="card-header">
                    <div class="icon-box">🔐</div>
                    <h4 class="title mt-2">Akses Terbatas</h4>
                    <p class="text-muted small">Fitur pemulihan memerlukan otentikasi password sistem.</p>
                </div>

                <div class="card-body">

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger text-center shadow-sm">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i><?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('restore/auth') ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="form-group mb-3">
                            <label class="small font-weight-bold" style="color: #cbd5e1;">Master Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                        </div>

                        <div class="form-group form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="checkShow" onclick="togglePassword()">
                            <label class="form-check-label" for="checkShow">Lihat Password</label>
                        </div>

                        <button type="submit" class="btn btn-custom btn-block shadow-sm">
                            Verifikasi & Lanjutkan
                        </button>

                        <div class="text-center mt-4">
                            <a href="<?= base_url('login') ?>" class="small text-muted" style="text-decoration: none;">
                                &larr; Kembali ke Login
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <script src="<?= base_url('assets/bootstrap/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            x.type = x.type === "password" ? "text" : "password";
        }
    </script>

</body>

</html>