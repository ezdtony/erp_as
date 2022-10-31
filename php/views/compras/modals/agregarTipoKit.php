<div id="addTipoKit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addTipoKitLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addTipoKitLabel">Registrar nuevo tipo de kit</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="abreviatura_tipo_kit" placeholder="Nombre de Almacen" />
                    <label for="abreviatura_tipo_kit">Abreviatura</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="descripcion_tipo_kit" placeholder="nombre@ejemplo.com" />
                    <label for="descripcion_tipo_kit">Descripción</label>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary saveTipoKit">Registrar tipo de kit</button>
            </div>
        </div>
    </div>
</div>