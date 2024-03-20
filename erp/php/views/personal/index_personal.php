<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
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
                <br><br>
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-toggle="modal" data-bs-target="#modalSendMails">Enviar correos de viáticos</button>
                <br>
                <br>
                <br>
                
            <div class="container">
                <div class="row g-4">
                    <div class="col-auto">
                        <label for="numProducts" class="col-form-label"> Mostrar: </label>
                    </div>
                    <div class="col-auto">
                        <select name="numProducts" id="numProducts" class="form-select">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="100">100</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                            <option value="0">Todos</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <label for="numProducts" class="col-form-label"> registros. </label>
                    </div>
                    <div class="col-6">
                    </div>
                    <div class="col-auto">
                        <label for="searchProd" class="col-form-label"> Buscar: </label>
                    </div>
                    <div class="col-auto">
                        <input type="text" id="searchProd" name="searchProd" class="form-control" placeholder="...">
                    </div>
                </div>
                <br>

                <table id="tableColabs" class="table table-striped dt-responsive nowrap w-100">
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

                    </tbody>
                </table>
                <br>
                <br>
                <div class="row">
                    <div class="col-6">
                    <dt class="col-auto" id="lblTotal"></dt>
                    </div>

                    <div class="col-6" id="navPagination">
                    
                    </div>
                </div>
                <br>
                </div>
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
include_once('php/views/personal/modals/sendViaticsMails.php');

?>
<script src="js/functions/loadColabs.js"></script>
<script src="js/functions/personal.js"></script>
<script src="js/functions/viaticos/mailFunctions.js"></script>
<script src="js/functions/users/edit_user.js"></script>
<script src="js/loading.js"></script>