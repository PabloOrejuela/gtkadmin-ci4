<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Administracion extends BaseController {

    public function acl() {
        $data['idrol'] = $this->session->idrol;
        $data['id'] = $this->session->id;
        $data['logged'] = $this->usuarioModel->_getLogStatus($data['id']);
        $data['nombre'] = $this->session->nombre;
        $data['miembro_desde'] = $this->session->created_at;
        return $data;
    }

    /**
     * Grid de miembros registrados para administrarlos
     *
     * @param 
     * @return void
     * @throws conditon
     **/
    public function listaMiembros() {

        $data = $this->acl();
        
        if ($data['logged'] == 1 && $this->session->miembros == 1) {

            $data['session'] = $this->session;
            $data['sistema'] = $this->sistemaModel->findAll();
            $data['micodigo'] = $this->socioModel->find($this->session->id);

            $data['mi_equipo'] = $this->socioModel->select('socios.id as id,codigo_socio,patrocinador,fecha_inscripcion,idusuario,idrango,socios.estado as estado_socio,
                                nombre, usuarios.cedula as cedula,telefono,email,idrol,rango,socios.id as idsocio')
                                ->where('patrocinador', $data['micodigo']->id)
                                ->join('usuarios', 'usuarios.id=socios.idusuario')
                                ->join('rangos', 'rangos.id=socios.idrango')
                                ->findAll();//echo $this->db->getLastQuery();

            $data['title'] = 'Administración';
            $data['subtitle'] = 'Administración de socios';
            $data['main_content'] = 'administracion/lista_socios';
            return view('dashboard/index', $data);
        }else{
            return redirect()->to('logout');
        } 
    }

    /**
     * Grid de miembros registrados para administrarlos
     *
     * @param 
     * @return void
     * @throws conditon
     **/
    public function reportePagosSocios() {

        $data = $this->acl();
        
        if ($data['logged'] == 1 && $this->session->miembros == 1) {

            $data['session'] = $this->session;
            $data['sistema'] = $this->sistemaModel->findAll();
            $data['micodigo'] = $this->socioModel->find($this->session->id);

            $data['resultados'] = $this->socioModel->select('socios.id as id,codigo_socio,patrocinador,idusuario,idrango,socios.estado as estado_socio,
                                nombre, usuarios.cedula as cedula,telefono,email,idrol,rango,socios.id as idsocio')
                                ->join('usuarios', 'usuarios.id=socios.idusuario')
                                ->join('rangos', 'rangos.id=socios.idrango')
                                ->findAll();


            $data['title'] = 'Administración';
            $data['subtitle'] = 'Reporte de resultados mensuales';
            $data['main_content'] = 'administracion/reporte_resultados_socios';
            return view('dashboard/index', $data);
        }else{
            return redirect()->to('logout');
        } 
    }

    public function registrarPagoRecompra(){

        $id = $this->request->getPostGet('recompra');
        $fecha_compra = $this->request->getPostGet('fecha');
        $abono = $this->request->getPostGet('total');
        $observacion = $this->request->getPostGet('observacion');
        $idsocio = $this->request->getPostGet('idsocio');
        
        $total = 0;
        $estado = 0;
        $saldo = 0;
        $abonos = 0;
        $total = $this->pedidoModel->select('total')->where('id', $id)->first();

        //Registro el pago de la recompra
        $pago = [
            'abono' => $abono,
            'observacion' => $observacion,
            'fecha' => date('Y-m-d H:i:s'),
            'idpedido' => $id
        ];
        // echo '<pre>'.var_export($abono, true).'</pre>';exit;
        try {
            $idpago = $this->pagoModel->insert($pago);

            //Traigo la suma de los abonos de ese pedido
            $abonos = $this->pagoModel->selectSum('abono', 'abonos')->where('idpedido', $id)->first();
            $saldo = $total->total - $abonos->abonos;

            if ($saldo <= 0) {
                $estado = 1; // pagado
            } else {
                $estado = 0; // pendiente
            }

            $pedido = [
                'abono' => $abonos->abonos,
                'saldo' => $saldo,
                'estado' => $estado
            ];

            $registro = $this->pedidoModel->update($id, $pedido);

            //Actualizo el estado del socio
            $idsocio = $this->request->getPostGet('idsocio');

            $socio = [
                'estado' => $estado
            ];

            $this->socioModel->update($idsocio, $socio);

            $res = true;
            $mensaje = 'Se ha registrado el pago';

        }catch(Exception $e) {
            
            $res = false;
            $mensaje = $e->getMessage();
        }

        echo json_encode([
            'success' => $res, 
            'mensaje' => $mensaje,
        ]);
        exit;
    }
}
