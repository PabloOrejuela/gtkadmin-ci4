<link rel="stylesheet" href="<?= site_url(); ?>public/css/frm-reg-new-member.css">
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
                    <th class="col-md-1">Id</th>
                    <th>Nombre</th>
                    <th class="col-md-1">Documento</th>
                    <th class="col-md-1">Estado</th>
                </thead>
                <tbody>
                    <?php
                        if ($mi_equipo) {
                            foreach ($mi_equipo as $socio) {
                                echo '<tr>';
                                echo '<td>'.$socio->id.'</td>';
                                echo '<td>'.$socio->nombre.'</td>';
                                echo '<td>'.$socio->cedula.'</td>';

                                //verifica el estado de un socio
                                if ($socio->estado_socio == 1 && $socio->estado_inscripcion == 1) {
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