<?php
 include_once('php/models/accesos/accesos_model.php');
 $accesos = new Access();
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
            <h4 class="page-title">Accesos | Administración</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Lista de Sitios</h4>
                <br>
                <button type="button" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#nuevoSitio">Nuevo Sitio</button>
                <br>
                <br>
                <br>

                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre Sitio</th>
                            <th>Empresa</th>
                            <th>Clasificación</th>
                            <th>Dirección</th>
                            <th>Info. Detallada</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $allSites = $accesos->getAllSites();

                        foreach ($allSites as $sites) { ?>
                            <tr>
                                <td><?= $sites->codigo_sitio ?></td>
                                <td><?= $sites->nombre_sitio ?></td>
                                <td><?= $sites->empresa_responsable ?></td>
                                <td>Indoor</td>
                                <td>Av. Parque de Chapultepec #1 int 1, El Parque, Naucalpan.</td>
                                <td><button class="btn btn-secondary addFactura"><i class="mdi mdi-information-variant"></i> </button></td>

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
include_once('php/views/accesos/modals/nuevoSitio.php');

?>
<script src="js/functions/accesos/accesos.js"></script>
<script src="js/loading.js"></script>