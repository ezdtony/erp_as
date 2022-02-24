<?php
include "php/controllers/login.php";

date_default_timezone_set('America/Mexico_City');
$user_name = "";
$id_area = "";
if (!isset($_SESSION['user'])) {
    header('Location: LogIn.php?#');
} else {
    $id_user = $_SESSION['id_user'];
    $user_name = $_SESSION['user'];
    $user_name_short = $_SESSION['user_short'];
    $id_area = $_SESSION['id_area'];
    $id_area_level = $_SESSION['id_areas_level'];
    $txt_area = $_SESSION['txt_area'];
    $txt_area_level = $_SESSION['txt_area_level'];




    $queries = new Queries;
    $estados = "SELECT * FROM uvzuyqbs_constructora.estados";

    $getStates = $queries->getData($estados);


    $sql_materiales = "SELECT * FROM uvzuyqbs_constructora.matriz_materiales";
    $getMateriales = $queries->getData($sql_materiales);

    $sql_proyect_types = "SELECT * FROM uvzuyqbs_constructora.tipos_proyecto";
    $getProyectTypes = $queries->getData($sql_proyect_types);

    $sql_personal = "SELECT 
            psn.id_lista_personal AS id_personal,
            CONCAT(
            tit.short_title, ' ', 
            psn.user_name, ' ', 
            psn.user_lastname
            ) AS nombre_completo

            FROM uvzuyqbs_constructora.lista_personal AS psn
            INNER JOIN uvzuyqbs_constructora.id_titulos AS tit ON psn.id_titulo = tit.id_titulo
            ";
    $getPersonal = $queries->getData($sql_personal);

    if ($id_area == 5) {
        $sql_proyectos = "SELECT 
        proy.id_proyectos, 
        proy.status, 
        proy.codigo_proyecto, 
        proy.nombre_largo,
        proy.comentario,
        proy.fecha_inicio,
        proy.fecha_cierre_proyectada,
        CONCAT(
        tit.short_title, ' ', 
        psn.user_name, ' ', 
        psn.user_lastname
        ) AS creador_proyecto,
        CONCAT(
        direc.direccion_calle, ' ', 
        direc.direccion_numero, ', ',
        direc.direccion_colonia, ', ',
        direc.direccion_codigo_postal, ', ',
        mun.municipio, ', ',
        est.estado, ', Méx.'

        ) AS direccion_proyecto

        FROM uvzuyqbs_constructora.proyectos AS proy 
        INNER JOIN uvzuyqbs_constructora.lista_personal AS psn 
        INNER JOIN uvzuyqbs_constructora.id_titulos AS tit ON psn.id_titulo = tit.id_titulo
        INNER JOIN uvzuyqbs_constructora.direcciones AS direc ON proy.id_direccion = direc.iddirecciones
        INNER JOIN uvzuyqbs_constructora.estados AS est ON direc.direccion_estado = est.id
        INNER JOIN uvzuyqbs_constructora.municipios AS mun ON direc.direccion_municipio = mun.id
        INNER JOIN uvzuyqbs_constructora.asignaciones_proyectos AS asp ON psn.id_lista_personal = asp.id_personal AND proy.id_proyectos = asp.id_proyecto AND asp.activo = 1
        WHERE proy.`status` = '1'    AND psn.id_lista_personal = $id_user
        ORDER BY id_proyectos   DESC
      ";
    } else if ($id_area <= 4) {
        $sql_lista_residentes = "SELECT lp.`id_lista_personal`,
        lp.`user_email`,
        lp.phone_number,
        lp.birthdate,
        CONCAT(
               tit.short_title, ' ',
               lp.user_name, ' ',
               lp.user_lastname
               ) AS nombre_completo,
                area.description, area.id_area, al.id_areas_level,al.level_description,
       CONCAT(
               direc.direccion_calle, ' ',
               direc.direccion_numero, ', ',
               direc.direccion_colonia, ', ',
               direc.direccion_codigo_postal, ', ',
               mun.municipio, ', ',
               est.estado, ', Méx.'
               ) AS direccion_personal

            FROM uvzuyqbs_constructora.lista_personal AS lp
            INNER JOIN uvzuyqbs_constructora.id_titulos AS tit ON lp.id_titulo = tit.id_titulo
            INNER JOIN uvzuyqbs_constructora.areas_level AS al ON al.id_areas_level = lp.id_areas_level
            INNER JOIN uvzuyqbs_constructora.areas AS area ON area.id_area = al.id_area
            INNER JOIN uvzuyqbs_constructora.direcciones AS direc ON lp.`id_direccion` = direc.iddirecciones
            INNER JOIN uvzuyqbs_constructora.estados AS est ON direc.direccion_estado = est.id
INNER JOIN uvzuyqbs_constructora.municipios AS mun ON direc.direccion_municipio = mun.id;";


        $getListaResidentes = $queries->getData($sql_lista_residentes);
        $sql_proyectos = "SELECT 
        proy.id_proyectos, 
        proy.status, 
        proy.codigo_proyecto, 
        proy.nombre_largo,
        proy.comentario,
        proy.fecha_inicio,
        proy.fecha_cierre_proyectada,
        CONCAT(
        tit.short_title, ' ', 
        psn.user_name, ' ', 
        psn.user_lastname
        ) AS creador_proyecto,
        CONCAT(
        direc.direccion_calle, ' ', 
        direc.direccion_numero, ', ',
        direc.direccion_colonia, ', ',
        direc.direccion_codigo_postal, ', ',
        mun.municipio, ', ',
        est.estado, ', Méx.'

        ) AS direccion_proyecto

        FROM uvzuyqbs_constructora.proyectos AS proy
        INNER JOIN uvzuyqbs_constructora.lista_personal AS psn ON proy.id_personal_creador = psn.id_lista_personal
        INNER JOIN uvzuyqbs_constructora.id_titulos AS tit ON psn.id_titulo = tit.id_titulo
        INNER JOIN uvzuyqbs_constructora.direcciones AS direc ON proy.id_direccion = direc.iddirecciones
        INNER JOIN uvzuyqbs_constructora.estados AS est ON direc.direccion_estado = est.id
        INNER JOIN uvzuyqbs_constructora.municipios AS mun ON direc.direccion_municipio = mun.id
        ORDER BY id_proyectos DESC
    ;
";
    }
    $getProyects = $queries->getData($sql_proyectos);
}
$sql_utilizacion = "SELECT * FROM uvzuyqbs_constructora.utilizaciones";

