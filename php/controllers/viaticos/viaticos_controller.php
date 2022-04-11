<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}

function saveDeposit()
{
    $id_user = $_POST['id_user'];
    $arr_fecha = explode("/", $_POST['fecha']);
    $fecha = $arr_fecha[2] . "-" . $arr_fecha[0] . "-" . $arr_fecha[1];
    $id_asingacion = $_POST['id_asingacion'];
    $sitio = $_POST['sitio'];
    $tipos_gasto = $_POST['tipos_gasto'];
    $importe = $_POST['importe'];
    $id_author = $_POST['id_author'];

    $queries = new Queries;

    $stmt = "UPDATE asteleco_viaticos.saldos 
    SET 
    saldo = saldo + $importe
    WHERE id_personal = $id_user";

    $updateSaldo = $queries->insertData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($updateSaldo)) {

        $sql_insertar_deposito = "INSERT INTO asteleco_viaticos.depositos (
            id_personal,
            id_asignacion_proyecto,
            id_tipos_gasto,
            id_personal_registro,
            sitio,
            cantidad,
            fecha,
            log_date
        ) VALUES (
            '$id_user',
            '$id_asingacion',
            '$tipos_gasto',
            '$id_author',
            '$sitio',
            '$importe',
            '$fecha',
            NOW()
            )";
        //--- --- ---//
        $insertar_deposito = $queries->insertData($sql_insertar_deposito);
        if (!empty($insertar_deposito)) {
            $data = array(
                'response' => true,
                'message'                => 'El depósito se registró correctamente!!'
            );
            //--- --- ---//

        } else {
            //--- --- ---//
            $data = array(
                'response' => false,
                'message'                => 'Error al registrar el depósito :('
            );
            //--- --- ---//
        }
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Error al actualizar el saldo del destinatario :('
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
