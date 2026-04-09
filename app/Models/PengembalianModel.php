<?php

namespace App\Models;

use CodeIgniter\Model;

class PengembalianModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjam';

    protected $allowedFields = [
        'id_user',
        'id_alat',
        'jumlah',
        'data_peminjam',
        'data_dikembalikan',
        'status',
        'denda'
    ];
}
