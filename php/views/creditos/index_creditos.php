<?php
if ($id_area <= 3) {
    $sql_creditos = "SELECT * FROM uvzuyqbs_constructora.creditos ";

    $arr_creditos = $queries->getData($sql_creditos);
}



?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <form class="d-flex">
                    <!-- <a href="javascript: void(0);" class="btn btn-primary ms-2">
                             <i class="mdi mdi-autorenew"></i>
                         </a> -->
                    <!--   <button type="button" class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#createSolicitud" data-bs-placement="top" title="Nueva solicitud">
                        <i class="mdi mdi-note-plus"></i>
                    </button> -->
                </form>
            </div>
            <h4 class="page-title">Administración de crédito</h4>
        </div>
    </div>
</div>

<div class="row">
    <?php if (empty($arr_creditos)) { ?>
    <?php } else { ?>
        <?php foreach ($arr_creditos as $creditos) : ?>
            <div class="col-xl-3 col-lg-6 order-lg-1">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="?submodule=reporte_credito&id_credito=<?=$creditos->id_credito?>" class="dropdown-item">Reporte de Gastos</a>
                                <!-- item-->
                                <!-- item-->
                                <a href="?submodule=reporte_depositos&id_credito=<?=$creditos->id_credito?>" class="dropdown-item">Reporte de Depósitos</a>
                                <!-- item-->
                                <a data-bs-toggle="modal" id=<?=$creditos->id_credito?> data-bs-target="#agregarSaldo" class="dropdown-item btn_agregarSaldo">Agregar Saldo</a>
                                <!-- item-->
                            </div>
                        </div>
                        <h4 class="header-title"><?= $creditos->proveedor ?></h4>
                        <div class="col" id="grafica_dona">
                            <canvas id="credito_<?=$creditos->id_credito?>"></canvas>
                        </div>
                       
                       
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        <?php endforeach; ?>
    <?php } ?>

</div>
</div>
<script src="js/functions/creditos.js"></script>
<script src="js/loading.js"></script>
<?php
include_once('php/views/creditos/modals/newCredit.php');
include_once('php/views/creditos/modals/agregarSaldo.php');
?>