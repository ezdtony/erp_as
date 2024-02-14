<div class="modal fade" id="uploadArchiveCotizacion" tabindex="-1" role="dialog" aria-labelledby="example_modal_title" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="example_modal_title">Adjuntar archivo a cotización</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="archive_description" placeholder="Descripción del archivo" />
                    <label for="archive_description">Descripción del archivo</label>
                </div>

                <div class="mb-3">
                    <label for="example-fileinput" class="form-label">Por favor, seleeccione un archivo (PDF, jpg, png, Word, etc.)</label>
                    <input type="file" id="documento_cotizacion" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" id="btnSubirArchivoCotizacion">Guardar</button>
            </div>
        </div>
    </div>
</div>