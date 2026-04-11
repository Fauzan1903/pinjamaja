<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">

    <div class="card shadow mx-auto" style="max-width: 500px;">
        <div class="card-body text-center">

            <!-- FOTO -->
            <?php if (isset($user) && !empty($user['foto'])): ?>
                <img src="<?= base_url('uploads/users/' . $user['foto']) ?>"
                    class="rounded-circle mb-3"
                    width="120" height="120"
                    style="object-fit: cover;">
            <?php else: ?>
                <img src="<?= base_url('assets/img/user.png') ?>"
                    class="rounded-circle mb-3"
                    width="120">
            <?php endif; ?>

            <!-- NAMA -->
            <h4><?= isset($user) ? ($user['nama'] ?? 'Tidak ada nama') : 'Data tidak ditemukan' ?></h4>

            <p><?= isset($user) ? ($user['username'] ?? '-') : '-' ?></p>

            <span class="badge bg-warning">
                <?= isset($user) ? ($user['role'] ?? '-') : '-' ?>
            </span>

            <hr>

            <!-- BUTTON -->
            <a class="btn btn-primary btn-sm" href="<?= base_url('profile/edit/' . session()->get('id_user')) ?>">
                <i class="bi bi-pencil"></i> Edit Profil
            </a>

        </div>
    </div>

</div>

<?= $this->endSection() ?>