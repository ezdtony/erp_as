<?php
include_once dirname(__DIR__ . '', 1) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}


function guardarSolicitud()
{
    $queries = new Queries;
    $arr_data = $_POST['arr_data'];

    $id_proyecto = $arr_data[0][0];
    $txt_proyecto = $arr_data[1][0];
    $id_utilizacion = $arr_data[2][0];
    $txt_utilizacion = $arr_data[3][0];
    $codigo_chuen = $arr_data[4][0];
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    // Output: 54esmdr0qf
    $cd1 = (substr(str_shuffle($permitted_chars), 0, 3));
    $cd2 = (substr(str_shuffle($permitted_chars), 0, 3));
    $cd3 = (substr(str_shuffle($permitted_chars), 0, 3));
    $random_code = "PY" . $id_proyecto . "-" . $cd1 . "-" . $cd2;
$fyh = date('Y-m-d H:i:s');
    $stmt = "INSERT INTO uvzuyqbs_constructora.cotizaciones_index 
                 (
                    id_cotizaciones_index,
                    id_lista_personal_creo,
                    id_proveedores,
                    consecutivo_cotizacion,
                    status,
                    comentarios,
                    fecha_creacion,
                    id_utilizacion,
                    id_proyectos,
                    txt_proyectos,
                    codigo_cotizacion_chuen
                 ) 
                 VALUES(
                     NULL,
                     $_SESSION[id_user],
                        '1',
                        '$random_code',
                        '1',
                        '',
                        '$fyh',
                        '$id_utilizacion',
                        '$id_proyecto',
                        '$txt_proyecto',
                        '$codigo_chuen'
                 )";
    $saveIndex = $queries->insertData($stmt);
    $id_index = $saveIndex['last_id'];

    $insertado = 1;
    for ($i = 1; $i < count($arr_data[5][0]); $i++) {
        $num_partida        = $arr_data[5][0][$i][0];
        $txt_material       = $arr_data[5][0][$i][1];
        $unidad_medicion    = $arr_data[5][0][$i][3];
        $cantidad           = $arr_data[5][0][$i][4];
        $observaciones      = $arr_data[5][0][$i][5];

        $stmt_desgloce = "INSERT INTO uvzuyqbs_constructora.cotizaciones_desglose
                 (
                    id_cotizaciones_desglose,
                    id_cotizaciones_index,
                    numero_partida,
                    descripcion_material,
                    unidad_medicion,
                    cantidad,
                    observaciones,
                    date_log
                 ) 
                 VALUES(
                     NULL,
                     $id_index,
                    '$num_partida[0]',
                    '$txt_material[0]',
                    '$unidad_medicion[0]',
                    '$cantidad[0]',
                    '$observaciones[0]',
                    '" . date('Y-m-d H:i:s') . "'
                 )";
        $insertPartida = $queries->insertData($stmt_desgloce);
        if (!empty($insertPartida)) {
            $insertado++;
        }
    }

    if ($insertado == count($arr_data[5][0])) {
        $data = array(
            'response' => true,
            'message' => 'Se guardaron todas las partidas'
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

function guardarDetallesEntregaCotizacion()
{
    $queries = new Queries;


    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $comentarios_entrega = $_POST['comentarios_entrega'];
    $id_rutas_doc = $_POST['id_rutas_doc'];
    $fh_entrega = $fecha . " " . $hora;
    $sql_entregas = "INSERT INTO uvzuyqbs_constructora.entregas
    (
        id_rutas,
        fecha_entrega,
        comentarios
    ) VALUES(
        '$id_rutas_doc',
        '$fh_entrega',
        '$comentarios_entrega'
    )";
    $insertEntrega = $queries->insertData($sql_entregas);

    if (!empty($insertEntrega)) {
        $last_id = $insertEntrega['last_id'];
        $data = array(
            'response' => true,
            'message' => 'Se guardaron todas las partidas'
        );
    } else {
        $data = array(
            'response' => false,
            'message'                => ''
        );
    }
    echo json_encode($data);
}

function getInfoRequest()
{
    $id_solicitud = $_POST['id_solicitud'];

    $queries = new Queries;

    $stmt = "SELECT coti.`txt_proyectos`, coti.`id_proyectos` 
    FROM `cotizaciones_index` AS coti
    WHERE `id_cotizaciones_index`= $id_solicitud
        ";

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

function getFullInfoPayment()
{
    $id_pago = $_POST['id_pago'];

    $queries = new Queries;

    $stmt = "SELECT pag.*, pr.empresa_proveedor, payen.descripcion AS payment_enterprise_via, fp.descripcion AS tt_forma_pago, DATE_FORMAT(pag.fecha_pago, '%d/%m/%Y') AS fecha_pag
    FROM uvzuyqbs_constructora.`pagos_cotizaciones`  AS pag
    INNER JOIN uvzuyqbs_constructora.formas_pago AS fp ON pag.id_formas_pago = fp.id_formas_pago
    INNER JOIN uvzuyqbs_constructora.proveedores AS pr ON pag.id_proveedores = pr.id_proveedores
    INNER JOIN uvzuyqbs_constructora.payment_enterprise AS payen ON payen.id_empresa_pago_lis = pag.id_enterprise_payment
    WHERE id_pagos_cotizaciones = $id_pago ORDER BY id_pagos_cotizaciones DESC LIMIT 1";

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

function updateRequest()
{

    $id_index = $_POST['id_index'];
    $no_partida = $_POST['no_partida'];
    $column_name = $_POST['column_name'];
    $value = $_POST['value'];

    $queries = new Queries;

    $stmt = "UPDATE  uvzuyqbs_constructora.cotizaciones_desglose
             SET  $column_name = '$value'
             WHERE id_cotizaciones_index = $id_index AND numero_partida = $no_partida";

    $setStatusRequest = $queries->insertData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($setStatusRequest)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'message' => 'Se actualizó correctamente la información'
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al actualizar la información'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function deleteRequestItem()
{

    $id_partida = $_POST['id_partida'];
    $id_cotizacion = $_POST['id_cotizacion'];

    $queries = new Queries;

    $stmt = "DELETE FROM  uvzuyqbs_constructora.cotizaciones_desglose
             WHERE id_cotizaciones_index = $id_cotizacion AND numero_partida = $id_partida";

    $setStatusRequest = $queries->insertData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($setStatusRequest)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'message' => 'Se eliminó correctamente la partida'
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al eliminar la partida'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function getInfoDelivery()
{
    $id_entrega = $_POST['id_entrega'];

    $queries = new Queries;

    $stmt = "SELECT * FROM uvzuyqbs_constructora.`entregas` WHERE id_entrega = $id_entrega";

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
function changeStatusRequest()
{
    $id_solicitud = $_POST['id_solicitud'];
    $id_status = $_POST['id_status'];

    $queries = new Queries;

    $stmt = "UPDATE  uvzuyqbs_constructora.`cotizaciones_index` 
             SET  status = $id_status
    WHERE `id_cotizaciones_index`= $id_solicitud
        ";

    $setStatusRequest = $queries->insertData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($setStatusRequest)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'message' => 'Se actualizó el status de la solicitud'
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
function changeStatusRequestList()
{
    $id_desglose = $_POST['id_desglose'];
    $status = $_POST['status'];

    $queries = new Queries;

    $stmt = "UPDATE  uvzuyqbs_constructora.`cotizaciones_desglose` 
             SET  completa = $status
    WHERE `id_cotizaciones_desglose`= $id_desglose
        ";

    $setStatusRequest = $queries->insertData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($setStatusRequest)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'message' => 'Se actualizó correctamente'
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
