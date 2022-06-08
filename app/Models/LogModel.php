<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Usuario;

class LogModel extends Model{
    protected $table      = 'tbl_logs';
    protected $primaryKey = 'idLog';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['descripcion','idModificado','date_create','idUsuario'];

    protected $useTimestamps = true;
    protected $createdField  = 'date_create';
    protected $updatedField  = 'date_update';
    protected $deletedField  = 'date_delete';
}