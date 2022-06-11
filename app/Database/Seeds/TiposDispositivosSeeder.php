<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TiposDispositivosSeeder extends Seeder
{
    public function run()
    {
        $tipoDispositivo=[
            [
                'dispositivo'=>'Mouse',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Teclado',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Bocina',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Pantalla',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Impresora',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Proyector de vídeo',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Microfono',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Escaner',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Cámara web',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ],
            [
                'dispositivo'=>'Panel táctil',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s')
            ]
        ];
        $builder = $this->db->table('tbl_tipos_de_dispositivo');
        $builder->insertBatch($tipoDispositivo);
    }
}