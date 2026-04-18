<?php

namespace App\Controllers;

use App\Models\NotifikasiModel;

class NotifikasiController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $data['notifikasi'] = $db->table('notifikasi')
            ->select('notifikasi.*, notifikasi.pesan, notifikasi.tanggal')
            ->join('notifikasi', 'notifikasi.id_notifikasi = notifikasi.id_notifikasi')
            ->where('notifikasi.id_user', session()->get('id_user'))
            ->orderBy('notifikasi.id', 'DESC')
            ->get()
            ->getResultArray();

        return view('notifikasi/index', $data);
    }

    public function markRead($id)
    {
        $db = \Config\Database::connect();

        $db->table('user_notifikasi')
            ->where('id', $id)
            ->update(['status' => 'dibaca']);

        return $this->response->setJSON(['success' => true]);
    }

    public function markAllRead()
    {
        $db = \Config\Database::connect();

        $db->table('notifikasi')
            ->where('id_user', session()->get('id_user'))
            ->update(['status' => 'dibaca']);

        return $this->response->setJSON(['success' => true]);
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();

        // 🔒 hanya admin boleh hapus
        if (session()->get('role') != 'admin') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Akses ditolak'
            ]);
        }

        $db->table('notifikasi')->delete(['id' => $id]);

        return $this->response->setJSON(['success' => true]);
    }
}
