<!-- Small modal -->
<div class="modal fade" id="agregarFotograia" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">Agregar fotografía del gasto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div>
                    <br><br>
                    <div class="col-sm-12">
                    <input type="hidden" id="input_id_gastos_foto">
                        <input type="hidden" id="input_codigo_proyecto_foto">
                        <label class="form-label">Cargar fotografía del ticket de compra</label>
                        <input class="form-control" type="file" id="fotografia_late">
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="guardar_fotografia" class="btn btn-success">Guardar fotografía</button>
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->