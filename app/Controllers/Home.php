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
            
            //Verfico si tiene un registro de puntos del mes actual
            $puntosRed = $this->puntosRedModel->where('idsocio', $data['id'])->where('mes', date('m'))->where('anio', date('Y'))->first();
            //echo '<pre>'.var_export($puntosRed, true).'</pre>';exit;
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
        $data = [
            'user' => $this->request->getPostGet('user'),
            'password' => $this->request->getPostGet('password'),
        ];
        
        $this->validation->setRuleGroup('login');
        
        if (!$this->validation->withRequest($this->request)->run()) {
            //Depuración
            //dd($validation->getErrors());
            
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }else{ 

            //$usuario = $this->usuarioModel->_getUsuario($data);

            // recuperamos el hash del usuario almacenado en base de datos
            $usuario = $this->usuarioModel->select('usuarios.id as id,rango,acuerdo_terminos,nombre,user,telefono,email,password,imagen,cedula,idrol,logged,rol,
            administracion,reportes,codigo_socio,miembros,usuarios.estado as estado,usuarios.created_at as miembro_desde')
                    ->where('user', $data['user'])
                    ->join('socios', 'socios.idusuario=usuarios.id')
                    ->join('rangos', 'rangos.id=socios.idrango')
                    ->join('roles', 'roles.id=usuarios.idrol')
                    ->findAll();
            
            // comprobamos si la contraseña enviada desde el formulario se corresponde con el hash alojado

            $ip = $_SERVER['REMOTE_ADDR'];
            $estado = 1;
            
            if ($estado == 0) {
                return redirect()->to('/');
            }else{
                
                if (isset($usuario) && $usuario != NULL && password_verify($data['password'], $usuario[0]->password)) {
                    //valido el login y pongo el id en sesion  && $usuario->id != 1 

                    if ($usuario[0]->logged == 1) {
                        //Está logueado así que lo deslogueo
                        $user = [
                            'id' => $usuario[0]->id,
                            'logged' => 0,
                            'ip' => 0
                        ];
                        $this->usuarioModel->update($usuario[0]->id, $user);
                    }

                    $estadoInscripcion = $this->inscripcionModel->select('estado')->where('idsocio', $usuario[0]->id)->findAll();
                    $estadoRecompra = $this->pedidoModel->_verificaRecompra($usuario[0]->id);

                    if (isset($estadoInscripcion) && isset($estadoRecompra) && $estadoInscripcion != 0 && $estadoRecompra->estado != 0) {
                        $suscripcion = "ACTIVO";
                    }else{
                        $suscripcion = "INACTIVO";
                    }

                    $sessiondata = [
                        
                        'id' => $usuario[0]->id,
                        'nombre' => $usuario[0]->nombre,
                        'idrol' => $usuario[0]->idrol,
                        'rol' => $usuario[0]->rol,
                        'cedula' => $usuario[0]->cedula,
                        'logged' => $usuario[0]->logged,
                        'administracion' => $usuario[0]->administracion,
                        'reportes' => $usuario[0]->reportes,
                        'socios' => $usuario[0]->codigo_socio,
                        'estado' => $usuario[0]->estado,
                        'estado_suscripcion' => $suscripcion,
                        'rango' => $usuario[0]->rango,
                        'miembro_desde' => $usuario[0]->miembro_desde,
                        'miembros' => $usuario[0]->miembros,
                        'reportes' => $usuario[0]->reportes,
                        'administracion' => $usuario[0]->administracion,
                    ];
                    
                    $iduser = $usuario[0]->id;

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

            //Actualizo el estado de los patrocinados en cada inicio
            $patrocinados = $this->socioModel->select('id')->where('patrocinador', $data['id'])->findAll();
            $this->actualizaEstado($patrocinados);

            //Actualizo el estado de los hijos por derrame en cada inicio
            $hijos = $this->socioModel->select('id')->where('nodopadre', $data['id'])->findAll();
            $this->actualizaEstado($hijos);

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

            $rangoAccede = $this->rangoModel->_verificaMeta($data['pts'], $data['rangos']);

            $data['resumen'] = [
                'mes'=> $this->meses[date('n')],
                'anio'=> $this->anio,
                'meta_rango' => $this->rangoModel->where('rango', $this->session->rango)->findAll(),
                'accede_rango' => $this->rangoModel->select('id,rango')->where('id', $rangoAccede['id'])->findAll(),
                'income' => $rangoAccede['income'],
                'cumpleMeta' => 1
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
                'idrango' => $data['resumen']['accede_rango'][0]->id,
                'idsocio' => $this->session->id,
            ];

            if ($histRango) {
                $this->histRangoModel->where('idsocio', $this->session->id)
                                                    ->where('month', $this->mes)
                                                    ->where('year', $this->anio)
                                                    ->update($histRango->id, $histRangoData);
            }else{
                
                $this->histRangoModel->insert($histRangoData);

            }
            
            //Actualizo el rango en la tabla socios
            $dataSocio = ['idrango' => $data['resumen']['accede_rango'][0]->id,];
            $this->socioModel->update($this->session->id, $dataSocio);
            
            $data['title'] = 'Inicio';
            $data['subtitle']='Index';
            $data['main_content'] = 'home/inicio';
            return view('dashboard/index', $data);
        }else{
            return redirect()->to('logout');
        }
    }

    public function actualizaEstado($arraySocios){
        $this->socioModel->_actualizaEstado($arraySocios);
    }

    public function selectCiudades(){
        $idprovincia = $this->request->getPostGet('idprovincia');
        $resultado['ciudades'] = $this->ciudadModel->where('idprovincia', $idprovincia)->findAll();
        echo json_encode($resultado);
    }

    /**
     * Abre la web personalizada con el form de registro
     *
     * @param 
     * @return void
     * @throws conditon
     **/
    public function miWeb() {

        $data['session'] = $this->session;
        $data['sistema'] = $this->sistemaModel->findAll();

        $data['provincias'] = $this->provinciaModel->findAll();
        $data['ciudades'] = $this->ciudadModel->findAll();
        $data['nombre'] = $this->session->nombre;
        $data['patrocinador'] = $this->session->id;

        $data['title'] = 'GTK Ecuador';
        $data['subtitle']='Mi Web';
        $data['main_content'] = 'mi-web/link-miweb';
        return view('dashboard/index', $data);
        
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

