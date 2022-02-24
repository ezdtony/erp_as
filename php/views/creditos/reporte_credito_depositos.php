<?php
if (isset($_GET['submodule']) && isset($_GET['id_credito'])) {
    $id_credito = $_GET['id_credito'];

    $sql_credito = "SELECT 
    DATE(dep.fecha) AS fecha_deposito, 
    dep.folio_fiscal, 
    dep.ruta_img, 
    dep.ruta_xml, 
    dep.ruta_pdf, 
    dep.cantidad,
    cr.monto, 
    cr.saldo,
    cr.credit_code,
    cr.proveedor, 
    cr.saldo
    FROM uvzuyqbs_constructora.creditos  AS cr
    INNER JOIN uvzuyqbs_constructora.depositos_creditos AS dep ON dep.id_credito = cr.id_credito
    WHERE cr.id_credito = '$id_credito'";
    $arr_creditos = $queries->getData($sql_credito);
}

?>
<link href="assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css" />
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <form class="d-flex">
                    <!-- <a href="javascript: void(0);" class="btn btn-primary ms-2">
                             <i class="mdi mdi-autorenew"></i>
                         </a> -->
                    <!--   <button type="button" class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#createSolicitud" data-bs-placement="top" title="Nueva solicitud">
                        <i class="mdi mdi-note-plus"></i>
                    </button> -->
                </form>
            </div>
            <h4 class="page-title" id="nombre_informe">Depóistos por Crédito</h4>
        </div>
    </div>
</div>

<!-- Datatables css -->
<link href="assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
<link href="assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />

<?php if (!empty($arr_creditos)) : ?>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                    <h6 id="fecha_solicitud" class="display-5">Crédito: <?= $arr_creditos[0]->proveedor ?></h6>
                    <h6 id="codigo_solicitud" class="display-5">Código de crédito: <?= $arr_creditos[0]->credit_code ?></h6>
                    <h6 id="codigo_solicitud" class="display-5">Saldo de crédito: <?= $arr_creditos[0]->saldo ?></h6>
                    <div class="tab-pane show active" id="datatable-button">

                        <table id="datatable-buttons" class="table table-striped table-responsive-sm table-centered dt-responsive w-100 mb-0">
                            <thead style="background-color:#cdffb8;">
                                <tr>
                                    <th>Fecha Depósito</th>
                                    <th>Cantidad Pago</th>
                                    <th>Comprobante</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                foreach ($arr_creditos as $gastos) :
                                    $total += $gastos->cantidad;
                                    //$txt_status = '';
                                    //$status_descripcion = $solicit->status_descripcion;
                                    /*  switch ($solicit->status) {
                                            case '1':
                                                $txt_status = '<i class="mdi mdi-circle text-success"></i> ' . $status_descripcion;

                                                break;
                                            case '2':
                                                $txt_status = '<i class="mdi mdi-circle text-danger"></i>' . $status_descripcion;

                                                break;
                                            case '3':
                                                $txt_status = '<i class="mdi mdi-circle text-warning"></i> ' . $status_descripcion;
                                                break;
                                            case '4':
                                                $txt_status = '<i class="mdi mdi-circle text-info"></i>' . $status_descripcion;
                                                break;
                                            case '5':
                                                $txt_status = '<i class="mdi mdi-circle text-primary"></i>' . $status_descripcion;
                                                break;
                                        } */
                                ?>
                                    <tr id="">
                                        <td><?= $gastos->fecha_deposito ?></td>
                                        <td><?= $gastos->cantidad ?></td>
                                        <?php
                                        if (file_exists($gastos->ruta_img)) {
                                        ?>
                                            <td class="text-center"><a href="<?= $gastos->ruta_img ?>" target="_blank" class="action-icon"> <img src="images/photo.png" alt="image" class="img-fluid avatar-sm rounded-circle"></a></td>
                                        <?php  } else {
                                        ?>
                                            <td class="text-center"><a class="action-icon"> <img src="images/broken-image.png" alt="image" class="img-fluid avatar-sm rounded-circle"></a></td>
                                        <?php  }
                                        ?>
                                    </tr>
                                <?php endforeach; ?>
                                <thead>
                                    <th style="text-align:center; background-color:#d1d1d1;" colspan="100%">Total</th>
                                </thead>
                                <thead>
                                    <th style="text-align:center; background-color:#d1d1d1;" colspan="100%" ><?= $total ?></th>
                                </thead>
                            </tbody>
                        </table>
                    </div> <!-- end preview-->
                </div> <!-- end tab-content-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
<?php endif; ?>
</div>
<script src="js/loading.js"></script>
<script src="assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="assets/js/vendor/buttons.html5.min.js"></script>
<script src="assets/js/vendor/buttons.flash.min.js"></script>
<script src="assets/js/vendor/reporte_soli_proyecto.js"></script>