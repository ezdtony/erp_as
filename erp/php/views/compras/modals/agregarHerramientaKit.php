<div id="addHerramientaKit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addHerramientaKitLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addHerramientaKitLabel">Agregar Herramienta a Kit</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nombre_de_herramienta" placeholder="Nombre de la herramienta" />
                    <label for="abreviatura_tipo_kit">Nombre de la Herramienta</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="marca_de_herramienta" placeholder="Marca de la Herramienta" />
                    <label for="abreviatura_tipo_kit">Marca de la Herramienta</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="modelo_herramienta" placeholder="Modelo" />
                    <label for="abreviatura_tipo_kit">Modelo</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="numero_serie_herramienta" placeholder="N° de Serie" />
                    <label for="abreviatura_tipo_kit">N° de Serie</label>
                </div>
                <label for="abreviatura_tipo_kit">Seleccione un status</label>
                <div class="form-floating mb-3">
                    <select class="form-control select2" data-toggle="select2" id="selectStatusHerramienta">
                        <option selected disabled>Seleccione un status</option>
                        <?php foreach ($getStatusHerramienta as $status_herramienta) : ?>
                            <option value="<?= $status_herramienta->id_status_herramienta ?>"><?= $status_herramienta->descripcion ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <label for="abreviatura_tipo_kit">Seleccione un almacen</label>
                <div class="form-floating mb-3">
                    <select class="form-control select2" data-toggle="select2" id="selectAlmacenHerramienta">
                        <option selected disabled>Seleccione un almacen</option>
                        <?php foreach ($getAlmacenesHerramienta as $almacenes) : ?>
                            <option value="<?= $almacenes->id_almacenes ?>"><?= $almacenes->nombre_almacen ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="comentarios_herramienta" class="form-label">Comentarios</label>
                    <textarea class="form-control" id="comentarios_herramienta" rows="5"></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary saveHerramienta">Registrar Herramienta</button>
            </div>
        </div>
    </div>
</div>