<?php

namespace App\Controllers;

class Home extends BaseController {

    private $meses = [
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    ];

    private $mes;
    private $anio;

    public function acl() {
        $data['idrol'] = $this->session->idrol;
        $data['id'] = $this->session->id;
        $data['logged'] = $this->usuarioModel->_getLogStatus($data['id']);
        $data['nombre'] = $this->session->nombre;
        $data['miembro_desde'] = $this->session->created_at;
        
        return $data;
    }


    public function __construct(){

        $this->mes = date('m');
        $this->anio = date('Y');

    }

    public function index(): string {

        $data = $this->acl();
        
        if ($data['logged'] == 1 ) {
            
            $data['session'] = $this->session;

            return redirect()->to('inicio');
        }else{
            $this->logout();
        }
    }

    public function calculaPuntos() {

        $data = $this->acl();
        
        if ($data['logged'] == 1 ) {
            
            $data['session'] = $this->session;

            $puntos_izq = $this->socioModel->_calculaPuntos(1, $data['id']);
            $puntos_der = $this->socioModel->_calculaPuntos(2, $data['id']);
        
            //Contar los puntos de cada pierna
            $socios_izq = $puntos_izq ? count($puntos_izq) : 0;
            $socios_der = $puntos_der ? count($puntos_der) : 0;
            
            //Verfico si tiene un registro de puntos del mes actual
            $puntosRed = $this->puntosRedModel->where('idsocio', $data['id'])->where('mes', date('m'))->where('anio', date('Y'))->first();
            
            if ($puntosRed) {
                //Si existe actualizo los puntos
                $this->puntosRedModel->update($puntosRed->id, [
                    'left_leg' => $socios_izq,
                    'right_leg' => $socios_der,
                    'pts_izq' => ($socios_izq*100),
                    'pts_der' => ($socios_der*100)
                ]);
            } else {
                //Si no existe inserto un nuevo registro
                $this->puntosRedModel->insert([
                    'idsocio' => $data['id'],
                    'left_leg' => $socios_izq,
                    'right_leg' => $socios_der,
                    'mes' => date('m'),
                    'anio' => date('Y'),
                    'pts_izq' => ($socios_izq*100),
                    'pts_der' => ($socios_der*100)
                ]);
            }

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
            
            $ip = $_SERVER['REMOTE_ADDR'];
            $estado = 1;
            
            if ($estado == 0) {
                return redirect()->to('/');
            }else{
                
                if (isset($usuario) && $usuario != NULL ) {
                    //valido el login y pongo el id en sesion  && $usuario->id != 1 

                    if ($usuario->logged == 1 ) {
                        //Está logueado así que lo deslogueo
                        $user = [
                            'id' => $usuario->id,
                            'logged' => 0,
                            'ip' => 0
                        ];
                        $this->usuarioModel->update($usuario->id, $user);
                    }

                    $estadoInscripcion = $this->inscripcionModel->select('estado')->where('idsocio', $usuario->id)->findAll();
                    $estadoRecompra = $this->pedidoModel->_verificaRecompra($usuario->id);

                    if (isset($estadoInscripcion) && isset($estadoRecompra) && $estadoInscripcion != 0 && $estadoRecompra->estado != 0) {
                        $suscripcion = "ACTIVO";
                    }else{
                        $suscripcion = "INACTIVO";
                    }

                    $sessiondata = [
                        
                        'id' => $usuario->id,
                        'nombre' => $usuario->nombre,
                        'idrol' => $usuario->idrol,
                        'rol' => $usuario->rol,
                        'cedula' => $usuario->cedula,
                        'logged' => $usuario->logged,
                        'administracion' => $usuario->administracion,
                        'reportes' => $usuario->reportes,
                        'socios' => $usuario->codigo_socio,
                        'estado' => $usuario->estado,
                        'estado_suscripcion' => $suscripcion,
                        'rango' => $usuario->rango,
                        'miembro_desde' => $usuario->miembro_desde,
                        'miembros' => $usuario->miembros,
                        'reportes' => $usuario->reportes,
                        'administracion' => $usuario->administracion,
                    ];
                    
                    $iduser = $usuario->id;

                    $user = [
                        'logged' => 1,
                        'ip' => $ip
                    ];
                    
                    $this->usuarioModel->update($iduser, $user);
                    
                    $this->session->set($sessiondata);
            
                    return redirect()->to('inicio');

                }else{
                    $this->session->setFlashdata('mensaje', $data);
                    //$this->logout();
                    return redirect()->back()->with(
                        'mensaje', 
                        'Hubo un problema, no puede ingresar al sistema, puede deberse a: Usuario / contraseña incorrectos o su usuario ha sido desactivado, contacte con el administrador'
                    );
                }
            }
        }
        
    }

