<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">

<style>
    body {
        background-color: #f1f3f6;
        font-family: 'Inter', sans-serif;
    }

    .print-area {
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }

    /* Header Laporan */
    .report-header {
        border-bottom: 3px solid #334155;
        padding-bottom: 20px;
        margin-bottom: 30px;
    }

    .report-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        color: #1e293b;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Info Section */
    .info-text {
        font-size: 0.85rem;
        color: #64748b;
    }

    /* Table Styling */
    .table {
        font-size: 0.85rem;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead th {
        background-color: #334155 !important;
        color: #ffffff !important;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        padding: 12px;
        border: none;
    }

    .table tbody td {
        padding: 12px;
        vertical-align: middle;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
    }

    /* Badge Status Clean */
    .badge-status {
        font-size: 0.7rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 5px;
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
    }

    /* Print Button Modern */
    .btn-print {
        background-color: #1e293b;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-print:hover {
        background-color: #000;
        color: white;
        transform: translateY(-2px);
    }

    @media print {
        body {
            background: white;
        }

        .print-area {
            box-shadow: none;
            border: none;
            padding: 0;
        }

        .no-print {
            display: none !important;
        }

        .table thead th {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            background-color: #334155 !important;
            color: white !important;
        }
    }
</style>

<div class="container mt-5 mb-5">

    <div class="no-print d-flex justify-content-between align-items-center mb-4">
        <a href="javascript:history.back()" class="text-decoration-none text-muted small">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <button onclick="window.print()" class="btn btn-print shadow-sm">
            <i class="bi bi-printer me-2"></i> Cetak Laporan (PDF)
        </button>
    </div>

    <div class="print-area">
        <div class="report-header d-flex justify-content-between align-items-end">
            <div>
                <h2 class="report-title mb-1">PinjaminAja</h2>
                <p class="text-muted small mb-0">Sistem Manajemen Inventaris Alat</p>
            </div>
            <div class="text-end">
                <h4 class="fw-bold mb-0" style="color: #334155;">LAPORAN PEMINJAMAN</h4>
                <p class="info-text mb-0">Periode: <?= date('F Y') ?></p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-6 info-text">
                <strong>Dicetak oleh:</strong> Admin Sistem<br>
                <strong>Tanggal Cetak:</strong> <?= date('d M Y, H:i') ?>
            </div>
            <div class="col-6 text-end info-text">
                <strong>Status Dokumen:</strong> Dokumen Resmi Digital
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="text-center">
                    <tr>
                        <th width="50">No</th>
                        <th class="text-start">Nama Pengguna</th>
                        <th class="text-start">Nama Alat</th>
                        <th class="text-center" width="80">Denda</th>
                        <th width="80">Qty</th>
                        <th>Tanggal Pinjam</th>
                        <th width="120">Status</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($peminjaman)): ?>
                        <?php $no = 1;
                        foreach ($peminjaman as $p): ?>
                            <tr>
                                <td class="text-center fw-bold text-muted"><?= $no++ ?></td>
                                <td class="fw-semibold"><?= $p['nama_user'] ?? '-' ?></td>
                                <td><?= $p['nama_alat'] ?? '-' ?></td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border"><?= $p['denda'] ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border"><?= $p['jumlah'] ?></span>
                                <td class="text-center">
                                    <i class="bi bi-calendar3 me-1 opacity-50"></i>
                                    <?= date('d/m/Y', strtotime($p['data_peminjam'])) ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge-status text-capitalize">
                                        <?= $p['status'] ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Tidak ada data peminjaman.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-5 pt-4 d-none d-print-block">
            <div class="row">
                <div class="col-8"></div>
                <div class="col-4 text-center">
                    <p class="mb-5 small">Petugas Inventaris,</p>
                    <p class="fw-bold mb-0 border-top pt-2">( ......................... )</p>
                    <p class="info-text">NIP. ___________________</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>