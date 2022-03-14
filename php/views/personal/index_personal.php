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
            <h4 class="page-title">Administración de Personal</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Lista de Personal</h4>
                <br>
                <button type="button" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#registrarUsuario">Nuevo Usuario</button>
                <br>
                <br>
                <br>

                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>N° Empleado</th>
                            <th>Área</th>
                            <th>Puesto</th>
                            <th>Código de Usuario</th>
                            <th>Correo LogIn</th>
                            <th>Password</th>
                            <th>¿Activo?</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php foreach ($getAllUsers as $user) { ?>
                            <tr>
                                <td><?= ($user->nombres) . " " . $user->apellido_paterno . " " . $user->apellido_materno ?></td>
                                <td><?= $user->id_lista_personal ?></td>
                                <td><?= ($user->descripcion_area) ?></td>
                                <td><?= ($user->puesto_area) ?></td>
                                <td><?= ($user->codigo_usuario) ?></td>
                                <td><?= ($user->correo_sesion) ?></td>
                                <td><?= ($user->password) ?></td>
                                <td>
                                    <!-- Switch-->
                                    <div>
                                        <input type="checkbox" id="switch03" data-switch="success" />
                                        <label for="switch03" data-on-label="Si" data-off-label="No" class="mb-0 d-block"></label>
                                    </div>
                                </td>
                                <td class="table-action">
                                    <a href="javascript: void(0);" class="action-icon" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip"  title="Archivos"> <i class="mdi mdi-folder-account"></i></a>
                                    <a href="javascript: void(0);" class="action-icon" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip"  title="Información detallada"> <i class="mdi mdi-information"></i></a>
                                    <a href="javascript: void(0);" class="action-icon" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip"  title="Eliminar usuario"> <i class="mdi mdi-delete"></i></a>
                                </td>
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
include_once('php/views/personal/modals/registrar_usuario.php');

?>
<script src="js/functions/personal.js"></script>
<script src="js/loading.js"></script>