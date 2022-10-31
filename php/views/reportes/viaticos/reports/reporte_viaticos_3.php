<?php
$queries = new Queries;
include_once('php/views/reportes/viaticos/reports/reports_data.php');
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
            <h4 class="page-title">Reporte de Viáticos | Depósitos por Colaborador</h4>
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
                            <label class="form-label">Colaborador:</label>
                            <select id="colaborador" class="form-control select2 " data-toggle="select2">
                                <option>Eliga un colaborador *</option>
                                <optgroup label="Colaborador">
                                    <?php foreach ($getUsersName as $users_name) : ?>
                                        <?php if (isset($_GET['colaborador'])) :
                                            $colaborador = $_GET['colaborador'];
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
                        <div class="col">

                        </div>
                    </div>
                </div>
            </div>
            <!-- end card-body-->
        </div>
        <!-- end card-->
    </div>
    <?php if (isset($_GET['colaborador']) && isset($_GET['fecha_1']) && isset($_GET['fecha_2'])) :
        $txt_colaborador = $_GET['colaborador'];
        $colaborador = str_replace('-', ' ', $txt_colaborador);
        $arr_fecha_1 = explode("/", $_GET['fecha_1']);
        $fecha_1 = $arr_fecha_1[2] . '-' . $arr_fecha_1[0] . '-' . $arr_fecha_1[1];
        $fecha_1 = str_replace(' ', '', $fecha_1);
        $arr_fecha_2 = explode("/", $_GET['fecha_2']);
        $fecha_2 = $arr_fecha_2[2] . '-' . $arr_fecha_2[0] . '-' . $arr_fecha_2[1];
        $fecha_2 = str_replace(' ', '', $fecha_2);

        include_once('php/models/viatics_reports.php');
        $viaticos_reports = new Viatics;
        $getUserRegisters = $viaticos_reports->getUserDeposits($colaborador, $fecha_1, $fecha_2);
        if (!empty($getUserRegisters)) {
            $nombre_usuario = $getUserRegisters[0]->nombre;
        }
        $total_depositos = 0;
    ?>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 id="nombre_informe" class="header-title mb-3">Depósitos Registrados de <?= $nombre_usuario ?></h4>
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
                                    <th class="text-center">Sitio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getUserRegisters as $registers) :

                                ?>
                                    <tr>
                                        <td class="text-center"><?= $registers->id_depositos ?></td>
                                        <td class="text-center"><?= $registers->fecha ?></td>
                                        <td class="text-center"><?= $registers->proyecto ?></td>
                                        <td class="text-center">$ <?= $registers->cantidad ?></td>
                                        <td class="text-center"><?= $registers->tipo_gasto ?></td>
                                        <td class="text-center"><?= $registers->sitio ?></td>
                                    </tr>
                                <?php
                                    $total_depositos =  $total_depositos + floatval($registers->cantidad) ;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <h2 id="obra">Total: $ <?= $total_depositos; ?> </h2>
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

<script src="js/functions/reports/viatics_report_1.js"></script>
<script src="js/loading.js"></script>