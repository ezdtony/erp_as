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
                                    <p class="text-muted font-14">
                                        Por favor ingrese todos los datos marcados con un asterísco (*).
                                    </p>
                                    <div class="row">
                                        <div class="col-6">
                                            <h4 class="header-title">Proyecto: </h4>
                                            <div class="tab-content">
                                                <div class="tab-pane show active" id="select2-preview">
                                                    <select id="id_proyecto" class="form-control select2" data-toggle="select2">
                                                        <option>Seleccione un proyecto *</option>
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
                                        <div class="col-6">
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
                                        </div>
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
                                                                <h5 class="card-title">Unidad de medida</h5>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane show active" id="select2-preview">
                                                                        <select id="id_unidad_medida" class="form-control select2" data-toggle="select2">
                                                                            <option>Seleccione una opción * </option>
                                                                            <optgroup label="Unidad de Medida">
                                                                                <option value="1">PIEZAS</option>
                                                                                <option value="2">METROS LINEALES</option>
                                                                                <option value="3">KILOGRAMOS</option>
                                                                                <option value="4">TONELADAS</option>
                                                                                <option value="6">METROS</option>
                                                                                <option value="7">TBO</option>
                                                                                <option value="8">CAR</option>
                                                                                <option value="9">MT3</option>
                                                                                <option value="10">GALON</option>
                                                                                <option value="11">CAJAS</option>
                                                                                <option value="12">ROLLO</option>
                                                                                <option value="13">CUBETA</option>
                                                                                <option value="14">BULTO</option>
                                                                                <option value="15">HOJA</option>
                                                                                <option value="16">LITRO</option>
                                                                                <option value="17">CU</option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <h5 class="card-title">Cantidad</h5>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane show active" id="select2-preview">
                                                                        <input id="cantidad" type="text" value="1">
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
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn_save_solicitud_list">Guardar Cotización</button>
            </div>
        </div>
    </div>
</div>