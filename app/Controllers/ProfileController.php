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
            'foto' => 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
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

        return redirect()->to('/profile')->with('success', 'Profile updated successfully');
    }

    public function updatePassword()
    {
        $model = new UsersModel();
        $id = session()->get('id_user');

        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[new_password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = $model->find($id);
        if (!password_verify($this->request->getPost('current_password'), $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Current password is incorrect');
        }

        $data = [
            'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT),
        ];

        $model->update($id, $data);

        return redirect()->to('/profile')->with('success', 'Password updated successfully');
    }
}
