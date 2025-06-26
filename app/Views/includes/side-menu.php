
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <?php
                if ($session->idrol == 1) {
                  echo '
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="nav-icon bi fa-hammer"></i>
                        <p>
                          Administración
                          <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="'.site_url().'admin-socios-list" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Administración de socios</p>
                          </a>
                        </li>
                      </ul>
                    </li>';
                }
              ?>
              
              <li class="nav-item">
                <a href="<?= site_url() ?>inicio" class="nav-link">
                  <i class="nav-icon bi bi-house"></i>
                  <p>Inicio</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-person-circle"> </i>
                  <p> Mi cuenta<i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="historial-pedidos" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Historial del pedidos</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url() ?>my-wallet" class="nav-link">
                      <i class="nav-icon bi bi-wallet-fill"></i>
                      <p>Mi billetera </p>
                    </a>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-seam-fill"></i>
                  <p>
                    Pedidos
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= site_url() ?>new-order" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Registrar pedidos</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="historial-pedidos" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Historial del pedidos</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="historial-pedidos" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Lista de pedidos mensual</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-diagram-2"></i>
                  <p>
                    Mi Equipo
                    <span class="nav-badge badge text-bg-secondary me-3"></span>
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= site_url() ?>lista-binaria" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Lista Binaria</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url() ?>arbol-binario" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Arbol Binario</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url() ?>tanque-reserva" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Tanque de retención</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url(); ?>lista-miembros" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Lista de Socios</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-award"></i>
                  <p>
                    Mi Rango
                    <span class="nav-badge badge text-bg-secondary me-3"></span>
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= site_url() ?>historial-rango" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Historial de rangos</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url() ?>progreso-rango" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Seguimiento proceso de rango</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="<?= site_url() ?>tablero-lideres" class="nav-link">
                  <i class="nav-icon bi bi-clipboard-fill"></i>
                  <p>Tablero de líderes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="new-member" class="nav-link">
                  <i class="nav-icon bi-person-plus"></i>
                  <p>Registrar nuevo Socio</p>
                </a>
              </li>
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->