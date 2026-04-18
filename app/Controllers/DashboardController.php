<?php

namespace App\Controllers;

class DashboardController extends BaseController
{

    public function index()
    {
        $AlatModel = new \App\Models\AlatModel();
        $UsersModel = new \App\Models\UsersModel();
        $PeminjamanModel = new \App\Models\PeminjamanModel();

        $db = \Config\Database::connect();

        // Statistik
        $data['total_alat'] = $AlatModel->countAll();
        $data['total_user'] = $UsersModel->countAll();
        $data['total_pinjam'] = $PeminjamanModel->countAll();

        // Status alat
        $data['alat_tersedia'] = $db->table('alat')->where('persediaan >', 0)->countAllResults();
        $data['alat_habis'] = $db->table('alat')->where('persediaan', 0)->countAllResults();

        // Recent activity
        $data['recent'] = $db->table('peminjaman')
            ->select('peminjaman.*, users.nama as nama_user, alat.nama_alat')
            ->join('users', 'users.id_user = peminjaman.id_user')
            ->join('alat', 'alat.id_alat = peminjaman.id_alat')
            ->orderBy('peminjaman.id_peminjam', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        return view('layouts/dashboard', $data);
    }
}
