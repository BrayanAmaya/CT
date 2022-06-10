<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Usuario;

class TipoDispositivoModel extends Model{
    protected $table      = 'tbl_tipos_de_dispositivo';
    protected $primaryKey = 'idTipoDispositivo';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['dispositivo'];

    protected $useTimestamps = true;
    protected $createdField  = 'date_create';
    protected $updatedField  = 'date_update';
}