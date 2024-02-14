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
<div class="chart-content-bg">

    <div class="row">
        <div class="row" id="">

            <?php
            include_once('php/models/vehiculos/vehiculos_model.php');
            $vehiculos_model = new ModeloVehiculos;
            $getVehiculos = $vehiculos_model->getVehiculosUser($id_user);
            ?>
            <?php if (!empty($getVehiculos)) : ?>
                <?php foreach ($getVehiculos as $vehiculos) : ?>
                    <!-- <tr id="trVehiculo<?= $vehiculos->id_vehiculos ?>">
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
                    </tr> -->
                    <div class="col-md-6">
                        <!-- Portlet card -->
                        <div id="card_proyect_<?= $vehiculos->id_vehiculos ?>" class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="card-widgets">
                                    <a data-bs-toggle="collapse" href="#card_proy<?= $vehiculos->id_vehiculos ?>" role="button" aria-expanded="false" aria-controls="card_proy<?= $vehiculos->id_vehiculos ?>"><i class="mdi mdi-plus"></i></a>
                                </div>
                                <h3><?= $vehiculos->nombre_vehiculo ?></h3>
                                <h5>PLACAS: <?= $vehiculos->placas ?></h5>
                                <h6><?= ($vehiculos->modelo) ?></h6>

                                <div id="card_proy<?= $vehiculos->id_vehiculos ?>" class="collapse pt-3">
                                    <!-- <p>
                                        <?= $vehiculos->nombre_vehiculo ?> | <?= $vehiculos->placas ?>
                                    </p>
                                    <p>

                                    </p>
                                    <br> -->

                                    <button type="button" style="margin: 5px 3px 5px 5px;" class="btn btn-success registrarRevision" data-id="<?= $vehiculos->id_vehiculos ?>" data-bs-target="#registrarRevision" data-bs-toggle="modal" data-bs-placement="top" title="Registrar revisión">REGISTRAR REVISIÓN <i class="mdi mdi-information-outline"></i> </button>
                                    <button type="button" style="margin: 5px 3px 5px 5px;" class="btn btn-info historialRevisiones" data-id="<?= $vehiculos->id_vehiculos ?>" data-bs-target="#historialRevisiones" data-bs-toggle="modal" data-bs-placement="top" title="Histórico de revisiones"><i class="mdi mdi-book-open-page-variant"></i> </button>
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div><!-- end col -->


                <?php endforeach; ?>
            <?php else : ?>
                <tr class="emptytable">
                    <td colspan="100%" class="text-center">No hay registros</td>
                </tr>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php
include_once('php/views/vehiculos/modals/modalCheckList.php');
include_once('php/views/vehiculos/modals/historialRevisiones.php');
?>

<script src="js/jsPDF/jspdf.umd.min.js"></script>
<script src="js/jsPDF/jspdf.plugin.autotable.js"></script>
<script src="js/functions/vehiculos/vehiculos.js"></script>
<script src="js/functions/vehiculos/getLogos.js"></script>
<script src="js/functions/vehiculos/generatePDFRevision.js"></script>
<script src="js/functions/vehiculos/downloadPDFRevision.js"></script>
<script src="js/loading.js"></script>