<?php

$id_solicitud = $_GET['id_solicitud'];
if ($id_solicitud == '') {
} else {
    $sql_solicitudes = "SELECT cot_des.numero_partida,
    cot_des.`descripcion_material`,
    cot_des.`unidad_medicion`,
    util.descripcion AS utilizacion,
    cot_des.`cantidad`,
    cot_des.`observaciones`,
    CONCAT(
    tit.short_title, ' ', 
    psn.user_name, ' ', 
    psn.user_lastname
    ) AS/*  */ nombre_solicitante,
    proy.nombre_largo AS proyecto,
        proy.codigo_proyecto ,
        cot_in.fecha_creacion,
        cot_in.consecutivo_cotizacion,
        cot_in.status,
        CONCAT(
        direc.direccion_calle, ' ', 
        direc.direccion_numero, ', ',
        direc.direccion_colonia, ', ',
        direc.direccion_codigo_postal, ', ',
        mun.municipio, ', ',
        est.estado, ', Méx.'
    
        ) AS direccion_proyecto
    FROM uvzuyqbs_constructora.`cotizaciones_desglose` AS cot_des
    INNER JOIN uvzuyqbs_constructora.cotizaciones_index AS cot_in ON cot_des.`id_cotizaciones_index` = cot_in.`id_cotizaciones_index`
    INNER JOIN uvzuyqbs_constructora.lista_personal AS psn ON psn.id_lista_personal = cot_in.id_lista_personal_creo
        INNER JOIN uvzuyqbs_constructora.proveedores AS prov ON prov.id_proveedores = cot_in.id_proveedores
        INNER  JOIN uvzuyqbs_constructora.proyectos AS proy ON proy.id_proyectos = cot_in.id_proyectos
        INNER JOIN uvzuyqbs_constructora.utilizaciones AS util ON util.id_utilizacion = cot_in.id_utilizacion
        INNER JOIN uvzuyqbs_constructora.direcciones AS direc ON proy.id_direccion = direc.iddirecciones
        INNER JOIN uvzuyqbs_constructora.estados AS est ON direc.direccion_estado = est.id
        INNER JOIN uvzuyqbs_constructora.municipios AS mun ON direc.direccion_municipio = mun.id
    INNER JOIN uvzuyqbs_constructora.id_titulos AS tit ON psn.id_titulo = tit.id_titulo
        WHERE cot_des.id_cotizaciones_index = $id_solicitud;
    ";
    $arr_solicitudes = $queries->getData($sql_solicitudes);


    $sql_archivos = "SELECT *  FROM uvzuyqbs_constructora.rutas_archivos WHERE id_cotizacion = '$id_solicitud'";
    $arr_archivos = $queries->getData($sql_archivos);
}


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
            <h4 class="page-title" id="nombre_informe">Lista de Archivos</h4>
        </div>
    </div>
</div>


<div class="col-12">
    <div class="card">
        <div class="card-body">
            <br>
            <h4 id="fecha_solicitud">Fecha de solicitud: <?= mb_strtoupper($arr_solicitudes[0]->fecha_creacion) ?></h4>
            <h4 id="obra">Obra: <?= mb_strtoupper($arr_solicitudes[0]->proyecto) ?></h4>
            <h4 id="direccion">Dirección: <?= mb_strtoupper($arr_solicitudes[0]->direccion_proyecto) ?></h4>

            <h4 id="codigo_solicitud">Código de solicitud: <?= mb_strtoupper($arr_solicitudes[0]->consecutivo_cotizacion) ?></h4>
            <h4 id="pedido">Pedido: <?= mb_strtoupper($arr_solicitudes[0]->utilizacion) ?></h4>
            <h4 id="solicitante">Solicitante: <?= mb_strtoupper($arr_solicitudes[0]->nombre_solicitante) ?></h4>




            <br>
            <br>
            <div class="tab-content">
                <div class="tab-pane show active">
                    <table id="basic-datatable" class="table table-striped table-centered dt-responsive w-100 mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Nombre del Archivo</th>
                                <th class="text-center">Tipo de Archivo</th>
                                <th class="text-center">Código de Cotización</th>
                                <th class="text-center">Fecha de Carga</th>
                                <th class="text-center">Detalles de entrega</th>
                                <th class="text-center">Comentrios de documento</th>
                                <th class="text-center">Descargar</th>
                                <!-- mdi-file-download -->
                            </tr>
                        </thead>


                        <tbody>
                            <?php foreach ($arr_archivos as $archives) :
                                $sql_entregas = "SELECT count(*) as nrows FROM uvzuyqbs_constructora.entregas WHERE id_rutas = '$archives->id_ruta'";
                                $arr_entregas = $queries->getData($sql_entregas);
                                $nrows = $arr_entregas[0]->nrows;

                                
                            ?>
                                <tr id="<?= $archives->id_ruta ?>">
                                    <td class="text-center"><?= mb_strtoupper($archives->nombre_archivo) ?></td>
                                    <td class="text-center"><?= mb_strtoupper($archives->tipo_archivo) ?></td>
                                    <td class="text-center"><?= mb_strtoupper($archives->codigo_proveedor) ?></td>
                                    <td class="text-center"><?= $archives->fecha_upload ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($nrows > 0) {
                                            $sql_entrega_details = "SELECT * FROM uvzuyqbs_constructora.entregas WHERE id_rutas = '$archives->id_ruta'";
                                            $arr_details_delivery = $queries->getData($sql_entrega_details);
                                            $id_entrega = $arr_details_delivery[0]->id_entrega;
                                        ?>
                                            <a class="action-icon delivery_details" id="<?= $id_entrega ?>" data-bs-toggle="modal" data-bs-target="#infoEntrega" data-bs-placement="top" title="Información de entrega"> <i class="mdi mdi-truck-delivery"></i></a>
                                        <?php } else { ?>
                                            <span>Sin detalles de entrega</span>
                                        <?php
                                        }
                                        ?>

                                    </td>
                                    <td class="text-center"><?= $archives->comentarios ?></td>
                                    <?php
                                    if (file_exists($archives->ruta)) {
                                    ?>
                                        <td class="text-center"><a href="<?= $archives->ruta ?>" target="_blank" class="action-icon"> <img src="images/download.png" alt="image" class="img-fluid avatar-sm rounded-circle"></a></td>
                                    <?php  } else {
                                    ?>
                                        <td class="text-center"><a class="action-icon"> <img src="images/error.png" alt="image" class="img-fluid avatar-sm rounded-circle"></a></td>
                                    <?php  }
                                    ?>
                                    </td>
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
<?php
include_once('php/views/solicitudes/modals/info_entrega.php');
?>
<script src="js/functions/solicitudes.js"></script>
<script src="js/loading.js"></script>