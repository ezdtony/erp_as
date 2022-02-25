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
                                 <div class="col-md-4">
                                 </div>
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