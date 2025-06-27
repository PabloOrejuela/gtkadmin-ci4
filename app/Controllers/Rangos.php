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
                'year,month,left_leg,right_leg,pts_left,pts_right,income,hist_rangos.idrango as idrango,hist_rangos.idsocio as idsocio,hist_rangos.estado as estado,rangos.rango as rango
            ')->where('idsocio', $this->session->id)
                ->join('rangos', 'rangos.id=hist_rangos.idrango')
                ->join('socios', 'socios.id=hist_rangos.idsocio')
                ->findAll();

            $data['title'] = 'Historial de Rangos';
            $data['main_content'] = 'rangos/historial_rangos';
            return view('dashboard/index', $data);
        }else{
            return redirect()->to('logout');
        }
    }
}
