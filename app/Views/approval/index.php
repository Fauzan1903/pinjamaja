<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- HEADER -->
    <div class="mb-4">
        <h3>Approval Peminjaman</h3>
        <p class="text-muted">Kelola permintaan peminjaman alat</p>
    </div>

    <!-- ALERTS -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- DAFTAR PEMINJAMAN PENDING -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Permintaan Peminjaman Menunggu Approval</h5>
        </div>
        <div class="card-body">

            <?php if (!empty($peminjaman_pending)): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Peminjam</th>
                                <th>Alat</th>
                                <th>Jumlah</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($peminjaman_pending as $p): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <strong><?= $p['nama_peminjam'] ?></strong>
                                        <br><small class="text-muted">User: <?= $p['nama_user'] ?></small>
                                    </td>
                                    <td><?= $p['nama_alat'] ?></td>
                                    <td><?= $p['jumlah'] ?></td>
                                    <td><?= date('d/m/Y', strtotime($p['data_peminjam'])) ?></td>
                                    <td><?= date('d/m/Y', strtotime($p['data_dikembalikan'])) ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <form action="<?= base_url('approval/approve/' . $p['id_peminjam']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui peminjaman ini?')">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="bi bi-check-circle"></i> Setujui
                                                </button>
                                            </form>

                                            <form action="<?= base_url('approval/reject/' . $p['id_peminjam']) ?>" method="post" class="d-inline ms-1" onsubmit="return confirm('Apakah Anda yakin ingin menolak peminjaman ini?')">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-x-circle"></i> Tolak
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-check-circle-fill text-success fs-1 mb-3"></i>
                    <h5>Tidak ada permintaan peminjaman yang menunggu approval</h5>
                    <p class="text-muted">Semua permintaan sudah diproses</p>
                </div>
            <?php endif; ?>

        </div>
    </div>

</div>

<?= $this->endSection() ?>