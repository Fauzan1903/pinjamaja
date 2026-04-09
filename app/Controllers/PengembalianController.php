<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\AlatModel;

class PengembalianController extends BaseController
{
    protected $peminjamanModel;
    protected $alatModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->alatModel = new AlatModel();
    }

    // 📊 Halaman riwayat peminjaman
    public function index()
    {
        $data['peminjaman'] = $this->peminjamanModel
            ->where('status', 'dipinjam')
            ->findAll();

        return view('pengembalian/index', $data);
    }
    public function riwayat()
    {
        $data['riwayat'] = $this->peminjamanModel->findAll();

        return view('pengembalian/riwayat', $data);
    }

    // 🔄 Proses pengembalian
    public function kembalikan($id)
    {
        $pinjam = $this->peminjamanModel->find($id);

        if (!$pinjam) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $alat = $this->alatModel->find($pinjam['id_alat']);

        // 📅 Hitung denda
        $hariIni = date('Y-m-d');
        $tanggalKembali = $pinjam['data_dikembalikan'];

        $denda = 0;

        if ($hariIni > $tanggalKembali) {
            $selisih = (strtotime($hariIni) - strtotime($tanggalKembali)) / (60 * 60 * 24);
            $denda = $selisih * 1000;
        }

        // ✅ Update status
        $this->peminjamanModel->update($id, [
            'status' => 'dikembalikan',
            'denda' => $denda
        ]);

        // 🔥 Kembalikan stok
        $this->alatModel->update($alat['id_alat'], [
            'persediaan' => $alat['persediaan'] + $pinjam['jumlah']
        ]);

        return redirect()->to('/pengembalian')
            ->with('success', 'Alat dikembalikan. Denda: Rp ' . $denda);
    }
}
