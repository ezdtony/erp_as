<?php
include_once('php/models/vehiculos/vehiculos_model.php');
$vehiculos_model = new ModeloVehiculos;

$getFamiliasPreguntas = $vehiculos_model->getFamiliasPreguntas();
$getTiposPreguntas = $vehiculos_model->getTiposPreguntas();
?>

<div id="registrarRevision" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="registrarRevisionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="registrarRevisionLabel">Registrar revision</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body ">
                <h3>REVISIÓN DE UNIDAD LOBO 2003</h3>
                <div class="form-floating mb-3">
                    <div class="row" id="rowFamiliasPreguntas">
                        <?php foreach ($getFamiliasPreguntas as $familia_preguntas) : ?>
                            <div class="col-xl-12">
                                <div class="card card-h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h4 class="header-title"><?= $familia_preguntas->descripcion ?> <br></h4>

                                            <br>
                                            <div class="accordion accordion-flush" id="familiaPreguntas<?= $familia_preguntas->id_familias_preguntas ?>">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-heading<?= $familia_preguntas->id_familias_preguntas ?>">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#desglosePreguntas<?= $familia_preguntas->id_familias_preguntas ?>" aria-expanded="false" aria-controls="desglosePreguntas<?= $familia_preguntas->id_familias_preguntas ?>">
                                                            DESGLOSE DE PREGUNTAS
                                                        </button>
                                                    </h2>
                                                    <div id="desglosePreguntas<?= $familia_preguntas->id_familias_preguntas ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $familia_preguntas->id_familias_preguntas ?>" data-bs-parent="#familiaPreguntas<?= $familia_preguntas->id_familias_preguntas ?>">
                                                        <div class="accordion-body" id="accordion<?= $familia_preguntas->id_familias_preguntas ?>">
                                                            <?php
                                                            $getGruposPreguntas = $vehiculos_model->getGruposPreguntas($familia_preguntas->id_familias_preguntas);
                                                            ?>
                                                            <br><br>
                                                            <?php if (!empty($getGruposPreguntas)) : ?>
                                                                <?php foreach ($getGruposPreguntas as $grupos_preguntas) : ?>
                                                                    <div class="table-responsive">
                                                                        <div class="bg-primary p-2 text-white bg-opacity-25">
                                                                            <h5><?= $grupos_preguntas->descripcion ?> <br><span class="help-block"><small>RIESGO: <?= $grupos_preguntas->riesgo ?></small></span></h6>
                                                                        </div>

                                                                        <br>

                                                                        <table class="table table-hover table-centered mb-0 table-responsive tablePreguntasFamilia<?= $familia_preguntas->id_familias_preguntas ?>" id="preguntasGrupo<?= $grupos_preguntas->id_grupos_preguntas ?>">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Pregunta</th>
                                                                                    <th>Info. Adicional</th>
                                                                                    <th>Respuesta</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php $getPreguntas = $vehiculos_model->getPreguntas($grupos_preguntas->id_grupos_preguntas); ?>
                                                                                <?php if (!empty($getPreguntas)) : ?>
                                                                                    <?php foreach ($getPreguntas as $preguntas) : ?>
                                                                                        <tr id="trpregunta<?= $preguntas->id_preguntas ?>">
                                                                                            <td id="td_pregunta<?= $preguntas->id_preguntas ?>"><?= $preguntas->pregunta ?></td>
                                                                                            <td>
                                                                                                <div class="input-group">
                                                                                                    <i data-id="<?= $preguntas->id_preguntas ?>" class="fa-solid fa-eye infoAdicional"></i>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?php if ($preguntas->id_tipos_preguntas == 1): ?>
                                                                                                    <?php $getPosiblesRespuestas = $vehiculos_model->getPosiblesRespuestas($preguntas->id_tipos_preguntas); ?>
                                                                                                <select data-pregunta="<?=$preguntas->pregunta?>" data-type="<?=$preguntas->id_tipos_preguntas?>" class="form-select selectTipoPregunta varialbesPreguntas" data-id="<?= $preguntas->id_preguntas ?>" id="respuesta<?= $preguntas->id_preguntas ?>">
                                                                                                    <option value="" selected disabled>Seleccione una opción</option>
                                                                                                    <?php foreach ($getPosiblesRespuestas as $posibles_respuestas): ?>
                                                                                                            <option value="<?= $posibles_respuestas->respuesta ?>"><?= $posibles_respuestas->respuesta ?></option>
                                                                                                    <?php endforeach; ?>
                                                                                                </select>
                                                                                                <?php elseif($preguntas->id_tipos_preguntas == 2): ?>
                                                                                                    <input data-pregunta="<?=$preguntas->pregunta?>" data-type="<?=$preguntas->id_tipos_preguntas?>" type="text" class="form-control varialbesPreguntas" data-id="<?= $preguntas->id_preguntas ?>" id="respuesta<?= $preguntas->id_preguntas ?>">
                                                                                                <?php endif; ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                    <?php endforeach; ?>
                                                                                <?php else : ?>
                                                                                    <tr colspan="100%">
                                                                                        <td colspan="100%">
                                                                                            <div class="alert alert-danger" role="alert">
                                                                                                No hay preguntas registradas
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php endif; ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <br>
                                                                    <br>
                                                                <?php endforeach; ?>
                                                            <?php else : ?>
                                                                <div class="alert alert-danger" role="alert">
                                                                    No hay grupos de preguntas registradas
                                                                </div>
                                                                <br>
                                                                <br>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        < </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary guardarRevision">Guardar</button>
                </div>
            </div>
        </div>
    </div>