<div class="modal fade" id="modalCrearProyecto" tabindex="-1" role="dialog" aria-labelledby="modalCrearProyectoTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCrearProyectoTitle">Crear Nuevo Proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="form_proyecto">
                    <div id="formulario_registro">
                        <h3>Información General</h3>
                        <h5>Ingrese todos los datos requeridos</h5>
                        <br>
                        <div class="form-floating mb-3">
                            <h4>Información General</h4>
                            <div class="row g-2">
                                <div class="col-md">
                                    <select class="form-control select2 re" id="select_tipo_proyecto" data-toggle="select2">
                                        <option selected="selected" class="proy_requerido" value="" disabled>Tipo de Proyecto *</option>
                                        <optgroup label="Tipos de Proyecto *">

                                            <?php
                                            foreach ($getProyectTypes as $proyect_type) {
                                            ?>
                                                <option value="<?= $proyect_type->id_tipos_proyecto?>"><?= $proyect_type->descripcion_tipo?></option>
                                            <?php } ?>


                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <select class="form-control select2 proy_requerido" id="region_proyecto" data-toggle="select2">
                                        <option selected="selected"  value="" disabled>Región *</option>
                                        <optgroup label="Tipos de Proyecto *">
                                        <?php
                                            foreach ($getRegions as $regiones) {
                                            ?>
                                                <option value="<?= $regiones->id_regiones?>">Región <?= $regiones->nombre_region?></option>
                                            <?php } ?>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control proy_requerido" id="nombre_proyecto" placeholder="Nombre del Proyecto *" />
                            <label for="nombre_proyecto">Nombre del Proyecto *</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Ingrese opcionalmente una descripción del proyecto" id="descripcion_proyecto" style="height: 100px;" data-toggle="maxlength" class="form-control" maxlength="450" rows="3" placeholder="Tiene un límite de 450 caracteres."></textarea>
                            <label for="descripcion_proyecto">Descripción de Proyecto</label>
                        </div>

                        <div class="row g-2">
                            <div class="col-md">
                                <div class="mb-3 position-relative" id="datepicker4">
                                    <label class="form-label">Fecha de Inicio *</label>
                                    <input type="text" id="fecha_inicio" class="form-control proy_requerido" data-provide="datepicker" data-date-autoclose="true" data-date-container="#datepicker4">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3 position-relative" id="datepicker4">
                                    <label class="form-label">Fecha de Cierre (Proyección)</label>
                                    <input type="text" id="fecha_cierre" class="form-control" data-provide="datepicker" data-date-autoclose="true" data-date-container="#datepicker4">
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <h3>Dirección del Proyecto</h3>
                        <h5>Ingresar los Datos que Apliquen</h5>

                        <div class="form-floating mb-3">
                            <div class="row g-2">
                                <div class="col-md">
                                    <select class="form-control select2 proy_requerido" id="estado_proyecto" data-toggle="select2">
                                        <option selected="selected" value="" disabled>Estado *</option>
                                        <optgroup label="Seleccione un estado *">
                                        <?php
                                            foreach ($getStates as $estados) {
                                            ?>
                                                <option value="<?= $estados->id?>"><?= $estados->estado?></option>
                                            <?php } ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <select class="form-control select2" id="municipio_proyecto" data-toggle="select2">
                                        <option selected="selected" class="proy_requerido" value="" disabled>Municipio *</option>
                                        <optgroup label="Seleccione un municipio">
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="colonia_direccion" placeholder="Colonia" />
                                    <label for="colonia_direccion">Colonia</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="zip_direccion" placeholder="Codigo Postal" />
                                    <label for="zip_direccion">Codigo Postal</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="calle_direccion" placeholder="Calle" />
                            <label for="calle_direccion">Calle</label>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="num_ext_direccion" placeholder="Número Exterior" />
                                    <label for="num_ext_direccion">Número</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="hidden" class="form-control" id="num_int_direccion" placeholder="Número Interior"  />
                                    <label for="num_int_direccion">Número Interior</label>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="guardarProyecto" class="btn btn-primary">Guardar Proyecto</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->