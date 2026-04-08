<?php

namespace App\Controllers;

use App\Models\AlatModel;
use App\Models\UsersModel;
use App\Models\PeminjamanModel;

class PinjamController extends BaseController
{
    protected AlatModel $alatModel;
    protected UsersModel $usersModel;
    protected PeminjamanModel $peminjamanModel;

    public function __construct()
    {
        $this->alatModel = new AlatModel();
        $this->usersModel = new UsersModel();
        $this->peminjamanModel = new PeminjamanModel();
    }

    public function form(int $id)
    {
        $alat = $this->alatModel->find($id);

        if (!$alat) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Alat tidak ditemukan.');
        }

        return view('pinjam/form', ['alat' => $alat]);
    }

    public function simpan()
    {
        $rules = [
            'id_alat' => 'required|integer',
            'nama' => 'required|max_length[30]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(', ', $this->validator->getErrors()));
        }

        // Simpan peminjaman ke database
        $data = [
            'id_alat' => $this->request->getPost('id_alat'),
            'nama_peminjam' => $this->request->getPost('nama'),
            'data_peminjam' => date('Y-m-d'),
            'data_dikembalikan' => date('Y-m-d', strtotime('+7 days')), // Asumsikan 7 hari
            'status' => 'ditunda'
        ];

        $this->peminjamanModel->save($data);
        // 🔥 VALIDASI STOK
        if ($alat['persediaan']) {
            return redirect()->back()->with('error', 'Stok tidak cukup!');
        }

        // 📊 SIMPAN PEMINJAMAN
        $db->table('peminjaman')->insert([
            'id_alat' => $id_alat,
            'nama_peminjam' => $this->request->getPost('nama'),
            'tanggal_pinjam' => date('Y-m-d')
        ]);

        // 🔥 KURANGI STOK
        $alatModel->update($id_alat, [
            'persediaan' => $alat['persediaan']
        ]);

        return redirect()->to('/alat')->with('success', 'Berhasil pinjam alat');
    }
} {
    // Jika ada method delete di PinjamController, tapi sepertinya ini salah
    // Method delete seharusnya di SimpanController
}
