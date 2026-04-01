<ul class="nav flex-column mt-3">
    <li class="nav-item">
        <a class="nav-link" href="#">
            <b>PinjaminAja</b> <i class="bi bi-yelp"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/') ?>">
            <i class="bi bi-house"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/users') ?>">
            <i class="bi bi-person"></i> <span>Users</span>
        </a>
    </li>
    <?php $idu = session('id_user'); ?>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('users/edit/' . $idu) ?>">
            <i class="bi bi-gear"></i> <span>Setting</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/logout') ?>">
            <i class="bi bi-box-arrow-left"></i> <span>Logout</span>
        </a>
    </li>
</ul>
<li class="nav-item mt-3">
    <span class="nav-link disabled">Masuk sebagai: <b><?= session('nama'); ?> (<?= session('role'); ?>)</b></span>
</li>

<center>
    <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" height="80" class="mt-3 rounded-circle" />
</center>