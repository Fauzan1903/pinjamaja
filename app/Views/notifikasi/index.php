<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="icon" href="<?= base_url('assets/img/Logo.png') ?>">


<div class="card shadow">
    <div class="card-header bg-warning d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Notifikasi</h4>
        <button id="mark-all-read" class="btn btn-sm btn-outline-primary">Tandai Semua Dibaca</button>
    </div>

    <div class="card-body">
        <?php if (empty($notifikasi)): ?>
            <p>Tidak ada notifikasi.</p>
        <?php else: ?>
            <div class="list-group">
                <?php foreach ($notifikasi as $notif): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center <?= strpos($notif['pesan'], 'Pemberitahuan Denda') !== false ? 'border-danger border-start border-4' : '' ?>">
                        <div>
                            <p class="mb-1 <?= strpos($notif['pesan'], 'Pemberitahuan Denda') !== false ? 'text-danger fw-bold' : '' ?>">
                                <?php if (strpos($notif['pesan'], 'Pemberitahuan Denda') !== false): ?>
                                    <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                                <?php endif; ?>
                                <?= esc($notif['pesan']) ?>
                            </p>
                            <small class="text-muted"><?= date('d M Y H:i', strtotime($notif['tanggal'])) ?></small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-<?= $notif['status'] == 'belum_dibaca' ? 'danger' : 'secondary' ?>">
                                <?= $notif['status'] == 'belum_dibaca' ? 'Baru' : 'Dibaca' ?>
                            </span>
                            <?php if (strpos($notif['pesan'], 'Pemberitahuan Denda') !== false): ?>
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-cash-coin"></i> Denda
                                </span>
                            <?php endif; ?>
                            <?php if ($notif['status'] == 'belum_dibaca'): ?>
                                <button class="btn btn-sm btn-outline-primary mark-read" data-id="<?= $notif['id_notifikasi'] ?>">
                                    Tandai Dibaca
                                </button>
                            <?php endif; ?>
                            <?php if (in_array(session()->get('role'), ['admin'])): ?>
                                <button class="btn btn-sm btn-outline-danger delete-notif" data-id="<?= $notif['id_notifikasi'] ?>">
                                    <i class="bi bi-trash"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mark single notification as read
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
                        if (data.success) {
                            updateItemStatus(item);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        // Mark all notifications as read
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
                        document.querySelectorAll('.list-group-item').forEach(item => {
                            updateItemStatus(item);
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        // Delete notification
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
                            } else {
                                alert('Gagal menghapus notifikasi: ' + (data.message || 'Unknown error'));
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menghapus notifikasi');
                        });
                }
            });
        });

        function updateItemStatus(item) {
            item.classList.remove('list-group-item-warning');
            item.classList.add('list-group-item-light');
            const markReadBtn = item.querySelector('.mark-read');
            if (markReadBtn) {
                markReadBtn.style.display = 'none';
            }
        }

        function updateCounter() {
            fetch('<?= base_url('api/notifikasi') ?>')
                .then(response => response.json())
                .then(data => {
                    const counter = document.getElementById('notif-counter');
                    if (counter) {
                        if (data.length > 0) {
                            counter.textContent = data.length;
                            counter.style.display = 'inline-block';
                        } else {
                            counter.style.display = 'none';
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>
<?= $this->endSection() ?>