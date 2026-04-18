<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="icon" href="<?= base_url('assets/img/Logo.png') ?>">


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

            <!-- NOMOR HP -->
            <div class="mb-3">
                <strong>Nomor HP:</strong><br>
                <?php if (isset($user) && !empty($user['no_hp'])): ?>
                    <span class="fs-5"><?= $user['no_hp'] ?></span>
                    <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $user['no_hp']) ?>"
                        target="_blank"
                        class="btn btn-success btn-sm ms-2">
                        <i class="bi bi-whatsapp"></i> WhatsApp
                    </a>
                <?php else: ?>
                    <span class="text-muted">Belum diisi</span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <strong>Email:</strong><br>
                <?php if (isset($user) && !empty($user['email'])): ?>
                    <span class="fs-5"><?= $user['email'] ?></span>
                    <a href="mailto:<?= $user['email'] ?>"
                        class="btn btn-primary btn-sm ms-2">
                        <i class="bi bi-envelope"></i> Email
                    </a>
                <?php else: ?>
                    <span class="text-muted">Belum diisi</span>
                <?php endif; ?>
            </div>

            <hr>
            <?php if (session()->get('errors')): ?>
                <div class="alert alert-danger">
                    <?php foreach (session()->get('errors') as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <!-- BUTTON -->
            <a class="btn btn-primary btn-sm" href="<?= base_url('profile/edit/' . session()->get('id_user')) ?>">
                <i class="bi bi-pencil"></i> Edit Profil
            </a>

        </div>
    </div>

</div>

<?= $this->endSection() ?>