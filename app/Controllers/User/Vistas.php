<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class Vistas extends BaseController{
/*-------------------------------------------------------------------------------------------------------------------*/
    public function index(){
        $modelIncidencia = model('IncidenciaModel');
        return view ('user/incidencias',[
            'incidencias' => $modelIncidencia->where('idUsuario',session('idUsuario'))->findAll()
        ]);
    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function miPerfil(){
        $model=model('UsuarioModel');
        return view ('user/perfil',[
            'usuario' => $model->find(session('idUsuario'))
        ]);
    }
/*-------------------------------------------------------------------------------------------------------------------*/

    public function incidencia(){
        $modelIncidencia = model('TipoIncidenciaModel');
        $modelCt = model('CtModel');

        return view ('user/agregarIncidencia',[
            'incidencia' => $modelIncidencia->findAll(),
            'ct' => $modelCt->where('estado',1)->findAll()
        ]);
    }
/*-------------------------------------------------------------------------------------------------------------------*/

    public function actualizarPerfil(){
        $model=model('UsuarioModel');
        return view ('user/actualizarPerfil',[
            'usuario' => $model->find(session('idUsuario'))
        ]);
    }
    
/*-------------------------------------------------------------------------------------------------------------------*/
    public function report(){
        $modelTipoIncidencia = model('TipoIncidenciaModel');
        return view ('user/reportes',[
            'tipoIncidencia' => $modelTipoIncidencia->findAll(),
        ]);
    }

/*-------------------------------------------------------------------------------------------------------------------*/  
    public function cerrar(){
        session()->destroy();
        return redirect()->route('index');
    }
}