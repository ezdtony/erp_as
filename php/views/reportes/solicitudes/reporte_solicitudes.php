<?php
if ($id_area >= 3) {
    $sql_solicitudes = "SELECT 
    cot_in.id_cotizaciones_index, 
    CONCAT(psn.user_name, ' ', psn.user_lastname) AS nombre_solicitante,
    util.descripcion AS utilizacion,
    proy.nombre_largo AS proyecto,
    proy.codigo_proyecto ,
    cot_in.fecha_creacion,
    cot_in.consecutivo_cotizacion,
    cot_in.status,
    stat.descripcion AS status_descripcion
    FROM constructora_personal.cotizaciones_index AS cot_in
    INNER JOIN constructora_personal.status_types AS stat ON stat.id_status = cot_in.status
    INNER JOIN constructora_personal.lista_personal AS psn ON psn.id_lista_personal = cot_in.id_lista_personal_creo
    INNER JOIN constructora_personal.proveedores AS prov ON prov.id_proveedores = cot_in.id_proveedores
    INNER  JOIN constructora_personal.proyectos AS proy ON proy.id_proyectos = cot_in.id_proyectos
    INNER JOIN constructora_personal.utilizaciones AS util ON util.id_utilizacion = cot_in.id_utilizacion
    ";
} else if ($id_area >= 5){
    $sql_solicitudes = "
    SELECT 
    cot_in.id_cotizaciones_index, 
    CONCAT(psn.user_name, ' ', psn.user_lastname) AS nombre_solicitante,
    CONCAT(psn1.user_name, ' ', psn1.user_lastname) AS supervisor,
    util.descripcion AS utilizacion,
    proy.nombre_largo AS proyecto,
    proy.codigo_proyecto ,
    cot_in.fecha_creacion,
    cot_in.consecutivo_cotizacion,
    cot_in.status,
    stat.descripcion AS status_descripcion
    FROM constructora_personal.cotizaciones_index AS cot_in
    INNER JOIN constructora_personal.status_types AS stat ON stat.id_status = cot_in.status
    INNER JOIN constructora_personal.lista_personal AS psn ON psn.id_lista_personal = cot_in.id_lista_personal_creo
    INNER JOIN constructora_personal.proveedores AS prov ON prov.id_proveedores = cot_in.id_proveedores
    INNER  JOIN constructora_personal.proyectos AS proy ON proy.id_proyectos = cot_in.id_proyectos
    INNER JOIN constructora_personal.utilizaciones AS util ON util.id_utilizacion = cot_in.id_utilizacion
    INNER JOIN constructora_personal.asignaciones_proyectos AS asp ON psn.id_lista_personal = asp.id_personal AND asp.activo = 1
    INNER JOIN constructora_personal.lista_personal AS psn1 ON psn1.id_lista_personal = $id_user
    ";
}

$arr_solicitudes = $queries->getData($sql_solicitudes);

$sql_status_types = "SELECT * FROM constructora_personal.status_types";
$arr_status_types = $queries->getData($sql_status_types);
?>
<link href="assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css" />
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
            <h4 class="page-title">Lista de Solicitudes</h4>
        </div>
    </div>
</div>


<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane show active"  id="datatable-button">
                    <table id="datatable-buttons" class="table table-striped dt-responsive  w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Consecutivo</th>
                                <th>Fecha</th>
                                <th>Proyecto</th>
                                <th>Pedido</th>
                                <th>Solicitante</th>
                                <th>Estado</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php foreach ($arr_solicitudes as $solicit) :
                                $txt_status = '';
                                $status_descripcion = $solicit->status_descripcion;
                                switch ($solicit->status) {
                                    case '1':
                                        $txt_status = '<i class="mdi mdi-circle text-success"></i> ' . $status_descripcion;

                                        break;
                                    case '2':
                                        $txt_status = '<i class="mdi mdi-circle text-danger"></i>' . $status_descripcion;

                                        break;
                                    case '3':
                                        $txt_status = '<i class="mdi mdi-circle text-warning"></i> ' . $status_descripcion;
                                        break;
                                    case '4':
                                        $txt_status = '<i class="mdi mdi-circle text-info"></i>' . $status_descripcion;
                                        break;
                                    case '5':
                                        $txt_status = '<i class="mdi mdi-circle text-primary"></i>' . $status_descripcion;
                                        break;
                                }
                            ?>
                                <tr id="<?= $solicit->id_cotizaciones_index ?>">
                                    <td><?= $solicit->id_cotizaciones_index ?></td>
                                    <td><?= mb_strtoupper($solicit->consecutivo_cotizacion) ?></td>
                                    <td><?= $solicit->fecha_creacion ?></td>
                                    <td><?= $solicit->proyecto ?></td>
                                    <td><?= $solicit->utilizacion ?></td>
                                    <td><?= $solicit->nombre_solicitante ?></td>
                                    <td id="td_status_<?= $solicit->id_cotizaciones_index ?>"><?= $txt_status ?></td>

                                    
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div> <!-- end preview-->
            </div> <!-- end tab-content-->

        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
</div>
<script src="js/functions/solicitudes.js"></script>
<script src="js/loading.js"></script>
<script src="assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="assets/js/vendor/buttons.html5.min.js"></script>
<script src="assets/js/vendor/buttons.flash.min.js"></script>
<script src="assets/js/vendor/buttons.print.min.js"></script>
<?php
include_once('php/views/solicitudes/modals/info_pago_completa.php');
include_once('php/views/solicitudes/modals/crear_solicitud.php');
include_once('php/views/solicitudes/modals/agregar_factura.php');
include_once('php/views/solicitudes/modals/agregar_pago.php');
include_once('php/views/solicitudes/modals/add_payment_details.php');

?>