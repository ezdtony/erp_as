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
            <h4 class="page-title">Ficha de Usuario</h4>
        </div>
    </div>
</div>
<?php

$queries = new Queries;
if (isset($_GET['id_user'])) {
    $id_user_data = $_GET['id_user'];

    $sql_user = "SELECT ar.id_areas, ar.descripcion_area,  niv_ar.descripcion_niveles_areas AS puesto_area, usr.* 
    FROM asteleco_personal.lista_personal AS usr 
    INNER JOIN asteleco_personal.niveles_areas AS niv_ar ON usr.id_niveles_areas = niv_ar.id_niveles_areas 
    INNER JOIN asteleco_personal.areas AS ar ON ar.id_areas = niv_ar.id_areas
    WHERE usr.id_lista_personal = '$id_user_data'";
    $userInfo = $queries->getData($sql_user);
    if (!empty($userInfo)) { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                        <li class="nav-item">
                            <a href="#home1" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                <span class="d-none d-md-block">Archivo de Usuario</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#profile1" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                <span class="d-none d-md-block">Información General</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#settings1" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                <span class="d-none d-md-block">Información médica</span>
                            </a>
                        </li>
                    </ul>
                    <?php
                    foreach ($userInfo as $user_data) { 
                        
                        ?>
                        <div class="tab-content">
                            <div class="tab-pane" id="home1">
                                <p>...</p>
                            </div>
                            <div class="tab-pane show active" id="profile1">
                                <div class="text-center">
                                    <img src="images/user_default.png" class="rounded" height="180" width="auto">
                                </div>
                                <h2>Nombre:</h2>
                                <p><?= $user_data->puesto_area ?></p>

                            </div>
                            <div class="tab-pane" id="settings1">
                                <p>...</p>
                            </div>
                        </div>

                    <?php } ?>
                    <!-- end card-body-->
                </div>
                <!-- end card-->
            </div>
            <!-- end col-->
        </div>
    <?php
    }

    include_once('php/views/personal/modals/registrar_usuario.php');

    ?>
    <script src="js/functions/personal.js"></script>
    <script src="js/loading.js"></script>

<?php
}
?>