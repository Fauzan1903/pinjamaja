<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS Lokal -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/vaficon.png') ?>">

    <style>
        /* 1. Pengaturan Dasar & Font Modern */
        :root {
            --sidebar-bg: #1e1e2d;
            /* Warna gelap elegan */
            --sidebar-color: #a2a3b7;
            --active-bg: #2b2b40;
            --active-color: #ffffff;
            --accent-color: #4e73df;
            /* Warna biru aksen */
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fc;
            margin: 0;
        }

        /* 2. Sidebar Minimalis */
        .sidebar {
            width: 240px;
            /* Sedikit lebih lebar agar teks tidak sesak */
            background-color: var(--sidebar-bg);
            color: var(--sidebar-color);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
            z-index: 100;
        }

        .content {
            flex-grow: 1;
            padding: 30px;
            background-color: #f8f9fc;
            min-width: 0;
            /* Mencegah overflow */
        }

        .sidebar .nav-link {
            color: var(--sidebar-color);
            padding: 12px 20px;
            margin: 4px 12px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            /* Jarak antara ikon dan teks */
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        /* Hover State */
        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--active-color);
            transform: translateX(4px);
        }

        /* Active State */
        .sidebar .nav-link.active {
            background-color: var(--accent-color) !important;
            color: white !important;
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.3);
        }

        /* Ikon di dalam Sidebar */
        .sidebar .nav-link i {
            font-size: 1.1rem;
            transition: 0.2s;
        }

        /* 4. Branding & Teks */
        .sidebar h5 {
            color: white;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 20px 25px 10px;
            margin: 0;
            opacity: 0.5;
        }

        /* 5. Collapse Mode (Mode Kecil) */
        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar.collapsed .nav-link span,
        .sidebar.collapsed h5 {
            display: none;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 15px 0;
            margin: 4px 15px;
        }

        /* 6. Animasi Tombol Global */
        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 8px 18px;
            transition: all 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Notif Counter agar lebih modern */
        #notif-counter {
            background-color: #e74a3b;
            color: white;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 50px;
            border: 2px solid var(--sidebar-bg);
        }

        /* Card Styling agar serasi */
        .card {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            border-radius: 12px;
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