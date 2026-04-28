<?php

namespace App\Controllers;

use App\Models\AlatModel;
use App\Models\UsersModel;
use App\Models\PeminjamanModel;
use App\Models\NotifikasiModel;

class PinjamController extends BaseController
{
    protected AlatModel $AlatModel;
    protected UsersModel $UsersModel;
    protected PeminjamanModel $PeminjamanModel;
    protected NotifikasiModel $NotifikasiModel;

    public function __construct()
    {
        $this->AlatModel = new AlatModel();
        $this->UsersModel = new UsersModel();
        $this->PeminjamanModel = new PeminjamanModel();
        $this->NotifikasiModel = new NotifikasiModel();
    }

    public function form(int $id)
    {
        $alat = $this->AlatModel->find($id);

        if (!$alat) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Alat tidak ditemukan.');
        }

        return view('pinjam/form', ['alat' => $alat]);
    }

    public function simpan()
    {
        $rules = [
            'id_alat' => 'required|integer',
            'nama' => 'required|max_length[100]',
            'jumlah' => 'required|integer|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(', ', $this->validator->getErrors()));
        }

        $alat = (int) $this->request->getPost('id_alat');
        $jumlah = (int) $this->request->getPost('jumlah');
        $nama = $this->request->getPost('nama');

        // Ambil data alat
        $alat = $this->AlatModel->find($alat);

        if (!$alat) {
            return redirect()->back()->withInput()->with('error', 'Alat tidak ditemukan.');
        }

        $stokTersedia = (int) $alat['persediaan'];

        // Simpan peminjaman dengan status ditunda
        $peminjamanData = [
            'id_user' => session('id_user'),
            'id_alat' => $alat['id_alat'],
            'nama_peminjam' => $nama,
            'jumlah' => $jumlah,
            'data_peminjam' => date('Y-m-d'),
            'data_dikembalikan' => date('Y-m-d', strtotime('+3 days')),
            'status' => 'ditunda',
        ];

        $inserted = $this->PeminjamanModel->insert($peminjamanData);

        if ($inserted === false) {
            $errors = $this->PeminjamanModel->errors();
            $message = $errors ? implode(' ', $errors) : 'Gagal menyimpan data peminjaman.';
            return redirect()->back()->withInput()->with('error', $message);
        }

        // Kirim notifikasi ke admin bahwa ada permintaan peminjaman baru
        $this->NotifikasiModel->insert([
            'pesan' => "Permintaan peminjaman baru: {$alat['nama_alat']} oleh {$nama}, jumlah: {$jumlah}. Menunggu approval.",
            'tanggal' => date('Y-m-d H:i:s'),
            'status' => 'belum_dibaca',
        ]);

        return redirect()->to('/alat')->with('success', 'Permintaan peminjaman berhasil dikirim. Menunggu persetujuan admin.');
    }
}
