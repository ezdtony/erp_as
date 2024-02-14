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
            <h4 class="page-title">Saldos de Usuario</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3" id="nombre_informe">Saldos de usuarios</h4>
                <br>
                <br>

                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                <thead class="table-dark">
                        <tr>
                            <th>Usuario</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        include_once('php/models/viaticos/viatics_model.php');
                        $viatics = new ViaticsInformation();
                        $getAllUserBalances = $viatics->getAllUserBalances();

                        foreach ($getAllUserBalances as $balance) {


                        ?>
                            <tr>
                                <td><?= $balance-> nombre_usuario?></td>
                                <td>$ <?= number_format($balance-> saldo, 2)?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
            </div>
            <!-- end card-body-->
        </div>
        <!-- end card-->
    </div>
    <!-- end col-->
</div>
<!-- end row -->
<?php
include_once('php/views/viaticos/modals/depositarViatico.php');
include_once('php/views/viaticos/modals/editarDeposito.php');

?>
<script src="js/functions/viaticos/viaticos.js"></script>
<script src="js/loading.js"></script>