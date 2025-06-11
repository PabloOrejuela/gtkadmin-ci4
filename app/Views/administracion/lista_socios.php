<link rel="stylesheet" href="<?= site_url(); ?>public/css/lista-socios-admin.css">
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
                    <th id="td-left">Id</th>
                    <th>Nombre</th>
                    <th>Documento</th>
                    <th>Inscripción</th>
                    <th>Recompra</th>
                    <th>Estado</th>
                    <th>ACCIONES</th>

                </thead>
                <tbody>
                    <?php
                        use App\Models\PedidoModel;
                        $this->pedidoModel = new PedidoModel();

                        if ($mi_equipo) {
                            foreach ($mi_equipo as $socio) {
                                
                                $fechaCadena = date('Y-m');
                                $month = date('m');
                                $year = date('Y');
                                
                                $num_dias = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                                $recompra = $this->pedidoModel->where('fecha_compra BETWEEN "'
                                                                . date('Y-m-d', strtotime($fechaCadena.'-01')). '" and "'
                                                                . date('Y-m-d', strtotime($fechaCadena.'-'.$num_dias)).'"')
                                                                ->where('idsocio', $socio->id)
                                                                ->findall();
                                
                                echo '<tr>';
                                echo '<td id="td-left">'.$socio->id.'</td>';
                                echo '<td>'.$socio->nombre.'</td>';
                                echo '<td>'.$socio->cedula.'</td>';

                                //verifica el pago de la inscripción
                                if ($socio->estado_inscripcion == 1) {
                                    echo '<td>PAGADO</td>';
                                } else {
                                    echo '<td>PAGO PENDIENTE</td>';
                                }
                                
                                //verifica si el socio tiene recompra activa
                                if (isset($recompra) && count($recompra) > 0 && $recompra[0]->estado == 1) {
                                    echo '<td>PAGADO</td>';
                                } else {
                                    echo '<td>PAGO PENDIENTE</td>';
                                }

                                //verifica el estado de un socio
                                if ($socio->estado_socio == 1 && $socio->estado_inscripcion == 1) {
                                    echo '<td>ACTIVO</td>';
                                } else {
                                    echo '<td>INACTIVO</td>';
                                }

                                echo '<td>Botones</td>';
                                
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