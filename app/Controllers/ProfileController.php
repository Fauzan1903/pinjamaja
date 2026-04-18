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

    public function edit($id)
    {
        $model = new UsersModel();
        $data['user'] = $model->find($id);

        if (!$data['user']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }

        return view('profile/edit', $data);
    }

    public function update()
    {
        $model = new UsersModel();
        $id = session()->get('id_user');

        $rules = [
            'nama' => 'required|min_length[3]',
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
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = time() . '_' . $file->getRandomName();
            $file->move('uploads/users', $newName);
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
        ];

        if ($newName) {
            $data['foto'] = $newName;
        }

        $model->update($id, $data);

        $model->update($id, $data);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
