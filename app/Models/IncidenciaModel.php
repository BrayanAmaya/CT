<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Usuario;

class IncidenciaModel extends Model{
    protected $table      = 'tbl_incidencias';
    protected $primaryKey = 'idIncidencia';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
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
        if($idTipoIncidencia == '1' || $idTipoIncidencia == '5' || $idTipoIncidencia == '10'){
            $asignarNivel = 'Alto';
        }elseif($idTipoIncidencia == '2' || $idTipoIncidencia == '4' || $idTipoIncidencia == '6'){
            $asignarNivel = 'Medio';
        }elseif($idTipoIncidencia == '3' || $idTipoIncidencia == '7' || $idTipoIncidencia == '8' || $idTipoIncidencia == '9'){
            $asignarNivel = 'Bajo';
        }else{
            $asignarNivel = 'Default';
        }
    }

    protected function agregarEstado($data){
        $data['data']['estado'] = $this->asignarEstado;
        return $data;
    }

    public function agregarUnEstado(){
        $this->asignarEstado = 1;
    }

}