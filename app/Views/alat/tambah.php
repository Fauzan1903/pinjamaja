<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <h3 class="mb-4">Tambah Alat</h3>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <form action="<?= base_url('alat/simpan') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <div class="mb-3">
            <label class="form-label">Nama Alat</label>
            <input type="text" name="nama_alat" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="persediaan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
            <label>Kategori</label>

            <div class="input-group">
                <select name="id_kategori" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($kategori as $k): ?>
                        <option value="<?= $k['id_kategori'] ?>">
                            <?= $k['nama_kategori'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#modalKategori">
                    +
                </button>
            </div>
        </div>


</div>

<button type="submit" class="btn btn-success">Simpan</button>
<a href="<?= base_url('alat') ?>" class="btn btn-secondary">Kembali</a>
</form>
<div class="modal fade" id="modalKategori">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formKategori">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" placeholder="Nama kategori" required>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
<script>
    document.getElementById('formKategori').addEventListener('submit', function(e) {
        e.preventDefault();

        let nama = document.getElementById('nama_kategori').value;

        fetch("<?= base_url('kategori/simpan') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "nama_kategori=" + nama
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // tambahkan ke dropdown
                    let select = document.querySelector('select[name="id_kategori"]');

                    let option = document.createElement("option");
                    option.value = data.id;
                    option.text = data.nama;
                    option.selected = true;

                    select.appendChild(option);

                    // reset & tutup modal
                    document.getElementById('formKategori').reset();
                    let modal = bootstrap.Modal.getInstance(document.getElementById('modalKategori'));
                    modal.hide();
                }
            });
    });
</script>
<?= $this->endSection() ?>