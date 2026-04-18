<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;

class ApprovalController extends BaseController
{
    protected $peminjamanModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
    }

    public function index()
    {
        $data['peminjaman_pending'] = $this->peminjamanModel
            ->select('peminjaman.*, users.nama as nama_user, alat.nama_alat')
            ->join('users', 'users.id_user = peminjaman.id_user')
            ->join('alat', 'alat.id_alat = peminjaman.id_alat')
            ->where('peminjaman.status', 'ditunda')
            ->findAll();

        return view('approval/index', $data);
    }

    public function approve($id)
    {
        $peminjaman = $this->peminjamanModel->find($id);

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Peminjaman tidak ditemukan');
        }

        // Mulai transaksi
        $db = \Config\Database::connect();
        $db->transStart();

        // Update status menjadi disetujui
        $this->peminjamanModel->update($id, ['status' => 'disetujui']);

        // Kurangi stok alat
        $alatModel = new \App\Models\AlatModel();
        $alat = $alatModel->find($peminjaman['id_alat']);
        if ($alat) {
            $stokBaru = $alat['persediaan'] - $peminjaman['jumlah'];
            $alatModel->update($peminjaman['id_alat'], ['persediaan' => $stokBaru]);
        }

        // Buat notifikasi untuk user
        $notifikasiModel = new \App\Models\NotifikasiModel();
        $notifikasiModel->insert([
            'id_user' => $peminjaman['id_user'],
            'pesan' => 'Peminjaman alat ' . $alat['nama_alat'] . ' telah disetujui. Silakan ambil alat di tempat yang ditentukan.',
            'status' => 'belum_dibaca',
            'tanggal' => date('Y-m-d H:i:s')
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal menyetujui peminjaman');
        }

        return redirect()->back()->with('success', 'Peminjaman berhasil disetujui');
    }

    public function reject($id)
    {
        $peminjaman = $this->peminjamanModel->find($id);

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Peminjaman tidak ditemukan');
        }

        // Update status menjadi ditolak
        $this->peminjamanModel->update($id, ['status' => 'ditolak']);

        // Buat notifikasi untuk user
        $notifikasiModel = new \App\Models\NotifikasiModel();
        $alatModel = new \App\Models\AlatModel();
        $alat = $alatModel->find($peminjaman['id_alat']);

        $notifikasiModel->insert([
            'id_user' => $peminjaman['id_user'],
            'pesan' => 'Maaf, peminjaman alat ' . ($alat ? $alat['nama_alat'] : 'alat') . ' ditolak.',
            'status' => 'belum_dibaca',
            'tanggal' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'Peminjaman berhasil ditolak');
    }
}
