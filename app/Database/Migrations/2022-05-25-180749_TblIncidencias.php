<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblIncidencias extends Migration
{
    public function up()
    {
        //$this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'idIncidencia'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'descripcion'       => [
                'type'       => 'TEXT',
                'null' => false,
            ],
            'imagen'       => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'estado'       => [
                'type'       => 'BIT',
                'null' => false,
            ],
            'nivel'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'resueltoPor'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'comentarioPor'       => [
                'type'       => 'TEXT',
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
            'idUsuario'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'null' => true,
            ],
            'idTipoIncidencia'          => [
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
        $this->forge->addKey('idIncidencia', true);
        //$this->forge->addForeignKey('idUsuario','tbl_usuarios','idUsuario','CASCADE','SET NULL');
        //$this->forge->addForeignKey('idTipoIncidencia','tbl_tipos_de_incidencia','idTipoIncidencia','CASCADE','SET NULL');
        //$this->forge->addForeignKey('idCt','tbl_ct','idCt','CASCADE','SET NULL');
        $this->forge->createTable('tbl_incidencias');
        //$this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tbl_incidencias');
    }
}