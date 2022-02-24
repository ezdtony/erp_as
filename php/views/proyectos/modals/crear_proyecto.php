<!-- Info Header Modal -->

<div id="addProyect" class="modal fade" role="dialog" aria-labelledby="addProyectLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title" id="addProyectLabel">Agregar Proyecto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Información general</h4>
                                <p class="text-muted font-14">
                                    Por favor ingrese todos los datos marcados con un asterísco (*).
                                </p>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="proyect_code" placeholder="Ingrese el nombre" />
                                    <label for="floatingInput">Código de proyecto (Opcional)</label>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Duración de Proyecto</label>
                                    <p><small>La fecha de cierre puede o no ser exacta.</small></p>
                                    <input type="text" class="form-control date" id="duracion_proyecto" data-toggle="date-picker" data-cancel-class="btn-warning">
                                </div>
                                <div class="form-floating mb-3">
                                    <label for="proyect_type">Tipo de proyecto *</label>

                                    <select id="proyect_type" class="form-control select2" data-toggle="select2">
                                        <option value="">** Seleccione un tipo de proyecto **</option>

                                        <optgroup label="Tipos de proyecto">
                                            <?php foreach ($getProyectTypes as $pr_types) : ?>
                                                <option value="<?= $pr_types->id_tipo_proyecto ?>"><?= $pr_types->descripcion ?> </option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    </select>

                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="proyect_name" placeholder="Ingrese el nombre" />
                                    <label for="floatingInput">Nombre de Proyecto *</label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Dirección de proyecto</h4>
                                <p class="text-muted font-14">
                                    Por favor ingrese todos los datos marcados con un asterísco (*).
                                </p>
                                <div class="form-floating mb-3">
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="select2-preview">
                                            <select id="estado" class="form-control select2" data-toggle="select2">
                                                <option value="">** Seleccione un estado</option>

                                                <optgroup label="Estados">
                                                    <?php foreach ($getStates as $states) : ?>
                                                        <option value="<?= $states->id ?>"><?= $states->estado ?> </option>
                                                    <?php endforeach; ?>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="select2-preview">
                                            <select id="municipio" class="form-control select2" data-toggle="select2">
                                                <option value="">** Seleccione un municipio</option>

                                                <optgroup label="Estados">
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="colonia_proyecto" placeholder="Ingrese el nombre" />
                                    <label for="floatingInput">Colonia * </label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="calle_proyecto" placeholder="Ingrese el nombre" />
                                    <label for="floatingInput">Calle *</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="dir_numero_proyecto" placeholder="Ingrese el nombre" />
                                    <label for="floatingInput">Número</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="codigo_postal_proyecto" placeholder="Ingrese el nombre" />
                                    <label for="floatingInput">Código postal *</label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Información adicional</h4>

                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="comentarios_proyecto" style="height: 100px;"></textarea>
                                    <label for="comentarios_proyecto">Comentarios adicionales</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button id="guardar_proyecto" class="btn btn-info">Guardar Proyecto</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->