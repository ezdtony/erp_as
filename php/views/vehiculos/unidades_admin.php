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
            <h4 class="page-title">Unidades</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Lista de Unidades</h4>
                <br>
                <button type="button" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#registrarUnidad">Registrar Unidad</button>
                <br>
                <br>
                <br>
                <!-- <div style="overflow-x: auto;"> -->
                    <table id="tablaUnidades" class="table table-striped dt-responsive nowrap w-100 ">
                        <thead>
                            <tr>
                                <th>Placas</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Modelo (Año)</th>
                                <th>Color</th>
                                <th>Observaciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once('php/models/vehiculos/vehiculos_model.php');
                            $vehiculos_model = new ModeloVehiculos;
                            $getVehiculos = $vehiculos_model->getVehiculos();
                            ?>
                            <?php if (!empty($getVehiculos)) : ?>
                                <?php foreach ($getVehiculos as $vehiculos) : ?>
                                    <tr id="trVehiculo<?= $vehiculos->id_vehiculos ?>">
                                        <td id="tdPlacas<?= $vehiculos->id_vehiculos ?>"><?= $vehiculos->placas ?></td>
                                        <td id="tdNombre<?= $vehiculos->id_vehiculos ?>"><?= $vehiculos->nombre_vehiculo ?></td>
                                        <td id="tdMarca<?= $vehiculos->id_vehiculos ?>"><?= $vehiculos->marca ?></td>
                                        <td id="tdModelo<?= $vehiculos->id_vehiculos ?>"><?= $vehiculos->modelo ?></td>
                                        <td id="tdColor<?= $vehiculos->id_vehiculos ?>"><?= $vehiculos->color ?></td>
                                        <td id="tdObservaciones<?= $vehiculos->id_vehiculos ?>"><?= $vehiculos->observaciones ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Opciones
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item asignarUnidad" data-tipo-pregunta="<? $vehiculos->id_vehiculos ?>" data-bs-toggle="modal" data-bs-target="#asignarUnidad" data-id="<?= $vehiculos->id_vehiculos ?>">Asignar Unidad</a>
                                                    <a class="dropdown-item registrarRevision" data-tipo-pregunta="<? $vehiculos->id_vehiculos ?>" data-bs-toggle="modal" data-bs-target="#registrarRevision" data-id="<?= $vehiculos->id_vehiculos ?>">Registrar revisión</a>
                                                    <a class="dropdown-item historicoRevisiones" data-tipo-pregunta="<? $vehiculos->id_vehiculos ?>" data-bs-toggle="modal" data-bs-target="#historicoRevisiones" data-id="<?= $vehiculos->id_vehiculos ?>">Histórico de revisiones</a>
                                                    <a class="dropdown-item editarUnidad" data-tipo-pregunta="<? $vehiculos->id_vehiculos ?>" data-bs-toggle="modal" data-bs-target="#editarUnidad" data-id="<?= $vehiculos->id_vehiculos ?>">Editar Unidad</a>
                                                    <a class="dropdown-item deleteUnidad" data-id="<?= $vehiculos->id_vehiculos ?>">Eliminar unidad</a>
                                                </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr class="emptytable">
                                    <td colspan="100%" class="text-center">No hay registros</td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                <!-- </div> -->

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
include_once('php/views/vehiculos/modals/registrarUnidad.php');
include_once('php/views/vehiculos/modals/editarUnidad.php');
include_once('php/views/vehiculos/modals/asignarUnidad.php');
?>
<script src="js/functions/vehiculos/vehiculos.js"></script>
<script src="js/loading.js"></script>