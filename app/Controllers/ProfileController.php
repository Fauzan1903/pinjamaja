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

    public function edit()
    {
        $model = new UsersModel();
        $id = session()->get('id_user');

        $user = $model->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User tidak ditemukan');
        }

        return view('profile/edit', ['user' => $user]);
    }

    public function update()
    {
        $model = new UsersModel();
        $id = session()->get('id_user');

        $rules = [
            'nama' => 'required|min_length[3]',
            // 🔥 perbaikan di sini (pakai id_user, bukan id)
            'username' => 'required|min_length[3]|is_unique[users.username,id_user,' . $id . ']',
            'foto' => 'permit_empty|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
            'no_hp' => 'permit_empty|regex_match[/^[0-9+\-\s]+$/]|min_length[10]|max_length[15]',
            'email' => 'permit_empty|valid_email',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('foto');
        $newName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = time() . '_' . $file->getRandomName();
            $file->move('uploads/users', $newName);
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

        // 🔥 pastikan update pakai primary key yang benar
        $model->where('id_user', $id)->set($data)->update();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
