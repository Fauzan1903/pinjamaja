<div id="sidebar" class="sidebar no-print">
    <div class="p-3">

        <!-- LOGO -->
        <div class="text-center mb-4">
            <img src="<?= base_url('assets/img/vaficon.png') ?>" width="60">
            <h5>PinjaminAja</h5>
        </div>

        <div class="text-center mb-4">
            <!-- FOTO USER -->
            <div class="text-center mb-4 dropdown">
                <a class="d-block text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <!-- FOTO -->
                    <?php if (session()->get('foto')): ?>
                        <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" class="rounded-circle mb-2" width="70" height="70" style="object-fit: cover;">
                    <?php else: ?>
                        <img src="<?= base_url('assets/img/user.png') ?>" class="rounded-circle mb-2" width="60">
                    <?php endif; ?>

                    <!-- NAMA -->
                    <div><strong><?= session()->get('nama') ?></strong></div>
                    <small class="text-muted">Masuk sebagai: <?= session()->get('role') ?></small>
                </a>
                <?php $idu = session('id'); ?>

                <!-- DROPDOWN MENU -->
                <ul class="dropdown-menu text-center">
                    <li>
                        <a class="dropdown-item" href="<?= base_url('profile') ?>">
                            <i class="bi bi-person"></i> Lihat Profil
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="<?= base_url('dashboard') ?>" class="nav-link <?= uri_string() == 'dashboard' ? 'active' : '' ?>">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('alat') ?>" class="nav-link <?= uri_string() == 'alat' ? 'active' : '' ?>">
                    <i class="bi bi-tools"></i> <span>Data Alat</span>
                </a>
            </li>

            <?php if (session()->get('role') == 'petugas'): ?>
                <li class="nav-item">
                    <a href="<?= base_url('notifikasi') ?>" class="nav-link <?= uri_string() == 'notifikasi' ? 'active' : '' ?> position-relative">
                        <i class="bi bi-bell"></i> <span>Notifikasi</span>
                        <span id="notif-counter" class="badge bg-danger position-absolute top-0 start-100 translate-middle" style="display: none;">0</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('approval') ?>" class="nav-link <?= uri_string() == 'approval' ? 'active' : '' ?>">
                        <i class="bi bi-check-circle"></i> <span>Approval</span>
                    </a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <a href="<?= base_url('pengembalian') ?>" class="nav-link <?= uri_string() == 'pengembalian' ? 'active' : '' ?>">
                    <i class="bi bi-arrow-return-left"></i> Pengembalian
                </a>
            </li>

            <?php if (session()->get('role') == 'admin'): ?>
                <li class="nav-item">
                    <a href="<?= base_url('users') ?>" class="nav-link <?= uri_string() == 'users' ? 'active' : '' ?>">
                        <i class="bi bi-people"></i> Users
                    </a>
                </li>
            <?php endif; ?>



            <hr>

            <li class="nav-item">
                <a href="<?= base_url('logout') ?>" class="nav-link text-danger">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </a>
            </li>
            <?php if (session()->get('role') == 'admin') : ?>
                <a href="<?= base_url('/backup') ?>" class="nav-link text-success"><i class="bi bi-download"></i>Backup Database</a>
            <?php endif; ?>
        </ul>

    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("collapsed");
    }
</script>