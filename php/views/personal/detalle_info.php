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

    include_once('php/models/user_details.php');
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
                            <!-- ARCHIVOS DE USUARIO -->
                            <div class="tab-pane" id="home1">
                                <div class="container">
                                    <table class="table table-centered mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="text-center">Nombre de archivo</th>
                                                <th class="text-center">Formato</th>
                                                <th class="text-center">Ver/Cargar</th>
                                                <th class="text-center">Sustituir archivo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($getUserArchives as $structure) :
                                                $ruta_archivo = $structure->ruta_archivo;
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $structure->nombre_catalogo ?></td>
                                                    <td class="text-center"><?= $structure->tipo_archivo ?></td>
                                                    <td class="table-action text-center">
                                                        <?php if ($ruta_archivo == '') : ?>
                                                            <div>
                                                                <button id="<?= $structure->id_archivos_usuarios ?>" data-html_input_type="<?= $structure->html_input_type ?>" data-nombre_archivo="<?= $structure->nombre_catalogo ?>" type="button" class="btn btn-primary btn_SubirArchivo" data-bs-toggle="modal" data-bs-target="#subirArchivo"><i class="mdi mdi-upload"></i> </button>
                                                            </div>
                                                            <?php else :
                                                            if (file_exists($ruta_archivo)) { ?>
                                                                <a href="<?= $ruta_archivo ?>" target="_blank"><button type="button" class="btn btn-danger"><i class="mdi mdi-file-pdf-box"></i> </button></a>
                                                            <?php
                                                            } else { ?>
                                                                <a><button type="button" class="btn btn-danger"><i class="mdi mdi-image-broken"></i> </button></a>
                                                            <?php
                                                            }
                                                            ?>


                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="table-action text-center">
                                                        <?php if ($ruta_archivo == '') : ?>
                                                            <div>

                                                                <button id="<?= $structure->id_archivos_usuarios ?>" data-html_input_type="<?= $structure->html_input_type ?>" data-nombre_archivo="<?= $structure->nombre_catalogo ?>" type="button" class="btn btn-info btn_SubirArchivo" data-bs-toggle="modal" data-bs-target="#subirArchivo" disabled><i class="mdi mdi-reload"></i> </button>
                                                            </div>
                                                        <?php else : ?>
                                                            <button id="<?= $structure->id_archivos_usuarios ?>" data-html_input_type="<?= $structure->html_input_type ?>" data-nombre_archivo="<?= $structure->nombre_catalogo ?>" type="button" class="btn btn-info btn_SubirArchivo" data-bs-toggle="modal" data-bs-target="#subirArchivo"><i class="mdi mdi-reload"></i> </button>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- INFORMACION GENERAL -->
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
                                    <div class="container">
                                        <div class="row" style="height:260px; overflow: auto;">
                                            <div class="col-sm">

                                                <h4><i class="fas fa-envelope-open-text"></i> CURP:</h4>
                                                <h4> <?= $user_data->curp ?> </h4>
                                                <br>

                                                <h4><i class="fas fa-envelope-open-text"></i> RFC:</h4>
                                                <h4> <?= $user_data->rfc ?> </h4>
                                                <br>

                                                <h4><i class="fas fa-envelope-open-text"></i> NSS:</h4>
                                                <h4> <?= $user_data->nss ?> </h4>
                                                <br>

                                            </div>
                                            <div class="col-sm">
                                                <h4><i class="fas fa-envelope-open-text"></i> Correo prinicipal de contacto:</h4>
                                                <h4> <?= $user_data->correo_electronico ?> </h4>
                                                <br>

                                                <h4><i class="fas fa-phone-square"></i> Teléfono prinicipal de contacto:</h4>
                                                <h4><?= $user_data->telefono_principal ?> </h4>
                                                <br>

                                                <h4><i class="fas fa-envelope-open-text"></i> Teléfono secundario de contacto:</h4>
                                                <h4> <?= $user_data->telefono_secundario ?> </h4>
                                                <br>

                                            </div>
                                            <div class="col-sm">
                                                <h4><i class="uil-calendar-alt"></i> Fecha de nacimiento:</h4>
                                                <h4><?= $fecha_nacimiento ?></h4>
                                                <h5>Edad: <?= $edad ?></h5>
                                                <br>

                                                <h4><i class="uil-calendar-alt"></i> Correo inicio de sesión:</h4>
                                                <h4><?= $user_data->correo_sesion ?></h4>
                                                <br>

                                                <h4><i class="uil-calendar-alt"></i> Contraseña inicio de sesión:</h4>
                                                <h4><?= $user_data->password ?></h4>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h4><i class="fas fa-house-user"></i> Dirección</h4>
                                    <h4><?= $user_data->direccion_usuario ?></h4>
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

    include_once('php/views/personal/modals/subir_archivo.php');

    ?>
    <script src="js/functions/profile/info_personal.js"></script>
    <script src="js/functions/profile/edit_avatar.js"></script>
    <script src="js/loading.js"></script>
    <!-- plugin js -->
    <script src="assets/js/vendor/dropzone.min.js"></script>
    <!-- init js -->
    <script src="assets/js/ui/component.fileupload.js"></script>
<?php
}
?>