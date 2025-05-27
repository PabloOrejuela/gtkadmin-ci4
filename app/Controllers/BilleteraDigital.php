<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BilleteraDigital extends BaseController {

    public function acl() {
        $data['idrol'] = $this->session->idrol;
        $data['id'] = $this->session->id;
        $data['logged'] = $this->usuarioModel->_getLogStatus($data['id']);
        $data['nombre'] = $this->session->nombre;
        $data['miembro_desde'] = $this->session->created_at;
        return $data;
    }

    public function index(){
        $data = $this->acl();
        
        if ($data['logged'] == 1 && $this->session->miembros == 1) {

            $data['session'] = $this->session;
            $data['sistema'] = $this->sistemaModel->findAll();

            $data['billetera'] = $this->billeteraDigitalModel->where('idsocio', $this->session->id)->findAll();

            $data['title'] = 'Billetera Digital';
            $data['main_content'] = 'billetera/billetera';
            return view('dashboard/index', $data);
        }else{
            return redirect()->to('logout');
        }
        
    }
    
}
