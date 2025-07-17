<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Rangos extends BaseController {

    public function acl() {
        $data['idrol'] = $this->session->idrol;
        $data['id'] = $this->session->id;
        $data['logged'] = $this->usuarioModel->_getLogStatus($data['id']);
        $data['nombre'] = $this->session->nombre;
        $data['miembro_desde'] = $this->session->created_at;
        
        return $data;
    }

    public function historialRangos() {
        
        $data = $this->acl();
        
        if ($data['logged'] == 1 && $this->session->miembros == 1) {

            $data['session'] = $this->session;
            $data['sistema'] = $this->sistemaModel->findAll();

            $data['historialRangos'] = $this->histRangoModel->select(
                'year,month,left_leg,right_leg,pts_left,pts_right,income,hist_rangos.idrango as idrango,hist_rangos.id as id,
                hist_rangos.idsocio as idsocio,hist_rangos.estado as estado,rangos.rango as rango')
                ->where('idsocio', $this->session->id)
                ->join('rangos', 'rangos.id=hist_rangos.idrango')
                ->join('socios', 'socios.id=hist_rangos.idsocio')
                ->orderBy('id', 'desc')
                ->findAll();
            
            $data['title'] = 'Historial de Rangos';
            $data['main_content'] = 'rangos/historial_rangos';
            return view('dashboard/index', $data);
        }else{
            return redirect()->to('logout');
        }
    }

    public function progresoRangos() {
        
        $data = $this->acl();
        
        if ($data['logged'] == 1 && $this->session->miembros == 1) {

            $data['session'] = $this->session;
            $data['sistema'] = $this->sistemaModel->findAll();
            $data['rangos'] = $this->rangoModel->findAll();

            $data['historialRangos'] = $this->histRangoModel->select(
                'year,month,left_leg,right_leg,pts_left,pts_right,income,hist_rangos.idrango as idrango,
                hist_rangos.idsocio as idsocio,hist_rangos.estado as estado,rangos.rango as rango')->where('idsocio', $this->session->id)
                ->join('rangos', 'rangos.id=hist_rangos.idrango')
                ->join('socios', 'socios.id=hist_rangos.idsocio')
                ->findAll();

            //Obtengo la cantidad de socios patrocinados
            $patrocinados_izq = $this->socioModel->_getCantSociosActivosPierna(1, $data['id'], 'patrocinador');
            $patrocinados_der = $this->socioModel->_getCantSociosActivosPierna(2, $data['id'], 'patrocinador');

            //Obtengo la cantidad de socios hijos por derrame
            $hijos_izq = $this->socioModel->_getCantSociosActivosPierna(1, $data['id'], 'nodopadre');
            $hijos_der = $this->socioModel->_getCantSociosActivosPierna(2, $data['id'], 'nodopadre');

            //Uno los resultados de hijos y patrocinados de cada pierna y para evitar errores de NULL los casteo a "array"
            $puntos_izq = array_unique(array_merge((array)$patrocinados_izq, (array)$hijos_izq), SORT_REGULAR);
            $puntos_der = array_unique(array_merge((array)$patrocinados_der, (array)$hijos_der), SORT_REGULAR);
            

            //Contar los puntos de cada pierna
            $socios_izq = $puntos_izq ? count($puntos_izq) : 0;
            $socios_der = $puntos_der ? count($puntos_der) : 0;
            $data['pts'] = $this->puntosRedModel->where('idsocio', $this->session->id)->where('mes', date('m'))->where('anio', date('Y'))->first();
            $rangoAccede = $this->rangoModel->_verificaMeta($data['pts'], $data['rangos']);

            $data['progreso'] = [
                'pierna_izq' => $socios_izq,
                'pierna_der' => $socios_der,
                'rango_actual' => $this->rangoModel->where('rango', $this->session->rango)->findAll(),
                'rango_siguiente' => $this->rangoModel->where('id', $data['id']+1)->findAll(),
                'meta_rango' => $this->rangoModel->where('rango', $this->session->rango)->findAll(),
                'accede_rango' => $this->rangoModel->select('id,rango')->where('id', $rangoAccede['id'])->findAll(),
            ];
            //echo '<pre>'.var_export($data['progreso']['rango_actual'][0]->cant_socios_pierna, true).'</pre>';exit;
            $data['title'] = 'Seguimiento del Progreso del Rango';
            $data['main_content'] = 'rangos/progreso_rangos';
            return view('dashboard/index', $data);
        }else{
            return redirect()->to('logout');
        }
    }
}
