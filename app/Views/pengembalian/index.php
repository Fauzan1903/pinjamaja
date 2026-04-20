<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="icon" href="<?= base_url('assets/img/vaficon.png') ?>">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #969696 0%, #3f3f3f 100%);
        --glass-bg: rgba(255, 255, 255, 0.95);
    }

    body {
        background-color: #f4f7fe;
    }

    /* Animasi Fade In */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    /* Header Styling */
    .dashboard-header {
        background: var(--primary-gradient);
        padding: 40px 25px;
        border-radius: 20px;
        color: white;
        margin-bottom: -50px;
        /* Offset untuk card overlap */
        box-shadow: 0 10px 20px rgba(118, 75, 162, 0.2);
    }

    /* Search Bar Glassmorphism */
    .glass-search {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        color: white !important;
    }

    .glass-search::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    /* Main Card */
    .main-card {
        background: var(--glass-bg);
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.8);
    }

    /* Table Improvements */
    .table-modern thead th {
        background-color: transparent;
        border-bottom: 2px solid #f1f4f8;
        color: #adb5bd;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 1px;
    }

    .table-modern tbody tr {
        transition: all 0.3s ease;
    }

    .table-modern tbody tr:hover {
        background-color: #f8faff;
        transform: scale(1.005);
    }

    /* Status Pills */
    .status-pill {
        padding: 5px 15px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-block;
    }

    .bg-soft-success {
        background: #e6fffa;
        color: #38b2ac;
    }

    .bg-soft-warning {
        background: #fffaf0;
        color: #ed8936;
    }

    /* Action Buttons */
    .btn-icon {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all 0.2s;
    }

    .btn-icon:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }
</style>

<div class="container-fluid py-4 px-4">

    <div class="dashboard-header animate-up">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold mb-1">Manajemen Pengembalian</h2>
                <p class="opacity-75 mb-0">Pantau dan verifikasi pengembalian alat secara real-time.</p>
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
                <form method="get">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control glass-search ps-4 py-2" placeholder="Cari data peminjaman...">
                        <button class="btn btn-white shadow-sm px-4" type="submit" style="border-radius: 0 12px 12px 0; background: white;">
                            <i class="bi bi-search text-primary"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="main-card animate-up mt-5 p-4">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
                <i class="bi bi-check-all me-2"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-modern align-middle border-0">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th class="text-start">User & Inventaris</th>
                        <th>Kuantitas</th>
                        <th>Timeline</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                        <th>Social</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($peminjaman as $p): ?>
                        <tr>
                            <td class="text-center text-muted fw-bold"><?= $no++ ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-box me-3 bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="bi bi-box-seam text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark"><?= $p['nama_user'] ?? $p['nama_peminjam'] ?? 'Guest' ?></div>
                                        <small class="text-muted"><?= $p['nama_alat'] ?></small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="fw-bold text-primary"><?= $p['jumlah'] ?> <small class="text-muted">Unit</small></span>
                            </td>
                            <td class="text-center">
                                <div class="small">
                                    <span class="text-success"><?= date('d M', strtotime($p['data_peminjam'])) ?></span>
                                    <i class="bi bi-arrow-right mx-1 text-muted"></i>
                                    <span class="text-danger fw-bold"><?= date('d M', strtotime($p['data_dikembalikan'])) ?></span>
                                </div>
                            </td>
                            <td class="text-center">
                                <?php if ($p['status'] == 'dikembalikan'): ?>
                                    <span class="status-pill bg-soft-success">Di kembalikan</span>
                                <?php else: ?>
                                    <span class="status-pill bg-soft-warning">Di pinjam</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if ($p['status'] == 'dikembalikan' && isset($p['denda'])): ?>
                                    <span class="<?= $p['denda'] > 0 ? 'text-danger fw-bold' : 'text-success' ?>">
                                        Rp <?= number_format($p['denda'], 0, ',', '.') ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (session()->get('role') == 'user' && $p['status'] != 'dikembalikan'): ?>
                                    <a href="<?= base_url('pengembalian/kembalikan/' . $p['id_peminjam']) ?>"
                                        class="btn btn-primary btn-sm px-3 rounded-pill shadow-sm"
                                        onclick="return confirm('Kembalikan alat ini?')">
                                        Kembalikan
                                    </a>
                                <?php endif; ?>

                                <?php if (session()->get('role') == 'admin'): ?>
                                    <a href="<?= base_url('pengembalian/delete/' . $p['id_peminjam']) ?>"
                                        class="btn btn-outline-danger btn-sm border-0 btn-icon"
                                        onclick="return confirm('Hapus data permanen?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="https://wa.me/?text=<?= urlencode('Info: ' . $p['nama_alat'] . ' - Status: ' . $p['status']) ?>"
                                        target="_blank" class="btn-icon bg-light text-success"><i class="bi bi-whatsapp"></i></a>

                                    <button onclick="copyLink('<?= base_url('pengembalian') ?>')"
                                        class="btn-icon bg-light text-secondary"><i class="bi bi-link-45deg"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function copyLink(link) {
        navigator.clipboard.writeText(link);
        // Toast sederhana
        const toast = document.createElement('div');
        toast.innerHTML = 'Link Copied!';
        toast.style = 'position:fixed; bottom:20px; right:20px; background:#333; color:#fff; padding:10px 20px; border-radius:10px; z-index:10000;';
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 2000);
    }
</script>

<?= $this->endSection() ?>