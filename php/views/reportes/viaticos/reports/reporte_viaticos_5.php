<?php
$queries = new Queries;
include_once('php/views/reportes/viaticos/reports/reports_data.php');

include_once('php/models/viatics_reports.php');
$viaticos_reports = new Viatics;
$Proyectos = $viaticos_reports->getProyectsUp();
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
            <h4 class="page-title">Reporte de Viáticos | Gastos y Depósitos por Proyecto</h4>
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
                            <label class="form-label">Rango de fechas:</label>
                            <input type="text" class="form-control date" id="rango_fechas" data-toggle="date-picker" data-cancel-class="btn-warning">
                        </div>
                        <div class="col">
                            <label class="form-label">Proyecto:</label>
                            <select id="proyecto" class="form-control select2 " data-toggle="select2">
                                <option>Eliga un proyecto *</option>
                                <optgroup label="Proyecto">
                                    <?php foreach ($Proyectos as $proyectos) : ?>
                                        <?php if (isset($_GET['proyecto'])) :
                                            $proyecto = $_GET['proyecto'];
                                            //$colaborador = str_replace('-', ' ', $colaborador);
                                        ?>
                                            <?php if ($proyectos->id_proyectos == $proyecto) : ?>
                                                <option value="<?= $proyectos->id_proyectos ?>" selected><?= $proyectos->proyecto ?></option>
                                            <?php else : ?>
                                                <option value="<?= $proyectos->id_proyectos ?>"><?= $proyectos->proyecto ?></option>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <option value="<?= $proyectos->id_proyectos ?>"><?= $proyectos->proyecto ?></option>
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

                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- end card-body-->
        </div>
        <!-- end card-->
    </div>
    <?php if (isset($_GET['proyecto']) && isset($_GET['fecha_1']) && isset($_GET['fecha_2'])) :
        $proyecto = $_GET['proyecto'];
        $arr_fecha_1 = explode("/", $_GET['fecha_1']);
        $fecha_1 = $arr_fecha_1[2] . '-' . $arr_fecha_1[0] . '-' . $arr_fecha_1[1];
        $fecha_1 = str_replace(' ', '', $fecha_1);
        $arr_fecha_2 = explode("/", $_GET['fecha_2']);
        $fecha_2 = $arr_fecha_2[2] . '-' . $arr_fecha_2[0] . '-' . $arr_fecha_2[1];
        $fecha_2 = str_replace(' ', '', $fecha_2);

        $getProyectsExpenses = $viaticos_reports->getProyectsExpenses($proyecto, $fecha_1, $fecha_2);
        $nombre_proy_exp = '';
        if (!empty($getProyectsExpenses)) {
            $nombre_proy_exp = $getProyectsExpenses[0]->proyecto;
        }
        $getProyectsSpends = $viaticos_reports->getProyectsSpends($proyecto, $fecha_1, $fecha_2);
        $nombre_proy = '';
        if (!empty($getProyectsExpenses)) {
            $nombre_proy = $getProyectsExpenses[0]->proyecto;
        }

        $total_depositos = 0;
        $total_gastos = 0;

        foreach ($getProyectsExpenses as $getProyectsExpense) {
            $total_depositos = $total_depositos + floatval($getProyectsExpense->cantidad);
        }

        foreach ($getProyectsSpends as $getProyectsSpend) {
            $total_gastos = $total_gastos + floatval($getProyectsSpend->importe);
        }

        $total_depositos = number_format($total_depositos, 2, '.', ',');
        $total_gastos = number_format($total_gastos, 2, '.', ',');

    ?>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h3 id="nombre_informe" class="header-title mb-3">Total depositado: $ <?= $total_depositos ?></h3>
                    <h4 id="fecha_solicitud" class="header-title mb-3">Depósitos del proyecto <?= $nombre_proy_exp ?></h4>
                    <h4 id="obra" class="header-title mb-3">Rango de fechas: <?= $fecha_1 . " / " . $fecha_2 ?></h4>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-centered mb-0 table-striped table-responsive-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Importe</th>
                                    <th class="text-center">Destinatario</th>
                                    <th class="text-center">Sitio</th>
                                    <th class="text-center">T. Gasto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getProyectsExpenses as $expenses) :
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $expenses->id_depositos ?></td>
                                        <td class="text-center"><?= $expenses->fecha ?></td>
                                        <td class="text-center"><?= $expenses->cantidad ?></td>
                                        <td class="text-center"><?= $expenses->nombre ?></td>
                                        <td class="text-center"><?= $expenses->sitio ?></td>
                                        <td class="text-center"><?= $expenses->tipo_gasto ?></td>
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
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h3 id="nombre_informe" class="header-title mb-3">Total gastos: $ <?= $total_gastos ?></h3>
                    <h4 id="fecha_solicitud" class="header-title mb-3">Depósitos del proyecto <?= $nombre_proy ?></h4>
                    <h4 id="obra" class="header-title mb-3">Rango de fechas: <?= $fecha_1 . " / " . $fecha_2 ?></h4>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table id="tablaRegistros" class="table table-centered mb-0 table-striped table-responsive-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Importe</th>
                                    <th class="text-center">Colab.</th>
                                    <th class="text-center">Lugar</th>
                                    <th class="text-center">Clasificación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getProyectsSpends as $spents) :
                                    if ($spents->clasificacion == '1') {
                                        $str_clasificacion = 'No deducible';
                                    } else {
                                        $str_clasificacion = 'Deducible';
                                    }
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $spents->id_gastos ?></td>
                                        <td class="text-center"><?= $spents->fecha_registro ?></td>
                                        <td class="text-center"><?= $spents->importe ?></td>
                                        <td class="text-center"><?= $spents->nombre ?></td>
                                        <td class="text-center"><?= $spents->localidad ?></td>
                                        <td class="text-center"><?= $str_clasificacion ?></td>
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

<script src="js/functions/reports/viatics_report_5.js"></script>
<script src="js/loading.js"></script>