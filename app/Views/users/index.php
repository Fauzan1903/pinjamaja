<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="icon" href="<?= base_url('assets/img/vaficon.png') ?>">

<style>
    :root {
        --sidebar-solid: #1e1e2d;
        --accent-blue: #00a3ff;
    }

    /* Card Styling */
    .card-custom {
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        background: white;
    }

    .card-header-custom {
        background: white;
        border-bottom: 1px solid #f0f0f0;
        padding: 20px 25px;
        border-radius: 12px 12px 0 0 !important;
    }

    /* Search Bar Professional */
    .input-group-modern {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        background-color: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 10px !important;
        padding: 2px 10px !important;
        transition: all 0.3s ease;
        min-width: 250px;
    }

    .input-group-modern .input-group-text {
        padding: 0 8px 0 0 !important;
        background: transparent !important;
    }

    .input-group-modern .form-control {
        border: none !important;
        box-shadow: none !important;
        background-color: transparent !important;
        padding: 8px 0 !important;
        font-size: 0.9rem !important;
        color: #334155 !important;
    }

    .input-group-modern:focus-within {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
    }

    /* Table Styling */
    .table thead th {
        background-color: var(--sidebar-solid);
        color: #a2a3b7;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1px;
        border: none;
        padding: 15px;
    }

    .table tbody td {
        padding: 15px;
        vertical-align: middle;
        color: #444;
        font-size: 14px;
        border-bottom: 1px solid #f8f9fa;
    }

    /* --- Role Badge Custom Colors --- */
    .badge-role {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 11px;
        display: inline-block;
    }

    /* Warna Hijau untuk Petugas */
    .badge-petugas {
        background: #e8f5e9;
        color: #2e7d32;
    }

    /* Warna Biru untuk Admin */
    .badge-admin {
        background: #e3f2fd;
        color: #1976d2;
    }

    /* Warna Abu-abu untuk User biasa */
    .badge-user {
        background: #f5f5f5;
        color: #616161;
    }

    /* Avatar Styling */
    .user-avatar {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #f0f0f0;
    }

    .btn-action {
        border-radius: 6px;
        padding: 6px 10px;
        font-size: 12px;
    }
</style>

<div class="container-fluid py-4 px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Manajemen Users</h3>
            <p class="text-muted small mb-0">Kelola akses dan informasi pengguna aplikasi.</p>
        </div>
        <?php if (session()->get('role') == 'admin') : ?>
            <a href="<?= site_url('users/create') ?>" class="btn btn-primary shadow-sm" style="background: var(--sidebar-solid); border:none;">
                <i class="bi bi-person-plus-fill me-2"></i> Tambah User
            </a>
        <?php endif; ?>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <div><?= session()->getFlashdata('success') ?></div>
        </div>
    <?php endif; ?>

    <div class="card card-custom">
        <div class="card-header-custom d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h5 class="mb-0 fw-bold text-dark">Daftar Pengguna</h5>
            <div class="search-wrapper">
                <div class="input-group-modern">
                    <span class="input-group-text"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari user / username...">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="60" class="text-center">No</th>
                        <th>Informasi User</th>
                        <th>Kontak</th>
                        <th>Email</th>
                        <th class="text-center">Role</th>
                        <th width="200" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody id="tableUser">
                    <?php if (!empty($users)): ?>
                        <?php $no = 1;
                        foreach ($users as $u): ?>
                            <tr>
                                <td class="text-center text-muted"><?= $no++ ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <?php if ($u['foto']): ?>
                                            <img src="<?= base_url('uploads/users/' . $u['foto']) ?>" class="user-avatar" />
                                        <?php else: ?>
                                            <div class="user-avatar d-flex align-items-center justify-content-center bg-light text-muted">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <div class="fw-bold text-dark"><?= $u['nama'] ?></div>
                                            <div class="text-muted small">@<?= $u['username'] ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php if (!empty($u['no_hp'])): ?>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="small"><?= $u['no_hp'] ?></span>
                                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $u['no_hp']) ?>"
                                                target="_blank" class="text-success" title="WhatsApp">
                                                <i class="bi bi-whatsapp"></i>
                                            </a>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
                                </td>
                                <td><span class="small text-muted"><?= $u['email'] ?? '-' ?></span></td>
                                <td class="text-center">
                                    <?php
                                    // Logika penentuan class badge berdasarkan role
                                    $badgeClass = 'badge-user'; // Default
                                    if (strtolower($u['role']) == 'admin') {
                                        $badgeClass = 'badge-admin';
                                    } elseif (strtolower($u['role']) == 'petugas') {
                                        $badgeClass = 'badge-petugas';
                                    }
                                    ?>
                                    <span class="badge-role <?= $badgeClass ?>">
                                        <?= strtoupper($u['role']) ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php if (session()->get('role') == 'admin') : ?>
                                        <a href="<?= base_url('users/edit/' . $u['id_user']) ?>" class="btn btn-warning btn-action text-white me-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="<?= base_url('users/delete/' . $u['id_user']) ?>"
                                            onclick="return confirm('Hapus user ini?')"
                                            class="btn btn-danger btn-action">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small italic">No Access</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-people fs-1 d-block mb-2 opacity-25"></i>
                                Belum ada data user
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let keyword = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tableUser tr');

        rows.forEach(function(row) {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(keyword) ? '' : 'none';
        });
    });
</script>

<?= $this->endSection() ?>