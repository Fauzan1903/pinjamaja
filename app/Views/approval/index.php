<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Styling Card & Shadow */
    .card-approval {
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        background: #fff;
    }

    .card-header-custom {
        background: #fff;
        border-bottom: 1px solid #f0f0f0;
        padding: 20px 25px;
        border-radius: 12px 12px 0 0 !important;
    }

    /* Table Styling */
    .table thead th {
        background-color: #f8f9fa;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        border: none;
        padding: 15px;
    }

    .table tbody td {
        padding: 18px 15px;
        vertical-align: middle;
        font-size: 14px;
        border-bottom: 1px solid #f8f9fa;
    }

    /* Badge & Information Styling */
    .info-user {
        font-size: 12px;
        color: #adb5bd;
    }

    .alat-name {
        font-weight: 600;
        color: #2d3436;
    }

    .date-badge {
        background: #eef2f7;
        color: #495057;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
    }

    /* Button Action Modern */
    .btn-action {
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
        padding: 8px 15px;
        transition: 0.3s;
    }

    .btn-approve {
        background-color: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .btn-approve:hover {
        background-color: #059669;
        color: #fff;
    }

    .btn-reject {
        background-color: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .btn-reject:hover {
        background-color: #dc2626;
        color: #fff;
    }

    .empty-state i {
        opacity: 0.3;
        display: block;
        margin-bottom: 15px;
    }
</style>

<div class="container-fluid py-4 px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Approval Peminjaman</h3>
            <p class="text-muted small mb-0">Kelola permintaan peminjaman alat secara real-time.</p>
        </div>
        <div class="badge bg-primary rounded-pill px-3 py-2">
            <?= count($peminjaman_pending ?? []) ?> Menunggu Proses
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger border-0 shadow-sm alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card card-approval">
        <div class="card-header-custom">
            <h5 class="mb-0 fw-bold text-dark">Daftar Permintaan</h5>
        </div>

        <div class="card-body p-0">
            <?php if (!empty($peminjaman_pending)): ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th>Peminjam</th>
                                <th>Detail Alat</th>
                                <th class="text-center">Jumlah</th>
                                <th>Periode Pinjam</th>
                                <th class="text-center">Konfirmasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($peminjaman_pending as $p): ?>
                                <tr>
                                    <td class="text-center text-muted"><?= $no++ ?></td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= $p['nama_peminjam'] ?></div>
                                        <div class="info-user"><i class="bi bi-person me-1"></i><?= $p['nama_user'] ?></div>
                                    </td>
                                    <td>
                                        <span class="alat-name text-primary"><?= $p['nama_alat'] ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border"><?= $p['jumlah'] ?> Unit</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="date-badge"><?= date('d/m/Y', strtotime($p['data_peminjam'])) ?></span>
                                            <i class="bi bi-arrow-right text-muted"></i>
                                            <span class="date-badge"><?= date('d/m/Y', strtotime($p['data_dikembalikan'])) ?></span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <form action="<?= base_url('approval/approve/' . $p['id_peminjam']) ?>" method="post" onsubmit="return confirm('Setujui permintaan peminjaman ini?')">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-action btn-approve d-flex align-items-center gap-1">
                                                    <i class="bi bi-check-lg"></i> Approve
                                                </button>
                                            </form>

                                            <form action="<?= base_url('approval/reject/' . $p['id_peminjam']) ?>" method="post" onsubmit="return confirm('Tolak permintaan peminjaman ini?')">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-action btn-reject d-flex align-items-center gap-1">
                                                    <i class="bi bi-x-lg"></i> Reject
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
                <div class="text-center py-5 empty-state">
                    <i class="bi bi-clipboard2-check fs-1 text-muted"></i>
                    <h5 class="fw-bold">Tidak Ada Antrean</h5>
                    <p class="text-muted small">Semua permintaan peminjaman telah selesai diproses.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>