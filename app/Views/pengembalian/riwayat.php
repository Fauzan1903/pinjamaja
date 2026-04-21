<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">

<style>
    body {
        background-color: #f1f3f6;
        font-family: 'Inter', sans-serif;
        color: #334155;
    }

    .page-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        color: #1e293b;
        font-size: 1.25rem;
        letter-spacing: -0.5px;
    }

    /* Card Container untuk Tabel */
    .table-container {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    /* Styling Tabel Modern & Compact */
    .table {
        margin-bottom: 0;
        font-size: 0.85rem;
        /* Ukuran teks lebih kecil & profesional */
    }

    .table thead {
        background-color: #334155;
        /* Slate Gray sesuai permintaan sebelumnya */
        color: #ffffff;
    }

    .table thead th {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 1px;
        padding: 12px 15px;
        border: none;
    }

    .table tbody td {
        padding: 12px 15px;
        vertical-align: middle;
        color: #475569;
        border-bottom: 1px solid #f1f5f9;
    }

    .table tbody tr:hover {
        background-color: #f8fafc;
        /* Efek hover halus */
    }

    /* Styling Badge Status */
    .badge-status {
        font-size: 0.7rem;
        font-weight: 700;
        padding: 5px 10px;
        border-radius: 6px;
        text-transform: uppercase;
    }

    .bg-success-subtle {
        background-color: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .bg-warning-subtle {
        background-color: #fef9c3;
        color: #854d0e;
        border: 1px solid #fef08a;
    }

    /* Denda Styling */
    .text-denda {
        font-weight: 600;
        color: #dc2626;
    }

    .text-no-denda {
        color: #94a3b8;
    }

    /* No Index Column */
    .col-no {
        width: 50px;
        text-align: center;
        font-weight: 600;
        color: #94a3b8;
    }
</style>

<div class="container mt-4">
    <div class="d-flex align-items-center mb-4">
        <div class="bg-dark rounded-3 p-2 me-3 shadow-sm">
            <i class="bi bi-clock-history text-white"></i>
        </div>
        <h3 class="page-title mb-0">Riwayat Peminjaman</h3>
    </div>

    <div class="table-container shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th class="col-no">#</th>
                        <th>ID Alat</th>
                        <th>Qty</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th class="text-end">Denda</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($riwayat)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($riwayat as $r): ?>
                            <tr>
                                <td class="text-center col-no"><?= $no++ ?></td>
                                <td class="fw-bold text-dark">
                                    <i class="bi bi-hash small"></i><?= $r['id_alat'] ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border"><?= $r['jumlah'] ?></span>
                                </td>
                                <td class="text-center small">
                                    <i class="bi bi-calendar-event me-1 opacity-50"></i>
                                    <?= date('d M Y', strtotime($r['data_peminjam'])) ?>
                                </td>
                                <td class="text-center small">
                                    <i class="bi bi-calendar-check me-1 opacity-50"></i>
                                    <?= $r['data_dikembalikan'] ? date('d M Y', strtotime($r['data_dikembalikan'])) : '-' ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge-status <?= $r['status'] == 'dikembalikan' ? 'bg-success-subtle' : 'bg-warning-subtle' ?>">
                                        <i class="bi <?= $r['status'] == 'dikembalikan' ? 'bi-check2' : 'bi-hourglass-split' ?> me-1"></i>
                                        <?= $r['status'] ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <span class="<?= ($r['denda'] ?? 0) > 0 ? 'text-denda' : 'text-no-denda' ?>">
                                        <?= ($r['denda'] ?? 0) > 0 ? 'Rp ' . number_format($r['denda'], 0, ',', '.') : 'Rp 0' ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-clipboard-x fs-1 d-block mb-2"></i>
                                Belum ada riwayat transaksi.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>