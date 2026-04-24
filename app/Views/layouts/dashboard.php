<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link rel="icon" href="<?= base_url('assets/img/vaficon.png') ?>">

<style>
    /* Professional Corporate Style */
    :root {
        --primary-color: #1e3a8a;
        --secondary-color: #3b82f6;
        --success-color: #059669;
        --danger-color: #dc2626;
        --warning-color: #d97706;
        --info-color: #0ea5e9;
        --dark-color: #1f2937;
        --light-color: #f8fafc;
        --border-color: #e2e8f0;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    }

    * {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .container-fluid {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        min-height: 100vh;
    }

    /* Professional Card Design */
    .card {
        border: 1px solid var(--border-color);
        border-radius: 16px;
        background: #ffffff;
        box-shadow: var(--shadow-md);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-xl);
        border-color: var(--secondary-color);
    }

    /* Professional Header */
    .welcome-text {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.2;
    }

    /* Stat Cards - Corporate Style */
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 600;
        box-shadow: var(--shadow-md);
        border: 2px solid transparent;
    }

    .bg-light-primary {
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .bg-light-success {
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        color: var(--success-color);
        border-color: var(--success-color);
    }

    .bg-light-warning {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        color: var(--warning-color);
        border-color: var(--warning-color);
    }

    .bg-light-danger {
        background: linear-gradient(135deg, #fef2f2, #fecaca);
        color: var(--danger-color);
        border-color: var(--danger-color);
    }

    /* Profile Section */
    .profile-img-container {
        border: 4px solid #ffffff;
        box-shadow: var(--shadow-lg);
        transition: all 0.3s ease;
    }

    .profile-img-container:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-xl);
    }

    /* Professional Table */
    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border: none;
        border-bottom: 3px solid var(--border-color);
        font-weight: 600;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        color: var(--dark-color);
        padding: 1.25rem 1rem;
        text-transform: uppercase;
    }

    .table tbody td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        border-color: var(--border-color);
    }

    .table-hover tbody tr:hover {
        background-color: #f8fafc;
        transform: scale(1.01);
    }

    /* Status Cards */
    .card.border-start.border-4 {
        border-left-width: 5px !important;
        box-shadow: var(--shadow-lg);
    }

    /* Profile Info Labels */
    small.text-muted {
        font-weight: 500;
        color: #6b7280 !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.75rem;
    }

    /* Badges */
    .badge {
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
    }

    .bg-soft-primary {
        background: linear-gradient(135deg, #eff6ff, #dbeafe) !important;
        color: var(--primary-color) !important;
        border: 1px solid var(--primary-color);
    }

    /* Buttons */
    .btn-outline-primary {
        border: 2px solid var(--secondary-color);
        color: var(--primary-color);
        font-weight: 600;
        padding: 0.5rem 1.5rem;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    /* Date Badge */
    .badge.bg-light {
        background: #f1f5f9 !important;
        border: 1px solid var(--border-color);
        font-weight: 500;
        font-size: 0.9rem;
        padding: 0.75rem 1.25rem;
        border-radius: 10px;
    }

    /* Numbers */
    h2 {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Card Headers */
    .card-header {
        background: linear-gradient(135deg, #ffffff, #f8fafc) !important;
        border-bottom: 1px solid var(--border-color) !important;
        border-radius: 16px 16px 0 0 !important;
    }

    /* Responsive Typography */
    @media (max-width: 768px) {
        .welcome-text {
            font-size: 1.5rem;
        }

        h2 {
            font-size: 2rem;
        }
    }

    /* Empty State */
    .italic {
        font-style: italic;
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="welcome-text mb-1">Dashboard</h3>
            <p class="text-muted mb-0">Selamat datang kembali, <strong><?= session()->get('nama') ?></strong></p>
        </div>
        <div class="text-end">
            <span class="badge bg-light text-dark border p-2"><?= date('l, d M Y') ?></span>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <?php if (session()->get('foto')): ?>
                                <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" alt="Foto user" class="rounded-circle profile-img-container" width="100" height="100" style="object-fit: cover;">
                            <?php else: ?>
                                <div class="rounded-circle bg-light d-flex justify-content-center align-items-center profile-img-container" style="width:100px; height:100px;">
                                    <i class="bi bi-person text-secondary" style="font-size: 3rem;"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col mt-3 mt-md-0">
                            <h4 class="mb-3 text-primary">Informasi Pengguna</h4>
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <small class="text-muted d-block">Nama Lengkap</small>
                                    <p class="fw-bold mb-2"><?= session()->get('nama') ?></p>
                                    <small class="text-muted d-block">Username</small>
                                    <p class="fw-bold mb-0"><?= session()->get('username') ?></p>
                                </div>
                                <div class="col-md-4 col-sm-6 border-start-md">
                                    <small class="text-muted d-block">Role Akses</small>
                                    <p class="mb-2"><span class="badge bg-soft-primary border border-primary text-primary"><?= ucfirst(session()->get('role')) ?></span></p>
                                    <small class="text-muted d-block">Email</small>
                                    <p class="fw-bold mb-0"><?= session()->get('email') ?? '-' ?></p>
                                </div>
                                <div class="col-md-4 col-sm-6 border-start-md">
                                    <small class="text-muted d-block">Nomor WhatsApp</small>
                                    <p class="fw-bold mb-2 text-success"><?= session()->get('no_hp') ?? '-' ?></p>
                                    <small class="text-muted d-block">Status Akun</small>
                                    <p class="fw-bold mb-0 text-primary">Aktif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1 fw-bold">TOTAL ALAT</p>
                            <h2 class="mb-0 fw-bold"><?= $total_alat ?? 0 ?></h2>
                        </div>
                        <div class="stat-icon bg-light-primary">
                            <i class="bi bi-tools fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1 fw-bold">TOTAL USER</p>
                            <h2 class="mb-0 fw-bold"><?= $total_user ?? 0 ?></h2>
                        </div>
                        <div class="stat-icon bg-light-success">
                            <i class="bi bi-people fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1 fw-bold">PEMINJAMAN</p>
                            <h2 class="mb-0 fw-bold"><?= $total_pinjam ?? 0 ?></h2>
                        </div>
                        <div class="stat-icon bg-light-warning">
                            <i class="bi bi-arrow-left-right fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 border-start border-4 border-success h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon bg-light-success me-3">
                        <i class="bi bi-check-circle-fill fs-4"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">Alat Tersedia</h5>
                        <p class="mb-0 text-muted"><span class="h4 fw-bold text-dark"><?= $alat_tersedia ?? 0 ?></span> Unit siap dipinjam</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 border-start border-4 border-danger h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon bg-light-danger me-3">
                        <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 text-danger">Stok Habis</h5>
                        <p class="mb-0 text-muted"><span class="h4 fw-bold text-dark"><?= $alat_habis ?? 0 ?></span> Alat sedang tidak tersedia</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold"><i class="bi bi-clock-history me-2"></i> Aktivitas Terbaru</h5>
                <button class="btn btn-sm btn-outline-primary">Lihat Semua</button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">User</th>
                            <th>Alat</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($recent)): ?>
                            <?php foreach ($recent as $r): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-light d-flex justify-content-center align-items-center me-2" style="width: 35px; height: 35px;">
                                                <i class="bi bi-person text-primary"></i>
                                            </div>
                                            <span class="fw-bold"><?= $r['nama_user'] ?></span>
                                        </div>
                                    </td>
                                    <td><?= $r['nama_alat'] ?></td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill bg-success px-3 py-2"><?= $r['status'] ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted italic">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    Belum ada aktivitas terekam
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>