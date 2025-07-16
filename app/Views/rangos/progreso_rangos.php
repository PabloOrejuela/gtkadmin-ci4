<link rel="stylesheet" href="<?= site_url(); ?>public/css/hist-rangos.css">
<!--begin::Form Validation-->
<div class="card card-gtk card-outline mb-4">
    <!--begin::Header-->
    <div class="card-header"><div class="card-title"><?= $title; ?></div></div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <div class="card-header">
                    <h5 class="card-title">Seguimiento del progreso</h5>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                      <div class="btn-group">
                        <button
                          type="button"
                          class="btn btn-tool dropdown-toggle"
                          data-bs-toggle="dropdown"
                        >
                          <i class="bi bi-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" role="menu">
                          <a href="#" class="dropdown-item">Action</a>
                          <a href="#" class="dropdown-item">Another action</a>
                          <a href="#" class="dropdown-item"> Something else here </a>
                          <a class="dropdown-divider"></a>
                          <a href="#" class="dropdown-item">Separated link</a>
                        </div>
                      </div>
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                   <?php
                    
                    $porcentajeCumplimientoIzq = ($progreso['pierna_izq'])*100/$progreso['rango_siguiente'][0]->cant_socios_pierna;
                    $porcentajeCumplimientoDer = ($progreso['pierna_der'])*100/$progreso['rango_siguiente'][0]->cant_socios_pierna;;

                    $cantPiernaLarga = $progreso['pierna_der'];
                    $cantPiernaCorta = $progreso['pierna_izq'];
                    $porcentPiernaLarga = $porcentajeCumplimientoDer;
                    $porcentPiernaCorta = $porcentajeCumplimientoIzq;

                    if ($progreso['pierna_izq'] >= $progreso['pierna_der']) {
                      $cantPiernaLarga = $progreso['pierna_izq'];
                      $cantPiernaCorta = $progreso['pierna_der'];
                      $porcentPiernaLarga = $porcentajeCumplimientoIzq;
                      $porcentPiernaCorta = $porcentajeCumplimientoDer;
                    }

                    $porcentRangoActual = ($cantPiernaCorta*100)/$progreso['rango_actual'][0]->cant_socios_pierna;
                    

                  ?>
                  <div class="card-body">
                    <!--begin::Row-->
                    <div class="row">
                      <!-- /.col -->
                      <div class="col-md-12">
                        <p class="text-center"><strong>Objetivos conseguidos</strong></p>
                        <div class="progress-group">
                          Cantidad socios pierna mas corta
                          <span class="float-end"><b><?= $cantPiernaCorta;?></b>/<?= $progreso['rango_siguiente'][0]->cant_socios_pierna; ?></span>
                          <div class="progress progress-sm">
                            <div <?= $porcentPiernaCorta >= 50 ? 'class="progress-bar text-bg-primary"' : 'class="progress-bar text-bg-danger"'; ?> style="width: <?= $porcentPiernaCorta;?>%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          Cantidad socios pierna mas larga
                          <span class="float-end"><b><?= $cantPiernaLarga;?></b>/<?= $progreso['rango_siguiente'][0]->cant_socios_pierna; ?></span>
                          <div class="progress progress-sm">
                            <div <?= $porcentPiernaLarga >= 50 ? 'class="progress-bar text-bg-primary"' : 'class="progress-bar text-bg-danger"'; ?> style="width: <?= $porcentPiernaLarga;?>%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                            Cantidad socios directos pierna izquierda
                            <span class="float-end"><b><?= $progreso['pierna_izq'];?></b>/<?= $progreso['rango_siguiente'][0]->cant_socios_pierna; ?></span>
                            <div class="progress progress-sm">
                                <div <?= $porcentajeCumplimientoIzq >= 50 ? 'class="progress-bar text-bg-primary"' : 'class="progress-bar text-bg-danger"'; ?> style="width: <?= $porcentajeCumplimientoIzq;?>%"></div>
                            </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                            Cantidad socios directos pierna derecha
                            <span class="float-end"><b><?= $progreso['pierna_der'];?></b>/<?= $progreso['rango_siguiente'][0]->cant_socios_pierna; ?></span>
                            <div class="progress progress-sm">
                                <div <?= $porcentajeCumplimientoDer >= 50 ? 'class="progress-bar text-bg-primary"' : 'class="progress-bar text-bg-danger"'; ?> style="width: <?= $porcentajeCumplimientoDer;?>%"></div>
                            </div>
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!--end::Row-->
                  </div>
                  <!-- ./card-body -->
                  <div class="card-footer">
                    <!--begin::Row-->
                    <div class="row">
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <span class="text-success">
                            <i class="bi bi-caret-up-fill"></i> <?= $porcentPiernaCorta; ?>%
                          </span>
                          <h5 class="fw-bold mb-0"><?= $progreso['pierna_izq'].' / '.$progreso['pierna_der']?></h5>
                          <span class="text-uppercase">TOTAL SOCIOS</span>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <span class="text-info"> <i class="bi bi-caret-left-fill"></i> <?= $porcentRangoActual; ?>% </span>
                          <h5 class="fw-bold mb-0"><?= $progreso['rango_actual'][0]->rango ?></h5>
                          <span class="text-uppercase">RANGO ACTUAL</span>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-6">
                        <div class="text-center">
                          <span class="text-success">
                            <i class="bi bi-caret-up-fill"></i> <?= $porcentRangoActual; ?>%
                          </span>
                          <h5 class="fw-bold mb-0"><?= $progreso['rango_siguiente'][0]->cant_socios_pierna.' / '.$progreso['rango_siguiente'][0]->cant_socios_pierna; ?></h5>
                          <span class="text-uppercase">OBJETIVO DEL RANGO ACTUAL</span>
                        </div>
                      </div>
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <span class="text-success">
                            <i class="bi bi-caret-up-fill"></i> <?= 100-$porcentPiernaCorta; ?>%
                          </span>
                          <h5 class="fw-bold mb-0"><?= $progreso['rango_siguiente'][0]->rango ?></h5>
                          <span class="text-uppercase">RANGO SIGUIENTE</span>
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!--end::Row-->
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
    </div>
    <!--end::Body-->
    <!--begin::Footer-->
    <div class="card-footer">
    </div>
    <!--end::Footer-->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= site_url(); ?>public/js/hist-rangos.js"></script>