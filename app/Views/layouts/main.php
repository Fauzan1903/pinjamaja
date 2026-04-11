<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url('assets/img/Logo.png') ?>">
    <title> PinjaminAja</title>


    <!-- Bootstrap CSS Lokal -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            font-family: "SF Pro", "Helvetica Neue", Helvetica, Arial, sans-serif;
            display: flex;
            min-height: 100vh;
            overflow-x: auto;
        }

        .sidebar {
            width: 200px;
            background-color: rgb(255, 221, 213);
            position: relative;
        }

        .content {
            flex-grow: 1;
            padding: 15px;
            background-color: #ffffff;
        }

        /* 🔥 Efek tombol menonjol */
        .btn {
            transition: all 0.2s ease-in-out;
        }

        /* Saat hover */
        .btn:hover {
            transform: scale(1.08) translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        /* Saat diklik */
        .btn:active {
            transform: scale(0.95);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* Sidebar menu */
        .sidebar .nav-link {
            color: #333;
            border-radius: 8px;
            margin: 5px;
            transition: 0.2s;
        }

        /* Hover */
        .sidebar .nav-link:hover {
            background-color: #ffe066;
            padding-left: 12px;
        }

        /* Active menu */
        .sidebar .nav-link.active {
            background-color: #ffc107;
            font-weight: bold;
            color: black !important;
        }

        /* Judul sidebar */
        .sidebar h5 {
            font-weight: bold;
            margin-top: 10px;
        }

        .sidebar .nav-link {
            transform: translateX(0);
        }

        .sidebar .nav-link:hover {
            transform: translateX(5px);
        }

        /* Sidebar collapse */
        .sidebar {
            transition: 0.3s;
        }

        /* Saat collapse */
        .sidebar.collapsed {
            width: 70px;
        }

        /* Sembunyikan teks saat collapse */
        .sidebar.collapsed .nav-link span {
            display: none;
        }

        /* Center icon */
        .sidebar.collapsed .nav-link {
            text-align: center;
        }

        .card img {
            transition: 0.3s;
        }

        .card img:hover {
            transform: scale(1.1);
        }

        .dropdown-toggle {
            cursor: pointer;
        }
    </style>

</head>

<body>
    <!-- Sidebar -->
    <div id="sidebar " class="sidebar no-print">
        <?php include(APPPATH . 'Views/layouts/menu.php'); ?>
    </div>

    <!-- Konten Utama -->
    <div class="content">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- Bootstrap JS Lokal -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

</body>

</html>