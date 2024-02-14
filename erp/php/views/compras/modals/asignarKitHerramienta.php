<div class="modal fade" id="asignarKitHerramienta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Archivos cargados</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" id="divasignarKitHerramienta">
                <br>
                <div class="accordion custom-accordion" id="custom-accordion-one">
                    <div class="card mb-0">
                        <div class="card-header" id="headingFour">
                            <h5 class="m-0">
                                <a class="custom-accordion-title d-block py-1" data-bs-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    Personal a quien se ha asignado el kit <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                </a>
                            </h5>
                        </div>

                        <div id="collapseFour" class="collapse hide" aria-labelledby="headingFour" data-bs-parent="#custom-accordion-one">
                            <div class="card-body">
                                <ul class="list-group" id="personal_kit_modal_as">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <h2>Seleccione el personal a quien se le asignará este kit</h2>
                <select class="select2 form-control select2-multiple" data-toggle="select2" multiple="multiple" id="select_asignar_kit" data-placeholder="Seleccione el personal a asignar ...">
                    <?php foreach ($getAllUsers as $personal) : ?>
                        <option value="<?= $personal->id_lista_personal ?>"><?= $personal->nombre_completo ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary waves-effect waves-light asignarKits">Asignar</button>
            </div>
        </div>
    </div>
</div>