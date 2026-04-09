<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container mt-2">
    <p>Ini adalah Halaman Dashboard
        <br>Selamat datang di <b>Pinjamin Aja</b>, aplikasi yang memudahkan Anda dalam mengelola barang pinjaman dengan cepat dan efisien.
    </p>
    <?= $this->extend('layouts/main') ?>
    <?= $this->section('content') ?>

    <div class="container mt-4">
        <h3 class="mb-4">Dashboard</h3>

        <div class="row">
            <div class="col-md-4">
                <div class="card bg-primary text-white p-3">
                    Total Alat
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-warning text-white p-3">
                    Sedang Dipinjam

                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-success text-white p-3">
                    Sudah Kembali

                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection() ?>
</div>
<?= $this->endSection() ?>