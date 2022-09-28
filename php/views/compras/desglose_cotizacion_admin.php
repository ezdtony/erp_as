<?php
include_once('php/models/compras/cotizaciones_model.php');

$id_cotizaciones = $_GET['id_cotizacion'];
$compras = new Compras();
$getDesgloseCotizacion = $compras->getDesgloseCotizacion($id_cotizaciones);
$getCotizacionInfo = $compras->getCotizacionInfo($id_cotizaciones);
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
            <h4 class="page-title">Compras | Coordinación | Desglose de Cotización</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 id="nombre_informe" class="header-title mb-3">Desglose de Cotización</h4>
                <br>
                <?php if (!empty($getDesgloseCotizacion)) : ?>
                    <h4 id="fecha_solicitud">Fecha de solicitud: <?= mb_strtoupper($getCotizacionInfo[0]->fecha) ?></h4>
                    <h4 id="obra">Proyecto: <?= mb_strtoupper($getCotizacionInfo[0]->nombre_proyecto) ?></h4>
                    <h4 id="codigo_solicitud">Código de solicitud: <?= mb_strtoupper($getCotizacionInfo[0]->codigo_solicitud) ?></h4>
                    <h4 id="solicitante">Solicitante: <?= mb_strtoupper($getCotizacionInfo[0]->nombre) ?></h4>
                    <input type="hidden" id="id_cotizacion" value="<?= $id_solicitud ?>">


                    <!-- <button type="button" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#nuevaCotizacion">Nueva cotización</button> -->
                    <br>
                    <br>
                    <br>

                    <table id="tablaGastos" class="table table-striped dt-responsive nowrap w-100 ">
                        <thead class="table-dark">
                            <tr>
                                <th>Cotizada</th>
                                <th>No° de Partida</th>
                                <th>Descripción</th>
                                <th>Cantidad <span class="badge bg-success rounded-pill">Editable</span></th>
                                <th>U.M.</th>
                                <th>Marca</th>
                                <th>Proveedor</th>
                                <th>Comentarios <span class="badge bg-success rounded-pill">Editable</span></th>
                                <th>Borrar</th>
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
                                    <td>
                                        <input class="chckPartidaCotizada" type="checkbox" data-id-partida="<?= $desglose->id_desglose_cotizacion; ?>" id="switch<?= $desglose->id_desglose_cotizacion; ?>" data-switch="none" <?=$txt_checked?> >
                                        <label for="switch<?= $desglose->id_desglose_cotizacion; ?>" data-on-label="" data-off-label=""></label>
                                    </td>
                                    <td><?= $desglose->no_partida; ?></td>
                                    <td><?= ($desglose->descripcion_material); ?></td>
                                    <td class="td_editable" column_name="cantidad"><?= $desglose->cantidad; ?></td>
                                    <td><?= $desglose->unidades_medida_long; ?></td>
                                    <td><?= ($desglose->nombre_marca); ?></td>
                                    <td><?= ($desglose->empresa_proveedor); ?></td>
                                    <td class="td_editable" column_name="comentarios"><?= $desglose->comentarios; ?></td>
                                    <td><button type="button" class="btn btn-danger btn-sm btn_borrar_partida_desglose" id="<?= $desglose->id_desglose_cotizacion ?>"><i class="mdi mdi-window-close"></i> </button></td>

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
        col_3: "select",
        col_4: "none",
        col_5: "select",
        col_6: "none",
        col_7: "none"
    });
    tGastos.init();
</script>