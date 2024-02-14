<div id="modalAgregarGrupoPreguntas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalAgregarGrupoPreguntasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalAgregarGrupoPreguntasLabel">Agregar grupo de preguntas</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <!-- <p class="text-muted">Escribe el nombre de la familia de preguntas <span class="badge badge-danger-lighten">Obligatorio</span></p> -->
                    <input type="text" class="form-control" id="grupoPreguntas" placeholder="Nombre de familia de preguntas" />
                    <label for="grupoPreguntas">Nombre del grupo de preguntas <span class="badge badge-danger-lighten">Obligatorio</span></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="riesgo" placeholder="Información adicional" />
                    <label for="riesgo">Riesgo <span class="badge badge-secondary-lighten">Opcional</span></label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btnGuardarGrupoPregunta">Guardar</button>
            </div>
        </div>
    </div>
</div>