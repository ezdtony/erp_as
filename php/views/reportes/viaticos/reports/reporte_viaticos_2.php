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
                                            $txt_colaborador = $_GET['colaborador'];
                                            $colaborador = str_replace('-', ' ', $txt_colaborador);
                                        ?>
                                            <?php if ($users_name->nombre == $colaborador) : ?>
                                                <option value="<?= $users_name->nombre ?>" selected><?= $users_name->nombre ?></option>
                                            <?php else : ?>
                                                <option value="<?= $users_name->nombre ?>"><?= $users_name->nombre ?></option>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <option value="<?= $users_name->nombre ?>"><?= $users_name->nombre ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                        <?php if (isset($_GET['colaborador'])): ?>
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
                                        $txt_colaborador = $_GET['colaborador'];
                                        $colaborador = str_replace('-', ' ', $txt_colaborador);
                                        $getUserProyects = $viaticos_reports->getUserProyects($colaborador);

                                        foreach ($getUserProyects as $proyecto) : ?>
                                            <?php if (isset($_GET['proyecto'])) :
                                                $nombre_proyecto = $_GET['proyecto'];
                                            ?>
                                                <?php if ($proyecto->proyecto == $nombre_proyecto) : ?>
                                                    <option value="<?= $proyecto->proyecto ?>" selected><?= $proyecto->proyecto ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $proyecto->proyecto ?>"><?= $proyecto->proyecto ?></option>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <option value="<?= $proyecto->proyecto ?>"><?= $proyecto->proyecto ?></option>
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
        $txt_colaborador = $_GET['colaborador'];
        $proyecto = $_GET['proyecto'];
        $colaborador = str_replace('-', ' ', $txt_colaborador);
        $arr_fecha_1 = explode("/", $_GET['fecha_1']);
        $fecha_1 = $arr_fecha_1[2] . '-' . $arr_fecha_1[0] . '-' . $arr_fecha_1[1];
        $fecha_1 = str_replace(' ', '', $fecha_1);
        $arr_fecha_2 = explode("/", $_GET['fecha_2']);
        $fecha_2 = $arr_fecha_2[2] . '-' . $arr_fecha_2[0] . '-' . $arr_fecha_2[1];
        $fecha_2 = str_replace(' ', '', $fecha_2);

        $getUserRegisters = $viaticos_reports->getUserRegistersByProyect($colaborador, $fecha_1, $fecha_2, $proyecto);
    ?>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 id="nombre_informe" class="header-title mb-3">Gastos Registrados de <?= $colaborador ?></h4>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table id="tablaRegistros" class="table table-centered mb-0 table-striped table-responsive-sm">
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
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $registers->id_reg ?></td>
                                        <td class="text-center"><?= $registers->fecha ?></td>
                                        <td class="text-center"><?= $registers->proyecto ?></td>
                                        <td class="text-center"><?= $registers->importe ?></td>
                                        <td class="text-center"><?= $registers->tgasto ?></td>
                                        <td class="text-center"><?= $registers->clasificacion ?></td>
                                        <td class="text-center"><?= $registers->status ?></td>
                                        <td class="text-center"><?= $registers->ffiscal ?></td>
                                        <td class="table-action text-center">
                                            <div>
                                                <?php
                                                $ruta_comprobante = str_replace("..", "http://astelecom.com.mx/viaticos", $registers->ruta_img);
                                                ?>
                                                <a href="<?= $ruta_comprobante ?>" target="_blank"><button type="button" class="btn btn-info"><i class="mdi mdi-image"></i> </button></a>
                                            </div>
                                        </td>
                                        <td class="table-action text-center">
                                            <?php if ($ruta_factura == 'Pendiente') : ?>
                                                <?php if ($ruta_factura == 'Pendiente' && $registers->clasificacion == 'No deducible') : ?>
                                                    N/A
                                                <?php else : ?>
                                                    <?= $ruta_factura ?>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <div>
                                                    <a href="<?= $ruta_factura ?>" target="_blank"><button type="button" class="btn btn-danger"><i class="mdi mdi-file-pdf-box"></i> </button></a>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
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
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script src="js/functions/reports/viatics_report_2.js"></script>
<script src="js/loading.js"></script>