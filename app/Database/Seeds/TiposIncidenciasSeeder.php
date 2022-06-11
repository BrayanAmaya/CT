<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TiposIncidenciasSeeder extends Seeder
{
    public function run()
    {
        $tipoIncidencia=[
            [
                'incidencia'=>'Daño de equipo',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'incidencia'=>'Extavió de equipo',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'incidencia'=>'Limpieza de hardware',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'incidencia'=>'Falta de equipo',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'incidencia'=>'Mantenimiento de software',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'incidencia'=>'Otros',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
        ];
        $builder = $this->db->table('tbl_tipos_de_incidencia');
        $builder->insertBatch($tipoIncidencia);
    }
}