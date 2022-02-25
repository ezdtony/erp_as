<?php
if ($id_area == 4) {
    $sql_solicitudes = "SELECT 
    cot_in.id_cotizaciones_index, 
    CONCAT(psn.user_name, ' ', psn.user_lastname) AS nombre_solicitante,
    (SELECT COUNT(*) FROM constructora_personal.cotizaciones_desglose AS desg WHERE desg.`id_cotizaciones_index` = cot_in.id_cotizaciones_index) AS partidas,
    (SELECT COUNT(*) FROM constructora_personal.cotizaciones_desglose AS desg WHERE desg.`id_cotizaciones_index` = cot_in.id_cotizaciones_index AND completa='1') AS partidas_completas,
    util.descripcion AS utilizacion,
    proy.nombre_largo AS proyecto,
    proy.codigo_proyecto ,
    cot_in.fecha_creacion,
    cot_in.codigo_cotizacion_chuen,
    cot_in.consecutivo_cotizacion,
    cot_in.status,
    stat.descripcion AS status_descripcion
    FROM constructora_personal.cotizaciones_index AS cot_in
    INNER JOIN constructora_personal.status_types AS stat ON stat.id_status = cot_in.status
    INNER JOIN constructora_personal.lista_personal AS psn ON psn.id_lista_personal = cot_in.id_lista_personal_creo
    INNER JOIN constructora_personal.proveedores AS prov ON prov.id_proveedores = cot_in.id_proveedores
    INNER  JOIN constructora_personal.proyectos AS proy ON proy.id_proyectos = cot_in.id_proyectos
    INNER JOIN constructora_personal.utilizaciones AS util ON util.id_utilizacion = cot_in.id_utilizacion
    WHERE cot_in.id_lista_personal_creo = $id_user
    ";
} else if ($id_area <= 3) {
    $sql_solicitudes = "SELECT 
    cot_in.id_cotizaciones_index, 
    CONCAT(psn.user_name, ' ', psn.user_lastname) AS nombre_solicitante,
    (SELECT COUNT(*) FROM constructora_personal.cotizaciones_desglose AS desg WHERE desg.`id_cotizaciones_index` = cot_in.id_cotizaciones_index) AS partidas,
    (SELECT COUNT(*) FROM constructora_personal.cotizaciones_desglose AS desg WHERE desg.`id_cotizaciones_index` = cot_in.id_cotizaciones_index AND completa='1') AS partidas_completas,
    util.descripcion AS utilizacion,
    proy.nombre_largo AS proyecto,
    proy.codigo_proyecto ,
    proy.id_proyectos,
    cot_in.fecha_creacion,
    cot_in.consecutivo_cotizacion,
    cot_in.codigo_cotizacion_chuen,
    cot_in.status,
    stat.descripcion AS status_descripcion
    FROM constructora_personal.cotizaciones_index AS cot_in
    INNER JOIN constructora_personal.status_types AS stat ON stat.id_status = cot_in.status
    INNER JOIN constructora_personal.lista_personal AS psn ON psn.id_lista_personal = cot_in.id_lista_personal_creo
    INNER JOIN constructora_personal.proveedores AS prov ON prov.id_proveedores = cot_in.id_proveedores
    INNER  JOIN constructora_personal.proyectos AS proy ON proy.id_proyectos = cot_in.id_proyectos
    INNER JOIN constructora_personal.utilizaciones AS util ON util.id_utilizacion = cot_in.id_utilizacion
    ";
} else if ($id_area >= 5) {
    $sql_solicitudes = "SELECT 
    cot_in.id_cotizaciones_index, 
    CONCAT(psn.user_name, ' ', psn.user_lastname) AS nombre_solicitante,
    CONCAT(psn1.user_name, ' ', psn1.user_lastname) AS supervisor,
    (SELECT COUNT(*) FROM constructora_personal.cotizaciones_desglose AS desg WHERE desg.`id_cotizaciones_index` = cot_in.id_cotizaciones_index) AS partidas,
    (SELECT COUNT(*) FROM constructora_personal.cotizaciones_desglose AS desg WHERE desg.`id_cotizaciones_index` = cot_in.id_cotizaciones_index AND completa='1') AS partidas_completas,
    util.descripcion AS utilizacion,
    proy.nombre_largo AS proyecto,
    proy.codigo_proyecto ,
    cot_in.fecha_creacion,
    cot_in.codigo_cotizacion_chuen,
    cot_in.consecutivo_cotizacion,
    cot_in.status,
    stat.descripcion AS status_descripcion
    FROM constructora_personal.cotizaciones_index AS cot_in
    INNER JOIN constructora_personal.status_types AS stat ON stat.id_status = cot_in.status
    INNER JOIN constructora_personal.lista_personal AS psn ON psn.id_lista_personal = cot_in.id_lista_personal_creo
    INNER JOIN constructora_personal.lista_personal AS psn1 ON psn1.id_lista_personal = $id_user
    INNER JOIN constructora_personal.proveedores AS prov ON prov.id_proveedores = cot_in.id_proveedores
    INNER JOIN constructora_personal.asignaciones_proyectos AS asp ON psn.id_lista_personal = asp.id_personal AND asp.activo = 1
    INNER JOIN constructora_personal.proyectos AS proy ON proy.id_proyectos = cot_in.id_proyectos AND proy.id_proyectos = asp.id_proyecto 
    INNER JOIN constructora_personal.utilizaciones AS util ON util.id_utilizacion = cot_in.id_utilizacion
    
    WHERE  psn1.id_lista_personal = $id_user
    ";
}

