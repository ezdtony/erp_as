<div id="agregarPago" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="agregarPagoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="agregarPagoLabel">Agregar comprobante de pago</h4>
            </div>
            <div class="modal-body">
            <h2 id="lblTituloPagoProyecto"> </h2>   
            <h2 id="lblCodigoPagoProyecto"> </h2>    
            <br>
            <h3>Agregar una captura de pantalla o comprobante electrónico PDF de su pago. </h3>
                <br>
                <div class="row g-2">
                    <div class="col-sm-12">
                        <label class="form-label">Agregar comprobante de pago</label>
                        <input class="form-control" type="file" accept="image/png,image/jpeg" id="input_pago">
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="mb-3">
                        <label for="fecha_pago" class="form-label">Fecha de pago</label>
                        <input type="date" id="fecha_pago" class="form-control">
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label">Comentarios sobre el pago</label>
                        <textarea class="form-control" id="comentarios_pago" rows="3"></textarea>
                    </div>
                    <br>
                    <input type="hidden" id="id_usuario" value="<?= $id_user ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary save_payment_voucher">Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div><!-- /.modal -->