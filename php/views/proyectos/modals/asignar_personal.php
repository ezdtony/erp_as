<div id="addPPersonal" class="modal fade" role="dialog" aria-labelledby="addPPersonal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title" id="addPPersonal">Asignar personal a proyecto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="accordion custom-accordion" id="custom-accordion-one">
                            <div class="card mb-0">
                                <div class="card-header" id="headingFour">
                                    <h5 class="m-0">
                                        <a class="custom-accordion-title d-block py-1" data-bs-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                            Personal Asignado a Proyecto <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapseFour" class="collapse hide" aria-labelledby="headingFour" data-bs-parent="#custom-accordion-one">
                                    <div class="card-body">
                                        <ul class="list-group" id="personal_asignado_modal_as">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Seleccione los usuarios que desea agregar</h4>
                                <!-- Multiple Select -->
                                <select id="asignar_personal" class="select2 form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button id="" class="btn btn-info asignar_personal">Asignar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->