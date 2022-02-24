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
                 <h4 class="page-title">Pagina Principal</h4>
             </div>
         </div>
     </div>
     <!-- end page title -->
     <div class="row">
         <div class="col-lg-12">
             <div class="card">
                 <div class="card-body">

                     <h4 class="header-title mb-3">Proyectos</h4>

                     <div class="chart-content-bg">
                         <div class="row">
                             <div class="row" id="simple-dragula" data-plugin="dragula">

                                 <?php foreach ($getProyects as $proyectos) :
                                        $clase_card = "bg-info";
                                        $btn_activar = '<button type="button"  id="' . $proyectos->id_proyectos . '" class="btn btn-primary btn_desactivar_proyecto" data-bs-placement="top" title="Desactivar proyecto"><i class="mdi mdi-eye-off-outline"></i> </button>';
                                        if ($proyectos->status == '0') {
                                            $clase_card = "bg-secondary";
                                            $btn_activar = '<button type="button" id="' . $proyectos->id_proyectos . '"  class="btn btn-primary btn_activar_proyecto" data-bs-placement="top" title="Activar proyecto"><i class="mdi mdi-eye-outline"></i> </button>';
                                        }
                                    ?>
                                     <div class="col-md-4">
                                         <!-- Portlet card -->
                                         <div id="card_proy_<?= $proyectos->id_proyectos ?>" class="card text-white  <?= $clase_card ?>">
                                             <div class="card-body">
                                                 <div class="card-widgets">
                                                     <a data-bs-toggle="collapse" href="#cardCollpase1<?= $proyectos->id_proyectos ?>" role="button" aria-expanded="false" aria-controls="cardCollpase1<?= $id_proyectos ?>"><i class="mdi mdi-plus"></i></a>
                                                 </div>
                                                 <h5 class="card-title mb-0"><?= strtoupper($proyectos->codigo_proyecto) ?></h5>

                                                 <div id="cardCollpase1<?= $proyectos->id_proyectos ?>" class="collapse pt-3 hide">
                                                     <h4><?= $proyectos->nombre_largo ?></h4>
                                                     <blockquote class="card-bodyquote">
                                                         <p><?= $proyectos->direccion_proyecto ?></p>

                                                         </footer>
                                                     </blockquote>
                                                     <?php if (($_SESSION['id_area'] <= 3) OR $_SESSION['id_area'] >= 5) : ?>
                                                         <button type="button" class="btn btn-primary btn_add_personal" id="<?= $proyectos->id_proyectos ?>" data-bs-target="#addPPersonal" data-bs-toggle="modal" data-bs-placement="top" title="Asignar personal"><i class="mdi mdi-account-plus-outline"></i> </button>
                                                         <?= $btn_activar ?>
                                                     <?php endif ?>
                                                     <button type="button" class="btn btn-primary infoProyect" id="<?= $proyectos->id_proyectos ?>" data-bs-toggle="modal" data-bs-placement="top" title="Detalle de proyecto"><i class="mdi mdi-information-outline"></i> </button>
                                                 </div>
                                             </div>
                                         </div> <!-- end card-->
                                     </div><!-- end col -->
                                 <?php endforeach; ?>

                             </div>
                         </div>
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
        if ($id_area <= 3) { ?>
         <!-- TABLA PERSONAL -->
         <div class="row">
             <div class="col-lg-12">
                 <div class="card">
                     <div class="card-body">
                         <a href="" class="btn btn-sm btn-link float-end add_personal" data-bs-toggle="modal" data-bs-target="#registrarUsuario">Agregar
                             <i class="mdi mdi-account-plus ms-1"></i>
                         </a>
                         <!--    <a href="" class="btn btn-sm btn-link float-end">Exportar
                             <i class="mdi mdi-download ms-1"></i>
                         </a> -->
                         <h4 class="header-title mt-2 mb-3">Lista de Residentes</h4>

                         <div class="table-responsive">
                             <table class="
                          table table-centered  table-striped
                          mb-0
                        ">
                                 <thead class="table-dark">
                                     <tr>
                                         <th>Código</th>
                                         <th>Nombre</th>
                                         <th>Área</th>
                                         <th>Correo</th>
                                         <th>Número</th>
                                         <th>Dirección</th>
                                         <th>Contraseña LogIn</th>
                                         <th>Acciones</th>
                                     </tr>

                                 </thead>
                                 <tbody>
                                     <?php foreach ($getListaResidentes as $residentes) : ?>
                                         <tr>
                                             <td>
                                                 <h5 class="font-14 my-1 fw-normal"><?= $residentes->user_code ?></h5>
                                             </td>
                                             <td>
                                                 <h5 class="font-14 my-1 fw-normal">
                                                     <?= $residentes->nombre_completo ?>
                                                 </h5>
                                                 <span class="text-muted font-13" <?= $residentes->birthdate ?></span>
                                             </td>
                                             <td>
                                                 <h5 class="font-14 my-1 fw-normal"><?= $residentes->description ?></h5>
                                             </td>
                                             <td>
                                                 <h5 class="font-14 my-1 fw-normal"><?= $residentes->user_email ?></h5>
                                             </td>
                                             <td>
                                                 <h5 class="font-14 my-1 fw-normal"><?= $residentes->phone_number ?></h5>
                                             </td>
                                             <td>
                                                 <h5 class="font-14 my-1 fw-normal"><?= $residentes->direccion_personal ?></h5>
                                                 <span class="text-muted font-13">México</span>
                                             </td>
                                             <td>
                                                 <h5 class="font-14 my-1 fw-normal"><?= $residentes->user_pass ?></h5>
                                             </td>
                                             <td class="table-action">
                                                 <?php
                                                    if ($residentes->active == 1) {
                                                    ?>
                                                     <a id="<?= $residentes->id_lista_personal ?>" class="action-icon unactive_user" data-bs-placement="top" title="Desactivar usuario"> <i id="icon_<?= $residentes->id_lista_personal ?>" class="mdi mdi-account-off"></i></a>
                                                 <?php
                                                    } else { ?>
                                                     <a id="<?= $residentes->id_lista_personal ?>" class="action-icon active_user" data-bs-placement="top" title="Activar usuario"> <i id="icon_<?= $residentes->id_lista_personal ?>" class="mdi mdi-account-check"></i></a>

                                                 <?php }
                                                    ?>

                                                 <a id="<?= $residentes->id_lista_personal ?>" class="action-icon delete_user" data-bs-placement="top" title="Eliminar usuario"> <i class="mdi mdi-account-remove"></i></a>
                                             </td>
                                         </tr>
                                     <?php endforeach; ?>

                                 </tbody>
                             </table>
                         </div>
                         <!-- end table-responsive-->
                     </div>
                     <!-- end card-body-->
                 </div>
                 <!-- end card-->
             </div>
             <!-- end col -->
         </div>

         <!-- TABLA DE PROVEEDORES -->
         <div class="row">
             <div class="col-lg-12">
                 <div class="card">
                     <div class="card-body">
                         <a href="" class="btn btn-sm btn-link float-end add_proveedor" data-bs-toggle="modal" data-bs-target="#registrarProveedor">Agregar
                             <i class="mdi mdi-briefcase-plus ms-1"></i>
                         </a>
                         <!--    <a href="" class="btn btn-sm btn-link float-end">Exportar
                             <i class="mdi mdi-download ms-1"></i>
                         </a> -->
                         <h4 class="header-title mt-2 mb-3">Lista de Proveedores</h4>

                         <div class="table-responsive">
                             <table class="
                          table table-centered  table-striped
                          mb-0
                        ">
                                 <thead class="table-dark">
                                     <tr>
                                         <th>Nombre Empresa</th>
                                         <th>Nombre Contacto</th>
                                         <th>Correo</th>
                                         <th>Número</th>
                                         <th>Acciones</th>
                                     </tr>

                                 </thead>
                                 <tbody>
                                     <?php foreach ($getProveedores as $proveedores) : ?>
                                         <tr>
                                             <td>
                                                 <h5 class="font-14 my-1 fw-normal"><?= $proveedores->empresa_proveedor ?></h5>
                                             </td>

                                             <td>
                                                 <h5 class="font-14 my-1 fw-normal"><?= $proveedores->nombre_proveedor ?></h5>
                                             </td>
                                             <td>
                                                 <h5 class="font-14 my-1 fw-normal"><?= $proveedores->correo_proveedor ?></h5>
                                             </td>
                                             <td>
                                                 <h5 class="font-14 my-1 fw-normal"><?= $proveedores->num_telefonico ?></h5>
                                             </td>
                                             <td class="table-action">
                                                 <?php
                                                    if ($proveedores->status == 1) {
                                                    ?>
                                                     <a id="<?= $proveedores->id_proveedores ?>" class="action-icon unactive_proveedor" data-bs-placement="top" title="Desactivar proveedor"> <i id="icon_<?= $proveedores->id_proveedores ?>" class="mdi mdi-account-off"></i></a>
                                                 <?php
                                                    } else { ?>
                                                     <a id="<?= $proveedores->id_proveedores ?>" class="action-icon active_proveedor" data-bs-placement="top" title="Activar proveedor"> <i id="icon_<?= $proveedores->id_proveedores ?>" class="mdi mdi-account-check"></i></a>

                                                 <?php }
                                                    ?>

                                                 <a id="<?= $proveedores->id_proveedores ?>" class="action-icon delete_proveedor" data-bs-placement="top" title="Eliminar proveedor"> <i class="mdi mdi-account-remove"></i></a>
                                             </td>
                                         </tr>
                                     <?php endforeach; ?>

                                 </tbody>
                             </table>
                         </div>
                         <!-- end table-responsive-->
                     </div>
                     <!-- end card-body-->
                 </div>
                 <!-- end card-->
             </div>
             <!-- end col -->
         </div>

         <!-- TABLA UTILIZACIONES  -->
         <div class="row">
             <div class="col-lg-6">
                 <div class="card">
                     <div class="card-body">
                         <a href="" class="btn btn-sm btn-link float-end add_personal" data-bs-toggle="modal" data-bs-target="#registrarUtilizacion">Agregar
                             <i class="mdi mdi-text-box-plus ms-1"></i>
                         </a>
                         <!--    <a href="" class="btn btn-sm btn-link float-end">Exportar
                             <i class="mdi mdi-download ms-1"></i>
                         </a> -->
                         <h4 class="header-title mt-2 mb-3">Lista de Utilizaciones</h4>

                         <div class="table-responsive">
                             <table class="
                          table table-centered  table-striped
                          mb-0
                        ">
                                 <thead class="table-dark">
                                     <tr>
                                         <th>Descripción</th>
                                     </tr>

                                 </thead>
                                 <tbody>
                                     <?php foreach ($getUtilizaciones as $utilizaciones) : ?>
                                         <tr>
                                             <td>
                                                 <h5 class="font-14 my-1 fw-normal"><?= $utilizaciones->descripcion ?></h5>
                                             </td>
                                         </tr>
                                     <?php endforeach; ?>

                                 </tbody>
                             </table>
                         </div>
                         <!-- end table-responsive-->
                     </div>
                     <!-- end card-body-->
                 </div>
                 <!-- end card-->
             </div>
             <!-- end col -->
             <div class="col-lg-6">
                 <div class="card">
                     <div class="card-body">
                         <a href="" class="btn btn-sm btn-link float-end add_personal" data-bs-toggle="modal" data-bs-target="#registrarMedicion">Agregar
                             <i class="mdi mdi-text-box-plus ms-1"></i>
                         </a>
                         <!--    <a href="" class="btn btn-sm btn-link float-end">Exportar
                             <i class="mdi mdi-download ms-1"></i>
                         </a> -->
                         <h4 class="header-title mt-2 mb-3">Unidades de medida</h4>

                         <div class="table-responsive">
                             <table class="
                          table table-centered  table-striped
                          mb-0
                        ">
                                 <thead class="table-dark">
                                     <tr>
                                         <th>Descripción</th>
                                     </tr>

                                 </thead>
                                 <tbody>
                                     <?php foreach ($getMediciones as $mediciones) : ?>
                                         <tr>
                                             <td>
                                                 <h5 class="font-14 my-1 fw-normal"><?= $mediciones->descripcion ?></h5>
                                             </td>
                                         </tr>
                                     <?php endforeach; ?>

                                 </tbody>
                             </table>
                         </div>
                         <!-- end table-responsive-->
                     </div>
                     <!-- end card-body-->
                 </div>
                 <!-- end card-->
             </div>
             <!-- end col -->
         </div>
     <?php
        }
        ?>
     <!-- GRAFICAS DE INICIO -->
     <!--  <div class="row">
         <div class="col-xl-5 col-lg-6">
             <div class="row">
                 <div class="col-lg-6">
                     <div class="card widget-flat">
                         <div class="card-body">
                             <div class="float-end">
                                 <i class="mdi mdi-account-multiple widget-icon"></i>
                             </div>
                             <h5 class="text-muted fw-normal mt-0" title="Number of Customers">
                                 Gastos aprobados
                             </h5>
                             <h3 class="mt-3 mb-3">36,254</h3>
                             <p class="mb-0 text-muted">
                                 <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span>
                                 <span class="text-nowrap">Since last month</span>
                             </p>
                         </div>
                       
     </div>
     
     </div>
     



     <div class="col-lg-6">
         <div class="card widget-flat">
             <div class="card-body">
                 <div class="float-end">
                     <i class="mdi mdi-cart-plus widget-icon"></i>
                 </div>
                 <h5 class="text-muted fw-normal mt-0" title="Number of Orders">
                     Gastos rechazados
                 </h5>
                 <h3 class="mt-3 mb-3">5,543</h3>
                 <p class="mb-0 text-muted">
                     <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 1.08%</span>
                     <span class="text-nowrap">Since last month</span>
                 </p>
             </div>
            
         </div>
         
     </div>
     
     </div>
     

     <div class="row">
         <div class="col-lg-6">
             <div class="card widget-flat">
                 <div class="card-body">
                     <div class="float-end">
                         <i class="mdi mdi-currency-usd widget-icon"></i>
                     </div>
                     <h5 class="text-muted fw-normal mt-0" title="Average Revenue">
                         Reembolsos
                     </h5>
                     <h3 class="mt-3 mb-3">$6,254</h3>
                     <p class="mb-0 text-muted">
                         <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                         <span class="text-nowrap">Since last month</span>
                     </p>
                 </div>
                 
             </div>
             
         </div>
         

         <div class="col-lg-6">
             <div class="card widget-flat">
                 <div class="card-body">
                     <div class="float-end">
                         <i class="mdi mdi-pulse widget-icon"></i>
                     </div>
                     <h5 class="text-muted fw-normal mt-0" title="Growth">
                         Growth
                     </h5>
                     <h3 class="mt-3 mb-3">+ 30.56%</h3>
                     <p class="mb-0 text-muted">
                         <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 4.87%</span>
                         <span class="text-nowrap">Since last month</span>
                     </p>
                 </div>
             </div>
         </div>
     </div>
     </div>

     <div class="col-xl-7 col-lg-6">
         <div class="card card-h-100">
             <div class="card-body">
                 <div class="dropdown float-end">
                     <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                         <i class="mdi mdi-dots-vertical"></i>
                     </a>
                     <div class="dropdown-menu dropdown-menu-end">
                        
                         <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                        
                         <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                    
                         <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                    
                         <a href="javascript:void(0);" class="dropdown-item">Action</a>
                     </div>
                 </div>
                 <h4 class="header-title mb-3">Aprobados Vs Rechazados</h4>

                 <div dir="ltr">
                     <div id="high-performing-product" class="apex-charts" data-colors="#727cf5,#e3eaef"></div>
                 </div>
             </div>
            
         </div>
       
     </div>
    
     </div> -->
     <!--FIN  GRAFICAS DE INICIO -->

     <?php
        include_once('php/views/principal/modals/registrar_usuario.php');
        include_once('php/views/proyectos/modals/crear_proyecto.php');
        include_once('php/views/proyectos/modals/asignar_personal.php');
        include_once('php/views/proyectos/modals/detalle_proyecto.php');
        include_once('php/views/principal/modals/registrar_proveedor.php');
        include_once('php/views/principal/modals/registrar_medicion.php');
        include_once('php/views/principal/modals/registrar_utilizaciones.php');

        ?>
     <script src="js/functions/proyects.js"></script>
     <script src="js/functions/principal.js"></script>
     <script src="js/loading.js"></script>