<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning">
            <h4 class="mb-0">Edit User</h4>
        </div>

        <div class="card-body">

            <form action="<?= base_url('users/update/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?> <!-- WAJIB -->
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" value="<?= $user['nama'] ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" value="<?= $user['username'] ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-control">
                        <option value="Petugas" <?= $user['role'] == 'Petugas' ? 'selected' : '' ?>>Petugas</option>
                        <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="<?= $user['email'] ?? '' ?>" class="form-control" placeholder="Contoh:emailanda@gmail.com">
                    <small class=" text-muted">Diperlukan untuk komunikasi dan konfirmasi</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input type="file" name="foto" class="form-control">
                    <p class="text-muted">Foto sekarang:</p>
                    <?php if ($user['foto']): ?>
                        <img src="<?= base_url('uploads/users/' . $user['foto']) ?>" width="80" class="rounded">
                    <?php else: ?>
                        <span>-</span>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor HP</label>
                    <input type="text" name="no_hp" value="<?= $user['no_hp'] ?? '' ?>" class="form-control" placeholder="Contoh: 081234567890">
                    <small class="text-muted">Diperlukan untuk komunikasi dan konfirmasi</small>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="<?= base_url('users') ?>" class="btn btn-secondary">Kembali</a>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>