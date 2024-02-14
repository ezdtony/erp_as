<div id="addAlmacen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addAlmacenLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addAlmacenLabel">Registrar nuevo almacen</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nombre_almacen" placeholder="Nombre de Almacen" />
                    <label for="nombre_almacen">Nombre de Almacen</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="direccion_almacen" placeholder="nombre@ejemplo.com" />
                    <label for="direccion_almacen">Dirección de Almacen</label>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary saveAlmacen">Registrar almacen</button>
            </div>
        </div>
    </div>
</div>