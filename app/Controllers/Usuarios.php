<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Usuarios extends BaseController {

    protected $pago_inscripcion = "50.00";

    public function acl() {
        $data['idrol'] = $this->session->idrol;
        $data['id'] = $this->session->id;
        $data['logged'] = $this->usuarioModel->_getLogStatus($data['id']);
        $data['nombre'] = $this->session->nombre;
        $data['miembro_desde'] = $this->session->created_at;
        return $data;
    }

    public function index(){
        //
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function listaBinaria(){
        $data = $this->acl();

        if ($data['logged'] == 1 && $this->session->miembros == 1) {

            $data['session'] = $this->session;
            $data['sistema'] = $this->sistemaModel->findAll();
            $data['micodigo'] = $this->socioModel->find($this->session->id);
            $data['mi_equipo'] = $this->socioModel->select('socios.id as id,codigo_socio,patrocinador,fecha_inscripcion,idusuario,
                                idrango,socios.estado as estado_socio,nombre,user,usuarios.cedula as cedula,posicion,
                                telefono,email,idrol,rango,inscripciones.estado as estado_inscripcion,nodopadre,idsocio')
                                ->where('patrocinador', $data['micodigo']->id)
                                ->join('usuarios', 'usuarios.id=socios.idusuario')
                                ->join('rangos', 'rangos.id=socios.idrango')
                                ->join('inscripciones', 'inscripciones.idsocio=socios.id', 'left')
                                ->findAll();//echo $this->db->getLastQuery();

            $data['title'] = 'Lista Binaria ACTUALMENTE EN PROCESO DE DESARROLLO';
            $data['subtitle'] = 'Lista de miembros en la organización con sus datos y ubicaciones en el binario';
            $data['main_content'] = 'usuarios/lista_binaria';

            return view('dashboard/index', $data);
        }else{
            return redirect()->to('logout');
        }
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function arbolBinario(){
        echo 'sección en construcción';
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
                
                //Inserto el nuevo usuario
                $user = $this->usuarioModel->insert($usuario);

                if ($user) {
                    //Género un codigo de socio
                    $lastId = $this->socioModel->orderBy('id',"desc")->limit(1)->findAll();

                    $socio = [
                        'codigo_socio' => 'GTK-170000'.(int)($lastId[0]->id + 1),
                        'patrocinador' => $this->session->id,
                        'fecha_inscripcion' => date('Y-m-d h:m:s'),
                        'idusuario' => $user,
                        'idrango' => 1,
                        'estado' => 0
                    ];
                    
                    $socio =$this->socioModel->insert($socio);

                } else {
                    //Salgo del sistema
                }
                
                if ($socio) {
                    //Se genera un BIR
                     $bir = [
                        'idsocio' => $this->session->id,
                        'socio_nuevo' => $socio,
                        'cantidad' => 50,
                        'concepto' => "BIR POR INSCRIPCION DE NUEVO SOCIO",
                        'fecha' => date('Y-m-d h:m:s'),
                        'estado' => 0,
                    ];
                    $idbir = $this->birModel->insert($bir);

                    //Se carga ese BIR por cobrar a la billetera digital
                    // if ($idbir) {
                    //     //Si se insertó el BIR cargo el bono en la billetera
                    //     $bono = [
                    //         'idsocio' => $this->session->id,
                    //         'fecha' => date('Y-m-d'),
                    //         'tipo_mov' => 3, //INGRESO POR BIR ACREDITADO
                    //         'cantidad' => 50,
                    //         'origen' => 0,
                    //         'concepto' => "INGRESO POR BIR ACREDITADO",
                    //         'idbir' => $idbir
                    //     ];

                    //     $res = $this->billeteraDigitalModel->insert($bono);
                    // }

                    //Se registra el pedido inicial con la inscripcion
                    $pedido_inicial = [
                            
                        'fecha_compra' => date('Y-m-d'),
                        'cantidad' => 1,
                        'total' => 135,
                        'observacion_pedido' => "COMPRA INICIAL POR INSCRIPCION",
                        'idsocio' => $socio,
                        'idpaquete' => 1,
                        'estado' => 0,
                    ];

                    $res = $this->pedidoModel->insert($pedido_inicial);

                    //Se registra el costo de $50 de la inscripción
                    $pago_inscripcion = [
                        'pago' => 50,
                        'idsocio' => $socio,
                        'estado' => 0,
                    ];

                    $res = $this->inscripcionModel->insert($pago_inscripcion);
                    
                }else{

                }
               
                //echo $this->db->getLastQuery();
                return redirect()->to('lista-miembros');
            }
        }else{

            return redirect()->to('logout');
        }
    }

    function verificaEstadoSocio($idsocio){
        return 1;
    }

    /**
     * Formulario de edición de datos del socio
     *
     * @param 
     * @return void
     * @throws conditon
     **/
    public function perfil($id, $mensaje = '') {

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
            $data['mensaje'] = $mensaje;

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
     * Recibe la información editada del perfil de un usuario
    */
    public function editProfile($mensaje = ''){

        $data = $this->acl();

        if ($data['logged'] == 1) {

            $id = $this->session->id;

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
            ];
            
            $this->validation->setRuleGroup('insertNewMember');
        
        
            if (!$this->validation->withRequest($this->request)->run()) {
                //Depuración
                //dd($validation->getErrors());
                
                return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
            }else{ 
                
                //Inserto el nuevo usuario
                $res = $this->usuarioModel->update($id, $usuario);

                if ($res) {
                    $this->session->setFlashdata('mensaje', "success");
                }else{
                    $this->session->setFlashdata('mensaje', "error");
                }
                
                return redirect()->to('perfil/'.$id);
            }
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
            $data['micodigo'] = $this->socioModel->find($this->session->id);

            $data['mi_equipo'] = $this->socioModel->select('socios.id as id,codigo_socio,patrocinador,fecha_inscripcion,idusuario,idrango,socios.estado as estado_socio,
                                nombre, usuarios.cedula as cedula,telefono,email,idrol,rango,inscripciones.estado as estado_inscripcion,idsocio')
                                ->where('patrocinador', $data['micodigo']->id)
                                ->join('usuarios', 'usuarios.id=socios.idusuario')
                                ->join('rangos', 'rangos.id=socios.idrango')
                                ->join('inscripciones', 'inscripciones.idsocio=socios.id', 'left')
                                ->findAll();//echo $this->db->getLastQuery();

            $data['title'] = 'Mi Equipo';
            $data['main_content'] = 'usuarios/lista_miembros';
            return view('dashboard/index', $data);
        }else{
            return redirect()->to('logout');
        } 
    }

    /**
     * Tanque de reserva miembros registrados aún no ubicados
     *
     * @param 
     * @return void
     * @throws conditon
     **/
    public function tanqueReserva() {

        $data = $this->acl();
        
        if ($data['logged'] == 1 && $this->session->miembros == 1) {

            $data['session'] = $this->session;
            $data['sistema'] = $this->sistemaModel->findAll();

            $data['miEquipo'] = $this->socioModel->where('patrocinador', $this->session->id)->findAll();

            //Traigo a los socios debajo del patrocinador que no tienen posición
            $data['sociosReserva'] = $this->socioModel->select('socios.id as id,codigo_socio,patrocinador,idusuario,nombre,cedula,email,fecha_inscripcion,socios.estado as estado')
                ->join('usuarios', 'socios.idusuario=usuarios.id', 'left')
                ->where('posicion','I')
                ->where('patrocinador', $this->session->id)
                ->orderBy('nombre', 'asc')
                ->findall();

            $data['title'] = 'Mi Equipo';
            $data['subtitle'] = 'Tanque de retención';
            $data['main_content'] = 'usuarios/tanque-reserva';
            return view('dashboard/index', $data);
        }else{
            return redirect()->to('logout');
        } 
    }

    /**
     * Devuelve los socios del equipo que estén en una pierna de la organización
     *
     * @param 
     * @return void
     * @throws conditon
     **/
    public function getSocios() {

        $pierna = $this->request->getPostGet('pierna');
        $equipo = $this->socioModel->select('socios.id as id,nombre,codigo_socio,patrocinador')
                ->where('patrocinador', $this->session->id)
                ->join('usuarios', 'socios.idusuario=usuarios.id', 'left')
                ->findAll();

        echo json_encode($equipo);
    }


    function setPosition(){
        $id = $this->request->getPostGet('id');
        $patrocinador = $this->request->getPostGet('patrocinador');

        $info['nodopadre'] = $this->request->getPostGet('posicion');
        $info['posicion'] = $this->request->getPostGet('piernas');

        if ($info['nodopadre'] == 0) {
            $info['nodopadre'] = $patrocinador;
        }

        if ($info['nodopadre'] == $id) {
            $info['nodopadre'] = $patrocinador;
        }

        $data = [
            'nodopadre'=> $info['nodopadre'],
            'posicion'=> $info['posicion']
        ];

        $info['res'] = $this->socioModel->update($id,  $data);
        //echo $this->db->getLastQuery();
        //echo json_encode($info);
        return redirect()->to('tanque-reserva');
    }
}
