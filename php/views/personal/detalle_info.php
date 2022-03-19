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
            <h4 class="page-title">Ficha de Colaborador</h4>
        </div>
    </div>
</div>
<?php

$queries = new Queries;
if (isset($_GET['id_user'])) {
    $id_user_data = $_GET['id_user'];

    $sql_user = "SELECT 
    ar.id_areas, 
    ar.descripcion_area,
    niv_ar.descripcion_niveles_areas AS puesto_area, 
    CONCAT (
        ar.descripcion_area, ' - ',
        niv_ar.descripcion_niveles_areas
    ) AS descripcion_area,
    CONCAT (
        aca.shortname_nivel, ' ',
        usr.nombres, ' ',
        usr.apellido_paterno, ' ',
        usr.apellido_materno
    ) AS nombre_usuario,
    usr.*,
    con.*
    FROM asteleco_personal.lista_personal AS usr 
    INNER JOIN asteleco_personal.niveles_academicos AS aca ON usr.id_niveles_academicos = aca.id_niveles_academicos
    INNER JOIN asteleco_personal.contacto_personal AS con ON usr.id_contacto_personal = con.id_contacto_personal 
    INNER JOIN asteleco_personal.niveles_areas AS niv_ar ON usr.id_niveles_areas = niv_ar.id_niveles_areas 
    INNER JOIN asteleco_personal.areas AS ar ON ar.id_areas = niv_ar.id_areas
    WHERE usr.id_lista_personal = $id_user_data";
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
                    $array_meses =  array(
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    );
                    foreach ($userInfo as $user_data) {
                        $arr_fecha_nacimiento = explode('-', $user_data->fecha_nacimiento);

                        $fecha_nacimiento = $arr_fecha_nacimiento[2] . ' de ' . $array_meses[($arr_fecha_nacimiento[1] - 1)] . ' de ' . $arr_fecha_nacimiento[0];
                        $nacimiento = new DateTime($user_data->fecha_nacimiento);
                        $ahora = new DateTime(date("Y-m-d"));
                        $diferencia = $ahora->diff($nacimiento);
                        $edad = $diferencia->format("%y");
                    ?>
                        <link rel="stylesheet" href="css/edit_avatar.css">
                        <div class="tab-content">
                            <div class="tab-pane" id="home1">
                                <p>...</p>
                            </div>
                            <div class="tab-pane show active" id="profile1">
                                <div class="container">
                                    <div class="text-center">
                                        <div class="avatar-wrapper">
                                            <img class="profile-pic profile-user-img img-responsive img-circle rounded" src="images/user_default.png" height="180" width="auto" />
                                            <div class="upload-button">
                                                <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                            </div>
                                            <input class="file-upload" type="file" accept="image/*" />
                                        </div>
                                    </div>
                                    <h4>Nombre y puesto:</h4>
                                    <h3> <?= $user_data->nombre_usuario ?> | <?= $user_data->descripcion_area ?></h3>
                                    <hr>
                                    <hr>
                                    <br>
                                    <div class="row" style="height:260px; overflow: auto;">
                                        <div class="col">
                                            <h4><i class="uil-calendar-alt"></i> Fecha de nacimiento:</h4>
                                            <h3><?= $fecha_nacimiento ?></h3>
                                            <h5>Edad: <?= $edad ?></h5>
                                            <br>

                                            <h4><i class="fas fa-envelope-open-text"></i> Correo prinicipal de contacto:</h4>
                                            <h3> <?= $user_data->correo_electronico ?> </h3>

                                            <h4><i class="fas fa-phone-square"></i> Teléfono prinicipal de contacto:</h4>
                                            <h3><?= $user_data->telefono_principal ?> </h3>
                                            <br>
                                            
                                        </div>
                                        <div class="col">
                                            <h2>Nombre del padre:</h2>
                                            <h4>AMIGA SMEKE MARCOS </h4>

                                            <h2><i class="far fa-envelope"></i> Correo del padre:</h2>
                                            <h4>marcosamiga@hotmail.com </h4>

                                            <h2><i class="fas fa-phone"></i> Teléfono del padre:</h2>
                                            <h4>5540946409 </h4>


                                        </div>

                                        <div class="col">
                                            <h2>Nombre de la madre:</h2>
                                            <h4>MICHAN HILU LETY </h4>

                                            <h2><i class="far fa-envelope"></i> Correo de la madre:</h2>
                                            <h4>letymichan@hotmail.com </h4>

                                            <h2><i class="fas fa-phone"></i> Teléfono de la madre:</h2>
                                            <h4>5521074648 </h4>
                                        </div>
                                    </div>
                                    <br>
                                    <h2><i class="fas fa-house-user"></i> Dirección</h2>
                                    <h4>Goldsmith 317 int. 305, Polanco III Secc, Miguel Hidalgo. 11550</h4>
                                    <br>
                                </div>
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
    <script src="js/functions/profile/edit_avatar.js"></script>
    <script src="js/loading.js"></script>

<?php
}
?>