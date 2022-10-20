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
            <h4 class="page-title">Administración de Personal (DEV)</h4>
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
                <div class="table-responsive">
                    <table id="" class="table table-striped dt-responsive nowrap w-100 tablaUsuarios">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>N° Empleado</th>
                                <th>¿Activo?</th>
                                <th>Área</th>
                                <th>Puesto</th>
                                <th>Código de Usuario</th>
                                <th>Documentos</th>
                                <th>Correo LogIn </th>
                                <th>Correo personal</th>
                                <th>Password</th>
                                <th>Acciones</th>
                                <th>Enviar correo Viaticos</th>
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
                                <tr id="<?= $user->id_lista_personal ?>">
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
                                    <td class="td_editable" column_name="codigo_usuario"><?= ($user->codigo_usuario) ?></td>
                                    <td><?= $user_information_table->getArchivesCount($user->id_lista_personal) ?> de <?= $getArchivesTableStructure[0]->total_archives ?></td>
                                    <td class="td_editable" column_name="correo_sesion"><?= ($user->correo_sesion) ?></td>
                                    <td class="td_editable" column_name="correo_personal"><?= ($user->correo_personal) ?></td>
                                    <td class="td_editable" column_name="password"><?= ($user->password) ?></td>

                                    <td class="table-action">
                                        <a href="?submodule=detalle_info&id_user=<?= $user->id_lista_personal ?>" target="_blank" class="action-icon" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" title="Información detallada"> <i class="mdi mdi-information"></i></a>
                                        <a class="action-icon editUser" id=<?= $user->id_lista_personal ?>" data-bs-container="#tooltip-container2" data-bs-toggle="modal" data-bs-target="#editarUsuario" data-bs-toggle="tooltip" title="Editar información"> <i class="mdi mdi-circle-edit-outline"></i></a>
                                        <a class="action-icon deleteUser" id=<?= $user->id_lista_personal ?>" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" title="Eliminar usuario"> <i class="mdi mdi-delete"></i></a>
                                    </td>
                                    <td>
                                        <a class="action-icon sendEmail" id-personal="<?= $user->id_lista_personal ?>" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" title="Enviar correo"> <i class="mdi mdi-email"></i></a>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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
include_once('php/views/personal/modals/editar_usuario.php');

?>
<script>
    var tf = new TableFilter(document.querySelector(".tablaUsuarios"), {
        base_path: "js/tablefilter/",
        paging: {
            results_per_page: ["Records: ", [10, 25, 50, 100]],
        },
        responsive: true,
        rows_counter: true,
        btn_reset: true,
    });
    tf.init();

    $(".td_editable").dblclick(function() {
        //alert(this.rowIndex);

        var $td = $(this);
        var _t = $td.text().trim();
        var _w = $td.width();
        var _h = $td.height();
        $td.html("");
        let $input = $("<input type = 'text' value =''>");

        $input
            .appendTo($td)
            .width(_w)
            .height(_h)
            .val(_t)
            .focus()
            .blur(function() {
                let remark = $(this).val();
                let id = $td.parent("tr").attr("id");
                let column_name = $td.attr("column_name");

                console.log(remark);
                console.log(id);
                console.log(column_name);

                $td.empty();
                $td.append("<td>" + remark + "</td>");

                $.ajax({
                        url: "php/controllers/compras/compras_controller.php",
                        method: "POST",
                        data: {
                            mod: "updateUserInfo",
                            id_personal: id,
                            column_name: column_name,
                            value: remark,
                        },
                    })
                    .done(function(data) {
                        var data = JSON.parse(data);
                        console.log(data);

                        if (data.response == true) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener("mouseenter", Swal.stopTimer);
                                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                                },
                            });

                            Toast.fire({
                                icon: "info",
                                title: data.message,
                            });
                        } else {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener("mouseenter", Swal.stopTimer);
                                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                                },
                            });

                            Toast.fire({
                                icon: "info",
                                title: data.message,
                            });
                        }

                        //--- --- ---//
                        //--- --- ---//
                    })
                    .fail(function(message) {});

                /*  $.ajax({
                        type:'POST',
                        url:'ajax_set_remark',
                        data: {id: id,remark:remark},
                        dataType:'json',
                        success:function(data){
                            if(data.errno == 0){
                                layer.msg(data.errdesc, {icon: 1});
                                $td.html(remark);
                                $("#update_time_"+id).html(data.date);
                            }else{
                                layer.msg(data.errdesc, {icon: 5});
                                $td.html(_t);
                                return false;
                            }
                        }
                    }); */
            });

        /* input.val(html);
            $(this).html(input); */
    });

    $(document).on("click", ".sendEmail", function() {
        loading();
        var id_personal = $(this).attr("id-personal");
        $.ajax({
                url: "php/controllers/personal/personal_controller.php",
                method: "POST",
                data: {
                    mod: "sendViaticsMail",
                    id_personal: id_personal
                },
            })
            .done(function(data) {
                var data = JSON.parse(data);
                console.log(data);

                if (data.response == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Correo enviado",
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    /*  Swal.fire("Éxito!", data.message, "success").then((result) => {
                       if (result.isConfirmed) {
                         loading();
                         location.reload();
                       }
                     }); */
                } else {
                    Swal.fire("Atención!", data.message, "info");
                }
                //--- --- ---//
                //--- --- ---//
            })
            .fail(function(message) {
                VanillaToasts.create({
                    title: "Error",
                    text: "Ocurrió un error, intentelo nuevamente",
                    type: "error",
                    timeout: 1200,
                    positionClass: "topRight",
                });
            });

    });

    function loading() {
        Swal.fire({
            title: "Cargando...",
            html: '<img src="images/loading.gif" width="300" height="175">',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCloseButton: false,
            showCancelButton: false,
            showConfirmButton: false,
        });
    }
</script>
<script src="js/functions/personal.js"></script>
<script src="js/functions/users/edit_user.js"></script>
<script src="js/loading.js"></script>