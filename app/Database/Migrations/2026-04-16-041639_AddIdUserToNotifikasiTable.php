<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIdUserToNotifikasiTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('notifikasi', [
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'after' => 'id_notifikasi',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('notifikasi', 'id_user');
    }
}
