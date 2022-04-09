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
            <h4 class="page-title">Módulo de Proyectos</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title mb-3">Mis Proyectos</h4>
                <div class="d-grid">
                <?php if ($id_area<=3):?>
                    <button type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearProyecto">Agregar Proyecto</button>
                <?php endif;?>
                </div>
                <br>
                <div class="chart-content-bg">

                    <div class="row">
                        <div class="row" id="simple-dragula" data-plugin="dragula">

                            <?php foreach ($getAllProyects as $proyectos) {
                                $class_status = "bg-primary text-white";
                                $status_proy = $proyectos->status;
                                if ($status_proy==0) {
                                    $class_status = "bg-secondary text-white";
                                }
                            ?>

                                <div class="col-md-4">
                                    <!-- Portlet card -->
                                    <div id="card_proyect_<?= $proyectos->id_proyectos ?>" class="card <?= $class_status ?>">
                                        <div class="card-body">
                                            <div class="card-widgets">
                                                <a data-bs-toggle="collapse" href="#card_proy<?= $proyectos->id_proyectos ?>" role="button" aria-expanded="false" aria-controls="card_proy<?= $proyectos->id_proyectos ?>"><i class="mdi mdi-plus"></i></a>
                                            </div>
                                            <h3><?= $proyectos->nombre_proyecto ?></h3>
                                            <h5>Región <?= $proyectos->nombre_region ?></h5>
                                            <h6><?= strtoupper($proyectos->codigo_proyecto) ?></h6>

                                            <div id="card_proy<?= $proyectos->id_proyectos ?>" class="collapse pt-3">
                                                <p>
                                                    <?= $proyectos->direccion_local ?> <?= $proyectos->direccion_zona ?>
                                                </p>
                                                <p>

                                                </p>
                                                <br>
                                                
                                                <button type="button" class="btn btn-success infoProyect" id="<?= $proyectos->id_proyectos ?>" data-bs-target="#infoProyect" data-bs-toggle="modal" data-bs-placement="top" title="Detalle de proyecto"><i class="mdi mdi-information-outline"></i> </button>
                                                <?php if ($id_area<=3):?>
                                                <button type="button" class="btn btn-success btn_add_personal" id="<?= $proyectos->id_proyectos ?>" data-bs-target="#addPPersonal" data-bs-toggle="modal" data-bs-placement="top" title="Asignar personal"><i class="mdi mdi-account-plus-outline"></i> </button>
                                                <button type="button" class="btn btn-success unactiveProyect" id="change_<?= $proyectos->id_proyectos ?>"  id-proy-change="<?= $proyectos->id_proyectos ?>" data-status-proyecto="<?= $status_proy ?>" data-bs-placement="top" title="Desactivar proyecto"><i class="mdi mdi-toggle-switch-off"></i> </button>
                                                <button type="button" class="btn btn-success deleteProyect" id="<?= $proyectos->id_proyectos ?>"  data-bs-placement="top" title="Eliminar proyecto"><i class="mdi mdi-delete"></i> </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div> <!-- end card-->
                                </div><!-- end col -->

                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card-body-->
        </div>
        <!-- end card-->
    </div>
    <!-- end col-->
</div>
<!-- end row -->
<?php
include_once('php/views/proyectos/modals/crear_proyecto.php');
include_once('php/views/proyectos/modals/asignar_personal.php');
include_once('php/views/proyectos/modals/detalle_proyecto.php');
?>
<script src="js/functions/proyectos.js"></script>
<script src="js/loading.js"></script>