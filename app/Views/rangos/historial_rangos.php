<link rel="stylesheet" href="<?= site_url(); ?>public/css/hist-rangos.css">
<!--begin::Form Validation-->
<div class="card card-gtk card-outline mb-4">
    <!--begin::Header-->
    <div class="card-header"><div class="card-title"><?= $title; ?></div></div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body">
        <table class="table table-striped" id="datatablesSimple">
            <thead>
                <tr>
                    <th style="width: 10px">No.</th>
                    <th>Rango</th>
                    <th>Fecha</th>
                    <th>Pierna Izquierda</th>
                    <th>Pierna Derecha</th>
                    <th>cant. socios directos (Izq./Der)</th>
                    <th>Sueldo recibido</th>
                    <th>Objetivo cumplido</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $num = 1;
                if ($historialRangos) {
                    
                    foreach ($historialRangos as $key => $hr) {
                        $fecha = $hr->year.'-'.$hr->month;
                        echo '<tr class="align-middle">
                            <td>'.$num.'</td>
                            <td>'.$hr->rango.'</td>
                            <td>'.$fecha.'</td>
                            <td>'.$hr->left_leg.' socios activos</td>
                            <td>'.$hr->right_leg.' socios activos</td>
                            <td>'.$hr->left_leg.'/'.$hr->right_leg.'</td>
                            <td>$ '.number_format($hr->income, 2).'</td>';

                            if ($hr->estado == 1) {
                                echo '<td>SI</td>';
                            } else {
                                echo '<td>NO</td>';
                            }
                            
                        echo '</tr>';
                        $num++;
                    }
                }else{
                    echo '<tr class="align-middle">
                            <td>1.</td>
                            <td>SIN DATOS</td>
                            <td>
                                <div class="progress progress-xs">
                                <div
                                    class="progress-bar progress-bar-danger"
                                    style="width: 55%"
                                ></div>
                                </div>
                            </td>
                            <td><span class="badge text-bg-danger">55%</span></td>
                            <td></td>
                            <td></td>
                        </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <!--end::Body-->
    <!--begin::Footer-->
    <div class="card-footer">
    </div>
    <!--end::Footer-->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= site_url(); ?>public/js/hist-rangos.js"></script>