$arr_solicitudes = $queries->getData($sql_solicitudes);

$sql_status_types = "SELECT * FROM constructora_personal.status_types";
$arr_status_types = $queries->getData($sql_status_types);

$sql_status_types_res = "SELECT * FROM constructora_personal.status_types WHERE id_status=4 OR id_status = 7 ";
$arr_status_types_residente = $queries->getData($sql_status_types_res);

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
            <h4 class="page-title">Lista de Solicitudes</h4>
        </div>
    </div>
</div>


<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane show active" id="">
                    <table id="basic-datatable" class="table table-striped table-centered dt-responsive w-100 mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Código CHUEN</th>
                                <th>Fecha</th>
                                <th>Proyecto</th>
                                <th>Pedido</th>
                                <?php if (($id_area <= 3 or $id_area >= 5)) : ?>
                                    <th>Cotización</th>
                                <?php endif; ?>
                                <th>Estado</th>
                                <th>Acciones</th>
                                <th>Archivos</th>

                                <?php if (($id_area <= 3 or $id_area >= 5)) : ?>
                                    <th>Cambiar Status</th>
                                    <th>Revisar</th>
                                <?php endif; ?>
                                <th>Solicitante</th>
                                <?php if (($_SESSION['id_area'] == 4)) : ?>
                                    <th>Aprobar</th>
                                <?php endif; ?>
                            </tr>
                        </thead>


                        <tbody>
                            <?php foreach ($arr_solicitudes as $solicit) :

                                $partidas = $solicit->partidas;
                                $partidas_completas = $solicit->partidas_completas;
                                $porcentaje = $partidas_completas / $partidas * 100;

                                if ($porcentaje == 100) {
                                    $bg_barra = 'bg-success';
                                } else if ($porcentaje >= 50 && $porcentaje < 100) {
                                    $bg_barra = 'bg-primary';
                                } else if ($porcentaje < 50 && $porcentaje > 15) {
                                    $bg_barra = 'bg-warning';
                                } else if ($porcentaje <= 15) {
                                    $bg_barra = 'bg-danger';
                                } else {
                                    $bg_barra = 'bg-info';
                                }


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
                                    case '6':
                                        $txt_status = '<i class="mdi mdi-circle text-primary"></i>' . $status_descripcion;
                                        break;
                                    case '7':
                                        $txt_status = '<i class="mdi mdi-circle text-secondary"></i>' . $status_descripcion;
                                        break;
                                    case '8':
                                        $txt_status = '<i class="mdi mdi-circle text-primary"></i>' . $status_descripcion;
                                        break;
                                }
                            ?>
                                <tr id="<?= $solicit->id_cotizaciones_index ?>">
                                    <td><?= $solicit->id_cotizaciones_index ?></td>
                                    <td><?= mb_strtoupper($solicit->codigo_cotizacion_chuen) ?></td>
                                    <td><?= $solicit->fecha_creacion ?></td>
                                    <td><?= $solicit->proyecto ?></td>
                                    <td><?= $solicit->utilizacion ?></td>
                                    <?php if (($_SESSION['id_area'] <= 3 or $id_area >= 5)) : ?>
                                        <td>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar progress-lg <?= $bg_barra ?>" role="progressbar" style="width: <?= $porcentaje ?>%" aria-valuenow="<?= $porcentaje ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                    <td id="td_status_<?= $solicit->id_cotizaciones_index ?>"><?= $txt_status ?></td>

                                    <td class="table-action">
                                        <a href="?submodule=desglose_solicitud&id_solicitud=<?= $solicit->id_cotizaciones_index ?>" target="_blank" class="action-icon" data-bs-placement="top" title="Lista completa"> <i class="mdi mdi-beaker-alert-outline"></i></a>
                                        <?php if (($_SESSION['id_area'] <= 3 or $id_area >= 5)) :
                                            $sql_pago = "SELECT COUNT(*) AS reg FROM constructora_personal.pagos_cotizaciones
                                            WHERE id_cotizaciones_index = '$solicit->id_cotizaciones_index' ORDER BY id_pagos_cotizaciones DESC LIMIT 1 ";
                                            $arr_count_pagos = $queries->getData($sql_pago);
                                            $count_pagos = $arr_count_pagos[0]->reg;
                                            if ($count_pagos == 0) { ?>
                                                <a class="action-icon icon_add_payment_voucher" id_proyect="<?= $solicit->id_proyectos ?>" id="<?= $solicit->id_cotizaciones_index ?>" data-bs-toggle="modal" data-bs-target="#agregarPago" data-bs-placement="top" title="Agregar pago"> <i class="mdi mdi-cash-plus"></i></a>
                                            <?php } else {

                                                $sql_pago_count = "SELECT COUNT(*) AS counts FROM constructora_personal.pagos_cotizaciones
                                                WHERE id_cotizaciones_index = '$solicit->id_cotizaciones_index' AND url_pdf IS NOT NULL AND url_xml IS NOT NULL ORDER BY id_pagos_cotizaciones DESC LIMIT 1 ";
                                                $arr_pagos_count = $queries->getData($sql_pago_count);
                                                $id_pagos_count = $arr_pagos_count[0]->counts;

                                                $sql_pago_2 = "SELECT * FROM constructora_personal.pagos_cotizaciones
                                                WHERE id_cotizaciones_index = '$solicit->id_cotizaciones_index' ORDER BY id_pagos_cotizaciones DESC LIMIT 1 ";
                                                $arr_pagos = $queries->getData($sql_pago_2);
                                                $id_pagos = $arr_pagos[0]->id_pagos_cotizaciones;
                                            ?>
                                                <a class="action-icon icon_edit_payment_voucher" id="<?= $id_pagos ?>" data-bs-placement="top" title="Ya se agregó el pago"> <i class="mdi mdi-cash-check"></i></a>
                                                <a class="action-icon add_payment_info" id_proyect="<?= $solicit->id_proyectos ?>" id="<?= $id_pagos ?>" data-bs-toggle="modal" data-bs-target="#agregarInformacionPago" data-bs-placement="top" title="Agregar / cambiar información de pago"> <i class="mdi mdi-cash-register"></i></a>
                                                <?php if ($id_pagos_count > 0) {  ?>
                                                    <a class="action-icon payment_info_final" id="<?= $id_pagos ?>" data-bs-toggle="modal" data-bs-target="#infoPaymentFinal" data-bs-placement="top" title="Información de pago"> <i class="mdi mdi-information"></i></a>

                                            <?php }
                                            }
                                            ?>



                                        <?php endif; ?>
                                    </td>
                                    <td id="td_status_<?= $solicit->id_cotizaciones_index ?>">
                                        <a class="action-icon add_document_request" id_proyect="<?= $solicit->id_proyectos ?>" id="<?= $solicit->id_cotizaciones_index ?>" data-bs-toggle="modal" data-bs-target="#agregarFactura" data-bs-placement="top" title="Subir Archivo"> <i class="mdi mdi-cloud-upload"></i></a>
                                        <?php
                                        $sql_archivos = "SELECT COUNT(*) AS nrows FROM constructora_personal.rutas_archivos WHERE id_cotizacion = '$solicit->id_cotizaciones_index'";
                                        $arr_archivos = $queries->getData($sql_archivos);
                                        $nrows = $arr_archivos[0]->nrows;
                                        if ($nrows > 0) {
                                        ?>

                                            <a href="?submodule=lista_archivos&id_solicitud=<?= $solicit->id_cotizaciones_index ?>" target="_blank" class="action-icon" data-bs-placement="top" title="Carpeta de archivos"> <i class="mdi mdi-folder-open"></i></a>

                                        <?php } else { ?>
                                            <a href="#" class="action-icon"> <i class="mdi mdi-folder-remove" data-bs-placement="top" title="Sin archivos"></i></a>
                                        <?php } ?>
                                    </td>
                                    <?php if (($_SESSION['id_area'] <= 3 or $id_area >= 5)) : ?>
                                        <td>
                                            <select id="<?= $solicit->id_cotizaciones_index ?>" class="form-select mb-3 id_status">
                                                <option>Seleccione una opción</option>
                                                <?php foreach ($arr_status_types as $status_type) : ?>
                                                    <?php if ($status_type->id_status == $solicit->status) { ?>
                                                        <option value="<?= $status_type->id_status ?>" selected><?= $status_type->descripcion ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $status_type->id_status ?>"><?= $status_type->descripcion ?></option>
                                                    <?php }
                                                    ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td class="table-action">
                                            <a href="?submodule=revision_partidas&id_solicitud=<?= $solicit->id_cotizaciones_index ?>" target="_blank" class="action-icon"> <i class="mdi mdi-beaker-check" data-bs-placement="top" title="Revisar partidas"></i></a>

                                        </td>
                                    <?php endif; ?>
                                    <td><?= $solicit->nombre_solicitante ?></td>
                                    <?php if (($_SESSION['id_area'] == 4)) :

                                        $select_enable = 'disabled';
                                        if ($solicit->status == 8) {
                                            $select_enable = '';
                                        }

                                    ?>
                                        <td>
                                            <select <?= $select_enable ?> id="<?= $solicit->id_cotizaciones_index ?>" class="form-select mb-3 id_status">
                                                <option value="" selected disabled>Seleccione una opción</option>
                                                <?php foreach ($arr_status_types_residente as $status_type_r) : ?>
                                                    <?php if ($status_type_r->id_status == $solicit->status) { ?>
                                                        <option value="<?= $status_type_r->id_status ?>" selected><?= $status_type_r->descripcion ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $status_type_r->id_status ?>"><?= $status_type_r->descripcion ?></option>
                                                    <?php }
                                                    ?>


                                                <?php endforeach; ?>
                                            </select>
                                        </td>


                                    <?php endif; ?>
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
<?php
include_once('php/views/solicitudes/modals/info_pago_completa.php');
include_once('php/views/solicitudes/modals/crear_solicitud.php');
include_once('php/views/solicitudes/modals/agregar_factura.php');
include_once('php/views/solicitudes/modals/agregar_pago.php');
include_once('php/views/solicitudes/modals/add_payment_details.php');

?>