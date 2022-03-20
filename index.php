<?php
include_once('php/views/head.php');

/* if (isset($_GET['submodule'])) {
    $submodule = $_GET['submodule'];
    switch ($submodule) {
        case 'solicitudes':
            $btns_action = '';
            if ($id_area >= 4  and $submodule == 'solicitudes') {
                $btns_action = '<li class="dropdown notification-list"><a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="modal" data-bs-target="#createSolicitud" data-bs-placement="top" title="Nueva solicitud"><i class="mdi mdi-note-plus noti-icon"></i><span class="noti-icon-badge"></span></a></li>';
            } else {
                $btns_action = '';
            }
        case 'creditos':
            $btns_action = '';
            if ($id_area >= 3 and $submodule == 'creditos') {
                $btns_action = '<li class="dropdown notification-list"><a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="modal" data-bs-target="#newCredit" data-bs-placement="top" title="Añadir crédito"><i class="mdi mdi-plus-thick noti-icon"></i><span class="noti-icon-badge"></span></a></li>';
            } else {
                $btns_action = '';
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
    if ($id_area <= 3 or $id_area >= 5) {
        $btns_action = '<li class="dropdown notification-list"><a class="nav-link dropdown-toggle arrow-none" data-bs-target="#addProyect" data-bs-toggle="modal" data-bs-placement="top" title="Agregar proyecto"><i class="mdi mdi-flag-plus noti-icon"></i><span class="noti-icon-badge"></span></a></li>';
    } else {
        $btns_action = '';
    }
} */


include_once('php/views/navbar.php');
include_once('php/views/topbar.php');
?>
<!-- Start Content-->
<div class="container-fluid">
    <?php
    $include_file = '';
    if (isset($_GET['submodule'])) {
        $submodule = $_GET['submodule'];
        switch ($submodule) {
            case 'registrar_gasto':
                $include_file = 'php/views/viaticos/registrar_gasto.php';
                break;
            case 'proyectos':
                $include_file = 'php/views/proyectos/index_proyectos.php';
                break;
            case 'personal':
                $include_file = 'php/views/personal/index_personal.php';
                break;
            case 'detalle_info':
                $include_file = 'php/views/personal/detalle_info.php';
                break;
            case 'reportes':
                $include_file = 'php/views/reportes/index_reportes.php';
                break;
            case 'reporte_viaticos':
                $include_file = 'php/views/reportes/viaticos/index_reporte_viaticos.php';
                break;
            case 'reporte_viaticos_1':
                $include_file = 'php/views/reportes/viaticos/reports/reporte_viaticos_1.php';
                break;
            case 'reporte_viaticos_2':
                $include_file = 'php/views/reportes/viaticos/reports/reporte_viaticos_2.php';
                break;
            case 'reporte_viaticos_3':
                $include_file = 'php/views/reportes/viaticos/reports/reporte_viaticos_3.php';
                break;
            default:
                $include_file = 'php/views/principal.php';
                break;
        }
        include $include_file;
    } else {
        include_once('php/views/principal.php');
    }
    ?>
</div>

<?php
include_once('php/views/footer.php');
?>