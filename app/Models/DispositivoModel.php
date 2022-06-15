<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Incidencia;

class IncidenciaModel extends Model{
    protected $table      = 'tbl_dispositivos';
    protected $primaryKey = 'idDispositivo';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nombreDispositivo','numeroDeSerie','estado','detalle', 'cantidad','idTipoDispositivo','idCt'];

    protected $useTimestamps = true;
    protected $createdField  = 'date_create';
    protected $updatedField  = 'date_update';
    protected $deletedField  = 'date_delete';

    protected $beforeInsert = ['agregarEstado'];

    protected $asignarEstado;

    protected function agregarEstado($data){
        $data['data']['estado'] = $this->asignarEstado;
        return $data;
    }

    public function agregarUnEstado(){
        $this->asignarEstado = 1;
    }

}