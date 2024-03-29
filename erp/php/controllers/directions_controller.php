<?php
include_once dirname(__DIR__.'',1 )."/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}




function getMunicipios()
{
    $id_estado = $_POST['id_estado'];

    $queries = new Queries;

        $stmt = "SELECT munic.* 
        FROM asteleco_matriz_direcciones.estados AS est 
        INNER JOIN asteleco_matriz_direcciones.estados_municipios AS est_mun ON est.id = est_mun.estados_id
        INNER JOIN asteleco_matriz_direcciones.municipios AS munic ON est_mun.municipios_id = munic.id
        WHERE est.id = $id_estado";
         
    $getMunicipios = $queries->getData($stmt);

    if (!empty($getMunicipios)) {

        
        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $getMunicipios
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