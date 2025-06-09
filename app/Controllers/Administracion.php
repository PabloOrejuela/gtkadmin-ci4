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


    public function index()
    {
        //
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
                                nombre, usuarios.cedula as cedula,telefono,email,idrol,rango,inscripciones.estado as estado_inscripcion,idsocio')
                                ->where('patrocinador', $data['micodigo']->id)
                                ->join('usuarios', 'usuarios.id=socios.idusuario')
                                ->join('rangos', 'rangos.id=socios.idrango')
                                ->join('inscripciones', 'inscripciones.idsocio=socios.id', 'left')
                                ->findAll();//echo $this->db->getLastQuery();

            $data['title'] = 'Administración';
            $data['subtitle'] = 'Administración de socios';
            $data['main_content'] = 'administracion/lista_socios';
            return view('dashboard/index', $data);
        }else{
            return redirect()->to('logout');
        } 
    }
}
