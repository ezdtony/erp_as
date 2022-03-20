<?php
$queries = new Queries;
include_once('php/views/reportes/viaticos/reports/reports_data.php');
?>
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
            <h4 class="page-title">Reporte de Viáticos | Gastos por Colaborador</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <!-- Single Select -->
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Rango de fechas:</label>
                            <input type="text" class="form-control date" id="rango_fechas" data-toggle="date-picker" data-cancel-class="btn-warning">

                        </div>
                        <div class="col">
                        <label class="form-label">Colaborador:</label>
                            <select id="colaborador" class="form-control select2 " data-toggle="select2">
                                <option>Eliga un colaborador *</option>
                                <optgroup label="Colaborador">
                                    <?php foreach ($getUsersName as $users_name) : ?>
                                        <option value="<?= $users_name->nombre ?>"><?= $users_name->nombre ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                </div>
            </div>
            <!-- end card-body-->
        </div>
        <!-- end card-->
    </div>
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
                            <th>¿Activo?</th>
                            <th>Área</th>
                            <th>Puesto</th>
                            <th>Código de Usuario</th>
                            <th>Documentos</th>
                            <th>Correo LogIn</th>
                            <th>Password</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        include_once('php/models/user_information_table.php');
                        $user_information_table = new UserArchives();
                        foreach ($getAllUsers as $user) {
                            $status = '';
                            if ($user->status == 1) {
                                $status = 'checked';
                            }
                        ?>
                            <tr>
                                <td><?= ($user->nombres) . " " . $user->apellido_paterno . " " . $user->apellido_materno ?></td>
                                <td><?= $user->id_lista_personal ?></td>
                                <td>
                                    <!-- Switch-->
                                    <div>
                                        <input class="change_user_status" type="checkbox" id="<?= $user->id_lista_personal ?>" data-switch="success" <?= $status ?> />
                                        <label for="<?= $user->id_lista_personal ?>" data-on-label="Si" data-off-label="No" class="mb-0 d-block"></label>
                                    </div>
                                </td>
                                <td><?= ($user->descripcion_area) ?></td>
                                <td><?= ($user->puesto_area) ?></td>
                                <td><?= ($user->codigo_usuario) ?></td>
                                <td><?= $user_information_table->getArchivesCount($user->id_lista_personal) ?> de <?= $getArchivesTableStructure[0]->total_archives ?></td>
                                <td><?= ($user->correo_sesion) ?></td>
                                <td><?= ($user->password) ?></td>

                                <td class="table-action">
                                    <a href="?submodule=detalle_info&id_user=<?= $user->id_lista_personal ?>" target="_blank" class="action-icon" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" title="Información detallada"> <i class="mdi mdi-information"></i></a>
                                    <a class="action-icon editUser" id=<?= $user->id_lista_personal ?>" data-bs-container="#tooltip-container2" data-bs-toggle="modal" data-bs-target="#editarUsuario" data-bs-toggle="tooltip" title="Editar información"> <i class="mdi mdi-circle-edit-outline"></i></a>
                                    <a class="action-icon deleteUser" id=<?= $user->id_lista_personal ?>" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" title="Eliminar usuario"> <i class="mdi mdi-delete"></i></a>
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

?>
<script src="js/functions/reports/viatics_report_1.js"></script>
<script src="js/loading.js"></script>