<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function index()
    {
        return view ('user/home');
    }
    public function miPerfil(){
        $model=model('UsuarioModel');
        return view ('user/perfil',[
            'usuario' => $model->find(session('idUsuario'))
        ]);
    }

    public function updatePerfil(){
        
        $valorRecibido = $_GET['id'];
        $model = model('UsuarioModel');
        $valorMostar = null;
        $usuarioComparar = null;
        $emailComparar = null;
        $telefonoComparar = null;
        $buscar = $model->findAll();
        
        foreach ($buscar as $key) {
            if(password_verify($key->idUsuario,$valorRecibido)){
                $valorMostar = $key->idUsuario;
                $usuarioComparar = $key->usuario;
                $emailComparar = $key->email;
                $telefonoComparar = $key->telefono;
                break;
            }
        }

        $validar = service('validation');
        
        $nombre = trim($this->request->getVar('nombre'));
        $apellido = trim($this->request->getVar('apellido'));
        $usuario = trim($this->request->getVar('usuario'));
        $email = trim($this->request->getVar('email'));
        $telefono = trim($this->request->getVar('telefono'));
        $password = trim($this->request->getVar('password'));
        
        if($usuario != $usuarioComparar){
            $validar->setRules([
                'usuario'=>'is_unique[tbl_usuarios.usuario]'
            ],
            [
                'usuario' => [
                        'is_unique' => 'El usuario ya se encuentra disponible'
                ],
            ]
            );
            if(!$validar->withRequest($this->request)->run()){
                return redirect()->back()->withInput()->with('errors',$validar->getErrors());
            }
        }

        if($email != $emailComparar){
            $validar->setRules([
                'email'=>'is_unique[tbl_usuarios.email]'
            ],
            [
                'email' => [
                        'is_unique' => 'El correo ya se encuentra disponible'
                ],
            ]
            );
            if(!$validar->withRequest($this->request)->run()){
                return redirect()->back()->withInput()->with('errors',$validar->getErrors());
            }
        }

        if($telefono != $telefonoComparar){
            $validar->setRules([
                'telefono'=>'is_unique[tbl_usuarios.telefono]'
            ],
            [
                'telefono' => [
                        'is_unique' => 'El telefono ya se encuentra disponible'
                ],
            ]
            );
            if(!$validar->withRequest($this->request)->run()){
                return redirect()->back()->withInput()->with('errors',$validar->getErrors());
            }
        }

        $validar->setRules([
            'nombre'=>'required|alpha_space|min_length[3]|max_length[25]',
            'apellido'=>'required|alpha_space|min_length[3]|max_length[32]',
            'email'=>'required|valid_email|max_length[32]',
            'telefono'=>'required|numeric|min_length[8]|max_length[8]',
            'password'=>'matches[c-password]|min_length[8]|max_length[32]'
        ],
        [
            'nombre' => [
                    'required' => 'Digite un nombre',
                    'alpha_space' => 'Caracteres no permitidos',
                    'min_length' => 'El nombre es muy corto',
                    'max_length' => 'El nombre es demasiado largo'
            ],
            'apellido' => [
                'required' => 'Digite un apellido',
                'alpha_space' => 'Caracteres no permitidos',
                'min_length' => 'El apellido es muy corto',
                'max_length' => 'El apellido es demasiado largo'
            ],
            'email' => [
                'required' => 'Digite un correo',
                'valid_email' => 'Correo no valido',
                'max_length' => 'El correo es demasiado extenso'
            ],
            'telefono' => [
                'required' => 'Digite un número de telefono',
                'numeric' => 'Solo digite numeros',
                'min_length' => 'El número de telefono debe tener 8 digítos',
                'max_length' => 'El número de telefono debe tener 8 digítos'
               
            ],
            'password' => [
                'matches' => 'Las contraseñas no coinciden',
                'min_length' => 'La contraseña es muy corta',
                'max_length' => 'La contraseña es demasiado extensa'
            ],
        ]
        );

        if(!$validar->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validar->getErrors());
        }
        
        $dataActualizada=[];
        if($password != null){
            $insertarPassword = password_hash($password,PASSWORD_DEFAULT);
            $dataActualizada= [
                'idUsuario' => $valorMostar,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'usuario' => $usuario,
                'email' => $email,
                'telefono' => $telefono,
                'password' => $insertarPassword
            ];
        }else{
            $dataActualizada= [
                'idUsuario' => $valorMostar,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'usuario' => $usuario,
                'email' => $email,
                'telefono' => $telefono,
            ];  
        }

        $model->save($dataActualizada);

        return redirect()->route('perfilUser')->with('msg',[
            'type'=>'success',
            'body'=>'Datos del usuario actualizado correctamente.']);
    }

    public function actualizarPerfil(){
        $model=model('UsuarioModel');
        return view ('user/actualizarPerfil',[
            'usuario' => $model->find(session('idUsuario'))
        ]);
    }
    public function cerrarS(){
        session()->destroy();
        return redirect()->route('index');
    }
}