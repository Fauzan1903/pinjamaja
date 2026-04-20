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
    .search-wrapper {
        max-width: 400px;
    }

    .input-group-modern {
        background: #f4f7f6;
        border-radius: 8px;
        border: 1px solid #e1e8ed;
        overflow: hidden;
        transition: 0.3s;
    }

    .input-group-modern:focus-within {
        border-color: var(--accent-blue);
        box-shadow: 0 0 0 3px rgba(0, 163, 255, 0.1);
    }

    .input-group-modern input {
        background: transparent;
        border: none;
        padding: 10px 15px;
    }

    .input-group-modern input:focus {
        box-shadow: none;
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

    /* Role Badge */
    .badge-role {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 11px;
    }

    .badge-admin {
        background: #e3f2fd;
        color: #1976d2;
    }

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
            <a href="<?= site_url('users/create') ?>" class="btn btn-primary shadow-sm" style="background: var(--sidebar-solid); border:none; position: relative; z-index: 10;">
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
            <div class="search-wrapper w-100 w-md-auto">
                <div class="input-group input-group-modern">
                    <span class="input-group-text bg-transparent border-0"><i class="bi bi-search text-muted"></i></span>
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
                                    <span class="badge-role <?= ($u['role'] == 'admin') ? 'badge-admin' : 'badge-user' ?>">
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