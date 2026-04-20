<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="icon" href="<?= base_url('assets/img/vaficon.png') ?>">

<style>
    :root {
        --denda-color: #ff4d4d;
        --notif-bg-new: #f0f7ff;
    }

    /* Card Styling */
    .card-notif {
        border: none;
        border-radius: 15px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .card-header-notif {
        background: white;
        padding: 25px;
        border-bottom: 1px solid #f0f0f0;
    }

    /* List Group Custom */
    .list-group-flush>.list-group-item {
        border-left: 4px solid transparent;
        transition: all 0.3s ease;
        padding: 20px 25px;
        margin-bottom: 5px;
    }

    .list-group-item:hover {
        background-color: #fafafa;
    }

    /* Notifikasi Belum Dibaca */
    .notif-unread {
        background-color: var(--notif-bg-new) !important;
        border-left-color: #007bff !important;
    }

    /* Notifikasi Denda */
    .notif-denda {
        border-left: 5px solid var(--denda-color) !important;
        background-color: #fffafa !important;
    }

    /* Badge Custom */
    .badge-soft {
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-soft-danger {
        background: #ffebeb;
        color: #ff4d4d;
    }

    .badge-soft-secondary {
        background: #f0f0f0;
        color: #777;
    }

    .badge-soft-warning {
        background: #fff4e6;
        color: #ff922b;
        border: 1px solid #ffe8cc;
    }

    /* Icons */
    .icon-box {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .icon-box-blue {
        background: #e7f3ff;
        color: #007bff;
    }

    .icon-box-red {
        background: #ffebeb;
        color: #ff4d4d;
    }

    /* Text Wrap */
    .notif-text {
        font-size: 0.95rem;
        line-height: 1.5;
        color: #333;
    }

    .notif-time {
        font-size: 0.8rem;
        color: #999;
        display: block;
        margin-top: 5px;
    }

    /* Buttons */
    .btn-action-notif {
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
        padding: 8px 16px;
        transition: 0.2s;
    }
</style>

<div class="container py-4">
    <div class="card card-notif">
        <div class="card-header-notif d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="fw-bold mb-1 text-dark">Pusat Notifikasi</h4>
                <p class="text-muted small mb-0">Lihat semua aktivitas dan peringatan akun Anda.</p>
            </div>
            <button id="mark-all-read" class="btn btn-outline-primary btn-action-notif shadow-sm">
                <i class="bi bi-check2-all me-1"></i> Tandai Semua Dibaca
            </button>
        </div>

        <div class="card-body p-0">
            <?php if (empty($notifikasi)): ?>
                <div class="text-center py-5">
                    <i class="bi bi-bell-slash text-muted opacity-25" style="font-size: 4rem;"></i>
                    <p class="mt-3 text-muted">Hening... Tidak ada notifikasi saat ini.</p>
                </div>
            <?php else: ?>
                <div class="list-group list-group-flush">
                    <?php foreach ($notifikasi as $notif):
                        $isDenda = strpos($notif['pesan'], 'Pemberitahuan Denda') !== false;
                        $isUnread = $notif['status'] == 'belum_dibaca';
                    ?>
                        <div class="list-group-item d-flex align-items-start gap-3 <?= $isUnread ? 'notif-unread' : '' ?> <?= $isDenda ? 'notif-denda' : '' ?>">

                            <div class="icon-box <?= $isDenda ? 'icon-box-red' : 'icon-box-blue' ?>">
                                <i class="bi <?= $isDenda ? 'bi-exclamation-octagon' : 'bi-bell-fill' ?> fs-5"></i>
                            </div>

                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <p class="mb-0 notif-text <?= $isDenda ? 'fw-bold text-danger' : '' ?>">
                                        <?= esc($notif['pesan']) ?>
                                    </p>
                                    <div class="ms-2">
                                        <span class="badge-soft <?= $isUnread ? 'badge-soft-danger' : 'badge-soft-secondary' ?>">
                                            <?= $isUnread ? 'Baru' : 'Dibaca' ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-2 mt-1">
                                    <small class="notif-time">
                                        <i class="bi bi-clock me-1"></i> <?= date('d M Y, H:i', strtotime($notif['tanggal'])) ?>
                                    </small>
                                    <?php if ($isDenda): ?>
                                        <span class="badge-soft badge-soft-warning small py-1 px-2" style="font-size: 10px;">
                                            <i class="bi bi-cash-coin"></i> TAGIHAN
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="mt-3 d-flex gap-2">
                                    <?php if ($isUnread): ?>
                                        <button class="btn btn-sm btn-primary btn-action-notif mark-read" data-id="<?= $notif['id_notifikasi'] ?>">
                                            Selesai Dibaca
                                        </button>
                                    <?php endif; ?>

                                    <?php if (in_array(session()->get('role'), ['petugas'])): ?>
                                        <button class="btn btn-sm btn-outline-danger btn-action-notif delete-notif" data-id="<?= $notif['id_notifikasi'] ?>">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.mark-read').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const item = this.closest('.list-group-item');
                fetch('<?= base_url('notifikasi/mark-read/') ?>' + id, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) updateItemStatus(item);
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        document.getElementById('mark-all-read').addEventListener('click', function() {
            fetch('<?= base_url('notifikasi/mark-all-read') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelectorAll('.list-group-item').forEach(item => updateItemStatus(item));
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        document.querySelectorAll('.delete-notif').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin menghapus notifikasi ini?')) {
                    const id = this.getAttribute('data-id');
                    const item = this.closest('.list-group-item');
                    fetch('<?= base_url('notifikasi/delete/') ?>' + id, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                item.remove();
                                updateCounter();
                            }
                        });
                }
            });
        });

        function updateItemStatus(item) {
            item.classList.remove('notif-unread');
            item.style.borderLeftColor = 'transparent';
            const markReadBtn = item.querySelector('.mark-read');
            if (markReadBtn) markReadBtn.style.display = 'none';
            const badge = item.querySelector('.badge-soft');
            if (badge) {
                badge.classList.remove('badge-soft-danger');
                badge.classList.add('badge-soft-secondary');
                badge.textContent = 'Dibaca';
            }
        }

        function updateCounter() {
            fetch('<?= base_url('api/notifikasi') ?>')
                .then(response => response.json())
                .then(data => {
                    const counter = document.getElementById('notif-counter');
                    if (counter) {
                        counter.textContent = data.length;
                        counter.style.display = data.length > 0 ? 'inline-block' : 'none';
                    }
                });
        }
    });
</script>
<?= $this->endSection() ?>