$getUtilizacion = $queries->getData($sql_utilizacion);


$id_user = $_SESSION['id_user'];
if (isset($_GET['submodule'])) {
    $submodule = $_GET['submodule'];
    switch ($submodule) {
        case 'solicitudes':
            $btns_action = '';
            if ($id_area >= 5) {
                $btns_action = '<li class="dropdown notification-list"><a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="modal" data-bs-target="#createSolicitud" data-bs-placement="top" title="Nueva solicitud"><i class="mdi mdi-note-plus noti-icon"></i><span class="noti-icon-badge"></span></a></li>';
            }


            break;
        case 'solicitudes_material':
            $btns_action = '';
            break;
        case 'solicitudes_insumos':
            $btns_action = '';
            break;
        case 'solicitudes_equipo':
            $btns_action = '';
            break;
        case 'desglose_solicitud':
            $btns_action = '';
            break;

        default:
            $btns_action = '';
            break;
    }
} else {
    if ($id_area <= 4) {
        $btns_action = '<li class="dropdown notification-list"><a class="nav-link dropdown-toggle arrow-none" data-bs-target="#addProyect" data-bs-toggle="modal" data-bs-placement="top" title="Agregar proyecto"><i class="mdi mdi-flag-plus noti-icon"></i><span class="noti-icon-badge"></span></a></li>';
    } else {
        $btns_action = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Constructora CHUEN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest">
    <link rel="mask-icon" href="images/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- <link rel="shortcut icon" href="assets/images/favicon.ico" /> -->

    <!-- third party css -->
    <link href="assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
    <!-- Datatables css -->
    <link href="assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />


    <!-- App css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
    <link href="assets/css/app-dark.min.css?v=1.1" rel="stylesheet" type="text/css" id="dark-style" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">
            <!-- LOGO -->
            <a href="index.html" class="logo text-center logo-light">
                <span class="logo-lg">
                    <img src="images/logo_chuen_light.png" alt="" height="36" />
                </span>
                <span class="logo-sm">
                    <img src="images/logo_chuen_light.png" alt="" height="16" />
                </span>
            </a>

            <!-- LOGO -->
            <a href="index.html" class="logo text-center logo-dark">
                <span class="logo-lg">
                    <img src="images/logo_chuen_light.png" alt="" height="16" />
                </span>
                <span class="logo-sm">
                    <img src="images/logo_chuen_light.png" alt="" height="16" />
                </span>
            </a>

            <div class="h-100" id="leftside-menu-container" data-simplebar="">
                <!--- Sidemenu -->
                <ul class="side-nav">
                    <li class="side-nav-title side-nav-item"><?= $user_name ?></li>

                    <li class="side-nav-item">
                        <a href="index.php" class="side-nav-link">
                            <i class="uil-home-alt"></i>
                            <span> Inicio </span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="?submodule=solicitudes" class="side-nav-link">
                            <i class="uil-comment-plus"></i>
                            <span> Solicitudes </span>
                        </a>
                    </li>

                    <!--  <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                    <i class="uil-bill"></i>
                    <span> Reembolsos </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEmail">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="apps-email-inbox.html">Captura</a>
                        </li>
                        <li>
                            <a href="apps-email-read.html">Aprobados</a>
                        </li>
                        <li>
                            <a href="apps-email-read.html">Revisión</a>
                        </li>
                        <li>
                            <a href="apps-email-read.html">Concentrado</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="apps-chat.html" class="side-nav-link">
                    <i class="uil-chart-line"></i>
                    <span> Gráficas </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="apps-calendar.html" class="side-nav-link">
                    <i class="uil-archive"></i>
                    <span> Reportes </span>
                </a>
            </li> -->

                </ul>

                <!-- Help Box -->
                <!-- <div class="help-box text-white text-center">
            <a href="javascript: void(0);" class="float-end close-btn text-white">
                <i class="mdi mdi-close"></i>
            </a>
            <img src="assets/images/help-icon.svg" height="90" alt="Helper Icon Image" />
            <h5 class="mt-3">Unlimited Access</h5>
            <p class="mb-3">
                Upgrade to plan to get access to unlimited reports
            </p>
            <a href="javascript: void(0);" class="btn btn-outline-light btn-sm">Upgrade</a>
        </div> -->
              
            </div>
            <!-- Sidebar -left -->
        </div>
        <!-- Left Sidebar End -->
        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                <div class="navbar-custom">
                    <ul class="list-unstyled topbar-menu float-end mb-0">

                        <?= $btns_action ?>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="account-user-avatar">
                                    <img src="assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle" />
                                </span>
                                <span>
                                    <span class="account-user-name"><?= $user_name_short ?></span>
                                    <span class="account-position"><?= $txt_area_level ?></span>
                                </span>
                            </a>
                            <div class="
                    dropdown-menu dropdown-menu-end dropdown-menu-animated
                    topbar-dropdown-menu
                    profile-dropdown
                  ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Bienvenido !</h6>
                                </div>

                                <!-- item-->
                                <a href="LogIn.php?#" class="dropdown-item notify-item">
                                    <i class="mdi mdi-logout me-1"></i>
                                    <span>Cerrar Sesión</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <button class="button-menu-mobile open-left">
                        <i class="mdi mdi-menu"></i>
                    </button>


                </div>
                <!-- end Topbar -->
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
                                                                <?php if ($_SESSION['id_area'] <= 4) : ?>
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
                if ($id_area <= 4) { ?>
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
                          table table-centered  table-hover
                          mb-0
                        ">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Área</th>
                                                    <th>Correo</th>
                                                    <th>Número</th>
                                                    <th>Dirección</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                <?php foreach ($getListaResidentes as $residentes) : ?>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">
                                                                <?= $residentes->nombre_completo ?>
                                                            </h5>
                                                            <span class="text-muted font-13" <?= $residentes->birthdate ?></span>
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

                ?>
                <script src="js/functions/proyects.js"></script>
                <script src="js/loading.js"></script>
            </div>
            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            © Constructora Chuen - Develped By GO-Tech
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->


    <div class="rightbar-overlay"></div>
    <!-- /End-bar -->

    <!-- bundle -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>

    <!-- third party js -->
    <script src="assets/js/vendor/apexcharts.min.js"></script>
    <script src="assets/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
    <!-- third party js ends -->
    <!-- Datatables js -->
    <script src="assets/js/vendor/jquery.dataTables.min.js"></script>
    <script src="assets/js/vendor/dataTables.bootstrap5.js"></script>
    <script src="assets/js/vendor/dataTables.responsive.min.js"></script>
    <script src="assets/js/vendor/responsive.bootstrap5.min.js"></script>

    <!-- Datatable Init js -->
    <script src="assets/js/pages/demo.datatable-init.js"></script>

    <!-- Datatables js -->
    <script src="assets/js/vendor/dataTables.buttons.min.js"></script>
    <script src="assets/js/vendor/buttons.bootstrap5.min.js"></script>
    <script src="assets/js/vendor/buttons.html5.min.js"></script>
    <script src="assets/js/vendor/buttons.flash.min.js"></script>
    <script src="assets/js/vendor/buttons.print.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="assets/js/vendor/dragula.min.js"></script>
    <script src="assets/js/ui/component.dragula.js"></script>

    <script src="assets/js/vendor/dropzone.min.js"></script>
    <!-- init js -->
    <script src="assets/js/ui/component.fileupload.js"></script>

    <!-- demo app -->
    <script src="assets/js/pages/demo.dashboard.js"></script>
    <!-- end demo js-->
</body>

</html>