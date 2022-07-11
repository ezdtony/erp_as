<!-- Standard modal -->
<div id="nuevoAcceso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="nuevoAccesoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="nuevoAccesoLabel">Registrar Acceso</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" id="bodyNuevoAcceso">
                <!-- Single Select -->
                <div class="mb-3">
                    <label class="form-label">Central</label>
                    <div class="input-group">
                        <select id="na_central" class="form-control select2" data-toggle="select2">
                            <option selected disabled value="">Seleccione una opción</option>
                            <?php foreach ($allCentrales as $central) : ?>
                                <option value="<?= $central->id_centrales ?>"><?= $central->nombre_central ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Zona</label>
                    <div class="input-group">
                        <select id="na_zona" disabled class="form-control select2" data-toggle="select2">
                            <option selected disabled value="">Seleccione una opción</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sitio</label>
                    <div class="input-group">
                        <select id="na_sitio" disabled class="form-control select2" data-toggle="select2">
                            <option selected disabled value="">Seleccione una opción</option>
                        </select>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="empresa" placeholder="Empresa" />
                    <label for="empresa">Empresa</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="actividad" class="form-control" id="actividad" placeholder="Actividad" />
                    <label for="actividad">Actividad</label>
                </div>
                <div class="form-floating row">
                    <div class="col-md-6">
                        <label for="example-time" class="form-label">Hora de Ingreso</label>
                        <input class="form-control" id="hora_ingreso" type="time" name="time" value="<?= date('h:i') ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="example-time" class="form-label">Hora de Salida</label>
                        <input class="form-control" id="hora_salida" type="time" name="time">
                    </div>
                </div>
                <br>
                <div class="form-floating mb-3">
                    <input type="proveedor" class="form-control" id="proveedor" placeholder="proveedor" />
                    <label for="proveedor">Nombre del proveedor</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="ayudantes" class="form-control" id="ayudantes" placeholder="ayudantes" />
                    <label for="ayudantes">Acompañantes del proveedor</label>
                </div>
                <div class="col-sm-12">
                    <label class="form-label">Fotografía / Identificación del proveedor</label>
                    <input class="form-control" type="file" id="fotografia_proveedor">
                </div>
                <br>
                <div>
                    <label class="form-label">Comentarios</label>
                    <p class="text-muted font-13"></p>
                    <textarea id="comentarios" name="comentarios" data-toggle="maxlength" class="form-control" maxlength="550" rows="4" placeholder="Dispone de un total de 550 caracteres."></textarea>
                </div>
                <br>
                <div class="col-sm-12">
                    <label class="form-label">Firma del proveedor</label>
                    <?php include 'firmaCanvas.php'; ?>
                    <br>
                     </div>
                <br>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar Acceso</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->