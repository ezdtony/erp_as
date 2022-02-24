<?php

?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <form class="d-flex">
                    <!-- <a href="javascript: void(0);" class="btn btn-primary ms-2">
                             <i class="mdi mdi-autorenew"></i>
                         </a> -->
                    <!--   <button type="button" class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#createSolicitud" data-bs-placement="top" title="Nueva solicitud">
                        <i class="mdi mdi-note-plus"></i>
                    </button> -->
                </form>
            </div>
            <h4 class="page-title">Reportes</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-4 col-lg-3">
        <div class="card cta-box overflow-hidden">
            <a href="?submodule=reporte_solicitudes">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="text-uppercase mt-0">Solicitudes</h6>
                            <h2 class="my-2" id="active-users-count">Reporte de Solicitudes General</h2>
                            <p class="mb-0 text-muted">
                        </div>
                        <img class="ms-3" src="images/solicitud.png" width="92" alt="Generic placeholder image">
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-4 col-lg-3">
        <div class="card cta-box overflow-hidden">
            <a href="?submodule=reporte_solicitudes_proyecto">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="text-uppercase mt-0">Solicitudes</h6>
                            <h2 class="my-2" id="active-users-count">Reporte de Solicitudes por Proyecto</h2>
                            <p class="mb-0 text-muted">
                        </div>
                        <img class="ms-3" src="images/clipboard.png" width="92" alt="Generic placeholder image">
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
</div>
<script src="js/functions/solicitudes.js"></script>
<script src="js/loading.js"></script>
<?php
include_once('php/views/solicitudes/modals/info_pago_completa.php');
include_once('php/views/solicitudes/modals/crear_solicitud.php');
include_once('php/views/solicitudes/modals/agregar_factura.php');
include_once('php/views/solicitudes/modals/agregar_pago.php');
include_once('php/views/solicitudes/modals/add_payment_details.php');

?>