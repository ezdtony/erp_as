<!-- Small modal -->
<div class="modal fade" id="newGabinete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">AGREGAR GABINETE</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nombre_gabinete" placeholder="Nombre del gabinete" />
                    <label for="nombre_gabinete">Nombre del gabinete</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="baterias_gabinete" placeholder="Número de baterías" />
                    <label for="baterias_gabinete">Número de baterías</label>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-control select2" id="cerraduras_gabinetes" data-toggle="select2">
                        <option value="" selected disabled>Seleccione una cerradura</option>
                        <?php foreach ($getAllLockTypes as $lockType) : ?>
                            <option value="<?= $lockType->id_tipos_cerraduras ?>"><?= $lockType->descripcion ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary saveGabinete" data-bs-dismiss="modal">Guardar Gabinete</button>
            </div>
        </div>
    </div>
</div>