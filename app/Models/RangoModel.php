<?php

namespace App\Models;

use CodeIgniter\Model;

class RangoModel extends Model {

    protected $table            = 'rangos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
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

    public function _verificaMeta($valor, $rangos){
        $res = null;
        foreach ($rangos as $key => $rango) {
            
            if ($valor >= $rango->cant_socios_pierna) {
                $res['id'] = $rango->id;
                $res['income'] = $rango->ingreso_mensual;
            }else{
                $res['id'] = 0;
            }
        }
        if ($res['id'] == '0') {
            $res['id'] = 1;
            $res['income'] = 0;
        }

        return $res;
    }
}
