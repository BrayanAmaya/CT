<?php
namespace App\Entities;

use CodeIgniter\Entity;

class Incidencia extends Entity{
    /*Variables de tiempo en la entidad Usuario*/
    protected $dates = ['date_create','date_update','date_delete'];

    public function mostrarTipoIncidencia(string $idTipoIncidencia){
        $modelTipoIncidencia = model('TipoIncidenciaModel');
        $row = $modelTipoIncidencia->where('idTipoIncidencia',$idTipoIncidencia)->first();
        return $row->incidencia;
    }

    public function mostrarUsuario(string $idUsuario){
        $modelUsuario = model('UsuarioModel');
        $row = $modelUsuario->where('idUsuario',$idUsuario)->get()->getFirstRow();
        return $row->usuario;
    }
    public function mostrarCt(string $idCt){
        $modelCt = model('CtModel');
        $row = $modelCt->where('idCt',$idCt)->get()->getFirstRow();
        return $row->nombreCt;
    }
}