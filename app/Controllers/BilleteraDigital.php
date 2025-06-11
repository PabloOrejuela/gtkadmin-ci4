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
            $data['bir_pendientes'] = $this->birModel->selectSum('cantidad', 'totalBir')->where('idsocio', $this->session->id)->where('estado', 0)->findAll();
            $data['total_retirado'] = $this->billeteraDigitalModel
                                    ->selectSum('cantidad', 'total')
                                    ->where('idsocio', $this->session->id)
                                    ->where('tipo_mov', 2)
                                    ->findAll();

            $data['total_acreditado'] = $this->billeteraDigitalModel
                                    ->selectSum('cantidad', 'total')
                                    ->where('idsocio', $this->session->id)
                                    ->where('tipo_mov', 1)
                                    ->orWhere('tipo_mov', 3)
                                    ->findAll();
                                    
            $data['idsocio'] = $this->socioModel->where('idusuario', $this->session->id)->first();

            $total = 0;
            foreach ($data['billetera'] as $key => $mov) {
                $total += $mov->cantidad;
            }
            
            $data['total'] = $total;

            $data['title'] = 'Billetera Digital';
            $data['main_content'] = 'billetera/billetera';
            return view('dashboard/index', $data);
        }else{
            return redirect()->to('logout');
        }
        
    }

    public function updateCantidadAhorro() {
        $id = $this->request->getPostGet('id');
        
        $data = [
            'porcentaje_billetera' => $this->request->getPostGet('porcentaje_billetera')
        ];
        $this->socioModel->update($id, $data);

        $idsocio = $this->socioModel->where('idusuario', $this->session->id)->first();

        //header('Content-Type: application/json');
        echo json_encode([
            'success' => true, 
            'mensaje' => 'Actualizado correctamente',
            'porcentaje' => $idsocio->porcentaje_billetera
        ]);
        exit;
    }

    public function transferirBirAhorro() {
        $id = $this->request->getPostGet('id');
        
        //Hago la transferencia de BIR a Ahorro
        $data = [
            'idsocio' => $id,
            'fecha' => date('Y-m-d H:i:s'),
            'tipo_mov' => 3,
            'cantidad' => $this->request->getPostGet('cantidad'),
            'concepto' => 'Transferencia de BIR a Billetera Digital',
            'origen' => $id
        ];
        $res = $this->billeteraDigitalModel->insert($data);

        //Actualizo el saldo de BIR del socio 
        $data = [
            'idsocio' => $id,
            'socio_nuevo' => 0,
            'cantidad' => ($this->request->getPostGet('cantidad') * -1), //Restamos la cantidad de BIR transferida
            'concepto' => 'Transferencia de BIR a Billetera Digital',
            'fecha' => date('Y-m-d H:i:s'),
            'estado' => 0

        ];
        $res = $this->birModel->insert($data);

        //header('Content-Type: application/json');
        echo json_encode([
            'respuesta' => $res,
            'success' => true, 
            'mensaje' => 'Transferencia realizada correctamente',
        ]);
        exit;
    }
    
}
