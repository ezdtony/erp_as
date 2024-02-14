<?php
include_once('php/models/accesos/accesos_model.php');
$accesos = new Access();
$allCentrales = $accesos->getAllCentral();
$getAllLockTypes = $accesos->getAllLockTypes();
$getPuertasDeAcceso = $accesos->getPuertasDeAcceso();
$getTiposCerraduraPA = $accesos->getTiposCerraduraPA();
$getAllLockTypesGabinetes = $accesos->getAllLockTypesGabinetes();
$getStatusLimpieza = $accesos->getStatusLimpieza();
$getPerimetros  = $accesos->getPerimetros();

?>
<input type="hidden" id="id_user" value="<?= $_SESSION['id_user'] ?>">
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
            <h4 class="page-title">Accesos | Mis accesos</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Lista de Accesos Registrados</h4>
                <div class="button-list">
                    <button type="button" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#nuevoAcceso">Registrar Acceso</button>
                    <!-- <button type="button" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#informacionSitio">Información de Sitios</button> -->
                </div>
                <br>

                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <th>Fecha</th>
                            <th>Código</th>
                            <th>Nombre Sitio</th>
                            <th>Actividad</th>
                            <th>Empresa</th>
                            <th>Proveedor</th>
                            <th>Aciones</th>
                            <th>Check-List</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $allSites = $accesos->getAccessList();

                        foreach ($allSites as $sites) { ?>
                            <tr id="tr_<?= $sites->id_accesos ?>">
                                <td><?= $sites->id_accesos ?></td>
                                <td><?= $sites->fecha ?></td>
                                <td><?= $sites->codigo_sitio ?></td>
                                <td><?= $sites->nombre_sitio ?></td>
                                <td><?= $sites->actividad ?></td>
                                <td><?= $sites->empresa ?></td>
                                <td><?= $sites->lider_cuadrilla ?></td>
                                <td class="table-action">
                                    <a id="<?= $sites->id_accesos ?>" title="Información detallada" class="action-icon infoAcceso" data-bs-toggle="modal" data-bs-target="#infoAcceso"> <i class="mdi mdi-information-outline"></i></a>
                                    <a data-id-acceso="<?= $sites->id_accesos ?>" title="Editar hora de salida" class="action-icon editarHoraSalida" data-bs-toggle="modal" data-bs-target="#editarHoraSalida"> <i class="mdi mdi-book-clock-outline"></i></a>
                                    <!-- <a id="<?= $sites->id_accesos ?>" title="Editar hora salida" class="action-icon editHoraSalida"> <i class="mdi mdi-calendar-clock"></i></a> -->
                                    <!-- <a id="<?= $sites->id_accesos ?>" title="Editar acceso" class="action-icon editAcceso"> <i class="mdi mdi-pencil"></i></a> -->
                                    <a id="<?= $sites->id_accesos ?>" title="Eliminar reigstro" class="action-icon deleteAcceso"> <i class="mdi mdi-delete"></i></a>


                                </td>
                                <td>
                                
                                <a href="php/views/fpdf/generate_check_list.php?id_acceso=<?=$sites->id_accesos ?>" target="_blank"><button data-id-site="<?= $sites->id_accesos ?>" data-site-name="<?= $sites->nombre_sitio ?>" data-site-code="<?= $sites->codigo_sitio ?>" class="btn btn-danger checkListSite"><i class="dripicons-document"></i> </button></a>
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
include_once('php/views/accesos/modals/nuevoAcceso.php');
include_once('php/views/accesos/modals/actualizarInfoSitio.php');
include_once('php/views/accesos/modals/addGabinete.php');
include_once('php/views/accesos/modals/infoAcceso.php');
include_once('php/views/accesos/modals/editarHoraSalida.php');


?>
<script src="js/functions/accesos/accesos.js"></script>
<script src="js/functions/accesos/firma.js"></script>
<script src="js/loading.js"></script>