<link rel="stylesheet" href="<?= site_url(); ?>public/css/inicio.css">
<!--begin::App Content-->
<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <!--begin::Col-->
        <div class="col-lg-3 col-6">
          <!--begin::Small Box Widget 1-->
          <div class="small-box text-bg-warning">
            <div class="inner">
              <h3><?= $pts->pts_izq; ?> pts</h3>
              <p>Total Volumen izquierda: <?= $pts->left_leg; ?> socios activos</p>
            </div>
            <svg
              class="small-box-icon"
              fill="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
              aria-hidden="true"
            >
              <path
                d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"
              ></path>
            </svg>
            <a
              href="#"
              class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
            >
              Mas información <i class="bi bi-link-45deg"></i>
            </a>
          </div>
          <!--end::Small Box Widget 1-->
        </div>
        <!--end::Col-->
        <div class="col-lg-3 col-6">
          <!--begin::Small Box Widget 2-->
          <div class="small-box text-bg-warning">
            <div class="inner">
              <h3><?= $pts->pts_der; ?> pts</h3>
              <p>Total Volumen derecha: <?= $pts->right_leg; ?> socios activos</p>
            </div>
            <svg
              class="small-box-icon"
              fill="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
              aria-hidden="true"
            >
              <path
                d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"
              ></path>
            </svg>
            <a
              href="#"
              class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
            >
              Mas información <i class="bi bi-link-45deg"></i>
            </a>
          </div>
          <!--end::Small Box Widget 2-->
        </div>
        <!--end::Col-->
        <div class="col-lg-3 col-6">
          <!--begin::Small Box Widget 3-->
          <div class="small-box text-bg-warning">
            <div class="inner">
              <h3>$ <?= $bir_pendientes[0]->totalBir; ?></h3>
              <p>BIR Pendientes de cobrar </p>
            </div>
            <svg
              class="small-box-icon"
              fill="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
              aria-hidden="true"
            >
              <path
                d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"
              ></path>
            </svg>
            <a
              href="#"
              class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover"
            >
              Mas información <i class="bi bi-link-45deg"></i>
            </a>
          </div>
          <!--end::Small Box Widget 3-->
        </div>
        <!--end::Col-->
        <div class="col-lg-3 col-6">
          <!--begin::Small Box Widget 4-->
          <div class="small-box text-bg-warning-rango">
            <div class="inner">
              <h3>Rango</h3>
              <p id="p-rango"><?= $session->rango; ?> | Estado: <?= $session->estado_suscripcion; ?></p>
            </div>
            <svg
              class="small-box-icon"
              fill="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
              aria-hidden="true"
            >
              <path
                clip-rule="evenodd"
                fill-rule="evenodd"
                d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
              ></path>
              <path
                clip-rule="evenodd"
                fill-rule="evenodd"
                d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
              ></path>
            </svg>
            <a
              href="#"
              class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
            >
              Mas información <i class="bi bi-link-45deg"></i>
            </a>
          </div>
          <!--end::Small Box Widget 4-->
        </div>
        <!--end::Col-->
      </div>
      <!--end::Row-->
      <!--begin::Row-->
      <div class="row">
        <!-- Start col -->
        <div class="col-lg-7 connectedSortable">
          <!-- Mis pedidos -->
          <div class="card direct-chat direct-chat-primary mb-4">
            <div class="card-header">
              <h3 class="card-title">Lista de Pedidos de la semana</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">No.</th>
                    <th>Fecha de compra</th>
                    <th>Paquete</th>
                    <th>Descripción</th>
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
                            <td>'.$pedido->paquete.' | '.$pedido->litros.' litros - $'.$pedido->pvp.'</td>
                            <td>'.$pedido->observacion_pedido.'</td>
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
                          </tr>';
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.Mis pedidos-->
          <!-- /.card -->
          <!-- Mi equipo -->
          <div class="card direct-chat direct-chat-primary mb-4">
            <div class="card-header">
              <h3 class="card-title">Mi Equipo</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">No.</th>
                    <th id="th-codigo">Código</th>
                    <th>Nombre</th>
                    <th>Rango</th>
                    <th>Estado</th>
                    <th style="width: 40px">Progreso</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $num = 1;
                    if ($mi_equipo) {
                      
                      foreach ($mi_equipo as $key => $socio) {
                        echo '<tr class="align-middle">
                            <td>'.$num.'</td>
                            <td>'.$socio->codigo_socio.'</td>
                            <td>'.$socio->nombre.'</td>
                            <td>'.$socio->rango.'</td>';

                          //verifica el estado de un socio
                          if ($socio->estado_socio == 1) {
                            echo '<td>ACTIVO</td>';
                          } else {
                            echo '<td>INACTIVO</td>';
                          }
                            
                        echo '<td><span class="badge text-bg-danger">55%</span></td>
                          </tr>';
                          $num++;
                      }
                    }else{
                      echo '<tr class="align-middle">
                            <td>1.</td>
                            <td colspan="3">SIN DATOS</td>
                            <td>
                              <div class="progress progress-xs">
                                <div
                                  class="progress-bar progress-bar-danger"
                                  style="width: 55%"
                                ></div>
                              </div>
                            </td>
                            <td><span class="badge text-bg-danger">55%</span></td>
                          </tr>';
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.Mi equipo-->
        </div>
        <!-- /.Start col -->
        <!-- Start col -->
        <div class="col-lg-5 connectedSortable">
          <div class="card text-black bg-resumen-financiero bg-gradient border-primary mb-4">
            <div class="card-header border-0">
              <h3 class="card-title">Resumen financiero</h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-primary btn-sm"
                  data-lte-toggle="card-collapse"
                >
                  <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                  <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-condensed" id="table-resumen">
                <thead>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Cantidad de socios inscritos personalmente (Izq/Der): </td>
                    <td><?= $pts->left_leg.' / '.$pts->right_leg; ?></td>
                  </tr>
                  <tr>
                    <td>Total usuarios activos: </td>
                    <td><?= $pts->left_leg.' / '.$pts->right_leg; ?></td>
                  </tr>
                  <tr>
                    <td>Estado de la membresía: </td>
                    <td><?= $session->estado_suscripcion; ?></td>
                  </tr>
                  <tr>
                    <td id="td-bold">BIR Pendientes de cobrar: </td>
                    <td id="td-bold">$ <?= $bir_pendientes[0]->totalBir; ?></td>
                  </tr>
                  <tr>
                    <td>Rango actual: </td>
                    <td><?= $session->rango; ?></td>
                  </tr>
                  <tr>
                    <td>Meta del rango: </td>
                    <td><?= $resumen['meta_rango'][0]->cant_socios_pierna.'/'.$resumen['meta_rango'][0]->cant_socios_pierna; ?></td>
                  </tr>
                  <tr>
                    <td>Meta alcanzada hasta el día <?= date('Y-m-d'); ?></td>
                    <td><?= $pts->left_leg.' / '.$pts->right_leg; ?></td>
                  </tr>
                  <tr>
                    <td id="td-bold">Cumple la meta del rango <?= $session->rango; ?> para poder cobrar: </td>
                    <td id="td-bold"><?= $resumen['cumpleMeta'] == 1 ? "SI" : "NO"; ?></td>
                  </tr>
                  <tr>
                    <td id="td-bold">Accede o permanece en el rango: </td>
                    <td id="td-bold"><?= $resumen['accede_rango'][0]->rango; ?></td>
                  </tr>
                  <tr>
                    <td id="td-bold">Sueldo a cobrar por el mes de: <?= $resumen['mes']; ?></td>
                    <td id="td-bold">$ <?= number_format($resumen['income'], 2) ?></td>
                  </tr>
                  <tr>
                    <td id="td-bold"></td>
                    <td id="td-bold"></td>
                  </tr>
                  <tr>
                    <td id="td-bold-total">TOTAL A COBRAR POR EL MES DE: <?= $resumen['mes'].' DEL '.$resumen['anio'] ; ?></td>
                    <td id="td-bold-total">$ <?= number_format(($resumen['income'] + $bir_pendientes[0]->totalBir), 2) ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer border-0">
              <!--end::Row-->
            </div>
          </div>
        </div>
        <!-- /.Start col -->
      </div>
      <!-- /.row (main row) -->
       <!--begin::Row-->
      <div class="row">
        <!-- Start col -->
        <div class="col-lg-7 connectedSortable">
          <!-- Mi equipo -->
          <div class="card direct-chat direct-chat-primary mb-4">
            <div class="card-header">
              <h3 class="card-title">Gana con GTK Ecuador</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="loren">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae posuere lorem, sit amet egestas quam. Quisque eleifend eleifend nibh quis tempus. Nullam id eros ut augue auctor sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus eu massa felis. Nullam eget vulputate justo. Nullam vitae laoreet sapien. Quisque dapibus eget dolor ut molestie. Phasellus tempor turpis a neque facilisis porta. Nam scelerisque tellus odio, a ultrices lacus sollicitudin in.

Donec dui ante, iaculis nec elementum a, efficitur sed turpis. Pellentesque sed quam id lacus aliquet mattis. 
Mauris eu imperdiet urna, vitae pulvinar mauris. Maecenas lectus sem, aliquet non sem non, posuere ullamcorper libero. Ut congue justo vel lectus vehicula aliquet. Etiam ullamcorper augue tellus, a sollicitudin sapien pulvinar eu. 
Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>

<p>GTK Ecuador cree en el avance de la tecnología y de los sistemas de mercadeo en red como uno de los métodos de mayor beneficio para todas las personas.

Consideramos que el mercadeo en red es el mejor sistema de trabajo donde usted lo desarrolla y se beneficia del trabajo de toda su organización por que es mejor trabajar con un equipo de personas que trabajar solo.

En este sistema usted no requiere de ningún requisito, solo el deseo de trabajar y cumplir sus sueños, aquí tiene disponibilidad de tiempo, hacerlo de una forma inteligente sin descuidar sus actividades normales y alcanzar sus metas de acuerdo a su esfuerzo.
"Si usted nació pobre no es su culpa; pero si muere pobre... eso si es su culpa".</p>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.Mi equipo-->
        </div>
        <!-- /.Start col -->
        <!-- Start col -->
        <div class="col-lg-5 connectedSortable">
          <!-- Mi equipo -->
          <div class="card direct-chat direct-chat-primary mb-4">
            <div class="card-header">
              <h3 class="card-title">Plan de compensación GTK</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <img src="<?= site_url(); ?>public/images/pc-bir-2025.jpeg" />
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.Mi equipo-->
        </div>
        <!-- /.Start col -->
      </div>
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content-->
