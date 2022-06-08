<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Usuario;

class TipoIncidenciaModel extends Model{
    protected $table      = 'tbl_tipos_de_incidencia';
    protected $primaryKey = 'idTipoIncidencia';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['incidencia'];

    protected $useTimestamps = true;
    protected $createdField  = 'date_create';
    protected $updatedField  = 'date_update';
}