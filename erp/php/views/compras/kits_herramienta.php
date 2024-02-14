<?php
include_once('php/models/viaticos/viatics_model.php');
include_once('php/models/compras/cotizaciones_model.php');

$compras = new Compras();
$getInventarioHerramientaAdmin = $compras->getInventarioHerramientaAdmin();
$getStatusHerramienta = $compras->getStatusHerramienta();
if ($id_area <= 3){

    $getKitsHerramienta = $compras->getKitsHerramienta();
}else{
    $getKitsHerramienta = $compras->getKitsHerramientaUser($_SESSION['id_user']);
}
$getAlmacenesHerramienta = $compras->getAlmacenesHerramienta();
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
            <h4 class="page-title">Compras | Coordinación | Inventario de Herramienta</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Kits de Herramienta</h4>
                <br>
                <!-- <button type="button" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#nuevaCotizacion">Nueva cotización</button> -->
                <br>
                <br>
                <?php foreach ($getKitsHerramienta as $kit) : ?>
                    <div class="accordion custom-accordion" id="custom-accordion-<?= $kit->id_kits_herramienta ?>">
                        <div class="card mb-0">
                            <div class="card-header" id="heading<?= $kit->id_kits_herramienta ?>">
                                <h5 class="m-0">
                                    <a class="custom-accordion-title collapsed d-block py-1" data-bs-toggle="collapse" href="#collapse<?= $kit->id_kits_herramienta ?>" aria-expanded="false" aria-controls="collapse<?= $kit->id_kits_herramienta ?>">
                                        <?= $kit->nombre_kit ?><i class="mdi mdi-chevron-down accordion-arrow"></i>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapse<?= $kit->id_kits_herramienta ?>" class="collapse" aria-labelledby="heading<?= $kit->id_kits_herramienta ?>" data-bs-parent="#custom-accordion-<?= $kit->id_kits_herramienta ?>">
                                <div class="card-body table-responsive">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#addHerramientaKit" class="btn btn-primary btnAddHerramientaKit" title="Agregar Kit" data-id-kit="<?= $kit->id_kits_herramienta ?>"><i class="mdi mdi-plus-thick"></i></button>
                                        </div>
                                        <?php if ($id_area <= 3) : ?>
                                            <div class="col-md-1">
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#asignarKitHerramienta" class="btn btn-primary btnAsignarKit" title="Asignar Kit" data-id-kit="<?= $kit->id_kits_herramienta ?>"><i class="dripicons-user-group"></i></button>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <br>
                                    <br>
                                    <table id="tablaHerramienta<?= $kit->id_kits_herramienta ?>" class="table table-striped dt-responsive nowrap w-100 ">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Código</th>
                                                <th>Herramienta</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>N° Serie</th>
                                                <th>Status</th>
                                                <th>Comentarios</th>
                                                <!-- <th>Kit</th> -->
                                                <th>Almacen</th>
                                                <!-- <th>Acciones</th> -->
                                            </tr>
                                        </thead>

                                        <?php
                                        include_once('php/models/viaticos/viatics_model.php');
                                        include_once('php/models/compras/cotizaciones_model.php');

                                        $compras = new Compras();
                                        $getInventarioHerramientaPorKit = $compras->getInventarioHerramientaPorKit($kit->id_kits_herramienta);
                                        $getStatusHerramienta = $compras->getStatusHerramienta();
                                        $getKitsHerramienta = $compras->getKitsHerramienta();
                                        $getAlmacenesHerramienta = $compras->getAlmacenesHerramienta();
                                        ?>

                                        <tbody>
                                            <?php if (!empty($getInventarioHerramientaPorKit)) : ?>
                                                <?php foreach ($getInventarioHerramientaPorKit as $herramienta) :
                                                ?>
                                                    <tr id="tr<?= $herramienta->id_herramienta; ?>">
                                                        <td><?= $herramienta->codigo_herramienta; ?></td>
                                                        <td><?= $herramienta->descripcion_herramienta; ?></td>
                                                        <td><?= $herramienta->marca; ?></td>
                                                        <td><?= $herramienta->modelo; ?></td>
                                                        <td><?= $herramienta->no_serie; ?></td>
                                                        <td>
                                                            <select id="statusHerramienta" class="form-select mb-3" data-id-herramienta="<?= $herramienta->id_herramienta ?>">
                                                                <option value="" selected disabled>Seleccione una opción</option>
                                                                <?php foreach ($getStatusHerramienta as $statusType) : ?>
                                                                    <?php if ($statusType->id_status_herramienta == $herramienta->id_status_herramienta) : ?>
                                                                        <option selected value="<?= $statusType->id_status_herramienta ?>"><?= $statusType->descripcion ?></option>
                                                                    <?php else : ?>
                                                                        <option value="<?= $statusType->id_status_herramienta ?>"><?= $statusType->descripcion ?></option>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </select>

                                                        </td>
                                                        <td><?= $herramienta->comentarios; ?></td>
                                                        <!-- <td>
                                                            <select id="kitsHerramienta" class="form-select mb-3" data-id-herramienta="<?= $herramienta->id_herramienta ?>">
                                                                <option value="" selected disabled>Seleccione una opción</option>
                                                                <?php foreach ($getKitsHerramienta as $kits) : ?>
                                                                    <?php if ($kits->id_kits_herramienta == $herramienta->id_kits_herramienta) : ?>
                                                                        <option selected value="<?= $kits->id_kits_herramienta ?>"><?= $kits->nombre_kit ?></option>
                                                                    <?php else : ?>
                                                                        <option value="<?= $kits->id_kits_herramienta ?>"><?= $kits->nombre_kit ?></option>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </select>

                                                        </td> -->
                                                        <td>
                                                            <select id="almacenesHerramienta" class="form-select mb-3" data-id-herramienta="<?= $herramienta->id_herramienta ?>">
                                                                <option value="" selected disabled>Seleccione una opción</option>
                                                                <?php foreach ($getAlmacenesHerramienta as $almacenes) : ?>
                                                                    <?php if ($almacenes->id_almacenes == $herramienta->id_almacenes) : ?>
                                                                        <option selected value="<?= $almacenes->id_almacenes ?>"><?= $almacenes->nombre_almacen ?></option>
                                                                    <?php else : ?>
                                                                        <option value="<?= $almacenes->id_almacenes ?>"><?= $almacenes->nombre_almacen ?></option>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </select>

                                                        </td>
                                                        <!-- <td class="table-action">
                                                            <a  class="action-icon deleteHerramienta" data-id-herramienta="<?= $herramienta->id_herramienta ?>"  data-bs-placement="top" title="Eliminar Herramienta"> <i class="mdi mdi-trash-can"></i></a>
                                                        </td> -->
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="10" class="text-center">No hay herramientas en este kit</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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
include_once 'modals/agregarHerramientaKit.php';
include_once 'modals/asignarKitHerramienta.php';
?>
<script src="js/functions/compras/herramienta.js"></script>
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