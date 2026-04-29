<div id="sidebar" class="sidebar no-print">

    <!-- KIRI (LOGO + MENU) -->
    <div class="d-flex align-items-center gap-4 w-100">

        <!-- LOGO -->
        <div class="d-flex align-items-center gap-2">
            <img src="<?= base_url('assets/img/vaficon.png') ?>" width="40">
            <strong class="text-white">PinjaminAja</strong>
        </div>

        <!-- MENU -->
        <ul class="nav">
            <li class="nav-item">
                <a href="<?= base_url('dashboard') ?>" class="nav-link <?= uri_string() == 'dashboard' ? 'active' : '' ?>">
                    <i class="bi bi-house"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('alat') ?>" class="nav-link <?= uri_string() == 'alat' ? 'active' : '' ?>">
                    <i class="bi bi-tools"></i> Data Alat
                </a>
            </li>

            <?php if (session()->get('role') == 'petugas'): ?>
                <li class="nav-item position-relative">
                    <a href="<?= base_url('notifikasi') ?>" class="nav-link <?= uri_string() == 'notifikasi' ? 'active' : '' ?>">
                        <i class="bi bi-bell"></i> Notifikasi
                        <span id="notif-counter" class="badge bg-danger position-absolute top-0 start-100 translate-middle" style="display:none;">0</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('approval') ?>" class="nav-link <?= uri_string() == 'approval' ? 'active' : '' ?>">
                        <i class="bi bi-check-circle"></i> Approval
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



        </ul>


        <!--  PROFILE KANAN -->
        <div class="ms-auto dropdown">
            <a href="#" data-bs-toggle="dropdown" class="d-flex align-items-center gap-2 text-white text-decoration-none">

                <?php if (session()->get('foto')): ?>
                    <img src="<?= base_url('upload/users/' . session()->get('foto')) ?>" class="rounded-circle" width="35" height="35" style="object-fit:cover;">
                <?php else: ?>
                    <img src="<?= base_url('assets/img/user.png') ?>" class="rounded-circle" width="35">
                <?php endif; ?>

                <span><?= session()->get('nama') ?></span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                <li>
                    <a class="dropdown-item" href="<?= base_url('profile/edit') ?>">
                        <i class="bi bi-person-gear me-2"></i> Profil
                    </a>
                </li>

                <?php if (session()->get('role') == 'admin') : ?>
                    <li>
                        <a class="dropdown-item text-success" href="<?= base_url('/backup') ?>">
                            <i class="bi bi-database-down me-2"></i> Backup
                        </a>
                    </li>
                <?php endif; ?>

                <li>
                    <hr>
                </li>

                <li>
                    <a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("collapsed");
    }
</script>