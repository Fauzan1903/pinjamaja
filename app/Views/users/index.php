<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="icon" href="<?= base_url('assets/img/Logo.png') ?>">


<div class="container mt-5">

    <h3 class="mb-4">Data Users</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="input-group mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari user / username...">
        <button class="btn btn-primary">Cari</button>
    </div>

    <table id="tableUser" class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr class="text-center">
                <th width="50">No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Role</th>
                <th>Foto</th>
                <?php if (session()->get('role') == 'admin') : ?>
                    <th width="200">Aksi</th>
                <?php endif; ?>

            </tr>
        </thead>

        <tbody id="tableUser">
            <?php if (!empty($users)): ?>
                <?php $no = 1;
                foreach ($users as $u): ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $u['nama'] ?></td>
                        <td><?= $u['username'] ?></td>
                        <td>
                            <?php if (!empty($u['no_hp'])): ?>
                                <div class="d-flex align-items-center gap-2">
                                    <span><?= $u['no_hp'] ?></span>
                                    <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $u['no_hp']) ?>"
                                        target="_blank"
                                        class="btn btn-success btn-sm"
                                        title="Hubungi via WhatsApp">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                </div>
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $u['email'] ?? '-' ?></td>
                        <td><?= ucfirst($u['role']) ?></td>
                        <td class="text-center">
                            <?php if ($u['foto']): ?>
                                <img src="<?= base_url('uploads/users/' . $u['foto']) ?>" width="50" class="rounded" />
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <?php if (session()->get('role') == 'admin') : ?>

                            <td class="text-center">
                                <a href="<?= base_url('users/edit/' . $u['id_user']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                <a href="<?= base_url('users/delete/' . $u['id_user']) ?>"
                                    onclick="return confirm('Hapus user ini?')"
                                    class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        <?php endif; ?>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data user</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let keyword = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tableUser tr');

        rows.forEach(function(row) {
            let text = row.innerText.toLowerCase();

            if (text.includes(keyword)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
<?= $this->endSection() ?>