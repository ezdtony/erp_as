<?php
$getClasificacionesMaterial = $compras->getClasificacionesMaterial();
$getUnidadesMedida = $compras->getUnidadesMedida();
$getUnidadesLongitud = $compras->getUnidadesLongitud();
$getMarcas = $compras->getMarcas();

?>
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="nuevaCotizacion" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-full-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollableModalTitle">Crear nueva cotización</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="display-6">Información General</h1>
                                    <div class="row">
                                        <div class="col-6">
                                            <h4 class="header-title">Proyecto:     <span class="badge badge-danger-lighten">Obligatorio</span></h4>
                                            <div class="tab-content">
                                                <div class="tab-pane show active" id="select2-preview">
                                                    <select id="id_proyecto_cotizacion" class="form-control select2" data-toggle="select2">
                                                        <option value="" selected disabled>Seleccione un proyecto *</option>
                                                        <optgroup label="Proyectos">
                                                            <?php foreach ($getAllProyectsByUser as $proyects) : ?>
                                                                <option value="<?= $proyects->id_proyectos; ?>"><?= $proyects->nombre_proyecto; ?></option>
                                                            <?php endforeach; ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <!--  <div class="col-6">
                                            <h4 class="header-title">Utilización: </h4>
                                            <div class="tab-content">
                                                <div class="tab-pane show active" id="select2-preview">
                                                    <select id="id_utilizacion" class="form-control select2" data-toggle="select2">
                                                        <option>Seleccione un proyecto *</option>
                                                        <optgroup label="Utilización">
                                                            <?php foreach ($getUtilizaciones as $utilizaciones) : ?>
                                                                <option value="<?= $utilizaciones->id_utilizaciones; ?>"><?= $utilizaciones->descripcion_utilizacion; ?></option>
                                                            <?php endforeach; ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-6">

                                            <!-- <div class="tab-content">
                                                <br>
                                                <div class="mb-3">
                                                    <h4 class="header-title">N° de Solicitud: </h4>
                                                    <label for="example-palaceholder" class="form-label"></label>
                                                    <input type="text" id="codigo_solicitud_chuen" class="form-control" placeholder="Ingrese sun número de solicitud">
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>

                                    <br>


                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-12" id="desglose_cotizacion" style="display:none"> -->
                        <div class="col-12" id="desglose_cotizacion">
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="display-6">Partidas de Material</h1>
                                    <!-- <p class="text-muted font-14">
                                        Por favor ingrese todos los datos marcados con un asterísco (*).
                                    </p> -->
                                    <div class="form-floating mb-3">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card border-secondary border">
                                                    <div class="card-body">
                                                        <h4 class="header-title">Agregar una partida</h4>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <h5 class="card-title">Clasificación de material     <span class="badge badge-danger-lighten">Obligatorio</span></h5>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane show active" id="select2-preview">
                                                                        <select class="form-control select2" data-toggle="select2" id="select_clasificacion_cotizacion">
                                                                            <option id="" value="" selected disabled>Seleccione una opción</option>
                                                                            <?php foreach ($getClasificacionesMaterial as $clasificacion) : ?>
                                                                                <option value="<?= $clasificacion->id_clasificaciones_catalogo ?>"><?= $clasificacion->clasificacion ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h5 class="card-title">Material     <span class="badge badge-danger-lighten">Obligatorio</span></h5>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane show active" id="select2-preview">
                                                                        <select class="form-control select2" disabled data-toggle="select2" id="material_cotizacion">
                                                                            <option id="" value="" selected disabled>Seleccione una opción</option>

                                                                        </select>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <div class="row" id="div_unidades_longitud" style="display:none">

                                                                <div class="col-6">
                                                                    <h5 class="card-title">Unidad de longitud     <span class="badge badge-danger-lighten">Obligatorio</span></h5>
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane show active" id="select2-preview">
                                                                            <select id="id_unidad_longitud" class="form-control select2" data-toggle="select2">
                                                                                <option value="" selected disabled>Seleccione una opción * </option>
                                                                                <?php foreach ($getUnidadesLongitud as $unidad_longitud) : ?>
                                                                                    <option  value="<?= $unidad_longitud->id_unidades_de_longitud ?>"><?= $unidad_longitud->uindad_longitud ?></option>
                                                                                <?php endforeach; ?>
                                                                                </optgroup>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <h5 class="card-title">Medida de longitud     <span class="badge badge-danger-lighten">Obligatorio</span></h5>
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane show active" id="select2-preview">
                                                                            <select id="id_medida_longitud" disabled class="form-control select2" data-toggle="select2">

                                                                                </optgroup>
                                                                            </select>
                                                                        </div>
                                                                    </div>
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
                                                                                                                                                            <option value="1">TUBO GALVANIZADO PARED DELGADA</option>

                                                                                                                                                            <option value="2">TUBO DE PCV PESADO </option>

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
                                                                <h5 class="card-title">Unidad de medida     <span class="badge badge-danger-lighten">Obligatorio</span></h5>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane show active" id="select2-preview">
                                                                        <select id="id_unidad_medida" class="form-control select2" data-toggle="select2">
                                                                            <option value="" selected disabled>Seleccione una opción * </option>
                                                                            <?php foreach ($getUnidadesMedida as $unidad_medida) : ?>
                                                                                <option value="<?= $unidad_medida->id_unidades_medida ?>"><?= $unidad_medida->unidades_medida_long ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <h5 class="card-title">Elegir una marca en específico (Opcional)</h5>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane show active" id="select2-preview">
                                                                        <select id="select_marca_cotizacion" class="form-control select2" data-toggle="select2">
                                                                            <option>Seleccione una opción * </option>
                                                                            <?php foreach ($getMarcas as $marca) : ?>
                                                                                <?php if ($marca->id_marcas == 1): ?>
                                                                                <option selected value="<?= $marca->id_marcas ?>"><?= $marca->nombre_marca ?></option>
                                                                                <?php else: ?>
                                                                                <option value="<?= $marca->id_marcas ?>"><?= $marca->nombre_marca ?></option>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">

                                                            <div class="col-6">
                                                                <h5 class="card-title">Cantidad</h5>
                                                                <div class="form-floating mb-3">
                                                                    <input type="email" class="form-control" id="canitdad_cotizacion" placeholder="Cantidad" />
                                                                    <label for="canitdad_cotizacion">Cantidad     <span class="badge badge-danger-lighten">Obligatorio</span></label>
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
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn_save_solicitud_list">Guardar Cotización</button>
            </div>
        </div>
    </div>
</div>