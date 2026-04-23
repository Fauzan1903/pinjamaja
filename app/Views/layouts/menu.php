<div id="sidebar" class="sidebar no-print">
    <div class="p-3">

        <!-- LOGO -->
        <div class="text-center mb-4">
            <img src="<?= base_url('assets/img/vaficon.png') ?>" width="60">
            <h5>PinjaminAja</h5>
        </div>

        <div class="text-center mb-4">
            <!-- FOTO USER -->
            <div class="avatar-container dropdown">
                <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                    <?php if (session()->get('foto')): ?>
                        <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" class="rounded-circle shadow-sm" width="70" height="70" style="object-fit: cover; border: 2px solid rgba(255,255,255,0.2);">
                    <?php else: ?>
                        <img src="<?= base_url('assets/img/user.png') ?>" class="rounded-circle shadow-sm" width="65">
                    <?php endif; ?>
                </a>

                <ul class="dropdown-menu dropdown-menu-dark shadow border-0 p-2 mt-2" style="border-radius: 15px; min-width: 200px;">
                    <li>
                        <h6 class="dropdown-header">Menu Akun</h6>
                    </li>
                    <li>
                        <a class="dropdown-item rounded-3 p-2" href="<?= base_url('profile/edit') ?>">
                            <i class="bi bi-person-gear me-2"></i> Pengaturan Profil
                        </a>
                    </li>
                    <?php if (session()->get('role') == 'admin') : ?>
                        <li>
                            <a class="dropdown-item rounded-3 p-2 text-success" href="<?= base_url('/backup') ?>">
                                <i class="bi bi-database-down me-2"></i> Backup Data
                            </a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <hr class="dropdown-divider border-secondary">
                    </li>
                    <li>
                        <a class="dropdown-item rounded-3 p-2 text-danger" href="<?= base_url('logout') ?>">
                            <i class="bi bi-box-arrow-right me-2"></i> Keluar
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



        </ul>

    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("collapsed");
    }
</script>