<!-- Small modal -->
<div class="modal fade" id="agregarFactura" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">Agregar factura</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div>
                    <br><br>
                    <label class="form-label">Por favor, ingrese los primeros 5 digitos del folio fiscal de la factura (CFDI)</label>
                    <div class="form-floating mb-3">
                        <input type="hidden" id="input_id_gastos">
                        <input type="hidden" id="input_codigo_proyecto">
                        <input type="text" class="form-control" id="folio_fiscal" placeholder="Folio fiscal" />
                        <label for="sitio">Folio fiscal</label>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label">Factura (PDF o Fotografía)</label>
                        <input class="form-control" type="file" id="factura_late">
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="guardar_factura" class="btn btn-success">Cargar Factura</button>
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->