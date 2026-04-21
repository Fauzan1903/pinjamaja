<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Restore Database - PinjaminAja</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="icon" href="<?= base_url('assets/img/vaficon.png') ?>">

    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Inter', sans-serif;
            color: #334155;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .container {
            max-width: 600px;
        }

        .card-restore {
            border: none;
            border-radius: 20px;
            background: #ffffff;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .header-accent {
            height: 6px;
            background: linear-gradient(to right, #ef4444, #b91c1c);
        }

        .card-body {
            padding: 40px;
        }

        .icon-box {
            width: 60px;
            height: 60px;
            background-color: #fee2e2;
            color: #ef4444;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 30px;
        }

        /* Warning Box */
        .alert-warning-custom {
            background-color: #fff7ed;
            border-left: 4px solid #f97316;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 30px;
        }

        .alert-warning-custom strong {
            color: #9a3412;
            display: block;
            margin-bottom: 4px;
        }

        .alert-warning-custom p {
            color: #c2410c;
            margin: 0;
            font-size: 0.85rem;
            line-height: 1.5;
        }

        /* Form Styling */
        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #475569;
        }

        .form-control {
            border: 2px dashed #e2e8f0;
            border-radius: 12px;
            padding: 12px;
            background-color: #f8fafc;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
            background-color: #fff;
        }

        /* Button Styling */
        .btn-restore {
            background-color: #ef4444;
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 12px;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-restore:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.3);
            color: white;
        }

        .btn-back {
            background-color: #f1f5f9;
            color: #64748b;
            border: none;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 12px;
            transition: 0.3s;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .btn-back:hover {
            background-color: #e2e8f0;
            color: #334155;
        }

        .alert-floating {
            border-radius: 12px;
            border: none;
            padding: 15px 20px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 25px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card-restore">
            <div class="header-accent"></div>
            <div class="card-body">

                <div class="icon-box">
                    <i class="bi bi-database-fill-up"></i>
                </div>

                <h3 class="title">Restore Database</h3>
                <p class="subtitle">Pulihkan data sistem Anda dari file cadangan SQL.</p>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger alert-floating">
                        <i class="bi bi-x-circle-fill me-2"></i> <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success alert-floating">
                        <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <div class="alert-warning-custom">
                    <strong><i class="bi bi-exclamation-triangle-fill"></i> PERHATIAN</strong>
                    <p>Proses ini akan <b>menghapus dan menimpa</b> seluruh data yang ada saat ini. Tindakan ini tidak dapat dibatalkan.</p>
                </div>

                <form action="<?= base_url('restore/process') ?>" method="post" enctype="multipart/form-data"
                    onsubmit="return confirm('Peringatan Terakhir: Apakah Anda yakin ingin melakukan restore? Seluruh data saat ini akan hilang!')">

                    <?= csrf_field(); ?>

                    <div class="mb-4">
                        <label class="form-label">Pilih File Backup (.sql)</label>
                        <input type="file" name="file_sql" class="form-control" accept=".sql" required>
                        <div class="form-text mt-2" style="font-size: 0.75rem;">Maksimum ukuran file mengikuti konfigurasi server.</div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn btn-restore">
                            <i class="bi bi-arrow-repeat"></i> Mulai Restore
                        </button>
                        <a href="<?= base_url('/') ?>" class="btn btn-back">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
        <p class="text-center mt-4 text-muted small">
            &copy; <?= date('Y') ?> PinjaminAja System Security
        </p>
    </div>

</body>

</html>