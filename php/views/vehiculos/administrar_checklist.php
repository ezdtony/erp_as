<?php
include_once('php/models/vehiculos/vehiculos_model.php');
$vehiculos_model = new ModeloVehiculos;

$getFamiliasPreguntas = $vehiculos_model->getFamiliasPreguntas();
$getTiposPreguntas = $vehiculos_model->getTiposPreguntas();
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Vehículos | Administrar Check - List</h4>
            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modalAgregarfamiliaPreguntas">Agregar clasificación de preguntas</button>
            <br><br>
        </div>
    </div>
</div>
<?php if ($id_area <= 3) : ?>
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
                                            <button data-id="<?= $familia_preguntas->id_familias_preguntas ?>" type="button" class="btn btn-primary waves-effect waves-light agregarGrupoPreguntas" data-bs-toggle="modal" data-bs-target="#modalAgregarGrupoPreguntas">Agregar grupo de preguntas</button>
                                            <br><br>
                                            <?php if (!empty($getGruposPreguntas)) : ?>
                                                <?php foreach ($getGruposPreguntas as $grupos_preguntas) : ?>
                                                    <div class="table-responsive">
                                                        <h5>Grupo de preguntas: <?= $grupos_preguntas->descripcion ?> <br><span class="help-block"><small>RIESGO: <?= $grupos_preguntas->riesgo ?></small></span></h6>
                                                            <br>
                                                            <button data-id="<?= $grupos_preguntas->id_grupos_preguntas ?>" type="button" class="btn btn-info waves-effect waves-light btnAgregarPregunta" data-bs-toggle="modal" data-bs-target="#agregarPregunta">Agregar pregunta</button>
                                                            <br>

                                                            <table class="table table-hover table-centered mb-0 table-responsive tablePreguntasFamilia<?= $familia_preguntas->id_familias_preguntas ?>" id="preguntasGrupo<?= $grupos_preguntas->id_grupos_preguntas ?>">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Pregunta</th>
                                                                        <th>T. de Pregunta</th>
                                                                        <th>Info. Adicional</th>
                                                                        <th>Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $getPreguntas = $vehiculos_model->getPreguntas($grupos_preguntas->id_grupos_preguntas); ?>
                                                                    <?php if (!empty($getPreguntas)) : ?>
                                                                        <?php foreach ($getPreguntas as $preguntas) : ?>
                                                                            <tr id="trpregunta<?= $preguntas->id_preguntas ?>">
                                                                                <td id="td_pregunta<?= $preguntas->id_preguntas ?>"><?= $preguntas->pregunta ?></td>
                                                                                <td>
                                                                                    <select disabled class="form-select selectTipoPregunta" id="tipoPregunta<?= $preguntas->id_preguntas ?>">
                                                                                        <?php foreach ($getTiposPreguntas as $tipos_preguntas) : ?>
                                                                                            <?php if ($tipos_preguntas->id_tipos_preguntas == $preguntas->id_tipos_preguntas) : ?>
                                                                                                <option value="<?= $tipos_preguntas->id_tipos_preguntas ?>" selected><?= $tipos_preguntas->descripcion ?></option>
                                                                                            <?php else : ?>
                                                                                                <option value="<?= $tipos_preguntas->id_tipos_preguntas ?>"><?= $tipos_preguntas->descripcion ?></option>
                                                                                            <?php endif; ?>
                                                                                        <?php endforeach; ?>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="input-group">
                                                                                        <i data-id="<?= $preguntas->id_preguntas ?>" class="fa-solid fa-eye infoAdicional"></i>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="btn-group">
                                                                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                            Opciones
                                                                                        </button>
                                                                                        <div class="dropdown-menu">
                                                                                            <a class="dropdown-item editPregunta" data-tipo-pregunta="<? $preguntas->id_tipos_preguntas ?>" data-bs-toggle="modal" data-bs-target="#editarPregunta" data-id="<?= $preguntas->id_preguntas ?>">Editar</a>
                                                                                            <a class="dropdown-item deletePregunta" data-id="<?= $preguntas->id_preguntas ?>">Eliminar</a>
                                                                                        </div>
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
        <?php endif; ?>
        <?php
        include_once 'modals/AgregarGrupoPreguntas.php';
        include_once 'modals/agregarPregunta.php';
        include_once 'modals/editar_pregunta.php';
        include_once 'modals/agregarFamiliaPreguntas.php';
        ?>
        <script src="js/functions/vehiculos/vehiculos.js"></script>
        <script src="js/loading.js"></script>