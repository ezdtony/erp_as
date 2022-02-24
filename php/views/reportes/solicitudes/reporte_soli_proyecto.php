<?php
if (isset($_GET['submodule']) && isset($_GET['id_proyecto'])) {
    $id_proyecto = $_GET['id_proyecto'];
    if ($id_area == 4) {
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
        FROM uvzuyqbs_constructora.cotizaciones_index AS cot_in
        INNER JOIN uvzuyqbs_constructora.status_types AS stat ON stat.id_status = cot_in.status
        INNER JOIN uvzuyqbs_constructora.lista_personal AS psn ON psn.id_lista_personal = cot_in.id_lista_personal_creo
        INNER JOIN uvzuyqbs_constructora.proveedores AS prov ON prov.id_proveedores = cot_in.id_proveedores
        INNER  JOIN uvzuyqbs_constructora.proyectos AS proy ON proy.id_proyectos = cot_in.id_proyectos
        INNER JOIN uvzuyqbs_constructora.utilizaciones AS util ON util.id_utilizacion = cot_in.id_utilizacion
        WHERE cot_in.id_lista_personal_creo = $id_user AND cot_in.id_proyectos = $id_proyecto
        ";
    } else  if ($id_area <= 3) {
        $sql_solicitudes = "SELECT 
        cot_in.id_cotizaciones_index, 
        CONCAT(psn.user_name, ' ', psn.user_lastname) AS nombre_solicitante,
        util.descripcion AS utilizacion,
        proy.nombre_largo AS proyecto,
        proy.codigo_proyecto ,
        CASE 
        WHEN codigo_cotizacion_chuen IS NULL
         THEN 'S/I' 
         ELSE codigo_cotizacion_chuen
        END AS codigo_cotizacion_chuen,
        
        DATE(cot_in.fecha_creacion) AS fecha_creacion,
        cot_in.consecutivo_cotizacion,
        cot_in.status,
        stat.descripcion AS status_descripcion,
        rut.importe_cotizacion,
        CASE 
        WHEN rut.importe_cotizacion IS NULL
         THEN 'S/I' 
         ELSE CONCAT('$ ', rut.importe_cotizacion)
        END AS importe_cotizacion,
    
        CASE 
        WHEN rut.codigo_proveedor IS NULL
         THEN 'S/I' 
         ELSE rut.codigo_proveedor
        END AS codigo_proveedor,
        pac.cfdi,
        CASE 
        WHEN pac.cfdi IS NULL
         THEN 'S/I' 
         ELSE pac.cfdi
        END AS cfdi,
        prov.empresa_proveedor,
        CASE 
        WHEN prov.empresa_proveedor IS NULL
         THEN 'S/I' 
         ELSE prov.empresa_proveedor
        END AS empresa_proveedor,
        CASE 
        WHEN pac.cantidad_pago IS NULL
         THEN 'S/I' 
         ELSE CONCAT('$ ', pac.cantidad_pago)
        END AS cantidad_pago,
        CASE 
        WHEN DATE(pac.fecha_pago)  IS NULL
         THEN 'S/I' 
         ELSE DATE(pac.fecha_pago)
        END AS fecha_pago
    
        FROM uvzuyqbs_constructora.cotizaciones_index AS cot_in
        INNER JOIN uvzuyqbs_constructora.status_types AS stat ON stat.id_status = cot_in.status
        INNER JOIN uvzuyqbs_constructora.lista_personal AS psn ON psn.id_lista_personal = cot_in.id_lista_personal_creo
        
        INNER  JOIN uvzuyqbs_constructora.proyectos AS proy ON proy.id_proyectos = cot_in.id_proyectos
        INNER JOIN uvzuyqbs_constructora.utilizaciones AS util ON util.id_utilizacion = cot_in.id_utilizacion
        LEFT JOIN uvzuyqbs_constructora.rutas_archivos AS rut ON rut.id_cotizacion = cot_in.id_cotizaciones_index
        LEFT JOIN uvzuyqbs_constructora.pagos_cotizaciones AS pac ON pac.id_cotizaciones_index = cot_in.id_cotizaciones_index
        LEFT JOIN uvzuyqbs_constructora.proveedores AS prov ON prov.id_proveedores = pac.id_proveedores
        WHERE  cot_in.id_proyectos = $id_proyecto
        ";
    } else  if ($id_area >= 5) {
        $sql_solicitudes = "SELECT 
        cot_in.id_cotizaciones_index, 
        CONCAT(psn.user_name, ' ', psn.user_lastname) AS nombre_solicitante,
        util.descripcion AS utilizacion,
        proy.nombre_largo AS proyecto,
        proy.codigo_proyecto ,
        CASE 
        WHEN codigo_cotizacion_chuen IS NULL
         THEN 'S/I' 
         ELSE codigo_cotizacion_chuen
        END AS codigo_cotizacion_chuen,
        
        DATE(cot_in.fecha_creacion) AS fecha_creacion,
        cot_in.consecutivo_cotizacion,
        cot_in.status,
        stat.descripcion AS status_descripcion,
        rut.importe_cotizacion,
        CASE 
        WHEN rut.importe_cotizacion IS NULL
         THEN 'S/I' 
         ELSE CONCAT('$ ', rut.importe_cotizacion)
        END AS importe_cotizacion,
    
        CASE 
        WHEN rut.codigo_proveedor IS NULL
         THEN 'S/I' 
         ELSE rut.codigo_proveedor
        END AS codigo_proveedor,
        pac.cfdi,
        CASE 
        WHEN pac.cfdi IS NULL
         THEN 'S/I' 
         ELSE pac.cfdi
        END AS cfdi,
        prov.empresa_proveedor,
        CASE 
        WHEN prov.empresa_proveedor IS NULL
         THEN 'S/I' 
         ELSE prov.empresa_proveedor
        END AS empresa_proveedor,
        CASE 
        WHEN pac.cantidad_pago IS NULL
         THEN 'S/I' 
         ELSE CONCAT('$ ', pac.cantidad_pago)
        END AS cantidad_pago,
        CASE 
        WHEN DATE(pac.fecha_pago)  IS NULL
         THEN 'S/I' 
         ELSE DATE(pac.fecha_pago)
        END AS fecha_pago
    
        FROM uvzuyqbs_constructora.cotizaciones_index AS cot_in
        INNER JOIN uvzuyqbs_constructora.status_types AS stat ON stat.id_status = cot_in.status
        INNER JOIN uvzuyqbs_constructora.asignaciones_proyectos AS asp ON  asp.id_personal = $id_user AND asp.activo = 1
        INNER JOIN uvzuyqbs_constructora.lista_personal AS psn ON psn.id_lista_personal = cot_in.id_lista_personal_creo
        INNER JOIN uvzuyqbs_constructora.lista_personal AS psn1 ON psn1.id_lista_personal = $id_user
        INNER  JOIN uvzuyqbs_constructora.proyectos AS proy ON proy.id_proyectos = cot_in.id_proyectos AND asp.id_proyecto = proy.id_proyectos
        INNER JOIN uvzuyqbs_constructora.utilizaciones AS util ON util.id_utilizacion = cot_in.id_utilizacion
        LEFT JOIN uvzuyqbs_constructora.rutas_archivos AS rut ON rut.id_cotizacion = cot_in.id_cotizaciones_index
        RIGHT JOIN uvzuyqbs_constructora.pagos_cotizaciones AS pac ON pac.id_cotizaciones_index = cot_in.id_cotizaciones_index
        LEFT JOIN uvzuyqbs_constructora.proveedores AS prov ON prov.id_proveedores = pac.id_proveedores
        WHERE  cot_in.id_proyectos = $id_proyecto
        ";
    }
    $sql_status_types = "SELECT * FROM uvzuyqbs_constructora.status_types";
    $arr_status_types = $queries->getData($sql_status_types);


    $arr_solicitudes = $queries->getData($sql_solicitudes);
}

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
            <h4 class="page-title" id="nombre_informe">Lista de Solicitudes Por Proyecto</h4>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mt-2 mb-3">Seleccionar un proyecto</h4>
            <br>
            <select id="id_proyecto" class="form-select form-select-lg mb-3">
                <option selected value="" disabled>Seleccionar proyecto</option>
                <?php foreach ($getProyects as $proyectos) : ?>
                    <?php if (isset($_GET['id_proyecto'])) {
                        if ($_GET['id_proyecto'] == $proyectos->id_proyectos) {  ?>
                            <option selected value="<?= $proyectos->id_proyectos ?>"><?= $proyectos->nombre_largo ?></option>
                        <?php } else { ?>
                            <option value="<?= $proyectos->id_proyectos ?>"><?= $proyectos->nombre_largo ?></option>
                        <?php }
                    } else { ?>
                        <option value="<?= $proyectos->id_proyectos ?>"><?= $proyectos->nombre_largo ?></option>
                    <?php } ?>

                <?php endforeach; ?>
            </select>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
