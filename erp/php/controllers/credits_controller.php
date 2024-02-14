<?php
include_once dirname(__DIR__ . '', 1) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}


function getInfoCredit()
{
    $id_credito = $_POST['id_credito'];

    $queries = new Queries;

    $stmt = "SELECT * FROM constructora_personal.creditos WHERE id_credito='$id_credito'";

    $getInfoCredit = $queries->getData($stmt);

    if (!empty($getInfoCredit)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $getInfoCredit
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
