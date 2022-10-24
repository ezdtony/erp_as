<?php
include_once('php/models/compras/cotizaciones_model.php');

$id_cotizaciones = $_GET['id_cotizacion'];
$compras = new Compras();
$getDesgloseCotizacion = $compras->getDesgloseCotizacion($id_cotizaciones);
$getCotizacionInfo = $compras->getCotizacionInfo($id_cotizaciones);
?>
<link rel="stylesheet" href="css/cssDatatable.css">

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
            <h4 class="page-title">Compras | Coordinación | Desglose de Cotización</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 id="nombre_informe" class="header-title mb-3 title_excel">Desglose de Cotización</h4>
                <br>
                <?php if (!empty($getDesgloseCotizacion)) : ?>
                    <h4 id="fecha_solicitud">Fecha de solicitud: <?= mb_strtoupper($getCotizacionInfo[0]->fecha) ?></h4>
                    <h4 id="obra">Proyecto: <?= mb_strtoupper($getCotizacionInfo[0]->nombre_proyecto) ?></h4>
                    <h4 id="codigo_solicitud">Código de solicitud: <?= mb_strtoupper($getCotizacionInfo[0]->codigo_solicitud) ?></h4>
                    <h4 class="archive_name" style="display:none">Cotización <?= mb_strtoupper($getCotizacionInfo[0]->codigo_solicitud) ?></h4>
                    <h4 id="solicitante">Solicitante: <?= mb_strtoupper($getCotizacionInfo[0]->nombre) ?></h4>
                    <input type="hidden" id="id_cotizacion" value="<?= $id_solicitud ?>">


                    <!-- <button type="button" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#nuevaCotizacion">Nueva cotización</button> -->
                    <br>
                    <br>
                    <br>

                    <table id="dataTableReport" class="table table-striped dt-responsive nowrap w-100 tablaGastos">
                        <thead class="table-dark">
                            <tr>
                                <th>No° de Partida</th>
                                <th>Descripción</th>
                                <th>Cantidad </th>
                                <th>U.M.</th>
                                <th>Marca</th>
                                <th>Proveedor</th>
                                <th>Comentarios </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getDesgloseCotizacion as $desglose) :
                                $txt_checked = '';
                                if ($desglose->cotizada == 1) {
                                    $txt_checked = 'checked';
                                }
                            ?>
                                <tr id="<?= $desglose->id_desglose_cotizacion ?>">
                                    </td>
                                    <td><?= $desglose->no_partida; ?></td>
                                    <td><?= ($desglose->descripcion_material); ?></td>
                                    <td class="td_editable" column_name="cantidad"><?= $desglose->cantidad; ?></td>
                                    <td><?= $desglose->unidades_medida_long; ?></td>
                                    <td><?= ($desglose->nombre_marca); ?></td>
                                    <td><?= ($desglose->empresa_proveedor); ?></td>
                                    <td class="td_editable" column_name="comentarios"><?= $desglose->comentarios; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <br>
                <?php else : ?>
                    <h4>No hay un desglose registrado para esta cotización </h4>
                <?php endif; ?>
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
<script src="js/functions/compras/desglose_cotizacion.js"></script>
<script src="js/functions/exportar_tablas/export_datatables.js"></script>
<script src="js/loading.js"></script>