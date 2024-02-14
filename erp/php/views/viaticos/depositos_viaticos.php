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
            <h4 class="page-title">Depósitos de Viáticos</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Lista de Depósitos</h4>
                <br>
                <?php if ($id_area <= 3) : ?>
                    <button type="button" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#depositarViatico">Nuevo Depósito</button>
                <?php endif; ?>
                <br>
                <br>
                <br>

                <table id="" class="table table-striped dt-responsive nowrap w-100 tablaDepositos">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Destinatario</th>
                            <th>Cantidad</th>
                            <th>Tipo de Gasto</th>
                            <th>Sitio</th>
                            <th>Proyecto</th>
                            <th>Registrado por</th>
                            <?php if ($id_area <= 3) : ?>
                                <th>Acciones</th>
                            <?php endif; ?>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        include_once('php/models/viaticos/viatics_model.php');
                        $viatics = new ViaticsInformation();
                        if ($id_area <= 3) {
                            $allDeposits = $viatics->getAllDeposits();
                        } else {
                            $allDeposits = $viatics->getAllDepositsUser($_SESSION['id_user']);
                        }


                        foreach ($allDeposits as $deposits) {


                        ?>
                            <tr>
                                <td><?= $deposits->fecha ?></td>
                                <td><?= $deposits->nombre_completo ?></td>
                                <td>$ <?= $deposits->cantidad ?></td>
                                <td><?= $deposits->descripcion_tipo_gasto ?></td>
                                <td><?= $deposits->sitio ?></td>
                                <td><?= $deposits->nombre_proyecto ?></td>
                                <td><?= $deposits->author ?></td>
                                <?php if ($id_area <= 3) : ?>
                                    <td class="table-action">
                                        <a id="<?= $deposits->id_depositos ?>" class="action-icon btnEditDeposits" data-id-destinatario="<?= $deposits->nombre_completo ?>" data-bs-toggle="modal" data-bs-target="#editarDeposito"> <i class="mdi mdi-pencil editDeposit"></i></a>
                                        <a id="<?= $deposits->id_depositos ?>" class="action-icon deleteDeposit"> <i class="mdi mdi-delete "></i></a>
                                    </td>
                                <?php endif; ?>
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