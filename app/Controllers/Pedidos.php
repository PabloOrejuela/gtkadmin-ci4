<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pedidos extends BaseController
{
    public function acl() {
        $data['idrol'] = $this->session->idrol;
        $data['id'] = $this->session->id;
        $data['logged'] = $this->usuarioModel->_getLogStatus($data['id']);
        $data['nombre'] = $this->session->nombre;
        $data['miembro_desde'] = $this->session->created_at;
        return $data;
    }

    /**
     * Formulario para registro de un pedido
     *
     * @param 
     * @return void
     * @throws conditon
     **/
    public function registraNuevoPedido() {
        
        $data['session'] = $this->session;
        $data['sistema'] = $this->sistemaModel->findAll();
        $data['provincias'] = $this->provinciaModel->findAll();
        $data['ciudades'] = $this->ciudadModel->findAll();
        $data['paquetes'] = $this->paqueteModel->findAll();
        $data['datosSocio'] = $this->miembroModel->where('idusuario', $this->session->id)
                            ->join('usuarios', 'usuarios.id=miembros.idusuario')
                            ->join('rangos', 'rangos.id=miembros.idrango')
                            ->findAll();

        $data['title'] = 'Pedidos';
        $data['subtitle']='Hacer un pedido de producto';
        $data['main_content'] = 'pedidos/form_new_order';
        return view('dashboard/index', $data);
        
    }

    public function getPaquete(){
        $idpaquete = $this->request->getPostGet('idpaquete');
        $res['infoPaquete'] = $this->paqueteModel->find($idpaquete);

        echo json_encode($res);
    }

    public function insertNuevoPedido(){

        $data = $this->acl();

        if ($data['logged'] == 1) {

            $pedido = [
                'nombre' => strtoupper($this->request->getPostGet('nombre')),
                'codigo_socio' => strtoupper($this->request->getPostGet('codigo_socio')),
                'cantidad' => strtoupper($this->request->getPostGet('cantidad')),
                'total' => strtoupper($this->request->getPostGet('total')),
                'idpaquete' => strtoupper($this->request->getPostGet('idpaquete')),
                'idmiembro' => $this->session->id,
                'observacion_pedido' => strtoupper($this->request->getPostGet('observacion_pedido')),
                'estado' => 0
            ];

            $this->validation->setRuleGroup('insertPedido');
        
        
            if (!$this->validation->withRequest($this->request)->run()) {
                //Depuración
                //dd($validation->getErrors());
                
                return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
            }else{ 
                //Inserto el nuevo pedido
                $this->pedidoModel->insert($pedido);
                //echo $this->db->getLastQuery();
                return redirect()->to('inicio');
            }
        }else{

            return redirect()->to('logout');
        }
    }
}
