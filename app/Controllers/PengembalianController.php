<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\AlatModel;
use App\Models\NotifikasiModel;

class PengembalianController extends BaseController
{
    protected $peminjamanModel;
    protected $alatModel;
    protected $notifikasiModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->alatModel = new AlatModel();
        $this->notifikasiModel = new NotifikasiModel();
    }

    // Halaman riwayat peminjaman
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $db = \Config\Database::connect();
        $builder = $db->table('peminjaman')
            ->select('peminjaman.*, users.nama as nama_user, alat.nama_alat')
            ->join('users', 'users.id_user = peminjaman.id_user', 'left')
            ->join('alat', 'alat.id_alat = peminjaman.id_alat', 'left');

        // Filter berdasarkan role user
        if (session()->get('role') == 'user') {
            $builder->where('peminjaman.id_user', session()->get('id_user'));
        }

        if ($keyword) {
            $builder->groupStart()
                ->like('users.nama', $keyword)
                ->orLike('alat.nama_alat', $keyword)
                ->groupEnd();
        }

        $data['peminjaman'] = $builder->get()->getResultArray();

        return view('pengembalian/index', $data);
    }

    // Proses pengembalian alat
    public function kembalikan($id)
    {
        $peminjaman = $this->peminjamanModel->find($id);

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan.');
        }

        // Validasi: hanya peminjam atau admin yang bisa mengembalikan
        if (session()->get('role') != 'admin' && $peminjaman['id_user'] != session()->get('id_user')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengembalikan alat ini.');
        }

        // Cek jika sudah dikembalikan
        if ($peminjaman['status'] == 'dikembalikan') {
            return redirect()->back()->with('error', 'Alat ini sudah dikembalikan.');
        }

        // Hitung denda jika terlambat
        $tanggalSekarang = new \DateTime();
        $denda = 0;
        $tarifDendaPerHari = 10000;

        // Pastikan tanggal kembali ada dan valid
        if (!empty($peminjaman['data_dikembalikan'])) {

            $tanggalKembali = new \DateTime($peminjaman['data_dikembalikan']);

            if ($tanggalSekarang > $tanggalKembali) {
                $selisihHari = $tanggalSekarang->diff($tanggalKembali)->days;
                $denda = $selisihHari * $tarifDendaPerHari;
            }
        } else {
            // kalau tanggal kosong → tidak kena denda
            $denda = 0;
        }

        // Update status peminjaman menjadi 'dikembalikan' dan simpan denda
        $this->peminjamanModel->update($id, [
            'status' => 'dikembalikan',
            'denda' => $denda
        ]);

        // Update stok alat
        $alat = $this->alatModel->find($peminjaman['id_alat']);
        if ($alat) {
            $stokBaru = (int) $alat['persediaan'] + (int) $peminjaman['jumlah'];
            $this->alatModel->update($peminjaman['id_alat'], ['persediaan' => $stokBaru]);
        }

        // Simpan notifikasi untuk admin dengan info denda
        $pesanDenda = $denda > 0 ? " (Denda: Rp " . number_format($denda, 0, ',', '.') . ")" : "";
        $this->notifikasiModel->save([
            'pesan' => "Alat dikembalikan: {$alat['nama_alat']} oleh {$peminjaman['nama_peminjam']}, jumlah: {$peminjaman['jumlah']}{$pesanDenda}",
            'tanggal' => date('Y-m-d H:i:s'),
            'status' => 'belum_dibaca',
            'id_user' => null, // Notifikasi untuk admin (umum)
        ]);

        // Jika ada denda, kirim notifikasi khusus ke user
        if ($denda > 0) {
            $this->notifikasiModel->save([
                'pesan' => " Pemberitahuan Denda: Anda terkena denda sebesar Rp " . number_format($denda, 0, ',', '.') . " karena terlambat mengembalikan alat '{$alat['nama_alat']}'. Silakan hubungi admin untuk pembayaran.",
                'tanggal' => date('Y-m-d H:i:s'),
                'status' => 'belum_dibaca',
                'id_user' => $peminjaman['id_user'], // Notifikasi khusus untuk user yang terkena denda
            ]);
        }

        $pesanSukses = $denda > 0 ?
            'Alat berhasil dikembalikan. Denda keterlambatan: Rp ' . number_format($denda, 0, ',', '.') :
            'Alat berhasil dikembalikan.';

        return redirect()->back()->with('success', $pesanSukses);
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

        return redirect()->to('/pengembalian ')->with('success', 'Data berhasil dihapus');
    }
}
