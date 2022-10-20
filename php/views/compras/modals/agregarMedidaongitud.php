<div id="nuevaMedidaLongitud" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="nuevaMedidaLongitudLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="nuevaMedidaLongitudLabel">Registrar nueva medida de longitud</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="example-select" class="form-label">Unidad de longitud</label>
                    <select class="form-select" id="select_um">
                        <option value="" selected disabled>Seleccione una unidad de longitud</option>
                        <?php foreach ($getUnidadesLongitud as $clasificacion) : ?>
                            <option value="<?= $clasificacion->id_unidades_de_longitud ?>"><?= $clasificacion->uindad_longitud ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="medida" placeholder="Medida" />
                    <label for="medida">Medida</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary saveUnidadLongitud">Registrar medida de longitud</button>
            </div>
        </div>
    </div>
</div>