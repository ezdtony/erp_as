<?php
include_once('php/models/accesos/accesos_model.php');
$accesos = new Access();
$getTiposSitio = $accesos->GetTipoSitio();

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
            <h4 class="page-title">Accesos | Sitios | Administración</h4>
        </div>
    </div>
</div <div class="row">
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-3">Lista de Sitios</h4>
            <br>
            <button type="button" disabled title="Estammos trabajando en ello..." class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#nuevoSitio">Nuevo Sitio</button>
            <br>
            <br>
            <div class="button-list">
            </div>
            <br>

            <table id="datatable-buttons" class="table table-striped dt-responsive  w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Nombre Sitio</th>
                        <th>Empresa</th>
                        <th>Clasificación</th>
                        <th>Central</th>
                        <th>Zona</th>
                        <th>Status</th>
                        <!-- <th>Info. Detallada</th> -->
                    </tr>
                </thead>


                <tbody>
                    <?php $allSites = $accesos->getAllSites(); 
                    set_time_limit(0);


                    ?>
                    <?php foreach ($allSites as $sites) : 
                        $getZonasSitios = $accesos->getZonasSitios($sites->id_centrales);
                        ?>
                        <tr>
                            <td><?= ($sites->id_sitios) ?></td>
                            <td><?= ($sites->codigo_sitio) ?></td>
                            <td><?= ($sites->nombre_sitio) ?></td>
                            <td><?= ($sites->empresa_responsable) ?></td>
                            <td>
                                <select class="form-select selectTipoSitio" id="<?=$sites->id_sitios?>">
                                    <?php foreach ($getTiposSitio as $type_sites) : ?>
                                        <?php if ($sites->id_tipos_sitio ==  $type_sites->id_tipos_sitio) : ?>
                                            <option selected value="<?= $type_sites->id_tipos_sitio ?>"><?= $type_sites->descripcion ?></option>
                                        <?php else : ?>
                                            <option  value="<?= $type_sites->id_tipos_sitio ?>"><?= $type_sites->descripcion ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-select selectZonaSitio" id="<?=$sites->id_sitios?>">
                                    <?php foreach ($getZonasSitios as $zone_sites) : ?>
                                        <?php if ($sites->id_zonas_central ==  $zone_sites->id_zonas_central) : ?>
                                            <option selected value="<?= $zone_sites->id_zonas_central ?>"><?= $zone_sites->descripcion ?></option>
                                        <?php else : ?>
                                            <option  value="<?= $zone_sites->id_zonas_central ?>"><?= $zone_sites->descripcion ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><?= ($sites->zona) ?></td>
                            <td><?= ($sites->status_sitio) ?></td>
                            <!-- <td>
                                <button data-id-site="<?= $sites->id_sitios ?>" data-site-name="<?= $sites->nombre_sitio ?>" data-site-code="<?= $sites->codigo_sitio ?>" class="btn btn-secondary infoSitio" data-bs-toggle="modal" data-bs-target="#infoSitio"><i class="mdi mdi-information-variant"></i> </button>
                            </td> -->

                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <br>
        </div>
    </div>
</div>
<< /div>
    <!-- end row -->
    <?php
    /* 
include_once('php/views/accesos/modals/nuevoSitio.php');
include_once('php/views/accesos/modals/infoSitio.php');
 */

    ?>
    <script src="js/functions/accesos/accesos.js"></script>
    <script src="js/loading.js"></script>