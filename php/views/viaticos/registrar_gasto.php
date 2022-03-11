<style>
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
        cursor: pointer;
    }
</style>
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
            <h4 class="page-title">Registrar Gasto</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-xl-4 col-lg-3">
        <div class="card cta-box overflow-hidden">
            <a id="reg_gasto_deducible" data-bs-toggle="modal" data-bs-target="#gastoDeducible" data-backdrop="static" data-keyboard="false">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="text-uppercase mt-0">Registrar Gasto</h6>
                            <h2 class="my-2" id="active-users-count">Gasto Deducible</h2>
                            <p class="mb-0 text-muted">
                        </div>
                        <img class="ms-3" src="images/budget.png" width="92" alt="Generic placeholder image">
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-4 col-lg-3">
        <div class="card cta-box overflow-hidden">
            <a id="reg_gasto_no_deducible" data-bs-toggle="modal" data-bs-target="#gastoNoDeducible">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="text-uppercase mt-0">Registrar Gasto</h6>
                            <h2 class="my-2" id="active-users-count">Gasto no Deducible</h2>
                            <p class="mb-0 text-muted">
                        </div>
                        <img class="ms-3" src="images/pay.png" width="92" alt="Generic placeholder image">
                    </div>
                </div>
            </a>
        </div>
    </div>
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
include_once('php/views/viaticos/modals/gasto_deducible.php');
include_once('php/views/viaticos/modals/gasto_no_deducible.php');
?>
<script src="js/functions/registrar_gasto.js"></script>
<script src="js/loading.js"></script>