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

    protected $allowedFields = ['numeroDeSerie','estado','detalle', 'cantidad','idTipoDispositivo','idCt'];

    protected $useTimestamps = true;
    protected $createdField  = 'date_create';
    protected $updatedField  = 'date_update';
    protected $deletedField  = 'date_delete';

}