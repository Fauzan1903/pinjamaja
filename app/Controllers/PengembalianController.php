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
        $keyword = $this->request->getGet('keyword');

        $db = \Config\Database::connect();
        $builder = $db->table('peminjaman')
            ->select('peminjaman.*, users.nama as nama_user, alat.nama_alat')
            ->join('users', 'users.id_user = peminjaman.id_user', 'left')
            ->join('alat', 'alat.id_alat = peminjaman.id_alat', 'left');

        if ($keyword) {
            $builder->groupStart()
                ->like('users.nama', $keyword)
                ->orLike('alat.nama_alat', $keyword)
                ->groupEnd();
        }

        $data['peminjaman'] = $builder->get()->getResultArray();

        return view('pengembalian/index', $data);
    }

    // ✅ Proses pengembalian alat
    public function kembalikan($id)
    {
        $peminjaman = $this->peminjamanModel->find($id);

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan.');
        }

        // Update status peminjaman menjadi 'dikembalikan'
        $this->peminjamanModel->update($id, ['status' => 'dikembalikan']);

        // Update stok alat
        $alat = $this->alatModel->find($peminjaman['id_alat']);
        if ($alat) {
            $stokBaru = (int) $alat['persediaan'] + (int) $peminjaman['jumlah'];
            $this->alatModel->update($peminjaman['id_alat'], ['persediaan' => $stokBaru]);
        }
        return redirect()->back()->with('success', 'Alat berhasil dikembalikan.');
    }
    public function export()
    {
        $db = \Config\Database::connect();

        $data['peminjaman'] = $db->table('peminjaman')
            ->select('peminjaman.*, alat.nama_alat, users.nama as nama_user')
            ->join('alat', 'alat.id_alat = peminjaman.id_alat', 'left')
            ->join('users', 'users.id_user = peminjaman.id_user', 'left')
            ->orderBy('peminjaman.id_peminjam', 'DESC')
            ->get()
            ->getResultArray();

        return view('pengembalian/export', $data);
    }
    public function delete($id)
    {
        // Cek role admin
        if (session()->get('role') != 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $this->peminjamanModel->delete($id);

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
