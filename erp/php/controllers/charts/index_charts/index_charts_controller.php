<?php
include_once dirname(__DIR__ . '', 3) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}


function getPieChartInfo()
{

    $id_user = $_SESSION['id_user'];
    $month = date("m");
    $year = date("Y");

    $queries = new Queries;

    $stmt = "SELECT DISTINCT tg.descripcion AS tipo_gasto, tg.id_tipos_gasto
     FROM asteleco_viaticos_erp.gastos AS gas
     INNER JOIN asteleco_viaticos_erp.tipos_gasto AS tg ON gas.id_tipos_gasto = tg.id_tipos_gasto
     WHERE MONTH(fecha_registro) = '$month' AND YEAR(fecha_registro) = '$year'";

    $getInfoRequest = $queries->getData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {
        for ($tg_ps = 0; $tg_ps < count($getInfoRequest); $tg_ps++) {
            $id_tipos_gasto = $getInfoRequest[$tg_ps]->id_tipos_gasto;
            $stmt = "SELECT SUM(importe) AS total FROM asteleco_viaticos_erp.gastos 
            WHERE  MONTH(fecha_registro) = '$month' AND YEAR(fecha_registro) = '$year' AND id_tipos_gasto = '$id_tipos_gasto'";
            
            $getInfoRequest_gastg = $queries->getData($stmt);
            if (!empty($getInfoRequest_gastg)) {

                $getInfoRequest[$tg_ps]->total_gastos = ($getInfoRequest_gastg[0]->total);

            }
        }

        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $getInfoRequest
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => ''
        );
        //--- --- ---//
    }

    echo json_encode($data);
}


function getBarChartInfo()
{
    $queries = new Queries;
    $id_user = $_SESSION['id_user'];

    $onemonthago = date("m", strtotime("-1 month"));
    $twomonthago = date("m", strtotime("-2 month"));
    $month = date("m");
    $year = date("Y");
    $mes = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $data_graph = array();

    for ($i = $twomonthago; $i <= $month; $i++) {
        $stmt_current_mont_depositos = "SELECT SUM(dep.cantidad) AS total_depositos, MONTH(fecha) AS mes
            FROM asteleco_viaticos_erp.depositos AS dep
            WHERE MONTH(fecha) = '$i' AND YEAR(fecha) = '$year'";
        $getInfoRequestDepositos = $queries->getData($stmt_current_mont_depositos);

        $stmt_current_mont_gastos = "SELECT SUM(importe) AS total_gastos, MONTH(fecha_registro) AS mes
            FROM asteleco_viaticos_erp.gastos AS gas 
            WHERE MONTH(gas.fecha_registro) = '$i' AND YEAR(gas.fecha_registro) = '$year' ";
        $getInfoRequestGastos = $queries->getData($stmt_current_mont_gastos);

        $nm_mont = number_format($i, 0);
        $data_graph[] = array(
            'mes' => $mes[$nm_mont],
            'total_depositos' => number_format($getInfoRequestDepositos[0]->total_depositos, 2),
            'total_gastos' => number_format($getInfoRequestGastos[0]->total_gastos, 2)
        );
    }

    /* echo json_encode($data_graph); */


    if (!empty($data_graph)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $data_graph
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => ''
        );
        //--- --- ---//
    }

    echo json_encode($data);
}

