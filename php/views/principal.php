<?php
include_once('php/models/viaticos/viatics_model.php');
$viaticos_reports = new ViaticsInformation;
$getUserSaldo = $viaticos_reports->getSaldoPorUsuario($id_user);
$saldo = $getUserSaldo[0]->saldo;
$saldo = number_format($saldo, 2, '.', ',');
$getUserDeposits = $viaticos_reports->monthlyDepositsUser($id_user);
$user_deposits = '0.00';
if (!empty($getUserDeposits)) {
    $user_deposits = $getUserDeposits[0]->total;
} else {
    $user_deposits = '0.00';
}

$monthlyViaticsUser = $viaticos_reports->monthlyViaticsUser($id_user);
$user_viatics = '0.00';
if (!empty($monthlyViaticsUser)) {
    $user_viatics = $monthlyViaticsUser[0]->total;
} else {
    $user_viatics = '0.00';
}
$user_deposits = number_format($user_deposits, 2, '.');
$user_viatics = number_format($user_viatics, 2, '.');

$month = date("m");
$mes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$mes_actual = $mes[$month-1];

?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Inicio</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-5 col-lg-6">


        <div class="row">
            <div class="col-sm-12">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-currency-usd widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Saldo Actual</h5>
                        <h3 class="mt-3 mb-3">$ <?= $saldo ?> </h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger me-2"></span>
                            <span class="text-nowrap"></span>
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            <!-- <div class="col-sm-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-pulse widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Growth">Growth</h5>
                        <h3 class="mt-3 mb-3">+ 30.56%</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 4.87%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div> 
                </div>
            </div> -->
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-cash-plus widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Depositado</h5>
                        <h3 class="mt-3 mb-3">$ <?= $user_deposits ?></h3>
                        <p class="mb-0 text-muted">
                            <!-- <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span> -->
                            <span class="text-nowrap">En el mes actual</span>
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-sm-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-cart-plus widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Comporbado</h5>
                        <h3 class="mt-3 mb-3">$ <?= $user_viatics ?></h3>
                        <p class="mb-0 text-muted">
                            <!-- <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 1.08%</span> -->
                            <span class="text-nowrap">En el mes actual</span>
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div> <!-- end row -->

    </div> <!-- end col -->

    <div class="col-xl-7 col-lg-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title">Depositado vs Comprobado</h4>
                    <br>
                    <h5>Últimos 3 meses</h5>
                </div>

                <div dir="ltr">
                    <div id="dashboardChart1" class="apex-charts" data-colors="#727cf5,#e3eaef" style="min-height: 257px;">


                    </div>
                </div>

            </div> <!-- end card-body-->
        </div> <!-- end card-->

    </div> <!-- end col -->
</div>
<div class="row">


    <div class="col-xl-7 col-lg-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title">Tipos de Gasto</h4>
                    <br>
                    <h5><?=$mes_actual?> <?=date('Y')?></h5>
                </div>

                <div dir="ltr">
                    <div id="dashboardChart2" class="apex-charts" data-colors="#727cf5,#e3eaef" style="min-height: 257px;">


                    </div>
                </div>

            </div> <!-- end card-body-->
        </div> <!-- end card-->

    </div> <!-- end col -->
    <div class="col-xl-5 col-lg-12  order-lg-2 order-xl-1">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title">Últimos registros (Gastos)</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover mb-0">
                        <tbody>
                            <tr>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">ASOS Ridley High Waist</h5>
                                    <span class="text-muted font-13">07 April 2018</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">$79.49</h5>
                                    <span class="text-muted font-13">Price</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">82</h5>
                                    <span class="text-muted font-13">Quantity</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">$6,518.18</h5>
                                    <span class="text-muted font-13">Amount</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">Marco Lightweight Shirt</h5>
                                    <span class="text-muted font-13">25 March 2018</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">$128.50</h5>
                                    <span class="text-muted font-13">Price</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">37</h5>
                                    <span class="text-muted font-13">Quantity</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">$4,754.50</h5>
                                    <span class="text-muted font-13">Amount</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">Half Sleeve Shirt</h5>
                                    <span class="text-muted font-13">17 March 2018</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">$39.99</h5>
                                    <span class="text-muted font-13">Price</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">64</h5>
                                    <span class="text-muted font-13">Quantity</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">$2,559.36</h5>
                                    <span class="text-muted font-13">Amount</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">Lightweight Jacket</h5>
                                    <span class="text-muted font-13">12 March 2018</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">$20.00</h5>
                                    <span class="text-muted font-13">Price</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">184</h5>
                                    <span class="text-muted font-13">Quantity</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">$3,680.00</h5>
                                    <span class="text-muted font-13">Amount</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">Marco Shoes</h5>
                                    <span class="text-muted font-13">05 March 2018</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">$28.49</h5>
                                    <span class="text-muted font-13">Price</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">69</h5>
                                    <span class="text-muted font-13">Quantity</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">$1,965.81</h5>
                                    <span class="text-muted font-13">Amount</span>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
<?php


?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="js/functions/principal/inicio/graficas/chart.js"></script>
<script src="js/loading.js"></script>