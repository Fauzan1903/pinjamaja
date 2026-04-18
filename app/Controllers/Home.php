<?php

namespace App\Controllers;

use App\Models\NotifikasiModel;

class Home extends BaseController
{
    protected NotifikasiModel $NotifikasiModel;

    public function __construct()
    {
        $this->NotifikasiModel = new NotifikasiModel();
    }

    public function index(): string
    {
        return view('layouts/dashboard');
    }

    public function getNotifikasi()
    {
        $builder = $this->NotifikasiModel->where('status', 'belum_dibaca');

        // Filter notifikasi berdasarkan role
        if (session()->get('role') == 'user') {
            // User hanya melihat notifikasi yang ditujukan untuk mereka atau notifikasi umum
            $builder->groupStart()
                ->where('id_user', session()->get('id_user'))
                ->orWhere('id_user', null)
                ->groupEnd();
        }
        // Admin melihat semua notifikasi

        $notifikasi = $builder->findAll();
        return $this->response->setJSON($notifikasi);
    }

    public function notifikasi(): string
    {
        $builder = $this->NotifikasiModel->orderBy('tanggal', 'DESC');

        // Filter notifikasi berdasarkan role
        if (session()->get('role') == 'user') {
            // User hanya melihat notifikasi yang ditujukan untuk mereka atau notifikasi umum
            $builder->groupStart()
                ->where('id_user', session()->get('id_user'))
                ->orWhere('id_user', null)
                ->groupEnd();
        }
        // Admin melihat semua notifikasi

        $notifikasi = $builder->findAll();
        return view('notifikasi/index', ['notifikasi' => $notifikasi]);
    }

    public function markAsRead($id)
    {
        $this->NotifikasiModel->update($id, ['status' => 'dibaca']);
        return $this->response->setJSON(['success' => true]);
    }

    public function markAllAsRead()
    {
        $this->NotifikasiModel->where('status', 'belum_dibaca')->set(['status' => 'dibaca'])->update();
        return $this->response->setJSON(['success' => true]);
    }

    public function deleteNotifikasi($id)
    {
        $this->NotifikasiModel->delete($id);
        return $this->response->setJSON(['success' => true]);
    }
}
