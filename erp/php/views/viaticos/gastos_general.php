<?php

include_once('php/models/viaticos/viatics_model.php');
$viatics = new ViaticsInformation();
?>
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
            <h4 class="page-title">Gastos Registrados</h4>
            <div class="row">
                <div class="col-3">
                    <div class="mb-3">
                        <label for="example-date" class="form-label">Fecha de Inicio</label>
                        <?php if (isset($_GET['start_date_search'])) : ?>
                            <input class="form-control" id="start_date_search" type="date" name="date" value="<?= $_GET['start_date_search'] ?>">
                        <?php else : ?>
                            <input class="form-control" id="start_date_search" type="date" name="date">
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="example-date" class="form-label">Fecha de Fin</label>
                        <?php if (isset($_GET['end_date_search'])) : ?>
                            <input class="form-control" id="end_date_search" type="date" name="date" value="<?= $_GET['end_date_search'] ?>">
                        <?php else : ?>
                            <input class="form-control" id="end_date_search" type="date" name="date">
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-3">

                    <button type="button" class="btn btn-success btnSearchAllGastos">Buscar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<?php if (isset($_GET['start_date_search']) && isset($_GET['end_date_search'])) : ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Lista de Gastos</h4>
                    <br>
                    <!-- <button type="button" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#registrarGasto">Registrar Gasto</button> -->
                    <br>
                    <br>
                    <br>
                    <table id="tablaGastos" class="table table-striped dt-responsive nowrap w-100 ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Colaborador</th>
                                <th>Proyecto</th>
                                <th>Sitio</th>
                                <th>Importe</th>
                                <th>Clasificación</th>
                                <th>T Gasto</th>
                                <th>Ap. Contabilidad</th>
                                <th>Ap. Coordinación</th>
                                <th>Status</th>
                                <th>Cambiar Status</th>
                                <th>Seguimiento</th>
                                <th>Ticket</th>
                                <th>F. Fiscal</th>
                                <th>Factura</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $allGastos = $viatics->getAllGastosNew($_GET['start_date_search'], $_GET['end_date_search']);
                            $statusTypes = $viatics->getStatusTypes();

                            foreach ($allGastos as $deposits) {

                                $clasificacion = $deposits->clasificacion;
                                if ($clasificacion == 1) {
                                    $folio_fiscal = 'N/A';
                                    $factura = 'N/A';
                                } else {
                                    $folio_fiscal = $deposits->folio_fiscal;
                                    if ($folio_fiscal == '') {
                                        $folio_fiscal = 'S/I';
                                        //  $factura = '<a href="'.$deposits->ruta_pdf.'" target="_blank" class="btn btn-info"><i class="mdi mdi-account-cash-outline"></i> </a>';
                                    }
                                }
                                $ap_coordinacion = "";
                                $ap_contabilidad = "";
                                if ($deposits->ap_coordinacion == 1) {
                                    $ap_coordinacion = 'checked';
                                }
                                if ($deposits->ap_contabilidad == 1) {
                                    $ap_contabilidad = 'checked';
                                }
                                $txt_clasifiacion = 'Deducible';
                                if ($deposits->clasificacion == 1) {
                                    $txt_clasifiacion = 'No deducible';
                                }
                                $enab_check_contabilidad = "disabled";
                                $enab_check_coordinacion = "disabled";
                                if ($id_area == 2) {
                                    $enab_check_contabilidad = "";
                                }
                                if ($id_area == 3) {
                                    $enab_check_coordinacion = "";
                                }

                                if ($id_area == 1) {
                                    $enab_check_contabilidad = "";
                                    $enab_check_coordinacion = "";
                                }
                                if ($id_area >= 4) {
                                    $enab_check_contabilidad = "disabled";
                                    $enab_check_coordinacion = "disabled";
                                }

                            ?>
                                <tr id="trGasto<?= $deposits->id_gastos ?>">
                                    <td><?= $deposits->id_gastos ?></td>
                                    <td><?= $deposits->fecha_registro ?></td>
                                    <td><?= $deposits->usuario_gasto ?></td>
                                    <td><?= $deposits->nombre_proyecto ?></td>
                                    <td><?= $deposits->localidad ?></td>
                                    <td>$ <?= $deposits->importe ?></td>
                                    <td><?= $txt_clasifiacion ?></td>
                                    <?php if ($deposits->id_tipos_gasto == 99) : ?>
                                        <td>
                                            <button type="button" data-id-gasto="<?= $deposits->id_gastos ?>" data-usuario-gasto="<?= $deposits->usuario_gasto ?>"  data-proyecto-gasto="<?= $deposits->nombre_proyecto ?>" data-gasto-manual="<?= $deposits->tipo_gasto_manual ?>"  class="btn btn-light btn-sm getComentarioGasto"><?= $deposits->tipo_gasto ?></button>
                                        </td>
                                    <?php else : ?>
                                        <td><?= $deposits->tipo_gasto ?></td>
                                    <?php endif ?>
                                    <td tabindex="0">
                                        <input type="checkbox" id="conta<?= $deposits->id_gastos ?>" id-gasto="<?= $deposits->id_gastos ?>" class="check_ap_contabilidad" <?= $ap_contabilidad ?> <?= $enab_check_contabilidad ?> data-switch="success">
                                        <label for="conta<?= $deposits->id_gastos ?>" data-on-label="Si" data-off-label="No"></label>
                                    </td>
                                    <td>
                                        <!-- Success Switch-->
                                        <input type="checkbox" id="coord<?= $deposits->id_gastos ?>" id-gasto="<?= $deposits->id_gastos ?>" class="check_ap_coordinacion" <?= $ap_coordinacion ?> <?= $enab_check_coordinacion ?> data-switch="success">
                                        <label for="coord<?= $deposits->id_gastos ?>" data-on-label="Si" data-off-label="No"></label>
                                    </td>
                                    <td class="table-action">
                                        <div id="txt_status_gasto<?= $deposits->id_gastos ?>">
                                            <i class="mdi mdi-circle text-<?= $deposits->clase_css ?>"></i><?= $deposits->estatus ?>
                                        </div>
                                    </td>
                                    <td class="table-action" style="width:200px !important">
                                        <div>
                                            <select class="form-select select_status_gasto" id-gasto="<?= $deposits->id_gastos ?>" id="status_gasto<?= $deposits->id_gastos ?>">
                                                <option value="" disabled>Eliga una opción</option>
                                                <?php foreach ($statusTypes as $statusType) : ?>
                                                    <?php if (($statusType->id_status_type) == 2 || $statusType->id_status_type == 3) : ?>
                                                        <option value="<?= $statusType->id_status_type ?>" disabled><?= $statusType->descripcion ?></option>
                                                    <?php else : ?>
                                                        <?php if ($statusType->id_status_type == $deposits->id_status_type) : ?>
                                                            <option value="<?= $statusType->id_status_type ?>" selected><?= $statusType->descripcion ?></option>
                                                        <?php else : ?>
                                                            <option value="<?= $statusType->id_status_type ?>"><?= $statusType->descripcion ?></option>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><button data-id-gasto="<?= $deposits->id_gastos ?>" class="btn btn-primary addSeguimientoGasto" title="Seguimiento / Comentario de Gastos" data-bs-toggle="modal" data-bs-target="#seguimientoGasto"><i class="mdi mdi-chat-processing-outline"></i> </button></td>
                                    <?php if ($deposits->ruta_img != NULL) : ?>
                                        <td class="table-action">
                                            <div>
                                                <?php
                                                $ruta_img = str_replace("..", "http://astelecom.com.mx/viaticos", $deposits->ruta_img);
                                                ?>
                                                <a href="<?= $ruta_img ?>" target="_blank" class="btn btn-info"><i class="mdi mdi-account-cash-outline"></i> </a>
                                            </div>
                                        </td>
                                    <?php else : ?>
                                        <td><button id="<?= $deposits->id_gastos ?>" class="btn btn-secondary addFotografia" proyect-code="<?= $deposits->codigo_proyecto ?> - <?= $deposits->nombre_proyecto ?>" title="Agregar fotografía" data-bs-toggle="modal" data-bs-target="#agregarFotograia"><i class="mdi mdi-camera-enhance"></i> </button></td>
                                    <?php endif ?>
                                    <td><?= $folio_fiscal ?></td>
                                    <?php if ($clasificacion == 1) : ?>
                                        <td><?= $factura ?></td>
                                    <?php else : ?>
                                        <?php if ($deposits->ruta_pdf == '') : ?>
                                            <td><button id="<?= $deposits->id_gastos ?>" class="btn btn-secondary addFactura" proyect-code="<?= $deposits->codigo_proyecto ?> - <?= $deposits->nombre_proyecto ?>" title="Agregar factura" data-bs-toggle="modal" data-bs-target="#agregarFactura"><i class="mdi mdi-file-upload-outline"></i> </button></td>
                                        <?php else :
                                            $ruta_pdf = str_replace("..", "http://astelecom.com.mx/viaticos", $deposits->ruta_pdf);
                                        ?>
                                            <td><a href="<?= $ruta_pdf ?>" target="_blank" class="btn btn-danger"><i class="mdi mdi-file-pdf-box"></i> </a></td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <td class="table-action">
                                        <a class="action-icon archivosExtra" data-bs-toggle="modal" data-id-gastos="<?= $deposits->id_gastos ?>" data-bs-target="#archivosExtra"> <i class="mdi mdi-folder archivosExtra"></i></a>
                                        <a id="<?= $deposits->id_gastos ?>" class="action-icon btnEditDeposits" data-bs-toggle="modal" data-bs-target="#editarGasto"> <i class="mdi mdi-pencil editGasto"></i></a>
                                        <a id="<?= $deposits->id_gastos ?>" class="action-icon deleteGasto"> <i class="mdi mdi-delete "></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
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

<?php endif ?>
<?php
include_once('php/views/viaticos/modals/addFactura.php');
include_once('php/views/viaticos/modals/registrarGasto.php');
include_once('php/views/viaticos/modals/editarGasto.php');

include_once('php/views/viaticos/modals/seguimientoGastos.php');
include_once('php/views/viaticos/modals/archivosExtra.php');

?>
<script src="js/functions/viaticos/viaticos.js"></script>
<script src="js/loading.js"></script>
<script>
    var tGastos = new TableFilter(document.querySelector("#tablaGastos"), {
        base_path: "js/tablefilter/",
        paging: {
            results_per_page: ['Records: ', [10, 25, 50, 100]]
        },
        responsive: true,
        rows_counter: true,
        btn_reset: true,
        col_2: 'select',
        col_6: "select",
        col_7: "select",
        col_8: "select",
        col_9: "none",
        col_10: "none",
        col_11: "select",
        col_12: "none",
        col_13: "none",
        col_14: "none",
        col_16: "none",
        col_17: "none",
    });
    tGastos.init();
</script>