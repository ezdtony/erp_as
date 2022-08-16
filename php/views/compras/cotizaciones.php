<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <form class="d-flex">
                    <!-- <a href="javascript: void(0);" class="btn btn-primary ms-2">
                             <i class="mdi mdi-autorenew"></i>
                         </a> -->
                </form>
            </div>
            <h4 class="page-title">Compras | Cotizaciones</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Lista de Cotizaciones</h4>
                <br>
                <button type="button" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#nuevaCotizacion">Nueva cotización</button>
                <br>
                <br>
                <br>

                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Proyecto</th>
                            <th>Sitio</th>
                            <th>Importe</th>
                            <th>Status</th>
                            <th>Ticket</th>
                            <th>F. Fiscal</th>
                            <th>Factura</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        include_once('php/models/viaticos/viatics_model.php');
                        include_once('php/models/compras/cotizaciones_model.php');

                        $compras = new Compras();
                        $getUtilizaciones = $compras->getUtilizaciones($id_user);
                        ?>
                    </tbody>
                </table>
                <br>
            </div>
            <!-- end card-body-->
        </div>
        <!-- end card-->
    </div>
    <!-- end col-->
</div>
<!-- end row -->
<?php
include_once('php/views/compras/modals/nueva_cotizacion.php');

?>
<script src="js/functions/compras/cotizaciones.js"></script>
<script src="js/loading.js"></script>