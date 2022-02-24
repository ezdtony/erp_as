<?php

$id_solicitud = $_GET['id_solicitud'];
if ($id_solicitud == '') {
} else {
    $sql_solicitudes = "SELECT cot_des.numero_partida,
    cot_des.`descripcion_material`,
    cot_des.`unidad_medicion`,
    cot_des.`completa`,
    util.descripcion AS utilizacion,
    cot_des.`cantidad`,
    cot_des.`observaciones`,
    CONCAT(
    tit.short_title, ' ', 
    psn.user_name, ' ', 
    psn.user_lastname
    ) AS nombre_solicitante,
    proy.nombre_largo AS proyecto,
        proy.codigo_proyecto ,
        cot_in.fecha_creacion,
        cot_des.`id_cotizaciones_desglose`,
        cot_in.consecutivo_cotizacion,
        cot_in.codigo_cotizacion_chuen,
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
}


?>
<script>
    function runScript(e) {
        //See notes about 'which' and 'key'
        if (e.keyCode == 13) {
            var tb = document.getElementById("scriptBox");
            eval(tb.value);
            return false;
        }
    }
</script>
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
            <h4 class="page-title" id="nombre_informe">Marcar las partidas cotizadas</h4>
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

            <h4 id="codigo_solicitud">Código de solicitud: <?= mb_strtoupper($arr_solicitudes[0]->codigo_cotizacion_chuen) ?></h4>
            <h4 id="pedido">Pedido: <?= mb_strtoupper($arr_solicitudes[0]->utilizacion) ?></h4>
            <h4 id="solicitante">Solicitante: <?= mb_strtoupper($arr_solicitudes[0]->nombre_solicitante) ?></h4>
            <input type="hidden" id="id_solicitud" value="<?= $id_solicitud ?>">



            <br>
            <br>
            <div class=" tab-content">
                <div class="tab-pane show active" id="datatable-button" style="overflow: auto; height: 350px;">
                    <table id="datatable-buttons" class="table table-striped dt-responsive  w-100 tabla_editar_solicitud">
                        <thead class="table-dark">
                            <tr>
                                <th>N. Partida</th>
                                <th>Descripción </th>
                                <th>Utilización</th>
                                <th>Unidad de M.</th>
                                <th>Cantidad </th>
                                <th>Comentarios <span class="badge bg-success rounded-pill">Editable</span></th>
                                <th>Completa</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php foreach ($arr_solicitudes as $solicit) : 
                                
                                $check = '';
                                if ($solicit->completa == 1) {
                                    $check = 'checked';
                                }
                                
                                ?>
                                <tr id="<?= $solicit->numero_partida ?>">
                                    <td column_name="numero_partida"><?= mb_strtoupper($solicit->numero_partida) ?></td>
                                    <td  column_name="descripcion_material"><?= mb_strtoupper($solicit->descripcion_material) ?></td>
                                    <td  column_name="utilizacion"><?= $solicit->utilizacion ?></td>
                                    <td  column_name="unidad_medicion"><?= $solicit->unidad_medicion ?></td>
                                    <td  column_name="cantidad"><?= $solicit->cantidad ?></td>
                                    <td class="td_editable" column_name="observaciones"><?= $solicit->observaciones ?></td>
                                    <td>
                                        <div>
                                            <input type="checkbox" id="switch2<?=$solicit->id_cotizaciones_desglose?>" id_desglose="<?=$solicit->id_cotizaciones_desglose?>" class="partida_cotizada" <?=$check?> data-switch="success" />
                                            <label for="switch2<?=$solicit->id_cotizaciones_desglose?>" data-on-label="Si" data-off-label="No" class="mb-0 d-block"></label>
                                        </div>
                                    </td>


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
include_once('php/views/solicitudes/modals/crear_solicitud.php');
?>
<script src="js/functions/solicitudes.js"></script>
<script src="js/loading.js"></script>