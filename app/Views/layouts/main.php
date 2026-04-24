<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/LOL.png') ?>">


    <style>
        :root {
            --sidebar-bg: #1e1e2d;

            --sidebar-color: #a2a3b7;
            --active-bg: #2b2b40;
            --active-color: #ffffff;
            --accent-color: #4e73df;

        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background-color: #f8f9fc;
            margin: 0;
        }

        /* 🔥 NAVBAR ATAS */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background: rgba(30, 30, 45, 0.95);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            padding: 0 20px;
            z-index: 999;
        }

        /* MENU HORIZONTAL */
        .sidebar .nav {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 10px;
        }

        /* 3. Link Menu Sidebar */
        .sidebar .nav-link {
            color: var(--sidebar-color);
            padding: 8px 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            transition: 0.2s;
        }


        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.08);
            color: white;
        }



        .sidebar .nav-link.active {
            background-color: var(--accent-color);
            color: white;
        }

        /* 🔥 PROFILE KANAN */
        .profile-area {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
        }

        .profile-area img {
            width: 35px;
            height: 35px;
            object-fit: cover;
            border-radius: 50%;
        }

        /*  CONTENT TURUN */
        .content {
            margin-top: 80px;
            padding: 25px;
        }

        /* NOTIF COUNTER */
        #notif-counter {
            background-color: #e74a3b;
            color: white;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 50px;
            border: 2px solid var(--sidebar-bg);
        }

        /* CARD */
        .card {
            border: none;
            box-shadow: 0 0.15rem 1.75rem rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }
    </style>
</head>

<body>

    <!-- NAVBAR (SIDEBAR JADI ATAS) -->
    <div class="sidebar">
        <?php include(APPPATH . 'Views/layouts/menu.php'); ?>

        <!--  PROFILE -->
        <div class="profile-area">
            <?php if (session()->get('foto')): ?>
                <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>">
            <?php else: ?>
                <img src="<?= base_url('assets/img/user.png') ?>">
            <?php endif; ?>
            <span><?= session()->get('nama') ?></span>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- JS -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Script untuk notifikasi counter dan browser notification -->
    <script>
        let lastNotifikasiCount = 0;
        let notifikasiData = [];

        // Request permission untuk browser notification
        function requestNotificationPermission() {
            if ('Notification' in window) {
                Notification.requestPermission();
            }
        }

        function showBrowserNotification(notifikasi) {
            if ('Notification' in window && Notification.permission === 'granted') {
                const notification = new Notification('PinjaminAja', {
                    body: notifikasi.pesan,
                    icon: '<?= base_url('assets/img/Logo.png') ?>'
                });

                notification.onclick = function() {
                    window.focus();
                    window.location.href = '<?= base_url('notifikasi') ?>';
                    notification.close();
                };
            }
        }

        // Fungsi untuk update counter notifikasi
        function updateNotifikasiCounter() {
            fetch('<?= base_url('api/notifikasi') ?>')
                .then(res => res.json())
                .then(data => {
                    const counter = document.getElementById('notif-counter');

                    if (data.length > lastNotifikasiCount) {
                        const newNotif = data.find(n => !notifikasiData.some(o => o.id_notifikasi === n.id_notifikasi));
                        if (newNotif) showBrowserNotification(newNotif);
                    }

                    if (data.length > 0) {
                        counter.textContent = data.length;
                        counter.style.display = 'inline-block';
                    } else {
                        counter.style.display = 'none';
                    }

                    lastNotifikasiCount = data.length;
                    notifikasiData = data;
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Request notification permission
            requestNotificationPermission();

            // Update counter saat halaman load
            updateNotifikasiCounter();

            // Show permission button if neede
            setInterval(updateNotifikasiCounter, 10000);
        });
    </script>

    <!-- Tombol permission notification (akan ditampilkan via JavaScript) -->


</body>



</html>