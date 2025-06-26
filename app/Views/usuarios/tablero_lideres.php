<link rel="stylesheet" href="<?= site_url(); ?>public/css/tanque-reserva.css">
<!--begin::Form Validation-->
<div class="card card-gtk card-outline mb-4">
    <!--begin::Header-->
    <div class="card-header">
        <div class="card-title"><?= $subtitle; ?></div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Row-->
        <div class="row g-3">
            <table id="tabla-lideres" class="table table-bordered table-striped mt-2">
                <thead>
                    <th class="col-md-1">No.</th>
                    <th class="col-md-4">Nombre</th>
                    <th class="col-md-1">Código</th>
                    <th class="col-md-1">Socios captados</th>
                </thead>
                <tbody id="table-datos">
                    <?php

                        $num = 1;

                        if ($tabla_lideres) {
                            foreach ($tabla_lideres as $lider) {
                                echo '<tr>
                                        <td>'.$num.'</td>
                                        <td>'.$lider->nombre.'</td>
                                        <td>'.$lider->codigo_socio.'</td>
                                        <td>'.$lider->cant_socios.'</td>';
                                echo '</tr>';
                                $num++;
                            }
                        } else {
                            
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
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= site_url(); ?>public/js/tanque-reserva.js"></script>