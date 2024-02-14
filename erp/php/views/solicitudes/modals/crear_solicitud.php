<?php
$sql_materiales = "SELECT * FROM constructora_personal.matriz_materiales";
$getMateriales = $queries->getData($sql_materiales);

$sql_medicion = "SELECT * FROM constructora_personal.medicion_tipo";
$getMediciones = $queries->getData($sql_medicion);
?>
<!-- Success Header Modal -->


<div id="createSolicitud" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createSolicitudLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-success">
                <h4 class="modal-title" id="createSolicitudLabel">Nueva Solicitud</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="display-6">Información General</h1>
                                <p class="text-muted font-14">
                                    Por favor ingrese todos los datos marcados con un asterísco (*).
                                </p>
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="header-title">Proyecto: </h4>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="select2-preview">
                                                <select id="id_proyecto" class="form-control select2" data-toggle="select2">
                                                    <option value="">** Seleccione un proyecto</option>

                                                    <optgroup label="Proyectos">
                                                        <?php foreach ($getProyects as $proyects) : ?>
                                                            <option value="<?= $proyects->id_proyectos ?>"><?= strtoupper($proyects->codigo_proyecto) ?> - <?= strtoupper($proyects->nombre_largo) ?></option>
                                                        <?php endforeach; ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h4 class="header-title">Utilización: </h4>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="select2-preview">
                                                <select id="id_utilizacion" class="form-control select2" data-toggle="select2">
                                                    <option value="">** Seleccione una opción</option>

                                                    <optgroup label="Utilización">
                                                        <?php foreach ($getUtilizacion as $utilizacion) : ?>
                                                            <option value="<?= $utilizacion->id_utilizacion ?>"><?= ($utilizacion->descripcion) ?></option>
                                                        <?php endforeach; ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        
                                        <div class="tab-content">
                                            <br>
                                            <div class="mb-3">
                                            <h4 class="header-title">N° de Solicitud: </h4>        
                                                <label for="example-palaceholder" class="form-label"></label>
                                                <input type="text" id="codigo_solicitud_chuen" class="form-control" placeholder="Ingrese sun número de solicitud">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>


                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="display-6">Partidas de Material</h1>
                                <p class="text-muted font-14">
                                    Por favor ingrese todos los datos marcados con un asterísco (*).
                                </p>
                                <div class="form-floating mb-3">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card border-secondary border">
                                                <div class="card-body">
                                                    <h4 class="header-title">Agregar partida</h4>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h5 class="card-title">Material</h5>
                                                            <div class="mb-3">
                                                                <label for="example-palaceholder" class="form-label"></label>
                                                                <input type="text" id="articulo" class="form-control" placeholder="Ingrese la descripción completa del artículo">
                                                            </div>
                                                        </div>


                                                        <!-- SELECTORES MATERIAL CON DIMENCIONES -->
                                                        <!-- 
                                                        <div class="col-6">
                                                            <h5 class="card-title">Material</h5>
                                                            <div class="tab-content">
                                                                <div class="tab-pane show active" id="select2-preview">
                                                                    <select id="id_material" class="form-control select2" data-toggle="select2">
                                                                        <option value="">** Seleccione una opción</option>

                                                                        <optgroup label="Materiales">
                                                                            <?php foreach ($getMateriales as $materiales) : ?>
                                                                                <option value="<?= $materiales->id_material ?>"><?= strtoupper($materiales->descripcion) ?></option>

                                                                            <?php endforeach; ?>
                                                                        </optgroup>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <h5 class="card-title">Dimensión</h5>
                                                            <div class="tab-content">
                                                                <div class="tab-pane show active" id="select2-preview">
                                                                    <select id="id_dimension" class="form-control select2" data-toggle="select2">
                                                                        <option value="">** Seleccione una opción</option>

                                                                        <optgroup label="Utilización">

                                                                            <option value="1">3/4"</option>
                                                                            <option value="1">1/2"</option>

                                                                        </optgroup>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div> -->

                                                        <!-- FIN SELECTORES MATERIAL CON DIMENCIONES -->



                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <h5 class="card-title">Unidad de medida</h5>
                                                            <div class="tab-content">
                                                                <div class="tab-pane show active" id="select2-preview">
                                                                    <select id="id_um" class="form-control select2" data-toggle="select2">
                                                                        <option value="">** Seleccione una opción</option>

                                                                        <optgroup label="Unidad de Medida">
                                                                            <?php foreach ($getMediciones as $um) : ?>
                                                                                <option value="<?= $um->id_medicion_tipo ?>"><?= strtoupper($um->descripcion) ?></option>
                                                                            <?php endforeach; ?>
                                                                        </optgroup>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <h5 class="card-title">Cantidad</h5>
                                                            <div class="tab-content">
                                                                <div class="tab-pane show active" id="select2-preview">
                                                                    <input data-toggle="touchspin" id="cantidad" type="text" value="1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">

                                                        <div class="form-floating">
                                                            <textarea class="form-control" placeholder="Leave a comment here" id="observaciones" style="height: 100px;"></textarea>
                                                            <label for="floatingTextarea">Observaciones</label>
                                                        </div>
                                                    </div>
                                                    <br>

                                                </div> <!-- end card-body-->
                                                <a href="javascript: void(0);" class="btn btn-secondary btn-sm btn_add_partida">Agregar</a>
                                            </div> <!-- end card-->
                                        </div> <!-- end col-->
                                        <div class="col-lg-6">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" id="divTablaSolicitudes">

                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
            <div class="modal-footer">
                <button type="button" id="btn_save_solicitud_list" class="btn btn-success">Guardar Solicitud</button>
            </div>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div><!-- /.modal -->
<script src="js/functions/dropdown.js"></script>