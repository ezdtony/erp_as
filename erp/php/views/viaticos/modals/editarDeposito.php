<!-- Success Header Modal -->
<div id="editarDeposito" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editarDepositoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-success">
                <h4 class="modal-title" id="editarDepositoLabel">Editar Deposito</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <h4>Ingrese toda la información requerida</h4>
                <h6>La información obligatoria está marcada con un asterísco (*)</h6>
                <br>    
                <input type="hidden" id="id_autor" value="<?=$_SESSION['id_user']?>">
                <input type="hidden" id="edit_id_deposito">
                <!-- Single Date Picker -->
                <div class="mb-3">
                    <label class="form-label">Fecha de depósito *</label>
                    <input type="text" class="form-control date" id="edit_fecha_deposito" data-toggle="date-picker" data-single-date-picker="true">
                </div>
                <!-- Single Select -->
                <div class="mb-3">
                    <label class="form-label">Destinatario de depósito *</label>
                    <select id="edit_destinatario" class="form-control select2" data-toggle="select2">
                        <option value="" disabled selected>Elija una opción</option>
                        <optgroup label="Destinatario">
                            <?php foreach ($getAllUsers as $users) : ?>
                                <option value="<?= $users->id_lista_personal ?>"><?= $users->nombre_completo ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Proyecto *</label>
                    <select id="edit_proyecto" class="form-control select2" data-toggle="select2" >
                    </select>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="edit_sitio" placeholder="Nombre del sitio" />
                    <label for="edit_sitio">Nombre del sitio</label>
                </div>
                <!-- Single Select -->
                <div class="mb-3">
                    <label class="form-label">Tipo de gasto *</label>
                    <select id="edit_tipos_gasto" class="form-control select2" data-toggle="select2">
                        <option value="" disabled selected>Elija una opción</option>
                        <optgroup label="Tipo de gasto">
                            <?php foreach ($getViaticsTypes as $expense) : ?>
                                <option value="<?= $expense->id_tipos_gasto ?>"><?= $expense->descripcion ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Importe *</label>
                    <input data-toggle="touchspin" id="edit_importe" type="number" data-bts-max="10000000" data-step="0.01" data-decimals="2" data-bts-prefix="$">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_edit_deposito" class="btn btn-success">Registrar depósito</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->