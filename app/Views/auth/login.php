<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - PinjaminAja</title>

    <link rel="icon" href="<?= base_url('assets/img/Logo.png') ?>">
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            background: linear-gradient(135deg, #979696, #7c7c7c);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-box {
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 30px;
            width: 350px;
            color: #fff;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-control {
            background: transparent;
            border: none;
            border-bottom: 1px solid #fff;
            color: #fff;
        }

        .form-control:focus {
            box-shadow: none;
            border-bottom: 1px solid #00f2fe;
        }

        .input-group-text {
            background: transparent;
            border: none;
            color: #fff;
        }

        .btn-login {
            background: #ffffff;
            border: none;
            color: #000;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-login:hover {
            transform: scale(1.05);
            background: #000000;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .toggle-eye {
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="login-box">

        <div class="logo">PinjaminAja</div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('salahpw')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('salahpw') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('/proses-login') ?>" method="post">

            <!-- Username -->
            <div class="mb-3 input-group">
                <span class="input-group-text ">
                    <i class="bi bi-person"></i>
                </span>
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>

            <!-- Password -->
            <div class="mb-3 input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock"></i>
                </span>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                <span class="input-group-text toggle-eye" onclick="togglePassword()">
                    <i class="bi bi-eye" id="eyeIcon"></i>
                </span>
            </div>

            <!-- Button -->
            <button class="btn btn-login w-100 mb-2">
                Login
            </button>

        </form>

        <div class="text-center mt-2">
            <small>Belum punya akun?
                <a href="<?= base_url('users/create') ?>" class="text-white">Daftar</a>
            </small>
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