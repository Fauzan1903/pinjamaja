<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNoHpToUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'after' => 'foto',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'no_hp');
    }
}
