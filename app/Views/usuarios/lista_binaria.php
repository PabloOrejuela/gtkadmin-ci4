<link rel="stylesheet" href="<?= site_url(); ?>public/css/lista-miembros.css">
<!--begin::Form Validation-->
<div class="card card-gtk card-outline mb-4">
    <!--begin::Header-->
    <div class="card-header"><div class="card-title"><?= $title; ?></div></div>
    <!--end::Header-->
    <!--begin::Form-->
    <form class="needs-validation" action="<?= site_url().'new-member-insert';?>" method="post" novalidate>
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Row-->
        <div class="row g-3">
            <table id="datatablesSimple" class="table table-bordered table-striped mt-1">
                <thead>
                    <th>Id</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Documento</th>
                    <th>Rango</th>
                    <th>Patrocinador</th>
                    <th>Padre</th>
                    <th>Pierna mayor</th>
                    <th>Binario Izquierdo/derecho</th>
                </thead>
                <tbody>
                    <?php
                        use App\Models\PedidoModel;
                        use App\Models\SocioModel;
                        $this->pedidoModel = new PedidoModel();
                        $this->socioModel = new SocioModel();
                        $this->db = \Config\Database::connect();

                        if ($mi_equipo) {
                            foreach ($mi_equipo as $socio) {
                                
                                $fechaCadena = date('Y-m');
                                $month = date('m');
                                $year = date('Y');
                                $puntos_izquierda = $this->socioModel->where('nodopadre', $socio->id)->where('posicion', 1)->findAll();
                                $puntos_derecha = $this->socioModel->where('nodopadre', $socio->id)->where('posicion', 2)->findAll();
                                $patrocinador = $this->socioModel->where('socios.id', $socio->patrocinador)
                                                ->join('usuarios', 'usuarios.id = socios.idusuario')->first();
                                                //echo $this->db->getLastQuery();exit;
                                $nodopadre = $this->socioModel->select('nombre')->where('socios.id', $socio->nodopadre)
                                                ->join('usuarios', 'usuarios.id = socios.idusuario')->first();

                                echo '<tr>';
                                echo '<td id="td-left">'.$socio->id.'</td>';
                                echo '<td id="td-left">'.$socio->user.'</td>';
                                echo '<td>'.$socio->nombre.'</td>';
                                echo '<td>'.$socio->cedula.'</td>';
                                echo '<td>'.$socio->rango.'</td>';
                                echo '<td>'.$patrocinador->nombre.'</td>';
                                
                                if ($nodopadre) {
                                    echo '<td>'.$patrocinador->nombre.'</td>';
                                } else {
                                    echo '<td>SIN UBICACION</td>';
                                }
                            

                                //verifica cual pierna es mayor
                                if (count($puntos_izquierda) > count($puntos_derecha)) {
                                    echo '<td>Izquierda</td>';
                                } else if(count($puntos_izquierda) < count($puntos_derecha)){
                                    echo '<td>Derecha</td>';
                                }else{
                                    echo '<td>Iguales</td>';
                                }
                                
                                echo '<td>'.count($puntos_izquierda).' / '.count($puntos_derecha).'</td>';
                                
                                echo '</tr>';
                            }
                        } else {
                            # code...
                        }
                        
                    ?>
                </tbody>
            </table>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Body-->
    <!--begin::Footer-->
    <div class="card-footer">
        <button class="btn btn-info" type="submit">Enviar</button>
    </div>
    <!--end::Footer-->
    </form>
    <!--end::Form-->
    <!--begin::JavaScript-->
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict';

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.from(forms).forEach((form) => {
        form.addEventListener(
            'submit',
            (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
            },
            false,
        );
        });
    })();
    </script>
    <!--end::JavaScript-->
</div>
<!--end::Form Validation-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= site_url(); ?>public/js/lista-miembros.js"></script>