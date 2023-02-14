<?php

?>

<!-- Success Header Modal -->
<div id="registrarGasto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="registrarGastoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-success">
                <h4 class="modal-title" id="registrarGastoLabel">Registrar Gasto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <h4>Ingrese toda la información requerida</h4>
                <h6>La información obligatoria está marcada con un asterísco (*)</h6>
                <br>
                <input type="hidden" id="id_autor" value="<?= $_SESSION['id_user'] ?>">
                <input type="hidden" id="user_name_gasto" value="<?= $_SESSION['user'] ?>">
                <!-- Single Date Picker -->
                <div class="mb-3">
                    <label class="form-label">Fecha de compra *</label>
                    <input disabled type="text" class="form-control date" id="fecha_compra" data-toggle="date-picker" data-single-date-picker="true">
                </div>



                <div class="mb-3">
                    <label class="form-label">Proyecto *</label>
                    <select id="proyecto_gasto" class="form-control select2" data-toggle="select2">
                        <option value="" selected disabled>Seleccione un proyecto</option>
                        <?php
                        $viatics = new ViaticsInformation();
                        $getAllProyectsByUser = $viatics->getProyectsByUser($id_user);
                        foreach ($getAllProyectsByUser as $proyecto) {
                        ?>
                            <option id-proyecto="<?= $proyecto->id_proyectos ?>" value="<?= $proyecto->id_asignaciones_proyectos ?>"><?= $proyecto->codigo_proyecto . " - " . $proyecto->nombre_proyecto ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="sitio_gasto" placeholder="Nombre del sitio" />
                    <label for="sitio">Nombre del sitio</label>
                </div>
                <!-- Single Select -->
                <div class="mb-3">
                    <label class="form-label">Tipo de gasto *</label>
                    <select id="tipos_gasto_gasto" class="form-control select2" data-toggle="select2">
                        <option value="" disabled selected>Elija una opción</option>
                        <optgroup label="Tipo de gasto">
                            <?php foreach ($getViaticsTypes as $expense) : ?>
                                <option value="<?= $expense->id_tipos_gasto ?>"><?= $expense->descripcion ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    </select>
                </div>
                <div class="mb-3" id="div_comentario_gasto" style="display:none">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Ingrese una descripción *" id="comentario_gasto" style="height: 100px;"></textarea>
                        <label for="comentario_gasto">Ingrese una descripción * </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Importe *</label>
                    <input data-toggle="touchspin" id="importe_gasto" type="number" data-bts-max="10000000" data-step="0.1" data-decimals="2" data-bts-prefix="$">
                </div>
                <div class="mb-3">
                    <label class="form-label">Coordenadas *</label>
                    <input id="coordenadas" class = "form-control" disabled>
                </div>
                <div class="col-sm-12">
                    <label class="form-label">Fotografía del ticket</label>
                    <input class="form-control" type="file" id="fotografia_ticket_gasto">
                </div>
                <!-- Inline-->
                <h5>Clasificación *</h5>
                <div class="mt-2">
                    <div class="form-check form-check-inline">
                        <input type="radio" id="deducible" value="1" name="clasificacion_gasto" class="form-check-input">
                        <label class="form-check-label" for="deducible">Deducible</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" id="no_deducible" value="2" name="clasificacion_gasto" class="form-check-input">
                        <label class="form-check-label" for="no_deducible">No deducible</label>
                    </div>
                </div>
                <br>
                <br>
                <div id="div-deducibles" style="display:none">
                    <h5>¿Cuenta con factura?</h5>
                    <!-- Success Switch-->
                    <input type="checkbox" id="check_factura" checked data-switch="success" />
                    <label for="check_factura" data-on-label="Si" data-off-label="No"></label>
                    <br>
                    <div id="div-folio-fiscal">
                        <br><br>
                        <label class="form-label">Por favor, ingrese los primeros 5 digitos del folio fiscal de la factura (CFDI)</label>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="folio_fiscal" placeholder="Folio fiscal" />
                            <label for="sitio">Folio fiscal</label>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label">Factura (PDF o Fotografía)</label>
                            <input class="form-control" type="file" id="factura">
                        </div>
                    </div>

                </div>
            </div>
            <br>
            <br>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_gasto" disabled class="btn btn-success">Registrar gasto</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->