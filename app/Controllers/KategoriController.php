<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    protected $kategori;

    public function __construct()
    {
        $this->kategori = new KategoriModel();
    }

    // =========================
    //  TAMPIL DATA
    // =========================
    public function index()
    {
        $data['kategori'] = $this->kategori->findAll();

        return view('kategori/index', $data);
    }

    // =========================
    //  FORM TAMBAH
    // =========================
    public function tambah()
    {
        return view('kategori/tambah');
    }

    // =========================
    //  SIMPAN (SUPPORT AJAX)
    // =========================

    public function simpan()
    {
        $model = new \App\Models\KategoriModel();

        $nama = $this->request->getPost('nama_kategori');

        $model->insert([
            'nama_kategori' => $nama
        ]);

        return $this->response->setJSON([
            'success' => true,
            'id' => $model->insertID(),
            'nama' => $nama
        ]);
    }

    // =========================
    // FORM EDIT
    // =========================
    public function edit($id)
    {
        $data['kategori'] = $this->kategori->find($id);

        return view('kategori/edit', $data);
    }

    // =========================
    //  UPDATE
    // =========================
    public function update($id)
    {
        $this->kategori->update($id, [
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);

        return redirect()->to('/kategori')->with('success', 'Kategori berhasil diupdate');
    }

    // =========================
    //  DELETE (AJAX + NORMAL)
    // =========================
    public function delete($id)
    {
        $this->kategori->delete($id);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['success' => true]);
        }

        return redirect()->to('/kategori')->with('success', 'Kategori berhasil dihapus');
    }
}
