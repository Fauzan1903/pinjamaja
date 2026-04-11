<?php

namespace App\Controllers;

use App\Models\AlatModel;

class AlatController extends BaseController
{
    public function index()
    {
        $model = new AlatModel();

        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $data['alat'] = $model
                ->like('nama_alat', $keyword)
                ->orLike('deskripsi', $keyword)
                ->findAll();
        } else {
            $data['alat'] = $model->findAll();
        }

        return view('alat/index', $data);
    }
    public function update()
    {
        $model = new AlatModel();

        $id = $this->request->getPost('id_alat');

        $model->update($id, [
            'nama_alat' => $this->request->getPost('nama_alat'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'persediaan' => $this->request->getPost('persediaan'),
        ]);

        return redirect()->to('/alat')->with('success', 'Data berhasil diupdate');
    }
    public function edit($id)
    {
        $model = new AlatModel();

        $data['alat'] = $model->find($id);

        return view('alat/edit', $data);
    }
    public function tambah()
    {
        return view('alat/tambah');
    }

    public function simpan()
    {
        $rules = [
            'nama_alat' => 'required|max_length[100]',
            'deskripsi' => 'permit_empty|string',
            'persediaan' => 'required|integer|greater_than_equal_to[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(', ', $this->validator->getErrors()));
        }

        $model = new AlatModel();

        $saved = $model->save([
            'nama_alat' => $this->request->getPost('nama_alat'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'persediaan' => $this->request->getPost('persediaan'),
        ]);

        if (!$saved) {
            $errors = $model->errors();
            $message = $errors ? implode(', ', $errors) : 'Gagal menyimpan data alat.';
            return redirect()->back()->withInput()->with('error', $message);
        }

        return redirect()->to('/alat')->with('success', 'Data berhasil ditambahkan');
    }
}
