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
                <h4 class="header-title mb-3">Inventario completo de herramienta</h4>
                <br>
                <!-- <button type="button" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#nuevaCotizacion">Nueva cotización</button> -->
                <br>
                <br>
                <br>

                <table id="tablaGastos" class="table table-striped dt-responsive nowrap w-100 ">
                    <thead class="table-dark">
                        <tr>
                            <th>Código</th>
                            <th>Herramienta</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>N° Serie</th>
                            <th>Status</th>
                            <th>Comentarios</th>
                            <th>Kit</th>
                            <th>Almacen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <?php
                    include_once('php/models/viaticos/viatics_model.php');
                    include_once('php/models/compras/cotizaciones_model.php');

                    $compras = new Compras();
                    $getInventarioHerramientaAdmin = $compras->getInventarioHerramientaAdmin();
                    $getStatusHerramienta = $compras->getStatusHerramienta();
                    $getKitsHerramienta = $compras->getKitsHerramienta();
                    $getAlmacenesHerramienta = $compras->getAlmacenesHerramienta();
                    ?>

                    <tbody>
                        <?php foreach ($getInventarioHerramientaAdmin as $herramienta) :

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
                                <td>
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

                                </td>
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
                                <td class="table-action">
                                    <a  class="action-icon deleteHerramienta" data-id-herramienta="<?= $herramienta->id_herramienta ?>"  data-bs-placement="top" title="Eliminar Herramienta"> <i class="mdi mdi-trash-can"></i></a>
                                    <!-- <a href="?submodule=imprimir_cotizacion&id_cotizacion=<?= $herramienta->id_herramienta ?>" target="_blank" class="action-icon" data-bs-placement="top" title="Imprimir"> <i class="mdi mdi-printer"></i></a> -->

                                   
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