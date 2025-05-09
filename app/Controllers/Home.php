<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function acl() {
        $data['idrol'] = $this->session->idrol;
        $data['id'] = $this->session->id;
        $data['logged'] = $this->usuarioModel->_getLogStatus($data['id']);
        $data['nombre'] = $this->session->nombre;
        $data['miembro_desde'] = $this->session->created_at;
        return $data;
    }

    public function index(): string
    {
        $data = $this->acl();
        
        if ($data['logged'] == 1 ) {
            
            $data['session'] = $this->session;

            return redirect()->to('inicio');
        }else{
            $this->logout();
        }
    }

    public function validate_login(){
        $data = array(
            'user' => $this->request->getPostGet('user'),
            'password' => $this->request->getPostGet('password'),
        );
        
        $this->validation->setRuleGroup('login');
        
        if (!$this->validation->withRequest($this->request)->run()) {
            //Depuración
            //dd($validation->getErrors());
            
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }else{ 

            $usuario = $this->usuarioModel->_getUsuario($data);
            //echo '<pre>'.var_export($usuario, true).'</pre>';exit;
            $ip = $_SERVER['REMOTE_ADDR'];
            //echo '<pre>'.var_export($usuario, true).'</pre>';exit;

            $estado = 1;
            
            if ($estado == 0) {
                return redirect()->to('/');
            }else{

                if (isset($usuario) && $usuario != NULL ) {
                    //valido el login y pongo el id en sesion  && $usuario->id != 1 
                    //echo '<pre>'.var_export($this->estadoSistema, true).'</pre>';
                    if ($usuario->logged == 1 ) {
                        //Está logueado así que lo deslogueo
                        $user = [
                            'id' => $usuario->id,
                            'logged' => 0,
                            'ip' => 0
                        ];
                        $this->usuarioModel->update($usuario->id, $user);
                    }
                    
                    $sessiondata = [
                        
                        'id' => $usuario->id,
                        'nombre' => $usuario->nombre,
                        'idrol' => $usuario->idrol,
                        'rol' => $usuario->rol,
                        'cedula' => $usuario->cedula,
                        'logged' => $usuario->logged,
                        'rol' => $usuario->rol,
                        'administracion' => $usuario->administracion,
                        'reportes' => $usuario->reportes,
                        'miembros' => $usuario->miembros,
                        'estado' => $usuario->estado,
                        'rango' => $usuario->rango,
                        'imagen_rango' => $usuario->imagen,
                        'miembro_desde' => $usuario->created_at,
                    ];
                    
                    $iduser = $usuario->id;

                    $user = [
                        'logged' => 1,
                        'ip' => $ip
                    ];
                    //echo '<pre>'.var_export($sessiondata, true).'</pre>';exit;
                    $this->usuarioModel->update($iduser, $user);
                    
                    $this->session->set($sessiondata);
            
                    return redirect()->to('inicio');

                }else{
                    $this->session->setFlashdata('mensaje', $data);
                    //$this->logout();
                    return redirect()->back()->with('mensaje', 'Hubo un problema, no puede ingresar al sistema, puede deberse a: Usuario / contraseña incorrectos o su usuario ha sido desactivado, contacte con el administrador');
                }
            }
        }
        
    }

    public function inicio() {

        $data = $this->acl();
        
        if ($data['logged'] == 1 && $this->session->miembros == 1) {

            $data['session'] = $this->session;
            $data['sistema'] = $this->sistemaModel->findAll();
            $data['users'] = $this->usuarioModel->findall();

            $data['micodigo'] = $this->miembroModel->find($this->session->id);
            
            $data['mi_equipo'] = $this->miembroModel->where('patrocinador', $data['micodigo']->id)
                                                    ->join('usuarios', 'usuarios.id=miembros.idusuario')
                                                    ->join('rangos', 'rangos.id=miembros.idrango')
                                                    ->findAll();

            $data['title'] = 'Inicio';
            $data['subtitle']='Index';
            $data['main_content'] = 'home/inicio';
            return view('dashboard/index', $data);
        }else{
            return redirect()->to('logout');
        }
    }

    public function selectCiudades(){
        $idprovincia = $this->request->getPostGet('idprovincia');
        $resultado['ciudades'] = $this->ciudadModel->where('idprovincia', $idprovincia)->findAll();
        echo json_encode($resultado);
    }

    public function logout(){
        //destruyo la session  y salgo
        $iduser = $this->session->id;
        $user = [
            'logged' => 0,
            'ip' => 0
        ];
        //echo '<pre>'.var_export($user, true).'</pre>';exit;
        if ($iduser) {
            $this->usuarioModel->update($iduser, $user);
        }
        $this->session->destroy();
        return redirect()->to('/');
    }
}

