<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PinjaminAja</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">

    <link rel="icon" href="<?= base_url('assets/img/vaficon.png') ?>">
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.12);
            --glass-border: rgba(255, 255, 255, 0.2);
            --accent-color: #334155;
            /* Slate Gray agar senada dengan Dashboard */
        }

        body {
            height: 100vh;
            /* Gradient yang lebih halus dan premium */
            background: radial-gradient(circle at top right, #475569, #1e293b);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Inter', sans-serif;
            margin: 0;
            overflow: hidden;
        }

        /* Dekorasi Background agar lebih keren */
        body::before {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            top: -100px;
            left: -100px;
        }

        .login-box {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 45px 35px;
            width: 100%;
            max-width: 400px;
            color: #ffffff;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
            position: relative;
            z-index: 1;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 32px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 8px;
            letter-spacing: -1px;
            background: linear-gradient(to bottom, #fff, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .subtitle {
            text-align: center;
            font-size: 0.9rem;
            color: #94a3b8;
            margin-bottom: 35px;
        }

        /* Form Styling */
        .input-group-custom {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid var(--glass-border);
            border-radius: 14px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            padding: 5px 15px;
        }

        .input-group-custom:focus-within {
            border-color: #fff;
            background: rgba(0, 0, 0, 0.3);
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1);
        }

        .input-group-custom i {
            color: #94a3b8;
            font-size: 1.1rem;
        }

        .form-control {
            background: transparent !important;
            border: none !important;
            color: #fff !important;
            padding: 12px 10px !important;
            font-size: 0.95rem;
        }

        .form-control::placeholder {
            color: #64748b;
        }

        .form-control:focus {
            box-shadow: none;
        }

        .toggle-eye {
            cursor: pointer;
            color: #94a3b8;
            transition: 0.2s;
        }

        .toggle-eye:hover {
            color: #fff;
        }

        /* Button Styling */
        /* Button Styling yang Lebih Gelap & Elegan */
        .btn-login {
            background: #334155;
            /* Slate Gray (Senada dengan Dashboard) */
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff;
            font-weight: 700;
            padding: 14px;
            border-radius: 14px;
            font-size: 1rem;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: #1e293b;
            /* Lebih gelap saat di-hover */
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.4);
            color: #ffffff;
        }

        .btn-restore {
            border: 1px solid rgba(248, 113, 113, 0.4);
            color: #f87171;
            font-size: 0.75rem;
            border-radius: 10px;
            text-decoration: none;
            padding: 8px 15px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 25px;
            transition: 0.3s;
        }

        .btn-restore:hover {
            background: rgba(248, 113, 113, 0.1);
            color: #f87171;
        }

        .footer-text {
            color: #94a3b8;
            font-size: 0.85rem;
        }

        .footer-text a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        /* Alert Styling */
        .alert {
            border-radius: 12px;
            font-size: 0.85rem;
            border: none;
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            backdrop-filter: blur(5px);
        }
    </style>
</head>

<body>

    <div class="login-box">
        <div class="logo">PinjaminAja</div>
        <p class="subtitle">Silakan masuk ke akun Anda</p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger mb-4">
                <i class="bi bi-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('salahpw')): ?>
            <div class="alert alert-danger mb-4">
                <i class="bi bi-shield-lock me-2"></i><?= session()->getFlashdata('salahpw') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/proses-login') ?>" method="post">
            <?= csrf_field(); ?>

            <div class="input-group-custom">
                <i class="bi bi-person"></i>
                <input type="text" name="username" class="form-control" placeholder="Username" required autocomplete="off">
            </div>

            <div class="input-group-custom">
                <i class="bi bi-lock"></i>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                <i class="bi bi-eye toggle-eye" id="eyeIcon" onclick="togglePassword()"></i>
            </div>

            <button type="submit" class="btn btn-login w-100">
                Masuk Sekarang
            </button>
        </form>

        <div class="text-center mt-4">
            <span class="footer-text">Belum punya akun?
                <a href="<?= base_url('users/create') ?>">Daftar</a>
            </span>
        </div>

        <div class="text-center border-top border-secondary mt-4">
            <a href="<?= base_url('restore') ?>" class="btn-restore">
                <i class="bi bi-database-fill-gear"></i> Pemulihan Sistem
            </a>
        </div>
    </div>

    <script>
        function togglePassword() {
            let pass = document.getElementById("password");
            let icon = document.getElementById("eyeIcon");

            if (pass.type === "password") {
                pass.type = "text";
                icon.classList.replace("bi-eye", "bi-eye-slash");
            } else {
                pass.type = "password";
                icon.classList.replace("bi-eye-slash", "bi-eye");
            }
        }
    </script>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>