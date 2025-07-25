<link rel="stylesheet" href="<?= site_url(); ?>public/css/form-reg-new-member.css">
<!--begin::Form Validation-->
    <div class="card card-gtk card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header"><div class="card-title"><?= $subtitle;  ?></div></div>
        <!--end::Header-->
        <!--begin::Form-->
        <form class="needs-validation" action="<?= site_url().'new-member-insert';?>" method="post" novalidate>
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Row-->
            <div class="row g-3">
                <!--begin::Col-->
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Nombre</label>
                    <input
                        type="text"
                        class="form-control"
                        id="validationCustom01"
                        name="nombre"
                        placeholder="nombre"
                        required
                    />
                    <div class="valid-feedback">Correcto!</div>
                    <div class="invalid-feedback">Por favor debe ingresar su nombre .</div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Usuario</label>
                    <input
                        type="text"
                        class="form-control"
                        id="validationCustomUsername"
                        name="user"
                        placeholder="usuario"
                        required
                    />
                    <div class="valid-feedback">Correcto!</div>
                    <div class="invalid-feedback">Por favor debe elegir un nombre de usuario.</div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Password</label>
                    <input
                        type="password"
                        class="form-control"
                        id="validationCustomUsername"
                        name="password"
                        placeholder="password"
                        required
                    />
                    <div class="valid-feedback">Correcto!</div>
                    <div class="invalid-feedback">Por favor debe elegir un nombre de usuario.</div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input
                        type="text"
                        class="form-control"
                        id="telefono"
                        name="telefono"
                        placeholder="teléfono"
                        required
                    />
                    <div class="valid-feedback">Correcto!</div>
                    <div class="invalid-feedback">Por favor debe registrar un número de teléfono.</div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                    <label for="telefono_2" class="form-label">Teléfono 2</label>
                    <input
                        type="text"
                        class="form-control"
                        id="telefono_2"
                        name="telefono_2"
                        placeholder="Teléfono 2"
                    />
                    <div class="valid-feedback">Correcto!</div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                    <label for="validationCustomUsername" class="form-label">Email</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input
                            type="email"
                            class="form-control"
                            id="validationCustomEmail"
                            name="email"
                            aria-describedby="inputGroupPrepend"
                            required
                        />
                        <div class="invalid-feedback">Por favor debe elegir un email válido.</div>
                    </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label">Cédula / Pasaporte</label>
                    <input
                        type="text"
                        name="cedula"
                        class="form-control"
                        id="validationCustom03"
                        required
                    />
                    <div class="invalid-feedback">Por favor debe ingresar un número de documento.</div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Provincia</label>
                    <select class="form-select" id="validationCustomProvincias" name="idprovincia" required>
                        <option selected disabled value="">--Escoja una provincia--</option>
                        <?php
                            if ($provincias) {
                                foreach ($provincias as $key => $provincia) {
                                    echo '<option value="'.$provincia->id.'">'.$provincia->provincia.'</option>';
                                }
                            } else {
                                # code...
                            }
                            
                        ?>
                    </select>
                    <div class="invalid-feedback">Por favor seleccione una provincia.</div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                    <label for="validationCustom05" class="form-label">Ciudad</label>
                    <select class="form-select" id="validationCustomCiudades" name="idciudad" required disabled></select>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label">Dirección</label>
                    <textarea 
                        class="form-control"
                        name="direccion"
                        placeholder="Ingrese su dirección" 
                        id="floatingTextarea2" 
                        style="height: 100px" 
                        required></textarea>
                    <div class="invalid-feedback">Por favor debe ingresar su dirección.</div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label">Paquete único mas costo de inscripción:</label>
                    <input
                        type="text"
                        name="inscripcion"
                        class="form-control"
                        id="input-inscripcion"
                        value="185.00"
                        readonly
                    />
                    <div class="invalid-feedback">Por favor debe ingresar un número de documento.</div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-12">
                    <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        value=""
                        id="invalidCheck"
                        name="chkTerminos"
                        required
                    />
                    <label class="form-check-label" for="invalidCheck">
                        Estoy de acuerdo con los téminos y condiciones del sitio
                    </label>
                    <div class="invalid-feedback">Por favor debe marcar que está de acuerdo con las condiciones del sitio.</div>
                    </div>
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
    <script src="<?= site_url(); ?>public/js/form-reg-new-member.js"></script>