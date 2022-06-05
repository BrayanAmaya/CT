<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user=[
            /*[
                'nombre'=>'Dimas',
                'apellido'=>'Amaya',
                'usuario'=>'dtdimasamaya1',
                'password'=>password_hash('dimas',PASSWORD_DEFAULT),
                'email'=>'dimas@gmail.com',
                'estado'=> 1,
                'dui'=>'00013545-1',
                'telefono'=>'7570-4365',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s'),
                'idRol'=>1
            ],
            [
                'nombre'=>'Brayan',
                'apellido'=>'Amaya',
                'usuario'=>'dtbrayanamaya1',
                'password'=>password_hash('brayan',PASSWORD_DEFAULT),
                'email'=>'brayan@gmail.com',
                'estado'=> 1,
                'dui'=>'00014545-2',
                'telefono'=>'7500-2959',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s'),
                'idRol'=>1
            ],
            [
                'nombre'=>'Jaime',
                'apellido'=>'Molina',
                'usuario'=>'dtjaimemolina1',
                'password'=>password_hash('jaime',PASSWORD_DEFAULT),
                'email'=>'jaime@gmail.com',
                'estado'=> 1,
                'dui'=>'00002452-3',
                'telefono'=>'7090-2501',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s'),
                'idRol'=>1
            ],*/
            [
                'nombre'=>'Valentiana',
                'apellido'=>'De la rosa',
                'usuario'=>'dtvalentina',
                'password'=>password_hash('valentina',PASSWORD_DEFAULT),
                'email'=>'valentina@gmail.com',
                'estado'=> 1,
                'dui'=>'000385174',
                'telefono'=>'74950184',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s'),
                'idRol'=>2
            ],
            [
                'nombre'=>'Efrain',
                'apellido'=>'Casas',
                'usuario'=>'dtefrain',
                'password'=>password_hash('efrain',PASSWORD_DEFAULT),
                'email'=>'efrain@gmail.com',
                'estado'=> 1,
                'dui'=>'013948392',
                'telefono'=>'74104189',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s'),
                'idRol'=>2
            ],
            [
                'nombre'=>'Raul',
                'apellido'=>'Arce',
                'usuario'=>'dtraul',
                'password'=>password_hash('raul',PASSWORD_DEFAULT),
                'email'=>'raul@gmail.com',
                'estado'=> 1,
                'dui'=>'130001928',
                'telefono'=>'74003148',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s'),
                'idRol'=>2
            ],
            [
                'nombre'=>'Manuel',
                'apellido'=>'Iglesias',
                'usuario'=>'dtmanuel',
                'password'=>password_hash('manuel',PASSWORD_DEFAULT),
                'email'=>'manuel@gmail.com',
                'estado'=> 1,
                'dui'=>'019000012',
                'telefono'=>'71847293',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s'),
                'idRol'=>2
            ],
            [
                'nombre'=>'Oscar',
                'apellido'=>'Martin',
                'usuario'=>'dtOscar',
                'password'=>password_hash('oscar',PASSWORD_DEFAULT),
                'email'=>'oscar@gmail.com',
                'estado'=> 1,
                'dui'=>'038229203',
                'telefono'=>'72093242',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s'),
                'idRol'=>2
            ],
            [
                'nombre'=>'Ines',
                'apellido'=>'martinez',
                'usuario'=>'dtines',
                'password'=>password_hash('ines',PASSWORD_DEFAULT),
                'email'=>'ines@gmail.com',
                'estado'=> 1,
                'dui'=>'921301928',
                'telefono'=>'73285019',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s'),
                'idRol'=>2
            ],
            [
                'nombre'=>'Pedro',
                'apellido'=>'Rico',
                'usuario'=>'dtpedro',
                'password'=>password_hash('pedro',PASSWORD_DEFAULT),
                'email'=>'pedro@gmail.com',
                'estado'=> 1,
                'dui'=>'0123482091',
                'telefono'=>'74019999',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s'),
                'idRol'=>2
            ],
            [
                'nombre'=>'Clara',
                'apellido'=>'Rodriguez',
                'usuario'=>'dtclara',
                'password'=>password_hash('clara',PASSWORD_DEFAULT),
                'email'=>'clara@gmail.com',
                'estado'=> 1,
                'dui'=>'038293401',
                'telefono'=>'75738927',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s'),
                'idRol'=>2
            ],
            [
                'nombre'=>'Sonia',
                'apellido'=>'Ruis',
                'usuario'=>'dtsonia',
                'password'=>password_hash('sonia',PASSWORD_DEFAULT),
                'email'=>'sonia@gmail.com',
                'estado'=> 1,
                'dui'=>'111111111',
                'telefono'=>'76091273',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s'),
                'idRol'=>2
            ],
            [
                'nombre'=>'Luis',
                'apellido'=>'Tomas',
                'usuario'=>'dtLuis',
                'password'=>password_hash('luis',PASSWORD_DEFAULT),
                'email'=>'luis@gmail.com',
                'estado'=> 1,
                'dui'=>'444444444',
                'telefono'=>'77930172',
                'date_create'=>date('Y-m-d H:i:s'),
                'date_update'=>date('Y-m-d H:i:s'),
                'idRol'=>2
            ],
        ];
        $builder = $this->db->table('tbl_usuarios');
        $builder->insertBatch($user);
    }
}