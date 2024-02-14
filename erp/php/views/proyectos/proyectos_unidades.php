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

                <h4 class="header-title mb-3">Mis Proyectos (Unidades)</h4>
                <div class="d-grid">
                    <?php if ($id_area <= 3) : ?>
                        <button type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearProyecto">Agregar Proyecto</button>
                    <?php endif; ?>
                </div>
                <br>
                <?php if ($id_area <= 3) : ?>
                    <?php $ForeachProyectos = $getAllProyectsUnidadesActivos; ?>
                    <div class="table-responsive">
                        <table id="tablaProyectosCoord" class="table table-striped dt-responsive nowrap w-100 ">
                            <thead class="table-dark">
                                <tr>
                                    <th>CONS. PROY.</th>
                                    <th>NOMBRE PROYECTO</th>
                                    <th>REGIÓN</th>
                                    <th>STATUS</th>
                                    <th>CREADO POR <span class="badge bg-success rounded-pill">Editable</span></th>
                                    <th>FECHA CREACIÓN</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ForeachProyectos as $proyecto) : ?>
                                    <?php $txt_checked = '';
                                    if ($proyecto->status == 1) {
                                        $txt_checked = 'checked';
                                    }
                                    ?>
                                    <tr id="<?= $proyecto->id_proyectos ?>">
                                        <!-- <td>
                                            <input class="chckPartidaCotizada" type="checkbox" data-id-partida="<?= $proyecto->id_desglose_cotizacion; ?>" id="switch<?= $proyecto->id_desglose_cotizacion; ?>" data-switch="none" <?= $txt_checked ?>>
                                            <label for="switch<?= $proyecto->id_desglose_cotizacion; ?>" data-on-label="" data-off-label=""></label>
                                        </td> -->
                                        <td><?= mb_strtoupper($proyecto->codigo_proyecto); ?></td>
                                        <td><?= mb_strtoupper($proyecto->nombre_proyecto); ?></td>
                                        <td>Región <?= ($proyecto->nombre_region); ?></td>
                                        <td>
                                            <input id-proy-change="<?= $proyecto->id_proyectos ?>" data-status-proyecto="<?= $status_proy ?>" class="chckProyectoStatus" title="Desactivar proyecto" type="checkbox" data-id-partida="<?= $proyecto->id_proyectos; ?>" id="switch<?= $proyecto->id_proyectos; ?>" data-switch="none" <?= $txt_checked ?>>
                                            <label for="switch<?= $proyecto->id_proyectos; ?>" data-on-label="" data-off-label=""></label>
                                        </td>
                                        <td>
                                            <select data-id-proyecto="<?= $proyecto->id_proyectos; ?>" class="form-select selectCreadorProyecto" id="example-select">
                                                <option selected disabled>Seleccione una opción</option>
                                                <?php foreach ($getCoordinatiors as $coordinatiors) : ?>
                                                    <?php if ($proyecto->id_personal_creador == $coordinatiors->id_lista_personal) : ?>
                                                        <option value="<?= $coordinatiors->id_lista_personal; ?>" selected><?= $coordinatiors->nombre_completo ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $coordinatiors->id_lista_personal; ?>"><?= $coordinatiors->nombre_completo ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td><?= ($proyecto->fecha_creacion_proy); ?></td>

                                        <td class="table-action">
                                            <!--    <?php if ($id_area <= 3) : ?>
                                                <button type="button" class="btn btn-success btn_add_personal" id="<?= $proyecto->id_proyectos ?>" ><i class="mdi mdi-account-plus-outline"></i> </button>
                                                <button type="button" class="btn btn-success unactiveProyect" id="change_<?= $proyecto->id_proyectos ?>" id-proy-change="<?= $proyecto->id_proyectos ?>" data-status-proyecto="<?= $status_proy ?>" data-bs-placement="top" title="Desactivar proyecto"><i class="mdi mdi-toggle-switch-off"></i> </button>
                                                <button type="button" class="btn btn-success deleteProyect" id="<?= $proyecto->id_proyectos ?>" ><i class="mdi mdi-delete"></i> </button>
                                            <?php endif; ?> -->
                                            <a class="action-icon btn_add_personal" id="<?= $proyecto->id_proyectos ?>" data-bs-target="#addPPersonal" data-bs-toggle="modal" data-bs-placement="top" title="Asignar personal">
                                                <i class="mdi mdi-account-plus-outline"></i>
                                            </a>
                                            <a class="action-icon infoProyect" id="<?= $proyecto->id_proyectos ?>" data-bs-target="#infoProyect" data-bs-toggle="modal" data-bs-placement="top" title="Detalle de proyecto">
                                                <i class="mdi mdi-information-outline"></i>
                                            </a>
                                            <a class="action-icon deleteProyect" id="<?= $proyecto->id_proyectos ?>" data-bs-placement="top" title="Eliminar proyecto">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <script>
                        var tGastos = new TableFilter(document.querySelector("#tablaProyectosCoord"), {
                            base_path: "js/tablefilter/",
                            paging: {
                                results_per_page: ['Records: ', [10, 25, 50, 100]]
                            },
                            responsive: true,
                            rows_counter: true,
                            btn_reset: true,
                            col_2: "select",
                            col_3: "none",
                            col_4: "none",
                            col_6: "none",
                            col_7: "none"
                        });
                        tGastos.init();
                    </script>
                <?php else : ?>
                    <?php $ForeachProyectos = $getAllProyectsByUserUnidades; ?>
                    <div class="chart-content-bg">

                        <div class="row">
                            <div class="row" id="">

                                <?php
                                foreach ($ForeachProyectos as $proyectos) {
                                    $class_status = "bg-primary text-white";
                                    $status_proy = $proyectos->status;
                                    if ($status_proy == 0) {
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
                                                </div>
                                            </div>
                                        </div> <!-- end card-->
                                    </div><!-- end col -->

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
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