<link rel="stylesheet" href="<?= site_url(); ?>public/css/frm-reg-new-member.css">
<!--begin::Form Validation-->
<div class="card card-gtk card-outline mb-4">
    <!--begin::Header-->
    <div class="card-header"><div class="card-title"><?= $subtitle; ?></div></div>
    <!--end::Header-->
    <!--begin::Form-->
    <form class="needs-validation" action="<?= site_url().'new-member-insert';?>" method="post" novalidate>
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Row-->
        <div class="row g-3">
            <table id="datatablesSimple" class="table table-bordered table-striped">
                <thead>
                    <th class="col-md-1">Codigo</th>
                    <th class="col-md-4">Nombre</th>
                    <th class="col-md-1">Documento</th>
                    <th class="col-md-1">Fecha de registro</th>
                    <th class="col-md-1">Seleccionar posición</th>
                    <th class="col-md-1">Estado</th>
                </thead>
                <tbody>
                    <?php
                        if ($sociosReserva) {
                            foreach ($sociosReserva as $socio) {
                                echo '<tr>
                                        <td>'.$socio->id.'</td>
                                        <td>'.$socio->nombre.'</td>
                                        <td>'.$socio->cedula.'</td>
                                        <td>'.$socio->fecha_inscripcion.'</td>
                                        <td>link modal posición</td>';
                                        if ($socio->estado == 1) {
                                            echo '<td>ACTIVO</td>';
                                        } else {
                                            echo '<td>INACTIVO</td>';
                                        }
                                        
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