<?php
include_once dirname(__DIR__ . '', 1) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}




function getChartData()
{
    $id_proyecto = $_POST['id_proyecto'];
    $labels = "";
    $quantities = "";
    $tipos = array();

    $queries = new Queries;

    $stmt = "SELECT DISTINCT uti.descripcion AS tipo_material, uti.id_utilizacion
        FROM uvzuyqbs_constructora.`cotizaciones_index` AS cot_in 
        INNER JOIN uvzuyqbs_constructora.utilizaciones AS uti ON uti.id_utilizacion = cot_in.id_utilizacion
        INNER JOIN pagos_cotizaciones AS pag ON cot_in.`id_cotizaciones_index` = pag.id_cotizaciones_index 
        WHERE cot_in.id_proyectos = $id_proyecto
        ";

    $getData = $queries->getData($stmt);
    foreach ($getData as $data) {
        $labels = $data->tipo_material;
        $tipo_utilizacion = $data->id_utilizacion;
        $sql_suma = "SELECT SUM(cantidad_pago) AS total_pagos
        FROM uvzuyqbs_constructora.`cotizaciones_index` AS cot_in 
        INNER JOIN uvzuyqbs_constructora.utilizaciones AS uti ON uti.id_utilizacion = cot_in.id_utilizacion
        INNER JOIN uvzuyqbs_constructora.pagos_cotizaciones AS pag ON cot_in.`id_cotizaciones_index` = pag.id_cotizaciones_index 
        WHERE cot_in.id_proyectos = '$id_proyecto' AND cot_in.id_utilizacion='$tipo_utilizacion'";

        $getData_suma = $queries->getData($sql_suma);
        if (!empty($getData_suma)) {
            if ($getData_suma[0]->total_pagos != null) {
                $total_pagos = $getData_suma[0]->total_pagos;
                $tipos[] = array(
                    'tipo_material' => $labels,
                    'total_pagos' => $total_pagos
                );
            }
        }
    }
    if (!empty($tipos)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $tipos
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

    echo json_encode($tipos);
}

function getCreditsChartData()
{


    $queries = new Queries;

    $stmt = "SELECT * FROM uvzuyqbs_constructora.creditos";

    $getData = $queries->getData($stmt);


    if (!empty($getData)) {
        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $getData
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
