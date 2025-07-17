<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\InscripcionModel;
use App\Models\PedidoModel;


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

    function _getCantSociosActivosPierna($pierna, $idsocio, $campo){
        
        //Tarigo el total de socios que son directos de un socio o son hijos del socio en una pierna en ese mes y que estén activos
        
        $result = NULL;
        $builder = $this->db->table('socios');
        $builder->where($campo, $idsocio);
        $builder->where('posicion', $pierna);
        $builder->where('estado', 1);
        
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

    /**
     * Verfica y actualiza el estado de un socio
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function _actualizaEstado($arraySocios){
        $this->inscripcionModel = new InscripcionModel();
        $this->pedidoModel = new PedidoModel();

        $fechaCadena = date('Y-m');
        $month = date('m');
        $year = date('Y');
        
        $num_dias = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        
        //Verifica si la variable no es null
        if ($arraySocios) {
            foreach ($arraySocios as $key => $socio) {
                $estado = 0;
                //Verifica si tiene pagada la inscripcion
                if ($socio->id) {
                    $inscripcion = $this->inscripcionModel->select('estado')->where('idsocio', $socio->id)->first();
                }
                
                //Verifica si tiene pagada la inscripcion
                if ($socio->id) {
                    $recompra = $this->pedidoModel->select('estado')
                            ->where('idsocio', $socio->id)
                            ->where('fecha_compra BETWEEN "'. date('Y-m-d', strtotime($fechaCadena.'-01')). '" and "'. date('Y-m-d', strtotime($fechaCadena.'-'.$num_dias)).'"')
                            ->first();
                }
                
                //Actualiza el estado
                $builder = $this->db->table('socios');
                $builder->where('id', $socio->id);

                if (isset($inscripcion) && isset($recompra)) {
                    if ($inscripcion->estado == 1 && $recompra->estado == 1) {
                        $estado = 1;
                    }
                }else{
                    $$estado = 0;
                }
                $builder->set('estado', $estado);
                $builder->update();
                
            }
        }
    }
}
