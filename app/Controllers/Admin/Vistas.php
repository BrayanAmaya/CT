<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Usuario;

class Vistas extends BaseController{
    protected $configs;
    
/*-------------------------------------------------------------------------------------------------------------------*/
    public function __construct(){
        $this->configs=config('CT');
    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function index(){
        $modelIncidencia = model('IncidenciaModel');
        $modelUsuario = model('UsuarioModel');
        $modelTipoIncidencia = model('TipoIncidenciaModel');
        return view ('admin/incidencias',[
            'incidencias' => $modelIncidencia->findAll(),
            'usuarios' => $modelUsuario->findAll(),
            'tipoIncidencia' => $modelTipoIncidencia->findAll()
        ]);
    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function incidencia(){
        $modelIncidencia = model('TipoIncidenciaModel');
        $modelCt = model('CtModel');

        return view ('admin/agregarIncidencia',[
            'incidencia' => $modelIncidencia->findAll(),
            'ct' => $modelCt->where('estado',1)->findAll()
        ]);
    }
/*-------------------------------------------------------------------------------------------------------------------*/
    public function filtrarIncidencia(){
        $modelIncidencia = model('IncidenciaModel');
        
        if(session('data.filtroEstado') == 'all'){
            if(session('data.filtroUsuario') == 'all'){
                if(session('data.filtroTipoIncidencia') =='all'){
                    return view ('admin/filtrarIncidencia',[
                        'incidencias' => $modelIncidencia->where('date_create >',session('data.fechaInicio'))->where('date_update <',session('data.fechaFinal'))->findAll()
                    ]);
                }else{
                    return view ('admin/filtrarIncidencia',[
                        'incidencias' => $modelIncidencia->where('idTipoIncidencia',session('data.filtroTipoIncidencia'))->where('date_create >',session('data.fechaInicio'))->where('date_update <',session('data.fechaFinal'))->findAll()
                    ]);
                }
            }else{
                if(session('data.filtroTipoIncidencia') =='all'){
                    return view ('admin/filtrarIncidencia',[
                        'incidencias' => $modelIncidencia->where('idUsuario',session('data.filtroUsuario'))->where('date_create >',session('data.fechaInicio'))->where('date_update <',session('data.fechaFinal'))->findAll()
                    ]);
                }else{
                    return view ('admin/filtrarIncidencia',[
                        'incidencias' => $modelIncidencia->where('idTipoIncidencia',session('data.filtroTipoIncidencia'))->where('idUsuario',session('data.filtroUsuario'))->where('date_create >',session('data.fechaInicio'))->where('date_update <',session('data.fechaFinal'))->findAll()
                    ]);
                }
            }
        }else{
            if(session('data.filtroUsuario') == 'all'){
                if(session('data.filtroTipoIncidencia') =='all'){
                    return view ('admin/filtrarIncidencia',[
                        'incidencias' => $modelIncidencia->where('estado',session('data.filtroEstado'))->where('date_create >',session('data.fechaInicio'))->where('date_update <',session('data.fechaFinal'))->findAll()
                    ]);
                }else{
                    return view ('admin/filtrarIncidencia',[
                        'incidencias' => $modelIncidencia->where('idTipoIncidencia',session('data.filtroTipoIncidencia'))->where('estado',session('data.filtroEstado'))->where('date_create >',session('data.fechaInicio'))->where('date_update <',session('data.fechaFinal'))->findAll()
                    ]);
                }
            }else{
                if(session('data.filtroTipoIncidencia') =='all'){
                    return view ('admin/filtrarIncidencia',[
                        'incidencias' => $modelIncidencia->where('idUsuario',session('data.filtroUsuario'))->where('estado',session('data.filtroEstado'))->where('date_create >',session('data.fechaInicio'))->where('date_update <',session('data.fechaFinal'))->findAll()
                    ]);
                }else{
                    return view ('admin/filtrarIncidencia',[
                        'incidencias' => $modelIncidencia->where('idTipoIncidencia',session('data.filtroTipoIncidencia'))->where('idUsuario',session('data.filtroUsuario'))->where('estado',session('data.filtroEstado'))->where('date_create >',session('data.fechaInicio'))->where('date_update <',session('data.fechaFinal'))->findAll()
                    ]);
                }
            }
        }
    }
/*-------------------------------------------------------------------------------------------------------------------*/
    public function register(){
        return view ('admin/registrarUsuario');
    }
/*-------------------------------------------------------------------------------------------------------------------*/
    public function report(){
        return view ('admin/reportes');
    }    
    
/*-------------------------------------------------------------------------------------------------------------------*/
    public function buscarUsuario(){

        $estatus = trim($this->request->getVar('estado'));
        if($estatus == null) {
            $estatus = 1;
        }

        $model = model('UsuarioModel');
        
        return view ('admin/buscarUsuario',[
            'usuarios' => $model->where('estado', $estatus)->findAll()
        ]);

    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function buscarCt(){
        $estatus = trim($this->request->getVar('estado'));
        if($estatus == null) {
            $estatus = 1;
        }
        $modelCt = model('CtModel');
        return view ('admin/buscarCt',[
            'cts' => $modelCt->where('estado',$estatus)->findAll()
        ]);

    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function agregarDispositivo(){
        return view ('admin/agregarDispositivo');
    }
    
/*-------------------------------------------------------------------------------------------------------------------*/
    public function miPerfil(){
        $model=model('UsuarioModel');
        return view ('admin/perfil',[
            'usuario' => $model->find(session('idUsuario'))
        ]);
    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function actualizarPerfil(){
        $model=model('UsuarioModel');
        return view ('admin/actualizarPerfil',[
            'usuario' => $model->find(session('idUsuario'))
        ]);
    }
/*-------------------------------------------------------------------------------------------------------------------*/
    public function registerCt(){
        $modelCt =model('CtModel');
        $model=model('UsuarioModel');
        $ct = $modelCt->findColumn('idUsuario');
        $modelTipoDispositivo = model('TipoDispositivoModel');

        if($ct==null){
            $ct = ['vacio'];
        }
        return view ('admin/registrarCt',[
            'usuarios' => $model->where('estado',1)->findAll(),
            'ct' => $ct,
            'dispositivos' => $modelTipoDispositivo->findAll()
        ]);
    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function actualizar(){
        if(!isset($_GET['id'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        $valorRecibido = $_GET['id'];
        $model = model('UsuarioModel');
        $valorMostar = null;
        $buscar = $model->findAll();

        foreach ($buscar as $key) {
            if(password_verify($key->idUsuario,$valorRecibido)){
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
        
        return view ('admin/actualizarUsuario',[
            'mostrar' => $model->find($valorMostar)
        ]);
    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function actualizarCts(){
        if(!isset($_GET['id'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        $valorRecibido = $_GET['id'];
        $model = model('CtModel');
        $modelUsuario=model('UsuarioModel');
        $valorMostar = null;
        $valorQuitar= null;
        $buscar = $model->findAll();
        foreach ($buscar as $key) {
            if(password_verify($key->idCt,$valorRecibido)){
                $valorMostar = $key->idCt;
                $valorQuitar = $key->idUsuario;
                break;
            }
        }
        if($valorMostar == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }

        $ct = $model->findColumn('idUsuario');

        $ct = array_diff($ct,array($valorQuitar));
        if($ct==null){
            $ct = ['vacio'];
        }
        
        return view ('admin/actualizarCt',[
            'mostrar' => $model->find($valorMostar),
            'ct' => $ct,
            'usuarios' => $modelUsuario->where('estado',1)->findAll()
        ]);
    }

/*-------------------------------------------------------------------------------------------------------------------*/
    public function resolverIncidencia(){
        if(!isset($_GET['id'])){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        $valorRecibido = $_GET['id'];
        $modelIncidencia = model('IncidenciaModel');
        $valorMostar = null;
        $estado = null;
        $buscar = $modelIncidencia->findAll();

        foreach ($buscar as $key) {
            if(password_verify($key->idIncidencia,$valorRecibido)){
                $valorMostar = $key->idIncidencia;
                $estado = $key->estado;
                break;
            }
        }
        if($valorMostar == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        if($estado == '0'){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        
        return view ('admin/resolverIncidencias',[
            'incidencia' => $modelIncidencia->find($valorMostar)
        ]);
    }
}