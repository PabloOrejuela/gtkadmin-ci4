<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Usuarios extends BaseController
{
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
     * Formulario para registro de un nuevo miembro
     *
     * @param 
     * @return void
     * @throws conditon
     **/
    public function registrarNuevoMiembro() {

        $data['session'] = $this->session;
        $data['sistema'] = $this->sistemaModel->findAll();

        $data['provincias'] = $this->provinciaModel->findAll();
        $data['ciudades'] = $this->ciudadModel->findAll();

        $data['title'] = 'Socios';
        $data['subtitle']='Registro un nuevo Socio';
        $data['main_content'] = 'usuarios/form_reg_new_member';
        return view('dashboard/index', $data);
        
    }

    public function insertNuevoMiembro(){

        $data = $this->acl();

        if ($data['logged'] == 1) {

            $usuario = [
                'nombre' => strtoupper($this->request->getPostGet('nombre')),
                'user' => strtoupper($this->request->getPostGet('user')),
                'password' => strtoupper($this->request->getPostGet('password')),
                'telefono' => strtoupper($this->request->getPostGet('telefono')),
                'telefono_2' => strtoupper($this->request->getPostGet('telefono_2')),
                'cedula' => strtoupper($this->request->getPostGet('cedula')),
                'direccion' => strtoupper($this->request->getPostGet('direccion')),
                'email' => $this->request->getPostGet('email'),
                'idciudad' => strtoupper($this->request->getPostGet('idciudad')),
                'acuerdo_terminos' => strtoupper($this->request->getPostGet('acuerdo_terminos')),
                'estado' => 1,
                'idrol' => 2
            ];
            
            $this->validation->setRuleGroup('insertNewMember');
        
        
            if (!$this->validation->withRequest($this->request)->run()) {
                //Depuración
                //dd($validation->getErrors());
                
                return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
            }else{ 
                
                //echo '<pre>'.var_export($usuario, true).'</pre>';exit;
                //Inserto el nuevo usuario
                $this->usuarioModel->insert($usuario);
                echo $this->db->getLastQuery();
                return redirect()->to('lista-miembros');
            }
        }else{

            return redirect()->to('logout');
        }
    }

    /**
     * Formulario de edición de datos del socio
     *
     * @param 
     * @return void
     * @throws conditon
     **/
    public function perfil($id) {

        $data = $this->acl();
        
        if ($data['logged'] == 1 && $this->session->miembros == 1) {

            $data['session'] = $this->session;
            $data['sistema'] = $this->sistemaModel->findAll();
            $data['provincias'] = $this->provinciaModel->findAll();
            $data['ciudades'] = $this->ciudadModel->findAll();

            $data['perfil'] = $this->usuarioModel->find($id);
            $data['ciudad'] = $this->ciudadModel->where('id', $data['perfil']->idciudad)->find();

            $data['title'] = 'Mis datos';
            $data['subtitle']='Editar datos del usuario';

            if ($data['perfil']) {
                $data['main_content'] = 'usuarios/form_edit_perfil';
            } else {
                $data['main_content'] = 'usuarios/form_error';
            }

            return view('dashboard/index', $data);
        }else{
            return redirect()->to('logout');
        }
        
    }

    /**
     * Grid de miembros registrados
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

            $data['users'] = $this->usuarioModel->findall();

            $data['title'] = 'Mi Equipo';
            $data['main_content'] = 'usuarios/lista_miembros';
            return view('dashboard/index', $data);
        }else{
            return redirect()->to('logout');
        }
        
    }
}
