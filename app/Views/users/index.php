<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">

    <h3 class="mb-4">Data Users</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr class="text-center">
                <th width="50">No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Foto</th>
                <?php if (session()->get('role') == 'admin') : ?>
                    <th width="150">Aksi</th>
                <?php endif; ?>

            </tr>
        </thead>

        <tbody>
            <?php if (!empty($users)): ?>
                <?php $no = 1;
                foreach ($users as $u): ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $u['nama'] ?></td>
                        <td><?= $u['username'] ?></td>
                        <td><?= ucfirst($u['role']) ?></td>
                        <td class="text-center">
                            <?php if ($u['foto']): ?>
                                <img src="<?= base_url('uploads/users/' . $u['foto']) ?>" width="60" class="rounded">
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
                    <td colspan="6" class="text-center text-muted">Belum ada data user</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
<?= $this->endSection() ?>