<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnsToPeminjaman extends Migration
{
    public function up()
    {
        $this->forge->addColumn('peminjaman', [
            'id_alat' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('peminjaman', ['id_alat', 'jumlah']);
    }
}
