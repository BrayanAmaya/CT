<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Incidencia;

class IncidenciaModel extends Model{
    protected $table      = 'tbl_incidencias';
    protected $primaryKey = 'idIncidencia';

    protected $useAutoIncrement = true;

    protected $returnType     = Incidencia::class;
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'descripcion','imagen','estado', 'nivel','resueltoPor','comentarioPor','idUsuario',
        'idTipoIncidencia','idCt'];

    protected $useTimestamps = true;
    protected $createdField  = 'date_create';
    protected $updatedField  = 'date_update';
    protected $deletedField  = 'date_delete';

    protected $beforeInsert = ['agregarNivel','agregarEstado'];

    protected $asignarNivel;
    protected $asignarEstado;

    protected function agregarNivel($data){
        $data['data']['nivel'] = $this->asignarNivel;
        return $data;
    }

    public function agregarUnNivel(string $idTipoIncidencia){
        if($idTipoIncidencia == '2' || $idTipoIncidencia == '4'){
            $this->asignarNivel = 'Alto';
        }elseif($idTipoIncidencia == '1' || $idTipoIncidencia == '3' || $idTipoIncidencia == '5'){
            $this->asignarNivel = 'Medio';
        }elseif($idTipoIncidencia == '6'){
            $this->asignarNivel = 'Bajo';
        }else{
            $this->asignarNivel = 'Default';
        }
    }

    protected function agregarEstado($data){
        $data['data']['estado'] = $this->asignarEstado;
        return $data;
    }

    public function agregarUnEstado(){
        $this->asignarEstado = 1;
    }

    public function mostrarTipoIncidencia(string $id){
        $modelTipoIncidencia = model('TipoIncidenciaModel');
        $row = $modelTipoIncidencia->where('idTipoIncidencia',$id)->first();
        return $row->incidencia;
    }

    public function mostrarUsuario(string $idUsuario){
        //$modelUsuario = model('UsuarioModel');
        $row = $this->db()->table('tbl_usuarios')->where('idUsuario',$idUsuario)->get()->getFirstRow();
        return $row->usuario;
    }

}