<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblCt extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'idCt'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'nombreCt'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
                'unique'  => true,
            ],
            'encargado'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'descripcion'       => [
                'type'       => 'TEXT',
                'null' => false,
            ],
            'estado'       => [
                'type'       => 'BIT',
                'null' => false,
            ],
            'date_create' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'date_update' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'date_delete' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'idUsuario'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('idCt', true);
        $this->forge->addForeignKey('idUsuario','tbl_usuarios','idUsuario','CASCADE','SET NULL');
        $this->forge->createTable('tbl_ct');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tbl_ct');
    }
}