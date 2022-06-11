<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblLogs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idLog'   => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'descripcion'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'idModificado'   => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'null' => true,
            ],
            'idUsuario'   => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'null' => true,
            ],
            'date_create' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'date_update' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('idLog', true);
        $this->forge->createTable('tbl_logs');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_logs');
    }
}