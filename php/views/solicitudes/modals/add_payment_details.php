<?php
$sql_fomras_pago = "SELECT * FROM constructora_personal.formas_pago WHERE id_formas_pago > 1";
$arr_f_pago = $queries->getData($sql_fomras_pago);

$sql_proveedores = "SELECT DISTINCT id_proveedores, empresa_proveedor FROM constructora_personal.proveedores";
$arr_proveedores = $queries->getData($sql_proveedores);

$sql_payment_enterprise = "SELECT * FROM constructora_personal.payment_enterprise";
$arr_payment_enterprise = $queries->getData($sql_payment_enterprise);

$sql_creditos = "SELECT * FROM constructora_personal.creditos ";

    $arr_creditos = $queries->getData($sql_creditos);

?>

<div id="agregarInformacionPago" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="agregarInformacionPagoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="agregarInformacionPagoLabel">Agregar información de pago</h4>
            </div>
            <div class="modal-body">
                <h2 id="lblTituloDDetailsProyecto"> </h2>
                <h2 id="lblCodigoDDetailsProyecto"> </h2>
                <h3>Agregar información sobre el pago realizado. </h3>
                <br>
                <div class="row g-2">

                    <div class="col-sm-6">
                        <label class="form-label">Cantidad pagada</label>
                        <input id="cantidad_pago" value="" type="number" step="0.01" class="form-control">
                        <span class="font-13 text-muted">Verífique que la cantidad conicida con la mostrada en el comprobante de pago</span>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">Proveedor</label>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="select2-preview">
                                <select id="id_proveedor" class="form-control select2" data-toggle="select2">
                                    <option value="">** Seleccione una opción</option>

                                    <optgroup label="Proveedor">
                                        <?php foreach ($arr_proveedores as $proveedores) : ?>
                                            <option value="<?= $proveedores->id_proveedores ?>"><?= mb_strtoupper($proveedores->empresa_proveedor) ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">Forma de pago</label>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="select2-preview">
                                <select id="id_forma_pago" class="form-control select2" data-toggle="select2">
                                    <option selected disabled value="">** Seleccione una opción</option>

                                    <optgroup label="Formas de pago">
                                        <?php foreach ($arr_f_pago as $pago) : ?>
                                            <option value="<?= $pago->id_formas_pago ?>"><?= mb_strtoupper($pago->descripcion) ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="display:none;" id="div_credito">
                        <label class="form-label">Crédito origen</label>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="select2-preview">
                                <select id="id_credito" class="form-control select2" data-toggle="select2">
                                    <option selected disabled value="">** Seleccione una opción</option>

                                    <optgroup label="Crédito">
                                        <?php foreach ($arr_creditos as $credito) : ?>
                                            <option value="<?= $credito->id_credito ?>"><?= mb_strtoupper($credito->proveedor) ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <input type="hidden" id="id_usuario" value="<?= $id_user ?>">
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-sm-12">
                        <label class="form-label">Agregar comprobante de pago (PDF)</label>
                        <input id="pdf_pago" class="form-control" type="file" accept="application/pdf" id="input_pago">
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-sm-12">
                        <label class="form-label">Agregar comprobante de pago (XML)</label>
                        <input class="form-control" id="xml_pago" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="input_pago">
                    </div>
                </div>
                <br>
                <div class="row g-2">

                    <div class="col-sm-6">
                        <label class="form-label">Código CFDI</label>
                        <input id="cfdi" type="text" value="" class="form-control">
                    </div>
                    <br>
                </div>

                <div class="row g-2">

                    <div class="row g-2">
                        <label class="form-label">Se paga con...</label>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="select2-preview">
                                <select id="id_empresa_pagocon" class="form-control select2" data-toggle="select2">
                                    <option value="" selected disabled>** Seleccione una opción</option>

                                    <optgroup label="Formas de pago">
                                        <?php foreach ($arr_payment_enterprise as $payment_enterprise) : ?>
                                            <option value="<?= $payment_enterprise->id_empresa_pago_lis ?>"><?= mb_strtoupper($payment_enterprise->descripcion) ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                </div>
                <br>
                <br>
                <div class="row g-2">

                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="comentarios_payment_details" style="height: 100px;"></textarea>
                        <label for="comentarios_payment_details">Comentarios</label>
                    </div>
                </div>
                <br>

            </div><!-- /.modal-content -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary save_payment_details">Guardar</button>
            </div>

        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>