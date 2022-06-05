<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblUsuarios extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'idUsuario'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'nombre'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'apellido'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'usuario'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
                'unique' => true,
            ],
            'password'       => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
                'unique' => true,
            ],
            'estado'       => [
                'type'       => 'BIT',
                'null' => false,
            ],
            'dui'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
                'unique' => true,
            ],
            'telefono'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
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
            'idRol'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('idUsuario', true);
        $this->forge->addForeignKey('idRol','tbl_roles','idRol','CASCADE','SET NULL');
        $this->forge->createTable('tbl_usuarios');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tbl_usuarios');
    }
}