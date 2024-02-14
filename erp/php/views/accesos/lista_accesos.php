<?php
include_once('php/models/accesos/accesos_model.php');
$accesos = new Access();
$allCentrales = $accesos->getAllCentral();
$getAllLockTypes = $accesos->getAllLockTypes();
$getAllLockTypesGabinetes = $accesos->getAllLockTypesGabinetes();
$getPuertasDeAcceso = $accesos->getPuertasDeAcceso();
$getTiposCerraduraPA = $accesos->getTiposCerraduraPA();
$getStatusLimpieza = $accesos->getStatusLimpieza();
$getPerimetros  = $accesos->getPerimetros();

?>
<input type="hidden" id="id_user" value="<?= $_SESSION['id_user'] ?>">
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <form class="d-flex">
                             <i class="mdi mdi-autorenew"></i>
                         </a>
                </form>
            </div>
            <h4 class="page-title">Accesos | Coordinación | Lista de Accesos</h4>
        </div>
    </div>
</div
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Lista de Accesos Registrados</h4>
                <div class="button-list">
                </div>
                <br>

                <table id="datatable-buttons" class="table table-striped dt-responsive  w-100">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <th>Fecha</th>
                            <th>Código</th>
                            <th>Nombre Sitio</th>
                            <th>Actividad</th>
                            <th>Empresa</th>
                            <th>Proveedor</th>
                            <th>Personal AS</th>
                            <th>Aciones</th>
                            <th>Check-List</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $allSites = $accesos->getAccessListAdmin();

                        foreach ($allSites as $sites) { ?>
                            <tr id="tr_<?= $sites->id_accesos ?>">
                                <td><?= $sites->id_accesos ?></td>
                                <td><?= $sites->fecha ?></td>
                                <td><?= $sites->codigo_sitio ?></td>
                                <td><?= $sites->nombre_sitio ?></td>
                                <td><?= $sites->actividad ?></td>
                                <td><?= $sites->empresa ?></td>
                                <td><?= $sites->lider_cuadrilla ?></td>
                                <td><?= $sites->pesonal_as ?></td>
                                <td class="table-action">
                                    <a id="<?= $sites->id_accesos ?>" title="Información detallada" class="action-icon infoAcceso" data-bs-toggle="modal" data-bs-target="#infoAcceso"> <i class="mdi mdi-information-outline"></i></a>
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
        </div>
    </div>
</div
<?php
include_once('php/views/accesos/modals/nuevoAcceso.php');
include_once('php/views/accesos/modals/actualizarInfoSitio.php');
include_once('php/views/accesos/modals/addGabinete.php');
include_once('php/views/accesos/modals/infoAcceso.php');


?>
<script src="js/functions/accesos/accesos.js"></script>
<script src="js/functions/accesos/firma.js"></script>
<script src="js/loading.js"></script>