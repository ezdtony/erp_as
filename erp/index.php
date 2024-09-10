<?php
include_once('php/views/head.php');


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
            case 'vacations':
                $include_file = 'php/views/rh/vacations/vacations.php';
                break;
            case 'nomina':
                $include_file = 'php/views/rh/nomina/nomina.php';
                break;
            case 'sitios':
                $include_file = 'php/views/accesos/sitios.php';
                break;
            case 'saldos':
                $include_file = 'php/views/viaticos/saldos_usuarios.php';
                break;

            case 'gastos':
                $include_file = 'php/views/viaticos/gastos_general.php';
                break;
            case 'gastos_recientes':
                $include_file = 'php/views/viaticos/gastos_recientes.php';
                break;

            case 'gastos_usuario':
                $include_file = 'php/views/viaticos/gastos_usuario.php';
                break;
            case 'proyectos':
                $include_file = 'php/views/proyectos/index_proyectos.php';
                break;
            case 'proyectos_unidades':
                $include_file = 'php/views/proyectos/proyectos_unidades.php';
                break;
            case 'proyectos_inactivos':
                $include_file = 'php/views/proyectos/proyectos_inactivos.php';
                break;
            case 'personal':
                $include_file = 'php/views/personal/index_personal.php';
                break;
            case 'personal_dev':
                $include_file = 'php/views/personal/personal_dev.php';
                break;
            case 'detalle_info':
                $include_file = 'php/views/personal/detalle_info.php';
                break;
            case 'send_mails':
                $include_file = 'php/views/viaticos/send_mails.php';
                break;
            case 'depositos_viaticos':
                $include_file = 'php/views/viaticos/depositos_viaticos.php';
                break;
            case 'inventario_material':
                $include_file = 'php/views/compras/inventario_material.php';
                break;
            case 'asignaciones_herramienta':
                $include_file = 'php/views/compras/asignaciones_herramienta.php';
                break;
            case 'info_auxiliar_herramienta':
                $include_file = 'php/views/compras/info_auxiliar_herramienta.php';
                break;
            case 'almacenes':
                $include_file = 'php/views/compras/almacenes.php';
                break;
            case 'reportes':
                $include_file = 'php/views/reportes/index_reportes.php';
                break;
            case 'reporte_viaticos':
                $include_file = 'php/views/reportes/viaticos/index_reporte_viaticos.php';
                break;
            case 'captura_accesos':
                $include_file = 'php/views/accesos/captura_accesos.php';
                break;
            case 'administrar_checklist':
                $include_file = 'php/views/vehiculos/administrar_checklist.php';
                break;
            case 'unidades_admin':
                $include_file = 'php/views/vehiculos/unidades_admin.php';
                break;
            case 'unidades_user':
                $include_file = 'php/views/vehiculos/unidades_user.php';
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
            case 'reporte_viaticos_4':
                $include_file = 'php/views/reportes/viaticos/reports/reporte_viaticos_4.php';
                break;
            case 'reporte_viaticos_5':
                $include_file = 'php/views/reportes/viaticos/reports/reporte_viaticos_5.php';
                break;
            case 'reporte_viaticos_6':
                $include_file = 'php/views/reportes/viaticos/reports/reporte_viaticos_6.php';
                break;
            case 'lista_accesos':
                $include_file = 'php/views/accesos/lista_accesos.php';
                break;

            case 'reportes_accesos':
                $include_file = 'php/views/reportes/accesos/index_reportes_accesos.php';
                break;

            case 'reporte_vandalismos':
                $include_file = 'php/views/reportes/accesos/reports/reporte_vandalismos.php';
                break;


            case 'compras_cotizaciones':
                if ($id_area >= 4) {
                    $include_file = 'php/views/compras/cotizaciones.php';
                } else {
                    $include_file = 'php/views/compras/cotizaciones_admin.php';
                }

                break;
            case 'info_auxiliar_material':
                $include_file = 'php/views/compras/info_auxiliar_material.php';
                break;
            case 'desglose_cotizacion':
                if ($id_area >= 4) {
                    $include_file = 'php/views/compras/desglose_cotizacion.php';
                } else {
                    $include_file = 'php/views/compras/desglose_cotizacion_admin.php';
                }
                break;
            case 'imprimir_cotizacion':
                $include_file = 'php/views/compras/imprimir_cotizacion.php';
                break;
            case 'catalogo_material':
                $include_file = 'php/views/compras/catalogo_material.php';
                break;
            case 'inventario_herramienta':
                $include_file = 'php/views/compras/inventario_herramienta.php';
                break;
            case 'kits_herramienta':
                $include_file = 'php/views/compras/kits_herramienta.php';
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