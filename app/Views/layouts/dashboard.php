<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="icon" href="<?= base_url('assets/img/Logo.png') ?>">

<div class="container-fluid">

    <!-- HEADER -->
    <div class="mb-4">
        <h3>Dashboard</h3>
        <p class="text-muted">Selamat datang, <?= session()->get('nama') ?></p>

    </div>

    <!-- INFO USER -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-body d-flex align-items-center gap-4 flex-wrap">
                    <div class="d-flex align-items-center">
                        <?php if (session()->get('foto')): ?>
                            <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" alt="Foto user" class="rounded-circle" width="80" height="80" style="object-fit: cover;">
                        <?php else: ?>
                            <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center" style="width:80px; height:80px;">
                                <i class="bi bi-person-fill fs-3"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <h5 class="mb-1">Info User</h5>
                        <p class="mb-1"><strong>Nama:</strong> <?= session()->get('nama') ?></p>
                        <p class="mb-1"><strong>Username:</strong> <?= session()->get('username') ?></p>
                        <p class="mb-0"><strong>Role:</strong> <?= ucfirst(session()->get('role')) ?></p>
                        <p class="mb-0"><strong>Nomor HP:</strong> <?= session()->get('no_hp') ?? '-' ?></p>
                        <p class="mb-0"><strong>Email:</strong> <?= session()->get('email') ?? '-' ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STATISTIK -->
    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card shadow border-0">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Total Alat</h6>
                        <h3><?= $total_alat ?? 0 ?></h3>
                    </div>
                    <i class="bi bi-tools fs-1 text-primary"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow border-0">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Total User</h6>
                        <h3><?= $total_user ?? 0 ?></h3>
                    </div>
                    <i class="bi bi-people fs-1 text-success"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow border-0">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Total Peminjaman</h6>
                        <h3><?= $total_pinjam ?? 0 ?></h3>
                    </div>
                    <i class="bi bi-arrow-left-right fs-1 text-warning"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- STATUS ALAT -->
    <div class="row mt-4">

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    Alat Tersedia
                </div>
                <div class="card-body">
                    <h4><?= $alat_tersedia ?? 0 ?></h4>
                    <small class="text-muted">Jumlah alat yang siap dipinjam</small>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    Alat Habis
                </div>
                <div class="card-body">
                    <h4><?= $alat_habis ?? 0 ?></h4>
                    <small class="text-muted">Stok kosong</small>
                </div>
            </div>
        </div>

    </div>

    <!-- RECENT ACTIVITY -->
    <div class="card shadow mt-4">
        <div class="card-header bg-dark text-white">
            Aktivitas Terbaru
        </div>
        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Alat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recent)): ?>
                        <?php foreach ($recent as $r): ?>
                            <tr>
                                <td><?= $r['nama_user'] ?></td>
                                <td><?= $r['nama_alat'] ?></td>
                                <td>
                                    <span class="badge bg-success"><?= $r['status'] ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada aktivitas</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>




<?= $this->endSection() ?>