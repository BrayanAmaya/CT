<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TiposIncidenciasSeeder extends Seeder
{
    public function run()
    {
        $tipoIncidencia=[
            [
                'incidencia'=>'Incidencia 1',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'incidencia'=>'Incidencia 2',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'incidencia'=>'Incidencia 3',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'incidencia'=>'Incidencia 4',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'incidencia'=>'Incidencia 5',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'incidencia'=>'Incidencia 6',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'incidencia'=>'Incidencia 7',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'incidencia'=>'Incidencia 8',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'incidencia'=>'Incidencia 9',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'incidencia'=>'Incidencia 10',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ]
        ];
        $builder = $this->db->table('tbl_tipos_de_incidencia');
        $builder->insertBatch($tipoIncidencia);
    }
}