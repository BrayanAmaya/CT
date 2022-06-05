<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Usuario;

class UsuarioModel extends Model{
    protected $table      = 'tbl_usuarios';
    protected $primaryKey = 'idUsuario';

    protected $useAutoIncrement = true;

    protected $returnType     = Usuario::class;
    protected $useSoftDeletes = true;

    protected $allowedFields = ['usuario','password','nombre', 'apellido','estado','email','dui','telefono','idRol','date_delete'];

    protected $useTimestamps = true;
    protected $createdField  = 'date_create';
    protected $updatedField  = 'date_update';
    protected $deletedField  = 'date_delete';

    protected $beforeInsert = ['agregarRol','agregarEstado'];

    protected $asignarRol;
    protected $asignarEstado;
    protected $asignarVistaRol;

    protected function agregarRol($data){
        $data['data']['idRol'] = $this->asignarRol;
        return $data;
    }

    public function agregarUnRol(string $rol){
        $row = $this->db()->table('tbl_roles')->where('rol',$rol)->get()->getFirstRow();
        if($row !== null){
            $this->asignarRol = $row->idRol;
        }
    }

    protected function agregarEstado($data){
        $data['data']['estado'] = $this->asignarEstado;
        return $data;
    }

    public function agregarUnEstado(){
        $this->asignarEstado = 1;
    }

    public function buscarUsuario(string $usuario, string $value){
        return $this->where($usuario,$value)->first();
    }

    public function buscarRol(string $value){
        $row = $this->db()->table('tbl_roles')->where('idRol',$value)->get()->getFirstRow();
        if($row !== null){
            $this->asignarVistaRol = $row->rol;
        }
    }

}