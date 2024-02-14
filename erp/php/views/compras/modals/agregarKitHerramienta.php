<div id="addKit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addKitLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addKitLabel">Registrar nuevo kit de herramienta</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nombre_de_kit" placeholder="Nombre del Kit" />
                    <label for="abreviatura_tipo_kit">Nombre del Kit</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-control select2" data-toggle="select2" id="select_id_tipos_kits_herramienta">
                        <option selected disabled>Seleccione un tipo de kit</option>
                        <?php foreach ($getTiposKitsHerramienta as $tipos_kits) : ?>
                            <option value="<?= $tipos_kits->id_tipos_kits_herramienta ?>"><?= $tipos_kits->nombre_corto ?> | <span class="badge bg-primary"><?= $tipos_kits->descripcion_tipo ?></span></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary saveKit">Registrar tipo de kit</button>
            </div>
        </div>
    </div>
</div>