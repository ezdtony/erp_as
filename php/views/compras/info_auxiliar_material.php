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
$getCotizaciones = $compras->getCotizacionesAdmin();
$getStatusTypes = $compras->getStatusTypes();
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Compras | Coordinación | Catalogo de proveedores y materiales</h4>
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
                    <button type="button" class="btn btn-primary addProveedor" data-bs-toggle="modal" data-bs-target="#nuevoProveedor" title="Agregar proveedor"><i class="mdi mdi-account-plus"></i> </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover mb-0 table_Proveedores" id="basic-datatable">
                        <thead class="table-dark"></thead>
                        <tr>
                            <th>Nombre de Contacto <span class="badge bg-success rounded-pill">Editable</span></th>
                            <th>Correo electrónico <span class="badge bg-success rounded-pill">Editable</span></th>
                            <th>Empresa <span class="badge bg-success rounded-pill">Editable</span></th>
                            <th>Teléfono <span class="badge bg-success rounded-pill">Editable</span></th>
                            <th>Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getProveeddores as $clasificacion) : ?>
                                <tr id="trProveedor<?= $clasificacion->id_proveedores ?>">
                                    <td data-id-proveedor="<?= $clasificacion->id_proveedores ?>" class="td_editableProveedor" column_name="nombre_contacto"><?= $clasificacion->nombre_contacto ?></td>
                                    <td data-id-proveedor="<?= $clasificacion->id_proveedores ?>" class="td_editableProveedor" column_name="correo_contacto"><?= $clasificacion->correo_contacto ?></td>
                                    <td data-id-proveedor="<?= $clasificacion->id_proveedores ?>" class="td_editableProveedor" column_name="empresa_proveedor"><?= $clasificacion->empresa_proveedor ?></td>
                                    <td data-id-proveedor="<?= $clasificacion->id_proveedores ?>" class="td_editableProveedor" column_name="telefono_contacto"><?= $clasificacion->telefono_contacto ?></td>
                                    <td>
                                        <button type="button" class="btn btn-danger deleteProveedor" data-id-proveedor="<?= $clasificacion->id_proveedores ?>"><i class="mdi mdi-trash-can "></i> </button>
                                    </td>
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
                            <th>Abreviatura  <span class="badge bg-success rounded-pill">Editable</span></th>
                            <th>Clasificación  <span class="badge bg-success rounded-pill">Editable</span></th>
                            <th>Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getUnidadesMedida as $clasificacion) : ?>
                                <tr id="trUmedida<?= $clasificacion->id_unidades_medida ?>">
                                    <td data-id-umedida="<?= $clasificacion->id_unidades_medida ?>" class="td_editableUmedida" column_name="unidades_medida_short"><?= $clasificacion->unidades_medida_short ?></td>
                                    <td data-id-umedida="<?= $clasificacion->id_unidades_medida ?>" class="td_editableUmedida" column_name="unidades_medida_long"><?= $clasificacion->unidades_medida_long ?></td>
                                    <td>
                                        <button type="button" class="btn btn-danger deleteUMedida" data-id-umedida="<?= $clasificacion->id_unidades_medida ?>"><i class="mdi mdi-trash-can "></i> </button>
                                    </td>
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevaClasificacion" title="Agregar Clasificación"><i class="mdi mdi-format-list-bulleted-type"></i> </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover mb-0 table_Clasificaciones" id="basic-datatable">
                        <thead class="table-dark"></thead>
                        <tr>
                            <th>Abreviatura  <span class="badge bg-success rounded-pill">Editable</span></th>
                            <th>Clasificación  <span class="badge bg-success rounded-pill">Editable</span></th>
                            <th>Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getClasificaciones as $clasificacion) : ?>
                                <tr id="trClasifMAter<?= $clasificacion->id_clasificaciones_catalogo ?>">
                                    <td data-id-clasif="<?= $clasificacion->id_clasificaciones_catalogo ?>" class="td_editableClasifMAter" column_name="nombre_corto"><?= $clasificacion->nombre_corto ?></td>
                                    <td data-id-clasif="<?= $clasificacion->id_clasificaciones_catalogo ?>" class="td_editableClasifMAter" column_name="clasificacion"><?= $clasificacion->clasificacion ?></td>
                                    <td>
                                        <button type="button" class="btn btn-danger deleteClasifMAter" data-id-clasif="<?= $clasificacion->id_clasificaciones_catalogo ?>"><i class="mdi mdi-trash-can "></i> </button>
                                    </td>
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevaMedidaLongitud" title="Agregar medida"><i class="mdi mdi-plus-thick"></i> </button>
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
                                    <td><?= $clasificacion->medida_de_longitud_long . " " . $clasificacion->simbolo ?></td>
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
<script src="js/functions/compras/proveedores.js"></script>