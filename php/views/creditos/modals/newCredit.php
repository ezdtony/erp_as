<!-- Primary Header Modal -->
<div id="newCredit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="newCreditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title" id="newCreditLabel">Agregar nuevo Crédito</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
            <h3>Ingresar la información requerida para registrar un crédito</h3>
            <br><br>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="proveedor" placeholder="Ingrese el proveedor" />
                    <label for="floatingInput">Proveedor</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="fiscal_code" placeholder="Ingrese el folio fiscal" />
                    <label for="floatingInput">Folio Fiscal</label>
                </div>
                <div class="col-lg-6">
                    <p class="mb-0">Fecha de Pago</p>
                    <input class="form-control" type="date" name="" id="fecha_pago">
                </div>
                <br>
                <br>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="monto_pago" placeholder="Ingrese el folio fiscal" />
                    <label for="floatingInput">Monto de pago</label>
                </div>
                <div class="row g-2">
                    <div class="col-sm-12">
                        <label class="form-label">Adjuntar comprobante de pago</label>
                        <input id="img_pago" class="form-control" type="file" accept="image/png,image/jpg,image/jpeg" id="img_pago">
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-sm-12">
                        <label class="form-label">Adjuntar PDF</label>
                        <input id="pdf_pago" class="form-control" type="file" accept="application/pdf" id="pdf_pago">
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-sm-12">
                        <label class="form-label">Adjuntar XML</label>
                        <input class="form-control" id="xml_pago" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="input_pago">
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary save_credit">Guardar Crédito</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
