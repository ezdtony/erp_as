<div id="agregarFactura" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="agregarFacturaLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title" id="agregarFacturaLabel">Agregar factura / documento</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <h3>Ingrese la información requerida acerca de la cotización: </h3>

                <h2 style="display:none" id="titulo_cotizacion"></h2>
                <h2 id="lblTituloFacturaProyecto"> </h2>
                <h2 id="lblCodigoFacturaProyecto"> </h2>
                <input type="hidden" id="id_proyecto" value="">
                <input type="hidden" id="id_cotizacion" value="">
                <br>
                <br>

                <h3>¿Desea agregar detalles de entrega?</h3>

                <input type="checkbox" id="add_details_delivery" data-switch="bool" />
                <label for="add_details_delivery" data-on-label="Si" data-off-label="No"></label>

                <div id="delivery_details" style="display:none">
                    <br>
                    <h3>Ingrese los datos a continuación solicitados</h3>
                    <br>
                    <br>

                    <br>
                    <div class="mb-3">
                        <div class="row">

                            <div class="col-lg-6">
                                <p class="mb-0">Fecha de entrega</p>
                                <input class="form-control" type="date" name="" id="fecha_entrega">
                            </div>

                            <div class="col-lg-6">
                                <p class="mb-0">Hora de entrega</p>
                                <input class="form-control" type="time" name="" id="hora_entrega">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="example-textarea" class="form-label">Comentarios de entrega / cotización.</label>
                        <textarea class="form-control" id="comentarios_entrega" rows="5"></textarea>
                    </div>
                </div>


                <br>
                <br>
                <h3>Código de cotización (enviada por el proveedor):</h3>
                <div class="mb-3">

                    <form name="send_document" id="send_document" enctype="multipart/form-data" method="post">
                        <label for="txt_fileinput_request" class="form-label">Opcional</label>
                        <input type="text" id="proveedor_codigoA" class="form-control">
                </div>
                <br>
                <br>
                <h3>Agregar archivo correspondiente:</h3>
                <div class="mb-3">

                    <form name="send_document" id="send_document" enctype="multipart/form-data" method="post">
                        <label for="txt_fileinput_request" class="form-label">Seleccionar archivo</label>
                        <input type="file" id="fileinput_request" class="form-control" accept="application/pdf, image/jpeg, image/png, image/jpg">
                </div>
                <div class="mb-3">
                    <label for="example-textarea" class="form-label">Comentarios generales del archivo.</label>
                    <textarea class="form-control" id="comentarios_archivo" rows="5"></textarea>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success btn-send_document">Enviar archivo</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->