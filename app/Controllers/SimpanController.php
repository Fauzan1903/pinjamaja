<?php

namespace App\Controllers;

use App\Models\SimpanModel;

class SimpanController extends BaseController
{
    protected SimpanModel $simpanModel;

    public function __construct()
    {
        $this->simpanModel = new SimpanModel();
    }

    public function index()
    {
        $data['alat'] = $this->simpanModel->findAll();

        return view('alat/index', $data);
    }

    public function tambah()
    {
        return view('alat/tambah');
    }

    public function simpan()
    {
        $rules = [
            'id_alat'   => 'required|integer',
            'nama_alat'  => 'required|max_length[100]',
            'deskripsi'  => 'permit_empty|string',
            'persediaan' => 'required|integer|greater_than_equal_to[0]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(', ', $this->validator->getErrors()));
        }

        $this->simpanModel->save([
            'id_alat'   => $this->request->getPost('id_alat'),
            'nama_alat'  => $this->request->getPost('nama_alat'),
            'deskripsi'  => $this->request->getPost('deskripsi'),
            'persediaan' => $this->request->getPost('persediaan'),
        ]);

        return redirect()->to('/alat')->with('success', 'Data alat berhasil disimpan.');
    }

    public function edit(int $id)
    {
        $alat = $this->simpanModel->find($id);

        if (! $alat) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data alat tidak ditemukan.');
        }

        return view('alat/tambah', ['alat' => $alat]);
    }

    public function update(int $id)
    {
        $alat = $this->simpanModel->find($id);

        if (! $alat) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data alat tidak ditemukan.');
        }

        $rules = [
            'id_alat'   => 'required|integer',
            'nama_alat'  => 'required|max_length[100]',
            'deskripsi'  => 'permit_empty|string',
            'persediaan' => 'required|integer|greater_than_equal_to[0]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(', ', $this->validator->getErrors()));
        }

        $this->simpanModel->update($id, [
            'id_alat'   => $this->request->getPost('id_alat'),
            'nama_alat'  => $this->request->getPost('nama_alat'),
            'deskripsi'  => $this->request->getPost('deskripsi'),
            'persediaan' => $this->request->getPost('persediaan'),
        ]);

        return redirect()->to('/alat')->with('success', 'Data alat berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $alat = $this->simpanModel->find($id);

        if (! $alat) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data alat tidak ditemukan.');
        }

        $this->simpanModel->delete($id);

        return redirect()->to('/alat')->with('success', 'Data alat berhasil dihapus.');
    }
}
