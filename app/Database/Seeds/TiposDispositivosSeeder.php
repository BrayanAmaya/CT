<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TiposDispositivosSeeder extends Seeder
{
    public function run()
    {
        $tipoDispositivo=[
            [
                'dispositivo'=>'Dispositivo 1',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Dispositivo 2',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Dispositivo 3',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Dispositivo 4',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Dispositivo 5',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Dispositivo 6',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Dispositivo 7',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Dispositivo 8',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Dispositivo 9',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Dispositivo 10',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ]
        ];
        $builder = $this->db->table('tbl_tipos_de_dispositivo');
        $builder->insertBatch($tipoDispositivo);
    }
}