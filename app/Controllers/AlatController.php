<?php

namespace App\Controllers;

use App\Models\AlatModel;

class AlatController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $keyword = $this->request->getGet('keyword');

        $builder = $db->table('alat')
            ->select('alat.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = alat.id_kategori', 'left');

        if ($keyword) {
            $builder->like('alat.nama_alat', $keyword);
            // kalau mau lebih canggih bisa tambah:
            // ->orLike('kategori.nama_kategori', $keyword);
        }

        $data['alat'] = $builder->get()->getResultArray();

        return view('alat/index', $data);
    }
    public function update()
    {
        $model = new AlatModel();

        $id = $this->request->getPost('id_alat');
        $alat = $model->find($id);

        $foto = $this->request->getFile('foto');
        $fotoName = $alat['foto'];

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            if (!empty($alat['foto']) && file_exists(FCPATH . 'uploads/alat/' . $alat['foto'])) {
                unlink(FCPATH . 'uploads/alat/' . $alat['foto']);
            }

            $fotoName = $foto->getRandomName();
            $foto->move(FCPATH . 'uploads/alat', $fotoName);
        }

        $model->update($id, [
            'nama_alat' => $this->request->getPost('nama_alat'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'persediaan' => $this->request->getPost('persediaan'),
            'foto' => $fotoName,
            'id_kategori' => $this->request->getPost('id_kategori')
        ]);

        return redirect()->to('/alat')->with('success', 'Data berhasil diupdate');
    }


    public function edit($id)
    {
        $model = new AlatModel();
        $kategoriModel = new \App\Models\KategoriModel();

        $data['alat'] = $model->find($id);
        $data['kategori'] = $kategoriModel->findAll();

        return view('alat/edit', $data);
    }

    public function tambah()
    {
        $kategori = new \App\Models\KategoriModel();

        $data['kategori'] = $kategori->findAll();

        return view('alat/tambah', $data);
    }

    public function simpan()
    {
        $rules = [
            'nama_alat' => 'required|max_length[100]',
            'deskripsi' => 'permit_empty|string',
            'persediaan' => 'required|integer|greater_than_equal_to[0]',
            'foto' => 'permit_empty|uploaded[foto]|max_size[foto,2048]|is_image[foto]',
            'id_kategori' => 'required|integer'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(', ', $this->validator->getErrors()));
        }

        $model = new AlatModel();

        $foto = $this->request->getFile('foto');
        $fotoName = null;

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move(FCPATH . 'uploads/alat', $fotoName);
        }

        $saved = $model->save([
            'nama_alat' => $this->request->getPost('nama_alat'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'persediaan' => $this->request->getPost('persediaan'),
            'foto' => $fotoName,
            'id_kategori' => $this->request->getPost('id_kategori')
        ]);

        if (!$saved) {
            $errors = $model->errors();
            $message = $errors ? implode(', ', $errors) : 'Gagal menyimpan data alat.';
            return redirect()->back()->withInput()->with('error', $message);
        }

        return redirect()->to('/alat')->with('success', 'Data berhasil ditambahkan');
    }
}
