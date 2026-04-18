<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="card shadow mx-auto" style="max-width: 600px;">
        <div class="card-header">
            <h5>Edit Profile</h5>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama', $user['nama']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= old('username', $user['username']) ?>" required>
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
                    <label for="no_hp" class="form-label">Nomor HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= old('no_hp', $user['no_hp'] ?? '') ?>" placeholder="Contoh: 081234567890">
                    <small class="form-text text-muted">Diperlukan untuk komunikasi dan konfirmasi.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="<?= $user['email'] ?? '' ?>" class="form-control" placeholder="Contoh:emailanda@gmail.com">
                    <small class=" text-muted">Diperlukan untuk komunikasi dan konfirmasi</small>
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
                <a href="<?= base_url('profile') ?>" class="btn btn-secondary">Batal</a>
            </form>

            <hr>
        </div>
    </div>
</div>

<?= $this->endSection() ?>