<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama', 'username', 'password', 'role', 'foto'];

    public function getUsersByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}
