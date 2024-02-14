<?php
if (isset($_GET['submodule']) && isset($_GET['id_credito'])) {
    $id_credito = $_GET['id_credito'];
   
    $sql_credito = "SELECT 
    DATE(pag.fecha_pago) AS fecha_gasto, 
    pag.cfdi, 
    pag.cantidad_pago AS cantidad_gasto, 
    cr.monto, 
    cr.saldo,
    cr.credit_code,
    cr.proveedor, 
    cr.saldo, 
    proy.nombre_largo
    FROM constructora_personal.pagos_cotizaciones AS pag
    INNER JOIN constructora_personal.creditos cr ON cr.id_credito = pag.id_credito
    INNER JOIN constructora_personal.cotizaciones_index AS cot_in ON cot_in.id_cotizaciones_index = pag.id_cotizaciones_index
    INNER  JOIN constructora_personal.proyectos AS proy ON proy.id_proyectos = cot_in.id_proyectos
    WHERE pag.id_credito = '$id_credito'";
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
            <h4 class="page-title" id="nombre_informe">Gastos por Crédito</h4>
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
                                <thead>
                                    <tr>
                                        <th>Proyecto</th>
                                        <th>Fecha</th>
                                        <th>Cantidad Pago</th>
                                        <th>CFDI</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php foreach ($arr_creditos as $gastos) :
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
                                            <td><?= $gastos->nombre_largo ?></td>
                                            <td><?= $gastos->fecha_gasto ?></td>
                                            <td><?= $gastos->cantidad_gasto ?></td>
                                            <td><?= mb_strtoupper($gastos->cfdi) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
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