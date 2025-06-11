<link rel="stylesheet" href="<?= site_url(); ?>public/css/billetera.css">
<!--begin::App Content-->
<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
      <div class="row">
        <!--begin::Col-->
        <div class="col-lg-3 col-6">
          <!--begin::Small Box Widget 1-->
          <div class="small-box text-bg-primary">
            <div class="inner">
              <h5>Balance actual</h5>
              <p>Disponible: $ <?= $total; ?> en su cuenta</p>
            </div>
            <svg
              class="small-box-icon"
              fill="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
              aria-hidden="true"
            >
              <path
                d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"
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
          <div class="small-box text-bg-success">
            <div class="inner">
              <h5>Total retirado</h5>
              <p>$ <?= isset($total_retirado[0]->total) ? $total_retirado[0]->total : '0.00'; ?> retirado o movido de su cuenta</p>
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
              <h5>Importe total:</h5>
              <p>$ <?= isset($total_acreditado[0]->total) ? $total_acreditado[0]->total : '0.00'; ?> dinero que ha entrado en su cuenta digital</p>
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
          <div class="small-box text-bg-danger">
            <div class="inner">
              <h5>Bono de Inicio Pendiente</h5>
              <p>$<?= $bir_pendientes[0]->totalBir ? $bir_pendientes[0]->totalBir : '0'; ?> pendiente de asignar</p>
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
      <div class="row mt-2">
        <div class="col-md-12">
          
        </div>
      </div>
      <!--end::Row-->
      <!--begin::Row-->
      <div class="row mt-2">
        <div class="card direct-chat direct-chat-primary mb-4">
          <div class="card-header">
            <h5>GTK Ecuador le da la oportunidad de usar el importe de sus BIR (Bonos de Inicio Rápido) para adquirir producto para usted o los miembros de su equipo. Simplemente seleccione la cantidad de dinero que desee asignar a su cuenta de crédito y este se añadirá automáticamente a su billetera cada vez que tenga uns ingreso por BIR.</h5>
            <h5>Porcentaje actualmente establecido: <input type="text" id="inputPorcentaje" class="form-control" value="<?= $idsocio->porcentaje_billetera; ?>" disabled/></h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <div class="col-md-12">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="porcentajeAhorro" id="radioAhorrar0" value="0" checked>
                  <label class="form-check-label" for="radioAhorrar">
                    No acredite NINGUNA de los importes de mis BIR a mi Billetera Digital
                  </label>
                </div>
                <div class="form-check col-md-9">
                  <input class="form-check-input" type="radio" name="porcentajeAhorro" id="radioAhorrar3" value="3">
                  <label class="form-check-label" for="radioAhorrar">
                    Me gustaría acreditar el siguiente porcentaje <input type="text" maxlength="3" class="form-control" id="porcentaje" name="porcentaje" placeholder="0%"/> de mis BIR a mi Billetera Digital
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="porcentajeAhorro" id="radioAhorrar100" value="100">
                  <label class="form-check-label" for="radioAhorrar">
                    Me gustaría acreditar el TOTAL de mis BIR a mi Billetera Digital
                  </label>
                </div>
              </div>      
          </div>
          <!-- /.card-body -->
          <!--begin::Footer-->
          <div class="card-footer">
              <button class="btn btn-info" type="button" id="btn-ahorrar">Ahorrar</button>
          </div>
          <!--end::Footer-->
        </div>
      </div>
      <!--begin::Row-->
      <!--begin::Row-->
      <div class="row mt-2">
        <div class="card direct-chat direct-chat-primary mb-4">
          <div class="card-header">
            <h4>Mover saldo de mis BIR a mi billetera digital</h4>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row mt-2 mb-3">
              <label class="form-check-label" for="inputValorTransferir">Valor que puede transferir a su billetera digital de acuerdo al porcentaje establecido:</label>
              <div class="col-md-2">
                  <input
                    type="text"
                    name="id"
                    class="form-control"
                    id="inputValorTransferir"
                    value=""
                />
              </div>
              <div class="col-md-2">
                <button class="btn btn-info" type="button" id="btn-transferir">Transferir a mi billetera digital</button>   
              </div>   
            </div> 
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <!--begin::Row-->
      <!--begin::Row-->
      <div class="row mt-3">
        <!-- Start col -->
        <div class="col-lg-7 connectedSortable">
          <!-- Mi equipo -->
          <div class="card direct-chat direct-chat-primary mb-4">
            <div class="card-header">
              <h3 class="card-title">Movimientos realizados en la Billetera Digital</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">No.</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Concepto</th>
                    <th>Cantidad</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $num = 1;
                    if ($billetera) {
                      
                      foreach ($billetera as $key => $mov) {
                        echo '<tr class="align-middle">
                            <td>'.$num.'</td>
                            <td>'.$mov->fecha.'</td>';
                            if ($mov->tipo_mov == 1) {
                              echo '<td>INGRESO</td>';
                            } else if($mov->tipo_mov == 2) {
                              echo '<td>EGRESO</td>';
                            }else if($mov->tipo_mov == 3) {
                              echo '<td>INGRESO</td>';
                            }
                            
                        echo'<td>'.$mov->concepto.'</td>
                            <td>'.$mov->cantidad.'</td>';
                            
                        echo '</tr>';
                        $num++;
                      }
                    }else{
                      echo '<tr class="align-middle">
                            <td>1.</td>
                            <td></td>
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
              <input
                  type="hidden"
                  name="id"
                  class="form-control"
                  id="id"
                  value="<?= $idsocio->id; ?>"
              />
              <input
                  type="hidden"
                  name="total_bir_pendientes"
                  class="form-control"
                  id="total_bir_pendientes"
                  value="<?= $bir_pendientes[0]->totalBir; ?>"
              />
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.Mi equipo-->
          <!-- /.card -->
        </div>
        <!-- /.Start col -->
      </div>
      <!-- /.row (main row) -->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?= site_url(); ?>public/js/billetera.js"></script>