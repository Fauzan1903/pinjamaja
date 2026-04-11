<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .print-area {
        background: white;
        padding: 20px;
    }

    @media print {
        body {

            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .table-dark {
            background-color: #212529 !important;
            color: white !important;
        }

        .table-dark th {
            background-color: #212529 !important;
            color: white !important;
        }

        .no-print {
            display: none;
        }

        .container {
            width: 100%;
            margin: 0;
            padding: 0;
        }
    }
</style>

<div class="container mt-4 print-area">

    <h3 class="text-center mb-4">Laporan Peminjaman Alat</h3>

    <div class="mb-3">
        Tanggal Cetak: <?= date('d-m-Y') ?>
    </div>

    <div class="no-print mb-3">
        <button onclick="window.print()" class="btn btn-primary">
            🖨️ Print / Save PDF
        </button>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Nama Alat</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1;
            foreach ($peminjaman as $p): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $p['nama_user'] ?? '-' ?></td>
                    <td><?= $p['nama_alat'] ?? '-' ?></td>
                    <td><?= $p['jumlah'] ?></td>
                    <td><?= $p['data_peminjam'] ?></td>
                    <td><?= $p['status'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?= $this->endSection() ?>