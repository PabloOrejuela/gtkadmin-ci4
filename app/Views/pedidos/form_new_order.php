<link rel="stylesheet" href="<?= site_url(); ?>public/css/form-new-order.css">
<!--begin::Form Validation-->
    <div class="card card-gtk card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header"><div class="card-title"><?= $subtitle;  ?></div></div>
        <!--end::Header-->
        <!--begin::Form-->
        <form class="needs-validation" action="<?= site_url().'new-order';?>" method="post" novalidate>
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Row-->
            <div class="row g-3">
                <!--begin::Col-->
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input
                        type="text"
                        class="form-control"
                        id="nombre"
                        name="nombre"
                        value="<?= $datosSocio[0]->nombre ?>"
                        required
                        readonly
                    />
                    <div class="valid-feedback">Correcto!</div>
                    <div class="invalid-feedback">Por favor debe ingresar su nombre .</div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                <label for="codigo_socio" class="form-label">Código</label>
                    <input
                        type="text"
                        class="form-control"
                        id="codigo_socio"
                        name="codigo_socio"
                        value="<?= $datosSocio[0]->codigo_socio ?>"
                        placeholder="nombre"
                        required
                        readonly
                    />
                    <div class="valid-feedback">Correcto!</div>
                    <div class="invalid-feedback">Por favor debe ingresar su nombre .</div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                    <label for="idpaquete" class="form-label">Paquete</label>
                    <select class="form-select" id="idpaquete" name="idpaquete" required>
                        <option selected disabled value="">--Escoja un paquete--</option>
                        <?php
                            if ($paquetes) {
                                foreach ($paquetes as $key => $paquete) {
                                    echo '<option value="'.$paquete->id.'" selected>'.$paquete->paquete.' | '.$paquete->litros.' litros - $'.$paquete->pvp.'</option>';
                                }
                            } else {
                                # code...
                            }
                            
                        ?>
                    </select>
                    <div class="invalid-feedback">Por favor seleccione un paquete.</div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-2">
                <label for="cantidad" class="form-label">Cantidad</label>
                    <input
                        type="text"
                        class="form-control"
                        id="cantidad"
                        name="cantidad"
                        value="1"
                        required
                    />
                    <div class="valid-feedback">Correcto!</div>
                    <div class="invalid-feedback">Por favor debe ingresar su nombre .</div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-2">
                <label for="total" class="form-label">Total a pagar</label>
                    <input
                        type="text"
                        class="form-control"
                        id="total"
                        name="total"
                        value="135"
                        readonly
                        required
                    />
                    <div class="valid-feedback">Correcto!</div>
                    <div class="invalid-feedback">Por favor debe ingresar su nombre .</div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                <label for="total" class="form-label">Descripción:</label>
                    <input
                        type="text"
                        class="form-control"
                        id="descripcion"
                        name="descripcion"
                        value="<?= $tiene_recompra == null ? 'RECOMPRA DEL MES DE '.strtoupper($mes_actual) : 'COMPRA DE PRODUCTO' ?>"
                        readonly
                        required
                    />
                    <div class="valid-feedback">Correcto!</div>
                    <div class="invalid-feedback">Por favor debe ingresar su nombre .</div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                    <label for="observacion_pedido" class="form-label">Observaciones</label>
                    <textarea 
                        class="form-control"
                        name="observacion_pedido"
                        placeholder="En caso de ser necesario puede escribir un mensaje u observación sobre su pedido" 
                        id="floatingTextarea2" 
                        style="height: 100px" 
                        ><?= old('observacion_pedido'); ?></textarea>
                </div>
                <!--end::Col-->
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
    <script src="<?= site_url(); ?>public/js/form-new-order.js"></script>