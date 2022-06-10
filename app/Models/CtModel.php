<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\CT;

class CtModel extends Model{
    protected $table      = 'tbl_ct';
    protected $primaryKey = 'idCt';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nombreCt','descripcion','estado','idUsuario'];

    protected $useTimestamps = true;
    protected $createdField  = 'date_create';
    protected $updatedField  = 'date_update';
    protected $deletedField  = 'date_delete';

    protected $beforeInsert = ['agregarEstado'];

    //protected $asignarEncargado;
    protected $asignarEstado;

    /*protected function agregarEncargado($data){
        $data['data']['encargado'] = $this->asignarEncargado;
        return $data;
    }

    public function agregarUnEncargado(string $idUsuario){
        $row = $this->db()->table('tbl_usuarios')->where('idUsuario',$idUsuario)->get()->getFirstRow();
        if($row !== null){
            $this->asignarEncargado = $row->usuario;
        }
    }*/

    protected function agregarEstado($data){
        $data['data']['estado'] = $this->asignarEstado;
        return $data;
    }

    public function agregarUnEstado(){
        $this->asignarEstado = 1;
    }

}