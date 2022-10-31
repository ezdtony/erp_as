<?php
include_once('php/models/viaticos/viatics_model.php');
include_once('php/models/compras/cotizaciones_model.php');

$compras = new Compras();
$getUtilizaciones = $compras->getUtilizaciones();
$getUnidadesMedida = $compras->getUnidadesMedida();
$getUnidadesLongitud = $compras->getUnidadesLongitud();
$getMedidasLongitud = $compras->getMedidasLongitud();
$getProveeddores = $compras->getProveeddores();

$getClasificaciones = $compras->getClasificaciones();
$getCotizaciones = $compras->getCotizacionesAdmin($id_user);
$getStatusTypes = $compras->getStatusTypes();
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Compras | Coordinación | Información Auxiliar Compras</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title">Proveedores</h4>
                    <br>
                    <button type="button" class="btn btn-primary addProveedor"  data-bs-toggle="modal" data-bs-target="#nuevoProveedor" title="Agregar proveedor"><i class="mdi mdi-account-plus"></i> </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover mb-0 table_Proveedores" id="basic-datatable">
                        <thead class="table-dark"></thead>
                        <tr>
                            <th>Nombre de Contacto</th>
                            <th>Correo electrónico</th>
                            <th>Empresa</th>
                            <th>Teléfono</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getProveeddores as $clasificacion) : ?>
                                <tr>
                                    <td><?= $clasificacion->nombre_contacto ?></td>
                                    <td><?= $clasificacion->correo_contacto ?></td>
                                    <td><?= $clasificacion->empresa_proveedor ?></td>
                                    <td><?= $clasificacion->telefono_contacto ?></td>
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


    <div class="col-xl-6 col-lg-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title">Unidades de Medida</h4>
                    <br>
                </div>
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover mb-0">
                        <thead class="table-dark"></thead>
                        <tr>
                            <th>Abreviatura</th>
                            <th>Clasificación</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getUnidadesMedida as $clasificacion) : ?>
                                <tr>
                                    <td><?= $clasificacion->unidades_medida_short ?></td>
                                    <td><?= $clasificacion->unidades_medida_long ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="col-xl-6 col-lg-12  order-lg-2 order-xl-1">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title">Claisificaciones de material</h4>
                    <br>
                    <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#nuevaClasificacion" title="Agregar Clasificación"><i class="mdi mdi-format-list-bulleted-type"></i> </button>
                </div>

                <div class="table-responsive">
                <table class="table table-centered table-nowrap table-hover mb-0 table_Clasificaciones" id="basic-datatable">
                        <thead class="table-dark"></thead>
                        <tr>
                            <th>Abreviatura</th>
                            <th>Clasificación</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getClasificaciones as $clasificacion) : ?>
                                <tr>
                                    <td><?= $clasificacion->nombre_corto ?></td>
                                    <td><?= $clasificacion->clasificacion ?></td>
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
    <div class="col-xl-6 col-lg-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title">Unidades de Longitud</h4>
                    <br>
                </div>
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover mb-0">
                        <thead class="table-dark"></thead>
                        <tr>
                            <th>Abreviatura</th>
                            <th>Clasificación</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getUnidadesLongitud as $clasificacion) : ?>
                                <tr>
                                    <td><?= $clasificacion->abreviacion ?></td>
                                    <td><?= $clasificacion->uindad_longitud ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="col-xl-6 col-lg-12  order-lg-2 order-xl-1">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title">Medidas de Longitud</h4>
                    <br>
                    <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#nuevaMedidaLongitud" title="Agregar medida"><i class="mdi mdi-plus-thick"></i> </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover mb-0">
                        <thead class="table-dark"></thead>
                        <tr>
                            <th>Medida</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getMedidasLongitud as $clasificacion) : ?>
                                <tr>
                                    <td><?= $clasificacion->medida_de_longitud_long . " ".$clasificacion->simbolo ?></td>
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
include_once 'php/views/compras/modals/agregarProveedor.php';
include_once 'php/views/compras/modals/agregarClasificacion.php';
include_once 'php/views/compras/modals/agregarMedidaongitud.php';

?>
<script src="js/functions/compras/cotizaciones.js"></script>