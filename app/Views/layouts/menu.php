<ul class="nav flex-column mt-3">
    <li class="nav-item">
        <a class="nav-link" href="#">
            <b>PinjaminAja</b> <i class="bi bi-send"></i>
        </a>
    </li>
    <center>
        <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" height="50" rounded-circle" />
    </center>
    <li class="nav-item mt-3">
        <span class="nav-link disabled">Masuk sebagai: <b><?= session('nama'); ?> (<?= session('role'); ?>)</b></span>

    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/dashboard') ?>">
            <i class="bi bi-house-door"></i></i> <span>Dasboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/alat') ?>">
            <i class="bi bi-tools"></i> <span>Alat</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/users') ?>">
            <i class="bi bi-person"></i> <span>Users</span>
        </a>
    </li>
    <?php $idu = session('id_user'); ?>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/logout') ?>">
            <i class="bi bi-box-arrow-left"></i> <span>Logout</span>
        </a>
    </li>

</ul>