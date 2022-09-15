<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <form class="d-flex">
                    <!-- <a href="javascript: void(0);" class="btn btn-primary ms-2">
                             <i class="mdi mdi-autorenew"></i>
                         </a> -->
                </form>
            </div>
            <h4 class="page-title">Compras | Coordinación | Cotizaciones</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Lista de Cotizaciones</h4>
                <br>
                <button type="button" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#nuevaCotizacion">Nueva cotización</button>
                <br>
                <br>
                <br>

                <table id="datatable-buttons" class="table table-striped dt-responsive w-100 tabla_editar_solicitud dataTable no-footer dtr-inline">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Fecha</th>
                            <th>Proyecto</th>
                            <th>Progreso</th>
                            <th>Status</th>
                            <th>Actualizar Status</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <?php
                    include_once('php/models/viaticos/viatics_model.php');
                    include_once('php/models/compras/cotizaciones_model.php');

                    $compras = new Compras();
                    $getUtilizaciones = $compras->getUtilizaciones($id_user);
                    $getCotizaciones = $compras->getCotizacionesAdmin($id_user);
                    $getStatusTypes = $compras->getStatusTypes();
                    ?>

                    <tbody>
                        <?php foreach ($getCotizaciones as $cotizaciones) :
                            $partidas = $cotizaciones->partidas;
                            $partidas_completas = $cotizaciones->partidas_completas;
                            if ($partidas == 0) {
                                $porcentaje = 0;
                            } else {
                                $porcentaje = $partidas_completas / $partidas * 100;
                            };

                            if ($porcentaje == 100) {
                                $bg_barra = 'bg-success';
                            } else if ($porcentaje >= 50 && $porcentaje < 100) {
                                $bg_barra = 'bg-primary';
                            } else if ($porcentaje < 50 && $porcentaje > 15) {
                                $bg_barra = 'bg-warning';
                            } else if ($porcentaje <= 15) {
                                $bg_barra = 'bg-danger';
                            } else {
                                $bg_barra = 'bg-info';
                            }
                        ?>
                            <tr>
                                <td><?= $cotizaciones->id_cotizaciones; ?></td>
                                <td><?= mb_strtoupper($cotizaciones->codigo_solicitud); ?></td>
                                <td><?= $cotizaciones->fecha_index; ?></td>
                                <td><?= $cotizaciones->proyecto; ?></td>
                                <td>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-lg <?= $bg_barra ?>" role="progressbar" style="width: <?= $porcentaje ?>%" aria-valuenow="<?= $porcentaje ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td id="td_status_<?= $cotizaciones->id_cotizaciones ?>"><i class="mdi mdi-circle text-<?= $cotizaciones->class_bootstrap_cotizaciones ?>"></i> <?= $cotizaciones->descripcion_status_cotizaciones ?></td>
                                <td>

                                    <select id="example-multiselect" class="form-select mb-3">
                                        <option value="" selected disabled>Seleccione una opción</option>
                                        <?php foreach ($getStatusTypes as $statusType) : ?>
                                            <?php if ($statusType->id_status_cotizaciones == $cotizaciones->id_status_cotizaciones) : ?>
                                                <option selected value="<?= $statusType->id_status_cotizaciones ?>"><?= $statusType->descripcion_status_cotizaciones ?></option>
                                            <?php else : ?>
                                                <option value="<?= $statusType->id_status_cotizaciones ?>"><?= $statusType->descripcion_status_cotizaciones ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>

                                </td>
                                <td class="table-action">
                                    <a href="?submodule=desglose_cotizacion&id_cotizacion=<?= $cotizaciones->id_cotizaciones ?>" target="_blank" class="action-icon" data-bs-placement="top" title="Desglose de cotización"> <i class="mdi mdi-beaker-alert-outline"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <br>
            </div>
            <!-- end card-body-->
        </div>
        <!-- end card-->
    </div>
    <!-- end col-->
</div>
<!-- end row -->
<?php
include_once('php/views/compras/modals/nueva_cotizacion.php');

?>
<script src="js/functions/compras/cotizaciones.js"></script>
<script src="js/loading.js"></script>