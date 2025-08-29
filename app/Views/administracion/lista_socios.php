<link rel="stylesheet" href="<?= site_url(); ?>public/css/lista-socios-admin.css">
<!--begin::Form Validation-->
<div class="card card-gtk card-outline mb-4">
    <!--begin::Header-->
    <div class="card-header"><div class="card-title"><?= $title; ?></div></div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Row-->
        <div class="row g-3">
            <table id="datatablesSimple" class="table table-bordered table-striped mt-1">
                <thead>
                    <th id="td-left">Id</th>
                    <th>Nombre</th>
                    <th>Documento</th>
                    <th>Recompra</th>
                    <th>Saldo a pagar</th>
                    <th>Estado</th>
                    <th>ACCIONES</th>

                </thead>
                <tbody>
                    <?php
                        use App\Models\PedidoModel;
                        use App\Models\PagoModel;
                        $this->pedidoModel = new PedidoModel();
                        $this->pagoModel = new PagoModel();

                        if ($mi_equipo) {
                            foreach ($mi_equipo as $socio) {
                                
                                $fechaCadena = date('Y-m');
                                $month = date('m');
                                $year = date('Y');
                                $abonos = 0;
                                $saldo = 0;
                                
                                $num_dias = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                                $recompra = $this->pedidoModel->select('pedidos.id as id,fecha_compra,total,descripcion,estado,observacion_pedido')
                                            ->where('fecha_compra BETWEEN "'. date('Y-m-d', strtotime($fechaCadena.'-01')). '" and "'. date('Y-m-d', strtotime($fechaCadena.'-'.$num_dias)).'"')
                                            ->where('idsocio', $socio->id)
                                            ->first();
                                
                                if ($recompra) {
                                    $saldo = $recompra->total;
                                    $sumaAbonos = $this->pagoModel->selectSum('abono','abonos')->where('idpedido', $recompra->id)->findAll();

                                    if ($sumaAbonos) {
                                        $abonos = $sumaAbonos[0]->abonos;
                                        $saldo = $recompra->total - $abonos;
                                    }
                                }

                                echo '<tr>';
                                echo '<td id="td-left">'.$socio->id.'</td>';
                                echo '<td>'.$socio->nombre.'</td>';
                                echo '<td>'.$socio->cedula.'</td>';
                                
                                //verifica si el socio tiene recompra activa
                                if (isset($recompra)) {
                                    echo '<td>HA REALIZADO UNA RECOMPRA</td>';
                                    echo '<td>'.$saldo.'</td>';
                                } else {
                                    echo '<td>NO REGISTRA RECOMPRA</td>';
                                    echo '<td>0.00</td>';
                                }

                                //verifica el estado de un socio
                                if ($socio->estado_socio == 1) {
                                    echo '<td>ACTIVO</td>';
                                } else {
                                    echo '<td>INACTIVO</td>';
                                }

                                if (isset($recompra) && $recompra->estado == 0) {
                                    echo '<td id="td-ventas">
                                        <a
                                            id="btn-register_'.$socio->id.'"
                                            data-idsocio="'.$socio->id.'"
                                            data-recompra="'.$recompra->id.'"
                                            data-saldo="'.$saldo.'"
                                            data-fecha="'.$recompra->fecha_compra.'"
                                            data-total="'.$recompra->total.'"
                                            data-observacion="'.$recompra->observacion_pedido.'"
                                            data-bs-toggle="modal"
                                            data-bs-target="#registraPagoModal"
                                            href="#" 
                                            class="edit"
                                        >Registrar pago</a>
                                    </td>';
                                }else if(isset($recompra) && $recompra->estado == 1){
                                    echo '<td id="td-ventas">
                                        NO TIENE PAGOS PENDIENTES
                                    </td>';
                                }else {
                                    echo '<td id="td-ventas">
                                        
                                    </td>';
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

    <!-- Registra pago Modal-->
    <div class="modal fade" id="registraPagoModal" tabindex="-1" aria-labelledby="registraPagoModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registra pago de recompra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title" id="staticBackdropLabel">Datos:</h5>
                    <input class="form-control" type="hidden" name="idsocio" id="idsocio" value="">

                    <label for="fecha" class="label mt-2">Fecha</label>
                    <input class="form-control" type="text" name="fecha" id="fecha" value="">

                    <label for="fecha" class="label mt-2">Abono:</label>
                    <input class="form-control" type="text" name="total" id="total" value="<?= $recompra ? $saldo : '0.00' ?>">

                    <label for="fecha" class="label mt-2">Observación</label>
                    <input class="form-control" type="text" name="observacion" id="observacion" value="">

                    <input class="form-control" type="hidden" name="recompra" id="recompra" value="">
                </div>
                <div class="modal-footer">
                    <button 
                        type="button" 
                        class="btn btn-secondary" 
                        data-bs-dismiss="modal" 
                        onClick="registraPago(document.getElementById('recompra').value,document.getElementById('fecha').value,document.getElementById('idsocio').value,document.getElementById('observacion').value,document.getElementById('total').value)"
                    >Registrar pago</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

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