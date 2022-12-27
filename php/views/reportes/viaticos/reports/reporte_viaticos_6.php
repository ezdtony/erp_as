<?php
$queries = new Queries;
include_once('php/views/reportes/viaticos/reports/reports_data.php');

include_once('php/models/viatics_reports.php');
$viaticos_reports = new Viatics;
$getExpensesTypes = $viaticos_reports->getExpensesTypes();
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
            <h4 class="page-title">Reporte de Viáticos | Gastos por Tipo de Gasto</h4>
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
                            <label class="form-label">Tipo de gasto:</label>
                            <select id="tipo" class="form-control select2 " data-toggle="select2">
                                <option>Eliga un tipo *</option>
                                <optgroup label="Tipo de Gasto">
                                    <?php foreach ($getExpensesTypes as $expenses) : ?>
                                        <?php if (isset($_GET['tipo'])) :
                                            $tipo = $_GET['tipo'];
                                            //$colaborador = str_replace('-', ' ', $txt_colaborador);
                                        ?>
                                            <?php if ($expenses->id_tipos_gasto == $tipo) : ?>
                                                <option value="<?= $expenses->id_tipos_gasto ?>" selected><?= $expenses->descripcion ?></option>
                                            <?php else : ?>
                                                <option value="<?= $expenses->id_tipos_gasto ?>"><?= $expenses->descripcion ?></option>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <option value="<?= $expenses->id_tipos_gasto ?>"><?= $expenses->descripcion ?></option>
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
    <?php if (isset($_GET['tipo']) && isset($_GET['fecha_1']) && isset($_GET['fecha_2'])) :
        $tipo = $_GET['tipo'];
        $arr_fecha_1 = explode("/", $_GET['fecha_1']);
        $fecha_1 = $arr_fecha_1[2] . '-' . $arr_fecha_1[0] . '-' . $arr_fecha_1[1];
        $fecha_1 = str_replace(' ', '', $fecha_1);
        $arr_fecha_2 = explode("/", $_GET['fecha_2']);
        $fecha_2 = $arr_fecha_2[2] . '-' . $arr_fecha_2[0] . '-' . $arr_fecha_2[1];
        $fecha_2 = str_replace(' ', '', $fecha_2);

        $getProyectsExpensesByType = $viaticos_reports->getProyectsExpensesByType($tipo, $fecha_1, $fecha_2);
        $tipo_gasto = '';
        if (!empty($getProyectsExpensesByType)) { {
                $tipo_gasto = $getProyectsExpensesByType[0]->tipo_gasto;
            }
            # code...
        }

        $total_gastos = 0;

        foreach ($getProyectsExpensesByType as $getProyectsSpend) {
            $total_gastos = $total_gastos + floatval($getProyectsSpend->importe);
        }

        $total_gastos = number_format($total_gastos, 2, '.', ',');

    ?>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h3 id="nombre_informe" class="header-title mb-3">Total gastos: $ <?= $total_gastos ?></h3>
                    <h4 id="fecha_solicitud" class="header-title mb-3">Gastos Registrados para <?= $tipo_gasto ?></h4>
                    <h4 id="obra" class="header-title mb-3">Rango de fechas: <?= $fecha_1 . " / " . $fecha_2 ?></h4>
                    <br>
                    <br>
                    <div class="table-responsive">
                    <table id="datatable-buttons" data-table-name="Gastos de <?= $tipo_gasto ?> entre <?= $fecha_1 ?> y <?= $fecha_2 ?>" class="table table-centered mb-0 table-striped table-responsive-sm tableReport">
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
                                <?php foreach ($getProyectsExpensesByType as $expenses) :
                                    if ($expenses->clasificacion == '1') {
                                        $str_clasificacion = 'No deducible';
                                    } else {
                                        $str_clasificacion = 'Deducible';
                                    }
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $expenses->id_gastos ?></td>
                                        <td class="text-center"><?= $expenses->fecha_registro ?></td>
                                        <td class="text-center"><?= $expenses->importe ?></td>
                                        <td class="text-center"><?= $expenses->nombre ?></td>
                                        <td class="text-center"><?= $expenses->localidad ?></td>
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
<script src="js/functions/reports/viatics_report_6.js"></script>
<script src="js/loading.js"></script>