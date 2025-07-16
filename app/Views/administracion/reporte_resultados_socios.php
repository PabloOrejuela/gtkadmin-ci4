<link rel="stylesheet" href="<?= site_url(); ?>public/css/reporte-resultados-socios.css">
<!--begin::Form Validation-->
<div class="card card-gtk card-outline mb-4">
    <!--begin::Header-->
    <div class="card-header"><div class="card-title"><?= $subtitle; ?></div></div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Row-->
        <div class="row g-3">
            <table id="datatablesSimple" class="table table-bordered table-striped mt-1">
                <thead>
                    <th id="td-left">Código</th>
                    <th>Nombre</th>
                    <th>Documento</th>
                    <th>Recompra</th>
                    <th>Cant socios (Izq./Der)</th>
                    <th>Rango</th>
                    <th>Meta</th>
                    <th>Sueldo</th>
                    <th>BIR por cobrar</th>
                    <th>Total</th>
                    <th>Estado</th>
                </thead>
                <tbody>
                    <?php
                        use App\Models\PedidoModel;
                        use App\Models\SocioModel;
                        use App\Models\RangoModel;
                        use App\Models\BirModel;
                        $this->pedidoModel = new PedidoModel();
                        $this->socioModel = new SocioModel();
                        $this->rangoModel = new RangoModel();
                        $this->birModel = new BirModel();

                        if ($resultados) {
                            foreach ($resultados as $res) {
                                
                                //Obtengo la cantidad de socios patrocinados del socio
                                $patrocinados_izq = $this->socioModel->_getCantSociosActivosPierna(1, $res->id, 'patrocinador');
                                $patrocinados_der = $this->socioModel->_getCantSociosActivosPierna(2, $res->id, 'patrocinador');
                                $pierna_corta = $patrocinados_der;
                                $birPendientes = $this->birModel->select('sum(cantidad) as birPendientes')->where('idsocio', $res->id)->findAll();

                                //defino la pierna menor
                                if ($patrocinados_izq >= $patrocinados_der) {
                                    $pierna_corta = $patrocinados_izq;
                                } 
                                
                                $fechaCadena = date('Y-m');
                                $month = date('m');
                                $year = date('Y');
                                
                                $num_dias = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                                $recompra = $this->pedidoModel->where('fecha_compra BETWEEN "'
                                                                . date('Y-m-d', strtotime($fechaCadena.'-01')). '" and "'
                                                                . date('Y-m-d', strtotime($fechaCadena.'-'.$num_dias)).'"')
                                                                ->where('idsocio', $res->id)
                                                                ->findall();

                                $sueldoRango = $this->rangoModel->find($res->idrango);

                                //Verifica si cumple la meta del rango
                                $meta_rango = $this->rangoModel->select('cant_socios_pierna')->where('id', $res->idrango)->findAll();
                                $cumpleMeta = count((array)$pierna_corta) >= ($meta_rango[0]->cant_socios_pierna) ? 1 : 0;

                                //echo '<pre>'.var_export($birPendientes, true).'</pre>';exit;
                                
                                echo '<tr>';
                                echo '<td id="td-left">'.$res->codigo_socio.'</td>';
                                echo '<td>'.$res->nombre.'</td>';
                                echo '<td>'.$res->cedula.'</td>';
                                
                                //verifica si el socio tiene recompra activa
                                if (isset($recompra) && count($recompra) > 0 && $recompra[0]->estado == 1) {
                                    echo '<td>PAGADO</td>';
                                } else {
                                    echo '<td>PAGO PENDIENTE</td>';
                                }
                                $izq = $patrocinados_izq ? count($patrocinados_izq) : '0';
                                $der = $patrocinados_der ? count($patrocinados_der) : '0';

                                // Cant Socios piernas
                                echo '<td id="td-left">'.$izq.'/'.$der.'</td>';

                                echo '<td>'.$res->rango.'</td>';
                                if ($cumpleMeta == 1) {
                                    echo '<td>CUMPLE LA META</td>';
                                    echo '<td>'.$sueldoRango->ingreso_mensual.'</td>';
                                } else {
                                    echo '<td>NO CUMPLE</td>';
                                    echo '<td>0.00</td>';
                                }

                                echo '<td>'.$birPendientes[0]->birPendientes.'</td>';
                                echo '<td>'.($sueldoRango->ingreso_mensual+$birPendientes[0]->birPendientes).'</td>';
                                
                                //verifica el estado de un socio
                                if ($res->estado_socio == 1 && $res->estado_inscripcion == 1) {
                                    echo '<td>ACTIVO</td>';
                                } else {
                                    echo '<td>INACTIVO</td>';
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
    <!--begin::Footer-->
    <div class="card-footer">
        <button class="btn btn-info" type="button" id="btn-reporte-resultados-excel">Descargar reporte excel</button>
    </div>
    <!--end::Footer-->
    <!--end::Form-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= site_url(); ?>public/js/reporte-resultados-socios.js"></script>