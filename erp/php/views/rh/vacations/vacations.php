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
            <h4 class="page-title">Módulo de RH | Vacaciones</h4>
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
                                    <th>FECHA INGRESO</th>
                                    <th>EQUIVALENTE VACACIONES</th>
                                    <th>VACACIONES DISPONIBLES</th>
                                    <th>PRIMA VACACIONAL</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getUsersVacations as $users) :
                                    $txt_eq_vacations = '-';
                                    $vacations_days = 12;

                                    $today = date('Y-m-d');
                                    if ($users->fecha_ingreso != '') {
                                        $vacations_days = 12;

                                        $date1 = new DateTime($users->fecha_ingreso);
                                        $date2 = new DateTime($today);
                                        $diff = $date1->diff($date2);
                                        switch ($diff->y) {
                                            case '0':
                                                $txt_eq_vacations = '12';
                                                $vacations_days = 12;
                                                break;
                                            case '1':
                                                $txt_eq_vacations = '12';
                                                $vacations_days = 12;
                                                break;
                                            case '2':
                                                $txt_eq_vacations = '14';
                                                $vacations_days = 14;
                                                break;
                                            case '3':
                                                $txt_eq_vacations = '16';
                                                $vacations_days = 16;
                                                break;
                                            case '4':
                                                $txt_eq_vacations = '18';
                                                $vacations_days = 18;
                                                break;
                                            case '5':
                                                $txt_eq_vacations = '20';
                                                $vacations_days = 20;
                                                break;
                                            case ($diff->y <= "10" && $diff->y >= "6"):
                                                $txt_eq_vacations = '22';
                                                $vacations_days = 22;
                                                break;
                                            case ($diff->y <= "11" && $diff->y >= "15"):
                                                $txt_eq_vacations = '24';
                                                $vacations_days = 24;
                                                break;
                                            case ($diff->y <= "16" && $diff->y >= "20"):
                                                $txt_eq_vacations = '26';
                                                $vacations_days = 26;
                                                break;
                                            case ($diff->y <= "21" && $diff->y >= "25"):
                                                $txt_eq_vacations = '28';
                                                $vacations_days = 28;
                                                break;
                                            case ($diff->y <= "26" && $diff->y >= "30"):
                                                $txt_eq_vacations = '30';
                                                $vacations_days = 30;
                                                break;
                                            case ($diff->y <= "30" && $diff->y >= "35"):
                                                $txt_eq_vacations = '32';
                                                $vacations_days = 32;
                                                break;

                                            default:
                                                $txt_eq_vacations = '12';
                                                $vacations_days = 12;
                                                break;
                                        }
                                    }
                                    $aviable_days = 0;
                                    $days_taken = 0;
                                    $user_information_table = new UserArchives();
                                    $days_taken = $user_information_table->getUsersVacationsTaken($users->id_lista_personal);

                                    $aviable_days = $vacations_days - $days_taken;
                                ?>
                                    <td><?= mb_strtoupper($users->id_lista_personal); ?></td>
                                    <td><?= mb_strtoupper($users->nombre_completo); ?></td>
                                    <td><?= mb_strtoupper($users->fecha_ingreso); ?></td>
                                    <td><strong><?= $txt_eq_vacations ?></strong></td>
                                    <td><strong><?= $aviable_days ?></strong></td>
                                    <td>$ <?= round(bcmul($users->gross_salary, $days_taken, 10), 2) ?></td>
                                    <td class="table-action">
                                        <a class="action-icon addVacationDay" data-user-name="<?= $users->nombre_completo ?>" data-id-user="<?= $users->id_lista_personal ?>" data-bs-target="#modalVacationDay" data-bs-toggle="modal" data-bs-placement="top" title="Asignar día">
                                            <i class="fa-solid fa-plus"></i>
                                        </a>
                                        <a class="action-icon detailVacationDay" data-user-name="<?= $users->nombre_completo ?>" data-id-user="<?= $users->id_lista_personal ?>" data-bs-target="#modalVacationDetail" data-bs-toggle="modal" data-bs-placement="top" title="Desglose de días">
                                            <i class="mdi mdi-information-outline"></i>
                                        </a>
                                        <a class="action-icon payBonusVacation" data-ammount="<?= round(bcmul($users->gross_salary, $days_taken, 10), 2) ?>"  data-user-name="<?= $users->nombre_completo ?>" data-id-user="<?= $users->id_lista_personal ?>" data-bs-target="#modalVacationBonus" data-bs-toggle="modal" data-bs-placement="top" title="Prima Vacacional">
                                        <i class="fas fa-hand-holding-usd"></i>
                                        </a>

                                    </td>
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
include_once('modals/modalVacationDay.php');
include_once('modals/userVacationsDetail.php');
include_once('modals/vacationBonus.php');
include_once('modals/regVacationBonus.php');
?>
<script src="js/functions/vacations/vacations.js"></script>
<script src="js/loading.js"></script>