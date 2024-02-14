<?php
$getClasificacionesMaterial = $compras->getClasificacionesMaterial();
$getUnidadesMedida = $compras->getUnidadesMedida();
?>

<div id="nuevoConceptoCatalogo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="nuevoConceptoCatalogoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="nuevoConceptoCatalogoLabel">Registrar nuevo material en catálogo</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <h3>Ingrese todos los datos</h3>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nombre_material" placeholder="Descripción de material" />
                            <label for="nombre_material">Descripción de material</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <p class="mb-1 fw-bold text-muted">Clasificación</p>
                        <select class="form-control select2" data-toggle="select2" id="select_clasificacion">
                            <option id="" value="" selected disabled>Seleccione una opción</option>
                            <?php foreach ($getClasificacionesMaterial as $clasificacion) : ?>
                                <option value="<?= $clasificacion->id_clasificaciones_catalogo ?>"><?= $clasificacion->clasificacion ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-lg-6">
                        <p class="mb-1 fw-bold text-muted">Unidad de Medida</p>
                        <select class="form-control select2" data-toggle="select2" id="select_unidad_medida">
                            <option id="" value="" selected disabled>Seleccione una opción</option>
                            <?php foreach ($getUnidadesMedida as $unidades_medida) : ?>
                                <option value="<?= $unidades_medida->id_unidades_medida ?>"><?= $unidades_medida->unidades_medida_long ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-lg-6">

                        <br>
                        <br>
                        <p class="mb-1 fw-bold text-muted">¿Aplicar unidades de longitud? </p>
                        <input type="checkbox" id="apply_ul" data-switch="primary" />
                        <label for="apply_ul" data-on-label="Si" data-off-label="No"></label>
                    </div>
                    <br>
                </div>
                <br>
                <div class="row">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light cerrarNuevoConceptoCatalogo" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary guardarNuevoConcepto">Guardar</button>
            </div>
        </div>
    </div>
</div>