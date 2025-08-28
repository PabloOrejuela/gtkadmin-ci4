<link rel="stylesheet" href="<?= site_url(); ?>public/css/form-reg-new-member.css">
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
                    <th>Fecha de compra</th>
                    <th>Descripción</th>
                    <th>Paquete</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $num = 1;
                if ($pedidos) {
                    
                    foreach ($pedidos as $key => $pedido) {
                    echo '<tr class="align-middle">
                        <td>'.$num.'</td>
                        <td>'.$pedido->fecha_compra.'</td>
                        <td>'.$pedido->descripcion.'</td>
                        <td>'.$pedido->paquete.' | '.$pedido->litros.' litros - $'.$pedido->pvp.'</td>
                        <td>'.$pedido->cantidad.'</td>
                        <td>'.$pedido->total.'</td>';
                        if ($pedido->estado == 1) {
                            echo '<td>Pagado</td>';
                        } else {
                            echo '<td>Por pagar</td>';
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
<script src="<?= site_url(); ?>public/js/historial-pedidos.js"></script>