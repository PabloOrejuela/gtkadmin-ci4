<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model {

    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nombre','cedula','user','password','telefono','telefono_2','direccion','email','estado','idrol','logged','ip','estado','acuerdo_terminos'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    function _getUsuario($usuario){
        $result = NULL;
        $builder = $this->db->table($this->table);
        $builder->select(
            'usuarios.id as id,rango,acuerdo_terminos,
            nombre,user,telefono,email,password,imagen,
            cedula,idrol,logged,rol,administracion,reportes,codigo_socio,miembros,
            '.$this->table.'.estado as estado,
            '.$this->table.'.created_at as miembro_desde'
        )->where('user', $usuario['user'])->where('password', sha1($usuario['password']))->where($this->table.'.estado', 1);
        $builder->join('socios', 'socios.idusuario=usuarios.id');
        $builder->join('rangos', 'rangos.id=socios.idrango');
        $builder->join('roles', 'roles.id=usuarios.idrol');
        $query = $builder->get();
        if ($query->getResult() != null) {
            foreach ($query->getResult() as $row) {
                $result = $row;
            }
        }
        //echo $this->db->getLastQuery();exit;
        return $result;
    }

    function _getLogStatus($id){
        $result = NULL;
        $builder = $this->db->table('usuarios');
        $builder->select('logged')->where('id', $id);
        $query = $builder->get();
        if ($query->getResult() != null) {
            foreach ($query->getResult() as $row) {
                $result = $row->logged;
            }
        }
        //echo $this->db->getLastQuery();
        return $result;
    }

    function _verificaEstadoSocio($id){
        // $result = NULL;
        // $builder = $this->db->table('usuarios');
        // $builder->select('logged')->where('id', $id);
        // $query = $builder->get();
        // if ($query->getResult() != null) {
        //     foreach ($query->getResult() as $row) {
        //         $result = $row->logged;
        //     }
        // }
        //echo $this->db->getLastQuery();
        return 1;
    }
}
