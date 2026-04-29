<?php

namespace App\Controllers;

use App\Models\UsersModel;

class ProfileController extends BaseController
{
    public function index()
    {
        $model = new UsersModel();

        $data['user'] = $model->find(session()->get('id_user'));

        return view('profile/index', $data);
    }

    public function edit($id = null)
    {
        $model = new UsersModel();
        $id = session()->get('id_user');

        $user = $model->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User tidak ditemukan');
        }

        return view('profile/edit', ['user' => $user]);
    }

    public function update($id = null)
    {
        $model = new UsersModel();
        if (!$id) {
            $id = session()->get('id_user');
        }

        $rules = [
            'nama' => 'required|min_length[3]',
            'username' => 'required|min_length[3]|is_unique[users.username,id_user,' . $id . ']',
            'foto' => 'permit_empty|max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/gif]',
            'no_hp' => 'permit_empty|regex_match[/^[0-9+\-\s]+$/]|min_length[10]|max_length[15]',
            'email' => 'permit_empty|valid_email',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('foto');
        $newName = null;
        $uploadPath = FCPATH . 'upload' . DIRECTORY_SEPARATOR . 'users';

        // Buat folder jika belum ada
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Ambil data user lama untuk menghapus foto lama jika ada
        $userLama = $model->find($id);

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Hapus foto lama jika ada
            if ($userLama && !empty($userLama['foto'])) {
                $oldPhotoPath = $uploadPath . DIRECTORY_SEPARATOR . $userLama['foto'];
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            $newName = time() . '_' . $file->getRandomName();
            if ($file->move($uploadPath, $newName)) {
                // Upload berhasil
            } else {
                return redirect()->back()->withInput()->with('errors', ['foto' => 'Gagal mengupload file. Pastikan folder uploads memiliki izin tulis.']);
            }
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'no_hp' => $this->request->getPost('no_hp'),
            'email' => $this->request->getPost('email'),
        ];

        if ($newName) {
            $data['foto'] = $newName;
        }

        $model->update($id, $data);

        return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui');
    }
}
