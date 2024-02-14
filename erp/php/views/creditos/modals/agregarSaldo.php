<div id="agregarSaldo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="agregarSaldoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="titulo_agregarSaldo">PROVEEDOR</h2>
                <h4 class="modal-title" id="agregarPagoLabel">Agregar saldo al crédito</h4>
            </div>
            <div class="modal-body">
                <br>
                <h3>Agregar una captura de pantalla o comprobante electrónico PDF de su pago. </h3>
                <br>
                <div class="row g-2">
                    <div class="col-sm-12">
                        <label class="form-label">Agregar comprobante de pago</label>
                        <input class="form-control" type="file" accept="image/png,image/jpeg" id="img_pago_extra">
                    </div>
                </div>
                <!-- <div class="row g-2">
                    <div class="col-sm-12">
                        <label class="form-label">Adjuntar PDF</label>
                        <input id="pdf_pago" class="form-control" type="file" accept="application/pdf" id="input_pago">
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-sm-12">
                        <label class="form-label">Adjuntar XML</label>
                        <input class="form-control" id="xml_pago" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="input_pago">
                    </div>
                </div> -->
                <br>
                <br>
                <div class="row g-2">
                    <div class="mb-3">
                        <label for="fecha_pago" class="form-label">Fecha de depósito</label>
                        <input type="date" id="fecha_deposito" class="form-control">
                    </div>
                    <br>
                </div>
                <div class="col-12">
                    <h5 class="card-title">Cantidad</h5>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="select2-preview">
                            <input  id="cantidad" type="number" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="" class="btn btn-primary guardar_saldo_extra">Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div><!-- /.modal -->