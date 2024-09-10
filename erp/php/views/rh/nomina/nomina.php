<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<style>
    /* Aumentar el tamaño del input */
    .datePicker {
        font-size: 18px;
        /* Tamaño del texto dentro del input */
        width: 200px;
        /* Ancho del input */
        height: 40px;
        /* Alto del input */
        padding: 5px;
        /* Espaciado interno */
    }
</style>
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
            <h4 class="page-title">Módulo de RH | Nómina</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title mb-3">Vacaciones de colaboadores</h4>
                <div class="d-grid">
                    <?php if ($id_area <= 3) : ?>
                        <!-- <button type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearProyecto">Agregar Proyecto</button> -->
                    <?php endif; ?>
                </div>
                <br>
                <?php if ($id_area <= 3) : ?>
                    <div class="table-responsive">
                        <table id="tablaProyectosCoord" class="table table-striped dt-responsive nowrap w-100 ">
                            <thead class="table-dark">
                                <tr>
                                    <th>N° COLABORADOR</th>
                                    <th>NOMBRE</th>
                                    <th>SALARIO BASE (SDI)</th>
                                    <th>TOTAL MENSUAL (SDI)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getUsersPayroll as $users) :
                                    $txt_eq_vacations = '-';
                                    $vacations_days = 12;

                                    $today = date('Y-m-d');

                                    $aviable_days = 0;
                                    $days_taken = 0;
                                    /* $user_information_table = new UserArchives(); */
                                    /* $days_taken = $user_information_table->getUsersVacationsTaken($users->id_lista_personal); */

                                    $aviable_days = $vacations_days - $days_taken;
                                ?>
                                    <td><?= mb_strtoupper($users->id_lista_personal); ?></td>
                                    <td><?= mb_strtoupper($users->nombre_completo); ?></td>
                                    <td class="tdSueldoBase" id="tdDiario<?= $users->id_lista_personal ?>" data-ammount="<?= $users->gross_salary ?>" data-id-colab="<?= $users->id_lista_personal ?>">$ <?= round($users->gross_salary, 2) ?></td>
                                    <td class="tdSSueldoMensual" id="tdMensual<?= $users->id_lista_personal ?>" data-id-colab="<?= $users->id_lista_personal ?>">$ <?= round(bcmul($users->gross_salary, 30, 10), 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <script>
                        var tGastos = new TableFilter(document.querySelector("#tablaProyectosCoord"), {
                            base_path: "js/tablefilter/",
                            paging: {
                                results_per_page: ['Records: ', [10, 25, 50, 100]]
                            },
                            responsive: true,
                            rows_counter: true,
                            btn_reset: true,
                            col_1: "select",
                            col_3: "none",
                            col_4: "none",
                            col_6: "none",
                            col_7: "none"
                        });
                        tGastos.init();
                    </script>
                <?php else : ?>

                <?php endif; ?>
            </div>
            <!-- end card-body-->
        </div>
        <!-- end card-->
    </div>
    <!-- end col-->
</div>
<!-- end row -->
<?php
//include_once('modals/modalVacationDay.php');
//include_once('modals/userVacationsDetail.php');
?>
<script src="js/functions/vacations/vacations.js"></script>
<script src="js/loading.js"></script>