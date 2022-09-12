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
            <h4 class="page-title">Compras | Coordinación | Catálogo de Material</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Lista de material</h4>
                <br>
                <button type="button" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#nuevoConceptoCatalogo">Nuevo material</button>
                <br>
                <br>
                <br>

                <table id="datatable-buttons" class="table table-striped dt-responsive w-100 tabla_editar_solicitud dataTable no-footer dtr-inline">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Concepto</th>
                            <th>Clasificación</th>
                            <th>U.M</th>
                        </tr>
                    </thead>

                    <?php
                    include_once('php/models/compras/cotizaciones_model.php');

                    $compras = new Compras();
                    $getCatalogo = $compras->getCatalogoMaterial();
                    ?>

                    <tbody>
                        <?php foreach ($getCatalogo as $catalogo) : ?>
                            <tr>
                                <td><?= $catalogo->id_catalogo_material; ?></td>
                                <td><?= mb_strtoupper($catalogo->codigo_astelecom); ?></td>
                                <td><?= $catalogo->descripcion_material; ?></td>
                                <td><?= $catalogo->clasificacion; ?></td>
                                <td><?= $catalogo->unidades_medida_long; ?></td>
                                <!-- <td>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-lg <?= $bg_barra ?>" role="progressbar" style="width: <?= $porcentaje ?>%" aria-valuenow="<?= $porcentaje ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td id="td_status_<?= $catalogo->id_cotizaciones ?>"><i class="mdi mdi-circle text-<?= $catalogo->class_bootstrap ?>"></i> <?= $catalogo->status_descripcion ?></td>
                                <td>

                                    <select id="example-multiselect"  class="form-select mb-3">
                                        <option value="" selected disabled>Seleccione una opción</option>
                                        <?php foreach ($getStatusTypes as $statusType) : ?>
                                            <option value="<?= $statusType->id_status_cotizaciones ?>"><?= $statusType->descripcion ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                   
                                </td>
                                <td class="table-action">
                                    <a href="?submodule=desglose_cotizacion&id_cotizacion=<?= $catalogo->id_cotizaciones ?>" target="_blank" class="action-icon" data-bs-placement="top" title="Desglose de cotización"> <i class="mdi mdi-beaker-alert-outline"></i></a>
                                </td> -->
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
include_once('php/views/compras/modals/nuevoConceptoCatalogo.php');

?>
<script src="js/functions/compras/catalogo_material.js"></script>
<script src="js/loading.js"></script>