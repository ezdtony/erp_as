<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";

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

    $queries = new Queries;

    $stmt = "SELECT DISTINCT tg.descripcion AS tipo_gasto, tg.id_tipos_gasto
     FROM asteleco_viaticos_erp.gastos AS gas
     INNER JOIN asteleco_viaticos_erp.tipos_gasto AS tg ON gas.id_tipos_gasto = tg.id_tipos_gasto
     WHERE id_personal = '$id_user' AND MONTH(fecha_registro) = '$month'";

    $getInfoRequest = $queries->getData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {
        for ($tg_ps = 0; $tg_ps < count($getInfoRequest); $tg_ps++) {
            $id_tipos_gasto = $getInfoRequest[$tg_ps]->id_tipos_gasto;
            $stmt = "SELECT SUM(importe) AS total FROM asteleco_viaticos_erp.gastos 
            WHERE id_personal = '$id_user' AND MONTH(fecha_registro) = '$month' AND id_tipos_gasto = '$id_tipos_gasto'";
            $getInfoRequest_gastg = $queries->getData($stmt);
            if (!empty($getInfoRequest_gastg)) {
                $getInfoRequest[$tg_ps]->total_gastos = $getInfoRequest_gastg[0]->total;
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
