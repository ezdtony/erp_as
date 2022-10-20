<div id="nuevoProveedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="nuevoProveedorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="nuevoProveedorLabel">Registrar nuevo proveedor</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nombre_proveedor" placeholder="Nombre del contacto" />
                    <label for="nombre_proveedor">Nombre del contacto</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="mail_proveedor" placeholder="nombre@ejemplo.com" />
                    <label for="mail_proveedor">Correo electrónico</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="telefono_proveedor" placeholder="Número telefónico" />
                    <label for="telefono_proveedor">Número telefónico</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="empresa_proveedor" placeholder="Empresa" />
                    <label for="empresa_proveedor">Empresa</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary saveProveedor">Registrar proveedor</button>
            </div>
        </div>
    </div>
</div>