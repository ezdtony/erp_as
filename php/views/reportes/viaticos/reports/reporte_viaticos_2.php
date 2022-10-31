<?php
$queries = new Queries;
include_once('php/views/reportes/viaticos/reports/reports_data.php');

include_once('php/models/viatics_reports.php');
$viaticos_reports = new Viatics;

?>
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
            <h4 class="page-title">Reporte de Viáticos | Gastos por Colaborador y Proyecto</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <!-- Single Select -->
                <div class="container">
                    <div class="row">

                        <div class="col">
                            <label class="form-label">Colaborador:</label>
                            <select id="colaborador" class="form-control select2 " data-toggle="select2">
                                <option>Eliga un colaborador *</option>
                                <optgroup label="Colaborador">
                                    <?php foreach ($getUsersName as $users_name) : ?>
                                        <?php if (isset($_GET['colaborador'])) :

                                            $colaborador =  $_GET['colaborador'];
                                        ?>
                                            <?php if ($users_name->id_lista_personal == $colaborador) : ?>
                                                <option value="<?= $users_name->id_lista_personal ?>" selected><?= $users_name->nombre ?></option>
                                            <?php else : ?>
                                                <option value="<?= $users_name->id_lista_personal ?>"><?= $users_name->nombre ?></option>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <option value="<?= $users_name->id_lista_personal ?>"><?= $users_name->nombre ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                        <?php if (isset($_GET['colaborador'])) : ?>
                            <div class="col">
                                <label class="form-label">Rango de fechas:</label>
                                <input type="text" class="form-control date" id="rango_fechas" data-toggle="date-picker" data-cancel-class="btn-warning">
                            </div>

                            <div class="col">
                                <label class="form-label">Proyecto:</label>
                                <select id="proyecto" class="form-control select2 " data-toggle="select2">
                                    <option>Eliga un proyecto *</option>
                                    <optgroup label="Proyecto">
                                        <?php
                                        if (isset($_GET['colaborador'])) {
                                            $colaborador = $_GET['colaborador'];
                                            $getUserProyects = $viaticos_reports->getUserProyects($colaborador);

                                            foreach ($getUserProyects as $proyecto) : ?>
                                                <?php if (isset($_GET['proyecto'])) :
                                                    $nombre_proyecto = $_GET['proyecto'];
                                                ?>
                                                    <?php if ($proyecto->id_proyectos == $nombre_proyecto) : ?>
                                                        <option value="<?= $proyecto->id_proyectos ?>" selected><?= $proyecto->proyecto ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $proyecto->id_proyectos ?>"><?= $proyecto->proyecto ?></option>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <option value="<?= $proyecto->id_proyectos ?>"><?= $proyecto->proyecto ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php }

                                        ?>
                                    </optgroup>
                                </select>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- end card-body-->
        </div>
        <!-- end card-->
    </div>
    <?php if (isset($_GET['colaborador']) && isset($_GET['fecha_1']) && isset($_GET['fecha_2']) && isset($_GET['proyecto'])) :
        $colaborador = $_GET['colaborador'];
        $proyecto = $_GET['proyecto'];
        $arr_fecha_1 = explode("/", $_GET['fecha_1']);
        $fecha_1 = $arr_fecha_1[2] . '-' . $arr_fecha_1[0] . '-' . $arr_fecha_1[1];
        $fecha_1 = str_replace(' ', '', $fecha_1);
        $arr_fecha_2 = explode("/", $_GET['fecha_2']);
        $fecha_2 = $arr_fecha_2[2] . '-' . $arr_fecha_2[0] . '-' . $arr_fecha_2[1];
        $fecha_2 = str_replace(' ', '', $fecha_2);

        $getUserRegisters = $viaticos_reports->getUserRegistersByProyect($colaborador, $fecha_1, $fecha_2, $proyecto);
        if (!empty($getUserRegisters)) {
            $nombre_usuario = $getUserRegisters[0]->nombre;
            $proyecto = $getUserRegisters[0]->proyecto;
        }
        $total_depositos = 0;
    ?>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 id="nombre_informe" class="header-title mb-3">Gastos Registrados de <?= $nombre_usuario ?> para el proyecto <?= $proyecto ?></h4>
                    <h5 id="fecha_solicitud" class="header-title mb-3">Entre fechas: <?= $fecha_1 ?> y <?= $fecha_2 ?></h5>
                    <br>
                    <br>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-centered mb-0 table-striped table-responsive-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Proyecto</th>
                                    <th class="text-center">Importe</th>
                                    <th class="text-center">T. Gasto</th>
                                    <th class="text-center">Clasificación</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">F. Fiscal</th>
                                    <th class="text-center">Comprobante</th>
                                    <th class="text-center">Factura</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getUserRegisters as $registers) :

                                    $ruta_factura = str_replace("..", "http://astelecom.com.mx/viaticos", $registers->ruta_pdf);
                                    if ($registers->clasificacion == '1') {
                                        $str_clasificacion = 'No deducible';
                                    } else {
                                        $str_clasificacion = 'Deducible';
                                    }
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $registers->id_gastos ?></td>
                                        <td class="text-center"><?= $registers->fecha_registro ?></td>
                                        <td class="text-center"><?= $registers->codigo_proyecto ?></td>
                                        <td class="text-center"><?= $registers->importe ?></td>
                                        <td class="text-center"><?= $registers->tipo_gasto ?></td>
                                        <td class="text-center"><?= $str_clasificacion ?></td>
                                        <td class="text-center"><?= $registers->estatus ?></td>
                                        <td class="text-center"><?= $registers->folio_fiscal ?></td>
                                        <td class="table-action text-center">
                                            <div>
                                                <?php
                                                $ruta_comprobante = str_replace("..", "http://astelecom.com.mx/viaticos", $registers->ruta_img);
                                                ?>
                                                <a href="<?= $ruta_comprobante ?>" target="_blank"><button type="button" class="btn btn-info"><i class="mdi mdi-image"></i> </button></a>
                                            </div>
                                        </td>
                                        <td class="table-action text-center">
                                            <?php if ($ruta_factura == '') : ?>
                                                <?php if ($ruta_factura == '' && $registers->clasificacion == '1') : ?>
                                                    N/A
                                                <?php else : ?>
                                                    PENDIENTE
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <div>
                                                    <a href="<?= $ruta_factura ?>" target="_blank"><button type="button" class="btn btn-danger"><i class="mdi mdi-file-pdf-box"></i> </button></a>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php $total_depositos =  $total_depositos + floatval($registers->importe);
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <h2 id="obra">Total: $ <?= $total_depositos; ?> </h2>
                    <br>
                </div>
                <!-- end card-body-->
            </div>
            <!-- end card-->
        </div>
    <?php endif; ?>

</div>
<!-- end row -->
<?php

?>

<script src="js/functions/reports/viatics_report_2.js"></script>
<script src="js/loading.js"></script>