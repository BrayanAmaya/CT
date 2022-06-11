<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class Registro extends BaseController{
/*-------------------------------------------------------------------------------------------------------------------*/
    public function reportarIncidencia(){
        $validar = service('validation');
        
        $validar->setRules([
            'incidencia'=>'required',
            'ct'=>'required',
            'descripcion'=>'required|alpha_numeric_punct',
        ],
        [
            'incidencia' => [
                    'required' => 'Seleccione una incidencia',
            ],
            'ct' => [
                'required' => 'Seleccione un centro de tecnología',
            ],
            'descripcion' => [
                'required' => 'Digite una descripción',
                'alpha_numeric_punct'=>'Caracteres no permitidos'
            ],
        ]
        );

        if(!$validar->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validar->getErrors());
        }

        $imageFile = $this->request->getFile('imagen');
        $validationRules = [
            'imagen' => [
                'rules' => [
                    'uploaded[imagen]',
                    'mime_in[imagen,image/png,image/jpg,image/jpeg]',
                   /* 'max_size[imagePerfil,100]',
                    'max_dims[imagePerfil,1024,768]',*/
                ],
                'errors' => [
                    'uploaded' => 'No ha subido imagen',
                    'mime_in' => 'Tipo de imagen no disponible'
                ],
            ]
        ];
        if (! $this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errorImg',$this->validator->getErrors());
        }

        if(!$imageFile->isValid() && $imageFile->hasMoved()){
            return redirect()->back()->withInput()->with('errorImg',$this->validator->getErrors());
        }
        
        $imagen = \Config\Services::image()->withFile($imageFile)->fit(250,250)->save($imageFile);

        $newName=$imageFile->getRandomName();
        
        $direccion='C:/laragon/www/ct/public/img/imagesIncidencias/';
        $direccionGuardado='/img/imagesIncidencias/'.$newName;

        $modelIncidencia = model('IncidenciaModel');
        $modelTipoIncidencia = model('TipoIncidenciaModel');
        $modelCt = model('CtModel');

        $idTipoIncidencia = trim($this->request->getVar('incidencia'));
        $idCt = trim($this->request->getVar('ct'));
        $descripcion = trim($this->request->getVar('descripcion'));
        
        $tipoIncidencia = null;
        $ct = null;

        $buscarTipoIncidencia = $modelTipoIncidencia->findAll();
        $buscarCt = $modelCt->findAll();

        foreach ($buscarTipoIncidencia as $key) {
            if(password_verify($key->idTipoIncidencia,$idTipoIncidencia)){
                $tipoIncidencia = $key->idTipoIncidencia;
                break;
            }
        }
        foreach ($buscarCt as $key) {
            if(password_verify($key->idCt,$idCt)){
                $ct = $key->idCt;
                break;
            }
        }
        
        $agregar = (int)$tipoIncidencia;

        $modelIncidencia->agregarUnEstado();
        $modelIncidencia->agregarUnNivel($tipoIncidencia);

        if(!$imageFile->move($direccion,$newName)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'Danger',
                'body'=>'Imagen no se pudo guardar.']);
        }
        
        $data = [
            'descripcion' => $descripcion,
            'imagen' => $direccionGuardado,
            'idUsuario' => session('idUsuario'),
            'idTipoIncidencia'=>$tipoIncidencia,
            'idCt'=>$ct
        ];

        if(!$modelIncidencia->save($data)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al reportar incidencia.'
            ]);
        }
        
        return redirect()->route('user')->with('msg',[
            'type'=>'success',
            'body'=>'Incidencia reportada correctamente.']
        );
    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function updatePerfil(){
        
        $valorRecibido = $_GET['id'];
        $model = model('UsuarioModel');
        $valorMostar = null;
        $usuarioComparar = null;
        $emailComparar = null;
        $telefonoComparar = null;
        $passwordComparar= null;
        $buscar = $model->findAll();
        
        foreach ($buscar as $key) {
            if(password_verify($key->idUsuario,$valorRecibido)){
                $valorMostar = $key->idUsuario;
                $usuarioComparar = $key->usuario;
                $emailComparar = $key->email;
                $telefonoComparar = $key->telefono;
                $passwordComparar = $key->password;
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
        $passwordAnterior = trim($this->request->getVar('passwordAnterior'));
        
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
        if($passwordAnterior != null){
            foreach ($buscar as $key) {
                if(!password_verify($passwordAnterior,$passwordComparar)){
                    return redirect()->back()->withInput()->with('errorsP','Contraseña no valida.');
                }
            }
        }
        if($password!=null){
            $validar->setRules([
                'password'=>'matches[c-password]|min_length[8]|max_length[32]'
            ],
            [
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
        }

        $validar->setRules([
            'nombre'=>'required|alpha_space|min_length[3]|max_length[25]',
            'apellido'=>'required|alpha_space|min_length[3]|max_length[32]',
            'email'=>'required|valid_email|max_length[32]',
            'telefono'=>'required|numeric|min_length[8]|max_length[8]',
            'password'=>'matches[c-password]'
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

        if(!$model->save($dataActualizada)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al actualizar los datos.'
            ]);
        }

        return redirect()->route('perfilUser')->with('msg',[
            'type'=>'success',
            'body'=>'Datos del usuario actualizado correctamente.']);
    }
}