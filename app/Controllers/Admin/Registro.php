<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Usuario;

class Registro extends BaseController{
    protected $configs;
    
/*-------------------------------------------------------------------------------------------------------------------*/
    public function __construct(){
        $this->configs=config('CT');
    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function registrarUsuario(){

        $validar = service('validation');
        
        $validar->setRules([
            'nombre'=>'required|alpha_space|min_length[3]|max_length[25]',
            'apellido'=>'required|alpha_space|min_length[3]|max_length[32]',
            'email'=>'required|valid_email|is_unique[tbl_usuarios.email]|max_length[32]',
            'telefono'=>'required|numeric|is_unique[tbl_usuarios.telefono]|min_length[8]|max_length[8]',
            'dui'=>'required|numeric|is_unique[tbl_usuarios.dui]|min_length[9]|max_length[9]',
            'password'=>'required|matches[c-password]|min_length[8]|max_length[32]'
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
                'is_unique' => 'Este correo ya existe',
                'max_length' => 'El correo es demasiado extenso'
            ],
            'telefono' => [
                'required' => 'Digite un número de telefono',
                'numeric' => 'Solo digite numeros',
                'is_unique' => 'Este número de telefono ya existe',
                'min_length' => 'El número de telefono debe tener 8 digítos',
                'max_length' => 'El número de telefono debe tener 8 digítos'
            ],
            'dui' => [
                'required' => 'Digite un número de Dui',
                'numeric' => 'Solo digite numeros',
                'is_unique' => 'Este número de dui ya existe',
                'min_length' => 'El número de DUI debe tener 9 digítos',
                'max_length' => 'El número de DUI debe tener 9 digítos'
            ],
            'password' => [
                'required' => 'Digite su contraseña',
                'matches' => 'Las contraseñas no coinciden',
                'min_length' => 'La contraseña es muy corta',
                'max_length' => 'La contraseña es demasiado extensa'
            ],
        ]
        );

        if(!$validar->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validar->getErrors());
        }

        $usuario = new Usuario($this->request->getPost());

        $usuario->generarUsername();

        $model=model('UsuarioModel');

        $model->agregarUnRol($this->configs->defaultRolUsuario);

        $model->agregarUnEstado();

        if(!$model->save($usuario)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al registrar el usuario.'
            ]);
        }

        return redirect()->route('register')->with('msg',[
            'type'=>'success',
            'body'=>'Usuario registrado correctamente'
        ]);
    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function registrarCentroTecnologia(){
        /*$dispositivos = $_POST['dispositivos'];
        $chekeado = $_POST['check'];

        //dd($chekeado);

        foreach ($chekeado as $key) {
            if($key == null){
            echo $key."<br>";
            }
        }
        //dd($dispositivos);
        for ($i=0; $i < count($dispositivos) ; $i++) { 
            //if(isset($chekeado[$i])){
                echo ("Si es ".$i." ".$dispositivos[$i]."<br>"); 
            //}
        }*/
        
        $modelCt = model('CtModel');
        $validar = service('validation');
        //alpha_numeric_punct
        $validar->setRules([
            'nombreCt'=>'required|is_unique[tbl_ct.nombreCt]',
            'encargado'=>'required',
            'descripcion'=>'required|alpha_numeric_punct',
        ],
        [
            'nombreCt' => [
                'required' => 'Digite un nombre',
                'is_unique' => 'El nombre del centro de tecnología ya existe.'
            ],
            'encargado' => [
                'required' => 'Seleccione un encargado',
            ],
            'descripcion' => [
                'required' => 'Digite una descripcion',
                'alpha_numeric_punct'=> 'Caracteres no permitidos o uso de «Enter»'
                //'not_in_list'=>'Caracteres no permitidos'
            ]
        ]
        ); 

        if(!$validar->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validar->getErrors());
        }

        $modelUsuario = model('UsuarioModel');

        $idUsuario = trim($this->request->getVar('encargado'));
        $nombreCt = trim($this->request->getVar('nombreCt'));
        $descripcion = trim($this->request->getVar('descripcion'));

        $buscar = $modelUsuario->findAll();
        $valorMostar= null;
        
        foreach ($buscar as $key) {
            if(password_verify($key->idUsuario,$idUsuario)){
                $valorMostar = $key->idUsuario;
                break;
            }
        }

        $data = [
            'nombreCt' => $nombreCt,
            'descripcion' => $descripcion,
            'idUsuario' => $valorMostar
        ];

        if($valorMostar == null){
            return redirect()->back()->withInput()->with('errors',[
                'encargado'=>'Encargado no valido'
            ]);
        }
        //$modelCt->agregarUnEncargado($valorMostar);
        $modelCt->agregarUnEstado();

        if(!$modelCt->save($data)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al guardar el centro de tecnología.'
            ]);
        }

        return redirect()->route('registerCt')->with('msg',[
            'type'=>'success',
            'body'=>'Centro de tecnología agregado correctamente.']);
        
    }

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
                'body'=>'Error al reportar la incidencia.'
            ]);
        }
        
        return redirect()->route('incidencia')->with('msg',[
            'type'=>'success',
            'body'=>'Incidencia reportada correctamente.']
        );
        
    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function filtrarIncidencias(){
        $fechaInicio = trim($this->request->getVar('fechaInicio'));
        $fechaFinal = trim($this->request->getVar('fechaFinal'));
        $filtroEstado = trim($this->request->getVar('filtroEstado'));
        $filtroUsuario = trim($this->request->getVar('filtroUsuario'));
        $filtroTipoIncidencia = trim($this->request->getVar('filtroTipoIncidencia'));

        $modelUsuario = model('UsuarioModel');
        $modelTipoIncidencia = model('TipoIncidenciaModel');

        $buscarUsuario = $modelUsuario->findAll();
        $buscarTipoIncidencia = $modelTipoIncidencia->findAll();

        $valorUsuario= $filtroUsuario;
        $valorTipoIncidencia = $filtroTipoIncidencia;
        $estados = ['0','1','all']; 

        if($fechaInicio == $fechaFinal){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Las fechas no pueden ser iguales!.'
            ]);
        }
        
        if(!in_array($filtroEstado,$estados)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!.'
            ]);
        }

        foreach ($buscarUsuario as $key) {
            if(password_verify($key->idUsuario,$filtroUsuario)){
                $valorUsuario = $key->idUsuario;
                break;
            }
        }
        if($valorUsuario == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }

        foreach ($buscarTipoIncidencia as $key) {
            if(password_verify($key->idTipoIncidencia,$filtroTipoIncidencia)){
                $valorTipoIncidencia = $key->idTipoIncidencia;
                break;
            }
        }
        if($valorUsuario == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }

        if($fechaInicio > $fechaFinal){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Fecha inicio no puede ser mayor a la fecha final!'
            ]);
        }
        return redirect()->route('filtrarIncidencia')->with('data',[
            'fechaInicio'=> $fechaInicio,
            'fechaFinal'=> $fechaFinal,
            'filtroEstado' => $filtroEstado,
            'filtroUsuario' => $valorUsuario,
            'filtroTipoIncidencia'=>$valorTipoIncidencia
        ]);
    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function cerrar(){
        session()->destroy();
        return redirect()->route('index');
    }
}