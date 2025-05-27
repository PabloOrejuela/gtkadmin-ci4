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
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>Balance actual</h3>
                    <p>Disponible: $ 100</p>
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
                    <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Mas información <i class="bi bi-link-45deg"></i>
                    </a>
            </div>
          <!--end::Small Box Widget 1-->
        </div>
        <!--end::Col-->
    </div>
      <!--end::Row-->
      <!--begin::Row-->
      <div class="row">
        <!-- Start col -->
        <div class="col-lg-7 connectedSortable">
          <!-- Mi equipo -->
          <div class="card direct-chat direct-chat-primary mb-4">
            <div class="card-header">
              <h3 class="card-title">Movimientos</h3>
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
                            <td>'.$mov->fecha.'</td>
                            <td>'.$mov->tipo_mov.'</td>
                            <td>'.$mov->concepto.'</td>
                            <td>'.$mov->cantidad.'</td>';
                            
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