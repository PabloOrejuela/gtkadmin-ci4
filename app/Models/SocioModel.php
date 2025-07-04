<?php

namespace App\Models;

use CodeIgniter\Model;

class SocioModel extends Model {

    protected $table            = 'socios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'codigo_socio',
        'patrocinador',
        'fecha_inscripcion',
        'idusuario',
        'idrango',
        'estado',
        'nodopadre',
        'posicion',
        'porcentaje_billetera'
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

    function _calculaPuntos($pierna, $idsocio){
        /*
        $fechaCadena = date('Y-m');
        $month = date('m');
        $year = date('Y');
        
        $num_dias = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        */

        //Tarigo el total de socios que son directos de un socio o son hijos del socio en una pierna en ese mes
        
        $result = NULL;
        $builder = $this->db->table('socios');
        $builder->where('patrocinador', $idsocio);
        $builder->orWhere('nodopadre', $idsocio);
        
        $query = $builder->get();
        if ($query->getResult() != null) {
            foreach ($query->getResult() as $row) {

                if ($row->estado == 1 && $row->posicion == $pierna) {
                    $result[] = $row;
                }
            }
        }
        //echo $this->db->getLastQuery();
        return $result;                               
    }
}
