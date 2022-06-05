<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblDispositivos extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'idDispositivo'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'numeroDeSerie'       => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'estado'       => [
                'type'       => 'BIT',
                'null' => false,
            ],
            'detalle'       => [
                'type'       => 'TEXT',
                'null' => false,
            ],
            'cantidad'       => [
                'type'       => 'INT',
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
            'date_delete' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'idTipoDispositivo'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'null' => true,
            ],
            'idCt'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('idDispositivo', true);
        $this->forge->addForeignKey('idTipoDispositivo','tbl_tipos_de_dispositivo','idTipoDispositivo','CASCADE','SET NULL');
        $this->forge->addForeignKey('idCt','tbl_ct','idCt','CASCADE','SET NULL');
        $this->forge->createTable('tbl_dispositivos');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tbl_dispositivos');
    }
}