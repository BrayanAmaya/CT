<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Usuario;

class UpdateDelete extends BaseController{
    protected $configs;
    
/*-------------------------------------------------------------------------------------------------------------------*/
    public function __construct(){
        $this->configs=config('CT');
    }
/*-------------------------------------------------------------------------------------------------------------------*/
    public function updatePerfil(){
        if(!isset($_GET['id'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        
        $valorRecibido = $_GET['id'];
        //$valor
        $model = model('UsuarioModel');
        $valorMostar = null;
        $usuarioComparar = null;
        $emailComparar = null;
        $telefonoComparar = null;
        $passwordComparar= null;
        $buscar = $model->findAll();
        if($valorRecibido == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
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

        if($valorMostar == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
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

        if($password != null && $passwordAnterior == null){
            return redirect()->back()->withInput()->with('errorsP','Ingrese una contraseña.');
        }

        if($password != null){
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

        return redirect()->route('perfil')->with('msg',[
            'type'=>'success',
            'body'=>'Datos del usuario guardados correctamente.']);
    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function actualizarUsuario(){
        if(!isset($_GET['id'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }

        $valorRecibido = $_GET['id'];
        $model = model('UsuarioModel');
        $valorMostar = null;
        $usuarioComparar = null;
        $emailComparar = null;
        $telefonoComparar = null;
        $duiComparar = null;
        $buscar = $model->findAll();
        
        foreach ($buscar as $key) {
            if(password_verify($key->idUsuario,$valorRecibido)){
                $valorMostar = $key->idUsuario;
                $usuarioComparar = $key->usuario;
                $emailComparar = $key->email;
                $telefonoComparar = $key->telefono;
                $duiComparar = $key->dui;
                break;
            }
        }
        if($valorMostar == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }

        $validar = service('validation');
        
        $nombre = trim($this->request->getVar('nombre'));
        $apellido = trim($this->request->getVar('apellido'));
        $usuario = trim($this->request->getVar('usuario'));
        $email = trim($this->request->getVar('email'));
        $telefono = trim($this->request->getVar('telefono'));
        $dui = trim($this->request->getVar('dui'));
        $password = trim($this->request->getVar('password'));
        $estado = trim($this->request->getVar('estado'));
        $idRol = trim($this->request->getVar('idRol'));


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

        if($dui != $duiComparar){
            $validar->setRules([
                'dui'=>'is_unique[tbl_usuarios.dui]'
            ],
            [
                'dui' => [
                        'is_unique' => 'El DUI ya se encuentra disponible'
                ],
            ]
            );
            if(!$validar->withRequest($this->request)->run()){
                return redirect()->back()->withInput()->with('errors',$validar->getErrors());
            }
        }
        if($password != null){
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
            'dui'=>'required|numeric|min_length[9]|max_length[9]',
            'password'=>'matches[c-password]',
            'estado'=>'required|in_list[0,1]',
            'idRol'=>'required|in_list[1,2]'
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
            'dui' => [
                'required' => 'Digite un número de Dui',
                'numeric' => 'Solo digite numeros',
                'min_length' => 'El número de DUI debe tener 9 digítos',
                'max_length' => 'El número de DUI debe tener 9 digítos'
            ],
            'password' => [
                'matches' => 'Las contraseñas no coinciden',
            ],
            'estado' => [
                'required' => 'Seleccione un estado valido',
                'in_list' => 'Estado no valido'
               
            ],
            'idRol' => [
                'required' => 'Seleccione un rol valido',
                'in_list' => 'Rol no valido'
            ],
        ]
        );

        if(!$validar->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validar->getErrors());
        }
        $agregarEstado = (int)$estado;

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
                'dui' => $dui,
                'password' => $insertarPassword,
                'estado' => $agregarEstado,
                'idRol' => $idRol
            ];
        }else{
            $dataActualizada= [
                'idUsuario' => $valorMostar,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'usuario' => $usuario,
                'email' => $email,
                'telefono' => $telefono,
                'dui' => $dui,
                'estado' => $agregarEstado,
                'idRol' => $idRol
            ];  
        }

        if(!$model->save($dataActualizada)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al actualizar los datos.'
            ]);
        }

        return redirect()->route('search')->with('msg',[
            'type'=>'success',
            'body'=>'Usuario actualizado correctamente.']);
    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function actualizarCt(){
        if(!isset($_GET['id'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        
        $valorRecibido = $_GET['id'];


        $model = model('CtModel');
        $modelUsuario = model('UsuarioModel');
        $valorMostar = null;
        $ctComparar = null;
        $buscar = $model->findAll();
        
        foreach ($buscar as $key) {
            if(password_verify($key->idCt,$valorRecibido)){
                $valorMostar = $key->idCt;
                $ctComparar = $key->nombreCt;
                break;
            }
        }
        if($valorMostar == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }

        $validar = service('validation');

        $nombreCt = trim($this->request->getVar('nombreCt'));
        $idUsuario = trim($this->request->getVar('encargado'));
        $descripcion = trim($this->request->getVar('descripcion'));
        $estado = trim($this->request->getVar('estado'));

        if($nombreCt != $ctComparar){
            $validar->setRules([
                'nombreCt'=>'is_unique[tbl_ct.nombreCt]'
            ],
            [
                'nombreCt' => [
                        'is_unique' => 'El nombre del centro de tecnología ya existe.'
                ],
            ]
            );
            if(!$validar->withRequest($this->request)->run()){
                return redirect()->back()->withInput()->with('errors',$validar->getErrors());
            }
        }
        
        $validar->setRules([
            'nombreCt'=>'required',
            'encargado'=>'required',
            'descripcion'=>'required|alpha_numeric_space',
            'estado'=>'required|in_list[0,1]',
        ],
        [
            'nombreCt' => [
                'required' => 'Digite un nombre'
            ],
            'encargado' => [
                'required' => 'Seleccione un encargado',
            ],
            'descripcion' => [
                'required' => 'Digite una descripcion',
                'alpha_numeric_space'=> 'Caracteres no permitidos o uso de «Enter»'
            ],
            'estado' => [
                'required' => 'Seleccione un estado valido',
                'in_list' => 'Estado no valido'
               
            ],
        ]
        ); 

        if(!$validar->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validar->getErrors());
        }

        $agregarUsuario = null;
        $buscarUsuario = $modelUsuario->findAll();
        
        foreach ($buscarUsuario as $key) {
            if(password_verify($key->idUsuario,$idUsuario)){
                $agregarUsuario = $key->idUsuario;
                break;
            }
        }
        $agregarEstado = (int)$estado;

        $dataActualizada= [
            'idCt' => $valorMostar,
            'nombreCt' => $nombreCt,
            'descripcion' => $descripcion,
            'idUsuario' => $agregarUsuario,
            'estado' => $agregarEstado,
        ];  

        if(!$model->save($dataActualizada)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al actualizar los datos.'
            ]);
        }

        return redirect()->route('searchCt')->with('msg',[
            'type'=>'success',
            'body'=>'Centro de tecnología actualizado correctamente.']);

    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function actualizarDispositivo(){
        if(!isset($_GET['id'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        
        $valorRecibido = $_GET['id'];


        $modelDispositivo = model('DispositivoModel');
        $modelTipoDispositivo = model('TipoDispositivoModel');
        $modelCt  = model('CtModel');
        //$modelUsuario = model('UsuarioModel');
        $valorMostar = null;
        //$ctComparar = null;
        $buscar = $modelDispositivo->findAll();
        
        foreach ($buscar as $key) {
            if(password_verify($key->idDispositivo,$valorRecibido)){
                $valorMostar = $key->idDispositivo;
                break;
            }
        }
        if($valorMostar == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }

        $validar = service('validation');

        $nombreDispostivo = trim($this->request->getVar('nombreDispositivo'));
        $numeroDeSerie = trim($this->request->getVar('numeroDeSerie'));
        $detalle = trim($this->request->getVar('detalle'));
        $td = trim($this->request->getVar('Td'));
        $ct = trim($this->request->getVar('Ct'));
        $estado = trim($this->request->getVar('estado'));
        $agregarTd=null;
        $agregarCt=null;
        $buscarTd = $modelTipoDispositivo->findAll();
        $buscarCt = $modelCt->findAll();
        
        foreach ($buscarTd as $key) {
            if(password_verify($key->idTipoDispositivo,$td)){
                $agregarTd = $key->idTipoDispositivo;
                break;
            }
        }
        if($agregarTd == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Tipo de dispositivo no valido!'
            ]);
        }
        foreach ($buscarCt as $key) {
            if(password_verify($key->idCt,$ct)){
                $agregarCt = $key->idCt;
                break;
            }
        }
        if($agregarCt == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Centro de tecnología no valido!'
            ]);
        }
        
        $validar->setRules([
            'nombreDispositivo'=>'required|alpha_space',
            'numeroDeSerie'=>'required|alpha_numeric_punct',
            'detalle'=>'required|alpha_numeric_punct',
            'Td'=>'required',
            'Ct'=>'required',
            'estado'=>'required|in_list[0,1]',
        ],
        [
            'nombreDispositivo' => [
                'required' => 'Digite un nombre para el dispositivo',
                'alpha_space' => 'Caracteres no permitidos',
            ],
            'numeroDeSerie' => [
                'required' => 'Digite un número de serie',
                'alpha_numeric_punct' => 'Caracteres no permitidos',
            ],
            'detalle' => [
                'required' => 'Digite un detalle',
                'alpha_numeric_punct' => 'Caracteres no permitidos',
            ],
            'Td' => [
                'required' => 'Seleccione un tipo de dispositivo',
            ],
            'Ct' => [
                'required' => 'Seleccione un centro de tecnología',
            ],
            'estado' => [
                'required' => 'Seleccione un estado valido',
                'in_list' => 'Estado no valido'
               
            ],
        ]
        ); 

        if(!$validar->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validar->getErrors());
        }
        
        $agregarEstado = (int)$estado;

        $dataActualizada= [
            'idDispositivo' => $valorMostar,
            'nombreDispositivo' => $nombreDispostivo,
            'numeroDeSerie' => $numeroDeSerie,
            'detalle' => $detalle,
            'idTipoDispositivo' => $agregarTd,
            'idCt' => $agregarCt,
            'estado' => $agregarEstado,
        ];  

        if(!$modelDispositivo->save($dataActualizada)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al actualizar los datos.'
            ]);
        }
        return redirect()->route('searchDispositivo')->with('msg',[
            'type'=>'success',
            'body'=>'Dispositivo actualizado correctamente.']);

    }
    /*-------------------------------------------------------------------------------------------------------------------*/
    public function darDeBaja(){
        if(!isset($_GET['estado'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        if(!isset($_GET['id'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }

        $valorRecibidoEstado = $_GET['estado'];
        $valorRecibidoId = $_GET['id'];
        $model = model('UsuarioModel');
        $valorMostar = null;
        $buscar = $model->findAll();
        $estados = ['0','1']; 

        if(!in_array($valorRecibidoEstado,$estados)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!.'
            ]);
        }

        foreach ($buscar as $key) {
            if(password_verify($key->idUsuario,$valorRecibidoId)){
                $valorMostar = $key->idUsuario;
                break;
            }
        }
        if($valorMostar == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        $agregarEstado = (int)$valorRecibidoEstado;

        $data = [
         'estado' => $agregarEstado,
         'idUsuario'  => $valorMostar,
        ];
        
        if(!$model->save($data)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al dar de baja.'
            ]);
        }

        return redirect()->route('search')->with('msg',[
            'type'=>'success',
            'body'=>'El usuario se dio de baja.']);
    }
/*-------------------------------------------------------------------------------------------------------------------*/
    public function darDeBajaCt(){

        if(!isset($_GET['estado'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        if(!isset($_GET['id'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }

        $valorRecibidoEstado = $_GET['estado'];
        $valorRecibidoId = $_GET['id'];
        $model = model('CtModel');
        $valorMostar = null;
        $buscar = $model->findAll();
        $estados = ['0','1']; 

        if(!in_array($valorRecibidoEstado,$estados)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!.'
            ]);
        }

        foreach ($buscar as $key) {
            if(password_verify($key->idCt,$valorRecibidoId)){
                $valorMostar = $key->idCt;
                break;
            }
        }
        if($valorMostar == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        $agregarEstado = (int)$valorRecibidoEstado;

        $data = [
         'estado' => $agregarEstado,
         'idCt'  => $valorMostar,
        ];
        
        if(!$model->save($data)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al dar de baja.'
            ]);
        }

        return redirect()->route('searchCt')->with('msg',[
            'type'=>'success',
            'body'=>'El centro de tecnología se dio de baja.']);
    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function darDeBajaDispositivo(){

        if(!isset($_GET['estado'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        if(!isset($_GET['id'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }

        $valorRecibidoEstado = $_GET['estado'];
        $valorRecibidoId = $_GET['id'];
        $modelDispositivo = model('DispositivoModel');
        $valorMostar = null;
        $buscar = $modelDispositivo->findAll();
        $estados = ['0','1']; 

        if(!in_array($valorRecibidoEstado,$estados)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!.'
            ]);
        }

        foreach ($buscar as $key) {
            if(password_verify($key->idDispositivo,$valorRecibidoId)){
                $valorMostar = $key->idDispositivo;
                break;
            }
        }
        if($valorMostar == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        $agregarEstado = (int)$valorRecibidoEstado;

        $data = [
         'estado' => $agregarEstado,
         'idDispositivo'  => $valorMostar,
        ];
        
        if(!$modelDispositivo->save($data)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al dar de baja.'
            ]);
        }

        return redirect()->route('searchDispositivo')->with('msg',[
            'type'=>'success',
            'body'=>'Dispositivo se dio de baja.']);
    }
/*-------------------------------------------------------------------------------------------------------------------*/
    public function volverUsuario(){
        if(!isset($_GET['estado'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        if(!isset($_GET['id'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }

        $valorRecibidoEstado = $_GET['estado'];
        $valorRecibidoId = $_GET['id'];
        $model = model('UsuarioModel');
        $valorMostar = null;
        $buscar = $model->findAll();
        $estados = ['0','1']; 

        if(!in_array($valorRecibidoEstado,$estados)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!.'
            ]);
        }

        foreach ($buscar as $key) {
            if(password_verify($key->idUsuario,$valorRecibidoId)){
                $valorMostar = $key->idUsuario;
                break;
            }
        }
        if($valorMostar == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        $agregarEstado = (int)$valorRecibidoEstado;

        $data = [
         'estado' => $agregarEstado,
         'idUsuario'  => $valorMostar,
        ];
        
        if(!$model->save($data)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al dar de alta.'
            ]);
        }

        return redirect()->route('search')->with('msg',[
            'type'=>'success',
            'body'=>'El usuario se dio de alta.']);
    }
/*-------------------------------------------------------------------------------------------------------------------*/
    public function volverCt(){
        if(!isset($_GET['id'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        if(!isset($_GET['estado'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        $valorRecibidoEstado = $_GET['estado'];
        $valorRecibidoId = $_GET['id'];
        $model = model('CtModel');
        $valorMostar = null;
        $buscar = $model->findAll();
        $estados = ['0','1']; 

        if(!in_array($valorRecibidoEstado,$estados)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!.'
            ]);
        }

        foreach ($buscar as $key) {
            if(password_verify($key->idCt,$valorRecibidoId)){
                $valorMostar = $key->idCt;
                break;
            }
        }
        if($valorMostar == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        $agregarEstado = (int)$valorRecibidoEstado;
        
        $data = [
        'estado' => $agregarEstado,
        'idCt'  => $valorMostar,
        ];
        
        if(!$model->save($data)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al dar de alta.'
            ]);
        }

        return redirect()->route('searchCt')->with('msg',[
            'type'=>'success',
            'body'=>'El centro de tecnología se dio de alta.']);
    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function volverDispositivo(){
        if(!isset($_GET['id'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        if(!isset($_GET['estado'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        $valorRecibidoEstado = $_GET['estado'];
        $valorRecibidoId = $_GET['id'];
        $modelDispositivo = model('DispositivoModel');
        $valorMostar = null;
        $buscar = $modelDispositivo->findAll();
        $estados = ['0','1']; 

        if(!in_array($valorRecibidoEstado,$estados)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!.'
            ]);
        }

        foreach ($buscar as $key) {
            if(password_verify($key->idDispositivo,$valorRecibidoId)){
                $valorMostar = $key->idDispositivo;
                break;
            }
        }
        if($valorMostar == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        $agregarEstado = (int)$valorRecibidoEstado;
        
        $data = [
        'estado' => $agregarEstado,
        'idDispositivo'  => $valorMostar,
        ];
        
        if(!$modelDispositivo->save($data)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al dar de alta.'
            ]);
        }

        return redirect()->route('searchDispositivo')->with('msg',[
            'type'=>'success',
            'body'=>'El dispositivo se dio de alta.']);
    }

/*-------------------------------------------------------------------------------------------------------------------*/ 
    public function resuelveIncidencia(){
        if(!isset($_GET['id'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        $valorRecibidoId = $_GET['id'];
        $modelIncidencia = model('IncidenciaModel');
        $valorMostar = null;
        $buscar = $modelIncidencia->findAll();
        $estado = 0;

        foreach ($buscar as $key) {
            if(password_verify($key->idIncidencia,$valorRecibidoId)){
                $valorMostar = $key->idIncidencia;
                break;
            }
        }
        if($valorMostar == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        $validar = service('validation');
        $comentarioPor = trim($this->request->getVar('comentarioPor'));

        $validar->setRules([
            'comentarioPor'=>'required',
        ],
        [
            'comentarioPor' => [
                'required' => 'Digite un nombre'
            ],
        ]
        ); 

        if(!$validar->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validar->getErrors());
        }

        $data = [
            'idIncidencia' => $valorMostar,
            'comentarioPor' => $comentarioPor,
            'resueltoPor' => session('idUsuario'),
            'estado' => $estado,
        ];

        if(!$modelIncidencia->save($data)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al resolver incidencia.'
            ]);
        }
        return redirect()->route('incidencia')->with('msg',[
            'type'=>'success',
            'body'=>'La incidencia se resolvió correctamente.']
        );
    }
}