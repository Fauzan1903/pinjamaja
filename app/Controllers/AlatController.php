<?php

namespace App\Controllers;

use App\Models\AlatModel;

class AlatController extends BaseController
{
    public function index()
    {
        $model = new AlatModel();
        $data['alat'] = $model->findAll();

        return view('alat/index', $data);
    }

    public function tambah()
    {
        return view('alat/tambah');
    }

    public function simpan()
    {
        $model = new AlatModel();

        $model->save([
            'nama_alat'   => $this->request->getPost('nama_alat'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'persediaan'  => $this->request->getPost('persediaan'),
        ]);

        return redirect()->to('/alat')->with('success', 'Data berhasil ditambahkan');
    }
}
