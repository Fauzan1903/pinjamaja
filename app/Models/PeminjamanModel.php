<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjam';

    protected $allowedFields = [
        'id_user',
        'id_alat',
        'jumlah',
        'data_peminjam',
        'data_dikembalikan',
        'status'
    ];

    protected $useTimestamps = false;
}