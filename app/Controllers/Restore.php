<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Restore extends Controller
{
    private $restorePassword = 'admin123'; // GANTI PASSWORD INI!

    public function index()
    {
        return view('restore/restore_login');
    }

    public function auth()
    {
        $password = $this->request->getPost('password');

        if ($password === $this->restorePassword) {
            session()->set('restore_access', true);
            return redirect()->to('/restore/form');
        }

        return redirect()->back()->with('error', 'Password salah!');
    }

    public function form()
    {
        if (!session()->get('restore_access')) {
            return redirect()->to('/restore');
        }

        return view('restore/restore');
    }

    public function process()
    {
        if (!session()->get('restore_access')) {
            return redirect()->to('/restore');
        }

        $file = $this->request->getFile('file_sql');

        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid');
        }

        $ext = strtolower($file->getClientExtension());

        if ($ext !== 'sql') {
            return redirect()->back()->with('error', 'File harus berformat .sql');
        }

        // TAMBAHAN : Otomatis membuat database jika belum ada
        $dbName = 'pustaka'; // Sesuaikan dengan nama database

        $conn = new \mysqli('localhost', 'root', '', '');

        if ($conn->connect_error) {
            die('Koneksi gagal');
        }

        // Buat database jika belum ada
        $conn->query("CREATE DATABASE IF NOT EXISTS $dbName");

        // Pilih database
        $conn->select_db($dbName);

        // Sampai sini ----------------------------------------

        $db = \Config\Database::connect();

        try {
            $sqlLines = file($file->getTempName());
            $query = '';

            foreach ($sqlLines as $line) {
                $line = trim($line);

                if ($line == '' || substr($line, 0, 2) == '--') {
                    continue;
                }

                $query .= $line;

                if (substr($line, -1) == ';') {
                    $db->query($query);
                    $query = '';
                }
            }

            session()->remove('restore_access');

            return redirect()->to('/')->with('success', 'Restore berhasil!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