    public function inicio() {
        
        $data = $this->acl();
        
        if ($data['logged'] == 1 && $this->session->miembros == 1) {

            $data['session'] = $this->session;
            $data['sistema'] = $this->sistemaModel->findAll();
            $data['users'] = $this->usuarioModel->findAll();

            $this->calculaPuntos();

            $data['micodigo'] = $this->socioModel->find($this->session->id);
            $data['rangos'] = $this->rangoModel->findAll();
            
            $data['mi_equipo'] = $this->socioModel->select('socios.id as id,codigo_socio,patrocinador,fecha_inscripcion,idusuario,idrango,socios.estado as estado_socio,
                                nombre,cedula,telefono,email,idrol,rango,inscripciones.estado as estado_inscripcion,idsocio')
                                ->where('patrocinador', $data['micodigo']->id)
                                ->join('usuarios', 'usuarios.id=socios.idusuario')
                                ->join('rangos', 'rangos.id=socios.idrango')
                                ->join('inscripciones', 'inscripciones.idsocio=socios.id', 'left')
                                ->findAll();


            $data['pedidos'] = $this->pedidoModel->where('idsocio', $this->session->id)
                                                    ->join('paquetes', 'paquetes.id=pedidos.idpaquete')
                                                    ->findAll();
            $data['pts'] = $this->puntosRedModel->where('idsocio', $this->session->id)
                                                    ->where('mes', date('m'))
                                                    ->where('anio', date('Y'))
                                                    ->first();

            $data['bir_pendientes'] = $this->birModel->selectSum('cantidad', 'totalBir')
                ->where('idsocio', $this->session->id)
                ->where('estado', 0)
                ->findAll();

            $rangoAccede = $this->rangoModel->_verificaMeta(1, $data['rangos']);
            $data['resumen'] = [
                'mes'=> $this->meses[date('n')],
                'meta_rango' => $this->rangoModel->where('rango', $this->session->rango)->findAll(),
                'accede_rango' => $this->rangoModel->select('rango')->where('id', $rangoAccede['id'])->findAll(),
                'income' => $rangoAccede['income'],
            ];

            //actualizo el historial de rango en la db
            $histRango = $this->histRangoModel->where('idsocio', $this->session->id)
                                                    ->where('month', $this->mes)
                                                    ->where('year', $this->anio)
                                                    ->first();
            $histRangoData = [
                'year' => $this->anio,
                'month' => $this->mes,
                'left_leg' => $data['pts']->left_leg,
                'right_leg' => $data['pts']->right_leg,
                'pts_left' => $data['pts']->pts_izq,
                'pts_right' => $data['pts']->pts_der,
                'income' => $data['resumen']['income'],
                'idrango' => $data['micodigo']->idrango,
                'idsocio' => $this->session->id,
                'estado' => 1,
            ];

            //echo '<pre>'.var_export($histRango, true).'</pre>';exit;
            if ($histRango) {
                $this->histRangoModel->where('idsocio', $this->session->id)
                                                    ->where('month', $this->mes)
                                                    ->where('year', $this->anio)
                                                    ->update($histRango->id, $histRangoData);
            }else{
                
                $this->histRangoModel->insert($histRangoData);
            }
                
            
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

