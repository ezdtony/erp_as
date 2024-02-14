<link rel="stylesheet" href="css/zoom_img.css">
<script>
    $(document).ready(function() {
        $('.zoom').hover(function() {
            $(this).addClass('transition');
        }, function() {
            $(this).removeClass('transition');
        });
    });
</script>
<div id="infoPaymentFinal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="infoPaymentFinalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content modal-filled bg-primary">
            <div class="modal-header">
                <h4 class="modal-title" id="infoPaymentFinalLabel">Información de Pago</h4>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="accordion custom-accordion" id="custom-accordion-one">
                    <div class="card mb-0" style="overflow:auto; ">
                        <div class="card-header" id="headingFour">
                            <h5 class="m-0">
                                <a class="custom-accordion-title d-block py-1" data-bs-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Comprobante de pago <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                </a>
                            </h5>
                        </div>

                        <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-bs-parent="#custom-accordion-one">
                            <div class="card-body">
                                <div id="img_comprobante_pago">

                                </div>
                                <div class="row">
                                    <div class="col-md-12" id="div_descargar_imagen">
                                        
                                        
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card mb-0">
                        <div class="card-header" id="headingFive">
                            <h5 class="m-0">
                                <a class="custom-accordion-title collapsed d-block py-1" data-bs-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Detalles del pago <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-bs-parent="#custom-accordion-one">
                            <div class="card-body">
                                <p class="text-dark">
                                    <strong>Cantidad pagada:</strong>       <span id="lbl_cantidad_pagada"></span>
                                    <br><br><strong>Fecha de pago:</strong> <span id="lbl_pago_fecha"></span>
                                    <br><br><strong>Forma de pago:</strong> <span id="lbl_forma_pago"></span>
                                    <br><br><strong>Proveedor:</strong>  <span id="lbl_empresa_proveedor"></span>
                                    <br><br><strong>CFDI:</strong>          <span id="lbl_pago_cfdi"></span>
                                    <br><br><strong>Comentarios:</strong>          <span id="lbl_comentarios"></span>
                                    <br><br><strong>Pagado vía:</strong>          <span id="lbl_empresa_pago"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-0">
                        <div class="card-header" id="headingSeven">
                            <h5 class="m-0">
                                <a class="custom-accordion-title collapsed d-block py-1" data-bs-toggle="collapse" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    Otros comprobantes <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-bs-parent="#custom-accordion-one">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6" id="btn_2">
                                        
                                    </div>
                                    <div class="col-md-6" id="btn_3">
                                        
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                   

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->