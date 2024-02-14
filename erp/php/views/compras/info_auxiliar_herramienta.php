<?php
include_once('php/models/viaticos/viatics_model.php');
include_once('php/models/compras/cotizaciones_model.php');

$compras = new Compras();
$getTiposKitsHerramienta = $compras->getTiposKitsHerramienta();
$getKitsHerramienta = $compras->getKitsHerramienta();
$getAlmacenes = $compras->getAlmacenes();

?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Compras | Coordinación | Kits de Herramienta</h4>
        </div>
    </div>
</div>
<div class="row">


    <div class="col-xl-6 col-lg-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title">Tipos de Kits</h4>
                    <br>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTipoKit" title="Agregar tipo kits"><i class="mdi mdi-plus-thick"></i> </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover mb-0 table_ClasificacionesKits">
                        <thead class="table-dark"></thead>
                        <tr>
                            <th>Abreviatura</th>
                            <th>Descripción</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getTiposKitsHerramienta as $kits) : ?>
                                <tr>
                                    <td><?= $kits->nombre_corto ?></td>
                                    <td><?= $kits->descripcion_tipo ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="col-xl-6 col-lg-6  order-lg-2 order-xl-1">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title">Kits de Herramienta</h4>
                    <br>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKit" title="Agregar Kit de Herramienta"><i class="mdi mdi-plus-thick"></i> </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover mb-0 tableKitsHerramientas" id="basic-datatable">
                        <thead class="table-dark"></thead>
                        <tr>
                            <th>Nombre del Kit</th>
                            <!-- <th>Acciones</th> -->
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getKitsHerramienta as $kits) : ?>
                                <tr>
                                    <td><?= $kits->nombre_kit ?></td>
                                    <!-- <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarClasificacion" title="Editar Clasificación" onclick="editarClasificacion(<?= $kits->id_kits_herramienta ?>)"><i class="mdi mdi-pencil"></i> </button>
                                        <button type="button" class="btn btn-danger" title="Eliminar Clasificación" onclick="eliminarClasificacion(<?= $kits->id_kits_herramienta ?>)"><i class="mdi mdi-delete"></i> </button> -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-xl-12 col-lg-12  order-lg-2 order-xl-1">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title">Almacenes</h4>
                    <br>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAlmacen" title="Agregar almacen"><i class="mdi mdi-plus-thick"></i> </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover mb-0 " id="tablaAlmacenes">
                        <thead class="table-dark"></thead>
                        <tr>
                            <th>Nombre y dirección del Almacen</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getAlmacenes as $almacenes) : ?>
                                <tr>
                                    <td><?= $almacenes->nombre_almacen  ?><br><span class="badge badge-info-lighten"><?= $almacenes->direccion_almacen  ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'php/views/compras/modals/agregarAlmacen.php';
include_once 'php/views/compras/modals/agregarTipoKit.php';
include_once 'php/views/compras/modals/agregarKitHerramienta.php';

?>
<script src="js/functions/compras/herramienta.js"></script>