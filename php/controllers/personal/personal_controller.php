<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}


function getAreaLevelsByAreaID()
{
    $id_area = $_POST['id_area'];

    $queries = new Queries;

    $stmt = "SELECT id_niveles_areas, descripcion_niveles_areas
    FROM asteleco_personal.`niveles_areas`  AS niv_ar
    WHERE niv_ar.id_areas = $id_area
    ORDER BY descripcion_niveles_areas ASC";

    $getInfoRequest = $queries->getData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {


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