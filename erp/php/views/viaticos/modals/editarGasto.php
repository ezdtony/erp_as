<!-- Success Header Modal -->
<div id="editarGasto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editarGastoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-warning">
                <h4 class="modal-title" id="editarGastoLabel">Editar Gasto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <h3 id="lbl_folio_editar">Está editando el folio: #16</h3>
                <h4>Ingrese toda la información requerida</h4>
                <h6>La información obligatoria está marcada con un asterísco (*)</h6>
                <br>
                <input type="hidden" id="id_autor_editar" value="<?= $_SESSION['id_user'] ?>">
                <input type="hidden" id="user_name_gasto_editar" value= "<?=$_SESSION['user']?>">
                <input type="hidden" id="id_gasto_editar" value= "">
                <!-- Single Date Picker -->
                <div class="mb-3">
                    <label class="form-label">Fecha de compra *</label>
                    <input type="text" class="form-control date" id="fecha_compra_editar" data-toggle="date-picker" data-single-date-picker="true">
                </div>



                <div class="mb-3">
                    <label class="form-label">Proyecto *</label>
                    <select id="proyecto_gasto_editar" class="form-control select2" data-toggle="select2">
                        <option value="" selected disabled>Seleccione un proyecto</option>
                        <?php
                        $viatics = new ViaticsInformation();
                        $getAllProyectsByUser = $viatics->getProyectsByUser($id_user);
                        foreach ($getAllProyectsByUser as $proyecto) {
                        ?>
                            <option id="<?= $proyecto->id_proyectos ?>" value="<?= $proyecto->id_asignaciones_proyectos ?>"><?= $proyecto->codigo_proyecto . " - " . $proyecto->nombre_proyecto ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="sitio_gasto_editar" placeholder="Nombre del sitio" />
                    <label for="sitio_gasto_editar">Nombre del sitio</label>
                </div>
                <!-- Single Select -->
                <div class="mb-3">
                    <label class="form-label">Tipo de gasto *</label>
                    <select id="tipos_gasto_gasto_editar" class="form-control select2" data-toggle="select2">
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
                    <input data-toggle="touchspin" id="importe_gasto_editar" type="number" data-bts-max="10000000" data-step="0.1" data-decimals="2" data-bts-prefix="$">
                </div>
                </div>
                <br>
                <br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="guardar_gasto_editar" class="btn btn-success">Guardar Cambios</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->