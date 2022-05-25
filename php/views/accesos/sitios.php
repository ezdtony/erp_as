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
            <h4 class="page-title">Accesos | Administración</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Lista de Sitios</h4>
                <br>
                <button type="button" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#registrarSitio">Dar de alta sitio</button>
                <br>
                <br>
                <br>

                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre Sitio</th>
                            <th>Empresa</th>
                            <th>Clasificación</th>
                            <th>Dirección</th>
                            <th>Info. Detallada</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        include_once('php/models/viaticos/viatics_model.php');
                        $viatics = new ViaticsInformation();
                        $allGastos = $viatics->getGastosByUser($id_user);

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



                        ?>
                            <tr>
                                <td><?= $deposits->id_gastos ?></td>
                                <td><?= $deposits->fecha_registro ?></td>
                                <td><?= $deposits->nombre_proyecto ?></td>
                                <td><?= $deposits->localidad ?></td>
                                <td>$ <?= $deposits->importe ?></td>
                                <td><i class="mdi mdi-circle text-<?= $deposits->clase_css ?>"></i><?= $deposits->estatus ?></td>
                                <td class="table-action">
                                    <div>
                                    <a href="<?=$deposits->ruta_img?>" target="_blank" class="btn btn-info"><i class="mdi mdi-account-cash-outline"></i> </a>
                                    </div>
                                </td>
                                <td><?= $folio_fiscal ?></td>
                                <?php if ($clasificacion === 1) : ?>
                                <td><?=$factura?></td>
                                <?php else : ?>
                                    <?php if ($deposits->ruta_pdf=='') : ?>
                                        <td><button id="<?= $deposits->id_gastos ?>" class="btn btn-secondary addFactura" proyect-code="<?=$deposits->codigo_proyecto?> - <?=$deposits->nombre_proyecto?>" title="Agregar factura" data-bs-toggle="modal" data-bs-target="#agregarFactura"><i class="mdi mdi-file-upload-outline"></i> </button></td>
                                    <?php else : ?>
                                <td><a href="<?=$deposits->ruta_pdf?>" target="_blank" class="btn btn-danger"><i class="mdi mdi-file-pdf-box"></i> </a></td>
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

?>
<script src="js/functions/viaticos/viaticos.js"></script>
<script src="js/loading.js"></script>