<link rel="stylesheet" href="<?= site_url(); ?>public/css/tanque-reserva.css">
<!--begin::Form Validation-->
<div class="card card-gtk card-outline mb-4">
    <!--begin::Header-->
    <div class="card-header"><div class="card-title"><?= $subtitle; ?></div></div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Row-->
        <div class="row g-3">
            <table id="datatablesSimple" class="table table-bordered table-striped mt-2">
                <thead>
                    <th class="col-md-1">Codigo</th>
                    <th class="col-md-4">Nombre</th>
                    <th class="col-md-1">Documento</th>
                    <th class="col-md-1">Fecha de registro</th>
                    <th class="col-md-1">Seleccionar posición</th>
                    <th class="col-md-1" id="div-center">Estado</th>
                </thead>
                <tbody id="table-datos">
                    <?php
                        if ($sociosReserva) {
                            foreach ($sociosReserva as $socio) {
                                echo '<tr>
                                        <td>'.$socio->id.'</td>
                                        <td>'.$socio->nombre.'</td>
                                        <td>'.$socio->cedula.'</td>
                                        <td>'.$socio->fecha_inscripcion.'</td>
                                        <td id="div-center">
                                            <a type="button" 
                                                id="selectPosition_'.$socio->id.'" 
                                                href="#" 
                                                data-id="'.$socio->id.'"
                                                data-patrocinador="'.$socio->patrocinador.'"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#selectPosition"
                                                class="btn btn-outline-success"
                                            >Seleccionar posición</a>
                                        </td>';
                                        if ($socio->estado == 1) {
                                            echo '<td id="div-center">ACTIVO</td>';
                                        } else {
                                            echo '<td id="div-center">INACTIVO</td>';
                                        }
                                        
                                echo '</tr>';
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


<!-- Modal Select Posición-->
<div class="modal fade" id="selectPosition" tabindex="-1" aria-labelledby="selectPosition" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectPosition">Seleccionar posición</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="get" action="<?= site_url().'setPosition';?>">
                <div class="modal-body" id="modal-body">
                    <h5 class="modal-title" id="staticBackdropLabel">Mi equipo</h5>
                    <input class="form-control" type="hidden" name="id" id="id">
                    <input class="form-control" type="hidden" name="patrocinador" id="patrocinador">
                    <select 
                        class="form-select" 
                        id="select-piernas" 
                        name="piernas"
                        data-style="form-control" 
                        data-live-search="true" 
                    >
                        <option selected>-- Seleccione una posición --</option>
                        <option value="1">Abajo a la izquierda de</option>
                        <option value="2">Abajo a la derecha de</option>
                    </select>
                    <select 
                        class="form-select" 
                        id="select-posicion" 
                        name="posicion"
                        data-style="form-control" 
                        data-live-search="true" 
                    >
                    </select>
                </div>
                <div class="modal-footer">
                    <button 
                        type="submit" 
                        class="btn btn-secondary" 
                        data-bs-dismiss="modal"
                        id="btn-actualizar-posicion"
                    >Actualizar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= site_url(); ?>public/js/tanque-reserva.js"></script>