<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS Lokal -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/Logo.png') ?>">


    <style>
        body {
            font-family: "SF Pro", "Helvetica Neue", Helvetica, Arial, sans-serif;
            display: flex;
            min-height: 100vh;
            overflow-x: auto;
        }

        .sidebar {
            width: 200px;
            background-color: rgb(218, 216, 216);
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
            background-color: #818080;
            padding-left: 12px;
        }

        /* Active menu */
        .sidebar .nav-link.active {
            background-color: #818080;
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

        /* Notification badge animation */
        #notif-counter {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Browser notification styling (for supported browsers) */
        .notification-denda {
            border-left: 4px solid #dc3545 !important;
        }

        .notification-denda .notification-icon {
            color: #dc3545;
            font-size: 1.2em;
        }

        /* Custom notification button */
        .notification-permission-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            display: none;
        }

        .notification-permission-btn.show {
            display: block;
        }

        .card {
            border-radius: 12px;
        }

        .card:hover {
            transform: translateY(-5px);
            transition: 0.3s;
        }

        .input-group .btn {
            transition: 0.2s;
        }

        .input-group .btn:hover {
            transform: scale(1.1);
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

    <!-- Script untuk notifikasi counter dan browser notification -->
    <script>
        let lastNotifikasiCount = 0;
        let notifikasiData = [];

        // Request permission untuk browser notification
        function requestNotificationPermission() {
            if ('Notification' in window) {
                Notification.requestPermission().then(function(permission) {
                    if (permission === 'granted') {
                        console.log('Notification permission granted');
                    } else {
                        console.log('Notification permission denied');
                    }
                });
            }
        }

        // Fungsi untuk menampilkan browser notification
        function showBrowserNotification(notifikasi) {
            if ('Notification' in window && Notification.permission === 'granted') {
                const options = {
                    body: notifikasi.pesan.length > 100 ? notifikasi.pesan.substring(0, 100) + '...' : notifikasi.pesan,
                    icon: '<?= base_url('assets/img/Logo.png') ?>',
                    badge: '<?= base_url('assets/img/Logo.png') ?>',
                    tag: 'pinjamaja-notif-' + notifikasi.id_notifikasi,
                    requireInteraction: notifikasi.pesan.includes('Pemberitahuan Denda'), // Notifikasi denda tetap tampil sampai di-click
                    silent: false
                };

                // Tambahkan styling khusus untuk notifikasi denda
                if (notifikasi.pesan.includes('Pemberitahuan Denda')) {
                    options.icon = '<?= base_url('assets/img/warning-icon.png') ?>'; // Jika ada icon warning
                    options.body = '' + options.body;
                }

                const notification = new Notification('PinjaminAja - Notifikasi', options);

                // Auto close setelah 5 detik untuk notifikasi biasa
                if (!notifikasi.pesan.includes('Pemberitahuan Denda')) {
                    setTimeout(() => {
                        notification.close();
                    }, 5000);
                }

                // Klik notification untuk redirect ke halaman notifikasi
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
                .then(response => response.json())
                .then(data => {
                    const counter = document.getElementById('notif-counter');
                    const currentCount = data.length;

                    // Cek apakah ada notifikasi baru
                    if (currentCount > lastNotifikasiCount && lastNotifikasiCount > 0) {
                        // Cari notifikasi baru
                        const newNotifikasi = data.find(notif => !notifikasiData.some(old => old.id_notifikasi === notif.id_notifikasi));

                        if (newNotifikasi) {
                            // Tampilkan browser notification untuk notifikasi baru
                            showBrowserNotification(newNotifikasi);

                            // Play sound untuk notifikasi denda
                            if (newNotifikasi.pesan.includes('Pemberitahuan Denda')) {
                                playDendaSound();
                            }
                        }
                    }

                    // Update counter
                    if (currentCount > 0) {
                        counter.textContent = currentCount;
                        counter.style.display = 'inline-block';
                    } else {
                        counter.style.display = 'none';
                    }

                    // Update data notifikasi
                    notifikasiData = data;
                    lastNotifikasiCount = currentCount;
                })
                .catch(error => console.error('Error:', error));
        }

        // Fungsi untuk memainkan suara notifikasi denda
        function playDendaSound() {
            // Buat audio context untuk suara warning
            try {
                const audioContext = new(window.AudioContext || window.webkitAudioContext)();
                const oscillator = audioContext.createOscillator();
                const gainNode = audioContext.createGain();

                oscillator.connect(gainNode);
                gainNode.connect(audioContext.destination);

                oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
                oscillator.frequency.setValueAtTime(600, audioContext.currentTime + 0.1);
                oscillator.frequency.setValueAtTime(800, audioContext.currentTime + 0.2);

                gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
                gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);

                oscillator.start(audioContext.currentTime);
                oscillator.stop(audioContext.currentTime + 0.5);
            } catch (e) {
                // Fallback: gunakan HTML5 audio jika tersedia
                console.log('Audio notification not supported');
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Request notification permission
            requestNotificationPermission();

            // Update counter saat halaman load
            updateNotifikasiCounter();

            // Update counter setiap 10 detik untuk semua user
            setInterval(updateNotifikasiCounter, 10000);
        });

        // Fungsi untuk menampilkan tombol permission notification
        function showNotificationPermissionButton() {
            if ('Notification' in window && Notification.permission === 'default') {
                // Buat tombol permission
                const button = document.createElement('button');
                button.className = 'btn btn-warning notification-permission-btn';
                button.innerHTML = '<i class="bi bi-bell"></i> Izinkan Notifikasi';
                button.onclick = function() {
                    requestNotificationPermission();
                    button.remove();
                };

                document.body.appendChild(button);

                // Tampilkan tombol setelah 3 detik
                setTimeout(() => {
                    button.classList.add('show');
                }, 3000);
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Request notification permission
            requestNotificationPermission();

            // Show permission button if needed
            showNotificationPermissionButton();

            // Update counter saat halaman load
            updateNotifikasiCounter();

            // Update counter setiap 10 detik untuk semua user
            setInterval(updateNotifikasiCounter, 10000);
        });
    </script>

    <!-- Tombol permission notification (akan ditampilkan via JavaScript) -->

</body>

</html>