<div id="agregarPregunta" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="agregarPreguntaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="agregarPreguntaLabel">Agregar pregunta</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <!-- <p class="text-muted">Escribe el nombre de la familia de preguntas <span class="badge badge-danger-lighten">Obligatorio</span></p> -->
                    <input type="text" class="form-control" id="pregunta" placeholder="Nombre de familia de preguntas" />
                    <label for="pregunta">Ingrese la pregunta <span class="badge badge-danger-lighten">Obligatorio</span></label>
                </div>

                <div class="form-floating mb-3">
                    <p class="text-muted">Seleccione un tipo de pregunta <span class="badge badge-danger-lighten">Obligatorio</span></p>
                    <select class="form-select" id="TipoPregunta">
                        <option disabled selected value="">Seleccione un tipo de pregunta</option>
                        <?php foreach ($getTiposPreguntas as $tipos_preguntas) : ?>
                            <option value="<?= $tipos_preguntas->id_tipos_preguntas ?>"><?= $tipos_preguntas->descripcion ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="infoAdicional" placeholder="Información adicional" />
                    <label for="infoAdicional">Información adicional <span class="badge badge-secondary-lighten">Opcional</span></label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btnGuardarPregunta">Guardar</button>
            </div>
        </div>
    </div>
</div>