<!-- Datatables css -->
<link href="assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
<link href="assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
<?php
if (isset($_GET['submodule']) && isset($_GET['id_proyecto'])) {
?>
    <?php if (!empty($arr_solicitudes)) : ?>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <h6 id="fecha_solicitud" class="display-5">Proyecto: <?= $arr_solicitudes[0]->proyecto ?></h6>
                        <h6 id="codigo_solicitud" class="display-5">Código de proyecto: <?= $arr_solicitudes[0]->codigo_proyecto ?></h6>
                        <div class="tab-pane show active" id="datatable-button">

                            <table id="datatable-buttons" class="table table-striped table-responsive-sm table-centered dt-responsive w-100 mb-0">
                                <thead>
                                    <tr>
                                        <th>Proyecto</th>
                                        <th>Fecha</th>
                                        <th>Consecutivo</th>
                                        <th>Solicitud</th>
                                        <th>Material</th>
                                        <th>Cotización</th>
                                        <th>Proveedor</th>
                                        <th>Importe</th>
                                        <th>Fecha de pago</th>
                                        <th>Empresa</th>
                                        <th>Importe P.</th>
                                        <th>XML</th>
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
                                            <td><?= $solicit->proyecto ?></td>
                                            <td><?= $solicit->fecha_creacion ?></td>
                                            <td><?= mb_strtoupper($solicit->consecutivo_cotizacion) ?></td>
                                            <td><?= mb_strtoupper($solicit->codigo_cotizacion_chuen) ?></td>
                                            <td><?= $solicit->utilizacion ?></td>
                                            <td><?= mb_strtoupper($solicit->codigo_proveedor) ?></td>
                                            <td><?= $solicit->empresa_proveedor ?></td>
                                            <td><?= $solicit->importe_cotizacion ?></td>
                                            <td><?= $solicit->fecha_pago ?></td>
                                            <td><?= $solicit->empresa_proveedor ?></td>
                                            <td><?= $solicit->cantidad_pago ?></td>
                                            <td><?= $solicit->cfdi ?></td>


                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    <?php endif; ?>
<?php
}
?>
</div>
<script src="js/functions/reportes.js"></script>
<script src="js/loading.js"></script>
<script src="assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="assets/js/vendor/buttons.html5.min.js"></script>
<script src="assets/js/vendor/buttons.flash.min.js"></script>
<script src="assets/js/vendor/reporte_soli_proyecto.js"></script>