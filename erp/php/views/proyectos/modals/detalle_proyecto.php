<!-- Info Header Modal -->

<div id="infoProyect" class="modal fade" role="dialog" aria-labelledby="infoProyect" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title" id="infoProyect">Información de proyecto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="display-6" id="info_proyect_name"></h1>
                                <h4 id="info_proyect_code">
                                    </h5>
                                    <h6 id="info_proyect_address"></h6>
                                    <br>

                                    <h4>Fecha de inicio</h5>
                                    <h5 id="info_proyect_start_date"></h5>
                                    <h4>Fecha de cierre estimada</h5>
                                    <h5 id="info_proyect_close_aprox_date"></h5>
                                    <h4>Fecha de cierre fin</h5>
                                    <h5 id="info_proyect_close_date"></h5>

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
                                                                <ul class="list-group" id="lista_asignado_detalle">
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="card ribbon-box">
                                                    <div class="card-body">
                                                        <div class="ribbon ribbon-success float-end"><i class="mdi mdi-text-account"></i> Comentarios</div>
                                                        <h5 class="text-success float-start mt-0" id="nombre_comentario"> </h5>
                                                        <div class="ribbon-content" id="comentarios_detalle">
                                                        </div>
                                                    </div> <!-- end card-body -->
                                                </div> <!-- end card-->

                                                <div class="row d-flex align-items-center h-100">
                                                    <div class="col col-lg-12">
                                                        <figure class="bg-white p-3 rounded" style="border-left: .25rem solid #a34e78;">
                                                            <blockquote class="blockquote pb-2">
                                                                <p id="nombre_creador"></p>
                                                            </blockquote>
                                                            <figcaption class="blockquote-footer mb-0 font-italic" id="fecha_creacion"></figcaption>
                                                        </figure>
                                                    </div>
                                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div>
            <div class="modal-footer">
                <button data-bs-dismiss="modal" class="btn btn-info">Aceptar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->