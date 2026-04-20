    <?= $this->extend('layouts/main') ?>
    <?= $this->section('content') ?>

    <link rel="icon" href="<?= base_url('assets/img/vaficon.png') ?>">

    <style>
        /* Card Container */
        .profile-card {
            border: none;
            border-radius: 24px;
            background: #ffffff;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        /* Header Accent */
        .profile-cover {
            height: 140px;
            background: linear-gradient(135deg, #969696 0%, #3f3f3f 100%);
            position: relative;
        }

        /* Avatar Styling */
        .avatar-container {
            margin-top: -70px;
            position: relative;
            z-index: 2;
        }

        .profile-avatar {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border: 6px solid #ffffff;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            background: #fff;
        }

        /* Typography & Badges */
        .user-name {
            font-weight: 800;
            color: #2d3436;
            letter-spacing: -0.5px;
        }

        .role-tag {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 6px 16px;
            border-radius: 50px;
            background: #fff4e6;
            color: #fd7e14;
            border: 1px solid #ffe8cc;
            display: inline-block;
        }

        /* Contact Section */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 30px;
            text-align: left;
        }

        .info-box {
            padding: 20px;
            background: #f8f9fc;
            border-radius: 16px;
            border: 1px solid #edf2f7;
            transition: transform 0.2s;
        }

        .info-box:hover {
            transform: translateY(-3px);
            background: #ffffff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
        }

        .icon-shape {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            font-size: 1.2rem;
        }

        .bg-soft-success {
            background: #d1fae5;
            color: #059669;
        }

        .bg-soft-primary {
            background: #e0e7ff;
            color: #616161;
        }

        /* Buttons */
        .btn-edit-wide {
            border-radius: 14px;
            padding: 12px 30px;
            font-weight: 700;
            transition: 0.3s;
        }
    </style>

    <div class="container py-5">
        <div class="card profile-card mx-auto" style="max-width: 550px;">
            <div class="profile-cover"></div>

            <div class="card-body text-center pt-0 px-4 pb-5">
                <div class="avatar-container mb-3">
                    <?php if (isset($user) && !empty($user['foto'])): ?>
                        <img src="<?= base_url('uploads/users/' . $user['foto']) ?>" class="rounded-circle profile-avatar">
                    <?php else: ?>
                        <img src="<?= base_url('assets/img/user.png') ?>" class="rounded-circle profile-avatar">
                    <?php endif; ?>
                </div>

                <h2 class="user-name mb-1">
                    <?= isset($user) ? ($user['nama'] ?? 'Guest User') : 'Data tidak ditemukan' ?>
                </h2>
                <p class="text-muted mb-3">@<?= isset($user) ? ($user['username'] ?? '-') : '-' ?></p>

                <div class="role-tag mb-4">
                    <i class="bi bi-shield-check me-1"></i> <?= isset($user) ? ($user['role'] ?? '-') : '-' ?>
                </div>

                <hr class="my-4 opacity-50">

                <div class="contact-grid">
                    <div class="info-box">
                        <div class="icon-shape bg-soft-success">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <small class="text-muted d-block">Nomor Telepon</small>
                        <span class="fw-bold d-block mb-2 text-dark"><?= (!empty($user['no_hp'])) ? $user['no_hp'] : 'Belum diatur' ?></span>
                        <?php if (!empty($user['no_hp'])): ?>
                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $user['no_hp']) ?>" target="_blank" class="btn btn-sm btn-outline-success w-100 rounded-pill mt-1">Chat Sekarang</a>
                        <?php endif; ?>
                    </div>

                    <div class="info-box">
                        <div class="icon-shape bg-soft-primary">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <small class="text-muted d-block">Alamat Email</small>
                        <span class="fw-bold d-block mb-2 text-dark text-truncate"><?= (!empty($user['email'])) ? $user['email'] : 'Belum diatur' ?></span>
                        <?php if (!empty($user['email'])): ?>
                            <a href="mailto:<?= $user['email'] ?>" class="btn btn-sm btn-outline-primary w-100 rounded-pill mt-1">Kirim Email</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mt-5">
                    <a class="btn btn-primary btn-edit-wide shadow-sm" href="<?= base_url('profile/edit') ?>">
                        <i class="bi bi-pencil-square me-2"></i> Edit Profil
                    </a>
                </div>

            </div>
        </div>
    </div>

    <?= $this->endSection() ?>