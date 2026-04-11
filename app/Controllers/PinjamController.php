<?php

namespace App\Controllers;

use App\Models\AlatModel;
use App\Models\UsersModel;
use App\Models\PeminjamanModel;

class PinjamController extends BaseController
{
    protected AlatModel $AlatModel;
    protected UsersModel $UsersModel;
    protected PeminjamanModel $PeminjamanModel;

    public function __construct()
    {
        $this->AlatModel = new AlatModel();
        $this->UsersModel = new UsersModel();
        $this->PeminjamanModel = new PeminjamanModel();
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

        $id_alat = (int) $this->request->getPost('id_alat');
        $jumlah = (int) $this->request->getPost('jumlah');
        $nama = $this->request->getPost('nama');

        // Ambil data alat
        $alat = $this->AlatModel->find($id_alat);

        if (!$alat) {
            return redirect()->back()->withInput()->with('error', 'Alat tidak ditemukan.');
        }

        $stokTersedia = (int) $alat['persediaan'];

        // Validasi stok
        if ($jumlah > $stokTersedia) {
            return redirect()->back()->withInput()->with('error', 'Stok tidak cukup. Tersedia: ' . $stokTersedia . '.');
        }

        // Mulai transaksi database
        $db = \Config\Database::connect();
        $db->transStart();

        // Simpan peminjaman
        $peminjamanData = [
            'id_user' => session('id_user'),
            'id_alat' => $id_alat,
            'nama_peminjam' => $nama,
            'jumlah' => $jumlah,
            'data_peminjam' => date('Y-m-d'),
            'data_dikembalikan' => date('Y-m-d', strtotime('+7 days')),
            'status' => 'dipinjam',
        ];

        $inserted = $this->PeminjamanModel->insert($peminjamanData);

        if ($inserted === false) {
            $db->transRollback();
            $errors = $this->PeminjamanModel->errors();
            $message = $errors ? implode(' ', $errors) : 'Gagal menyimpan data peminjaman.';
            return redirect()->back()->withInput()->with('error', $message);
        }

        // Kurangi stok alat
        $updated = $this->AlatModel->update($id_alat, [
            'persediaan' => $stokTersedia - $jumlah,
        ]);

        if ($updated === false) {
            $db->transRollback();
            $errors = $this->AlatModel->errors();
            $message = $errors ? implode(' ', $errors) : 'Gagal mengurangi stok alat.';
            return redirect()->back()->withInput()->with('error', $message);
        }

        $db->transComplete();

        if (!$db->transStatus()) {
            $dbError = $db->error();
            return redirect()->back()->withInput()->with('error', $dbError['message'] ?? 'Gagal menyimpan data peminjaman.');
        }

        return redirect()->to('/alat')->with('success', 'Berhasil pinjam alat. Menunggu persetujuan.');
        $peminjamanModel->where('id_user', $id)->delete();
        $userModel->delete($id);
    }
}
