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
        </div>
    </div>
</div>
<!-- end page title -->
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
                        include_once('php/models/viaticos/viatics_model.php');
                        $viatics = new ViaticsInformation();
                        $allGastos = $viatics->getGastosRecientes();
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
                                <td><?= $deposits->tipo_gasto ?></td>

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
<!-- end row -->
<?php
include_once('php/views/viaticos/modals/addFactura.php');
include_once('php/views/viaticos/modals/registrarGasto.php');
include_once('php/views/viaticos/modals/editarGasto.php');

include_once('php/views/viaticos/modals/seguimientoGastos.php');
?>

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
        col_8: "none",
        col_9: "none",
        col_10: "select",
        col_11: "none",
        col_12: "none",
        col_13: "none",
        col_15: "none",
        col_16: "none",
    });
    tGastos.init();
</script>