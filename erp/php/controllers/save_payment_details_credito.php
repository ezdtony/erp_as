<?php
include_once dirname(__DIR__ . '', 1) . "/models/petitions.php";
date_default_timezone_set('America/Mexico_City');

$id_pago = $_POST['id_pago'];
$id_forma_pago = $_POST['id_forma_pago'];
$cantidad = $_POST['cantidad'];
$cfdi = $_POST['cfdi'];
$id_proveedor = $_POST['id_proveedor'];
$comentarios = $_POST['comentarios'];
$id_enterprise_payment = $_POST['id_enterprise_payment'];
$id_credito = $_POST['id_credito'];

$fecha_archivo = date('Y-m-d');
$hora_archivo = date('H:i:s');
$fyh = $fecha_archivo . ' ' . $hora_archivo;


$txt_proyecto = $_POST['txt_proyecto'];
$arr_codigo_proyecto = explode("-", $_POST['codigo_proyecto']);
$codigo_proyecto = $arr_codigo_proyecto[0];

$proyecto_carpeta = $txt_proyecto;
$proyecto_carpeta = str_replace(' ', '_', $proyecto_carpeta);
$proyecto_subcarpeta = "COMPROBANTES_PAGO";

$nm_Archivo_pdf = $codigo_proyecto . "-" . $id_pago . "PAG-PDF-" . $fecha_archivo . "-" . time();
$nm_Archivo_xml = $codigo_proyecto . "-" . $id_pago . "PAG-XML-" . $fecha_archivo . "-" . time();


$target_file = basename($_FILES["xml"]["name"]);

$extension_pdf = basename($_FILES["pdf"]["type"]);
$extension_xml = basename($_FILES["xml"]["type"]);
$FileType = pathinfo($target_file, PATHINFO_EXTENSION);

$directorio_pdf =  dirname(__DIR__ . '', 2) . '/uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta;
$directorio_xml =  dirname(__DIR__ . '', 2) . '/uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta;

$archivo_pdf = $directorio_pdf . "/" .  $nm_Archivo_pdf . "." . $extension_pdf;
$archivo_xml = $directorio_xml . "/" .  $nm_Archivo_xml . "." . $FileType;

$ruta_sql_pdf = 'uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta . "/" .  $nm_Archivo_pdf . "." . $extension_pdf;



$ruta_sql_xml = 'uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta . "/" .  $nm_Archivo_xml . "." . $FileType;


if (!file_exists($directorio_pdf)) {
    mkdir($directorio_pdf, 0777, true);
}

if ((move_uploaded_file($_FILES["pdf"]["tmp_name"], $archivo_pdf)) && (move_uploaded_file($_FILES["xml"]["tmp_name"], $archivo_xml))) {


    $queries = new Queries;

    $sql_check_saldo = "SELECT * FROM constructora_personal.creditos WHERE id_credito = '$id_credito'";
    $result_check_saldo = $queries->getData($sql_check_saldo);
    foreach ($result_check_saldo as $row_check_saldo) {
        $saldo_actual = $row_check_saldo->saldo;
    }

    $update_credit = array();

    if ($saldo_actual > $cantidad) {

        $sql_credito = "UPDATE constructora_personal.creditos SET saldo = saldo-$cantidad WHERE id_credito = '$id_credito'";
        $update_credit = $queries->insertData($sql_credito);

        $sql_chec_credito = "SELECT * FROM constructora_personal.pagos_cotizaciones WHERE id_pagos_cotizaciones = '$id_pago' AND id_credito IS NOT NULL";
        $result_chec_credito = $queries->getData($sql_chec_credito);

        if (!empty($result_chec_credito)) {
            foreach ($result_chec_credito as $creditos) {
                $id_credito = $creditos->id_credito;
                $cantidad_registrada = $creditos->cantidad_pago;
            }
            $sql_update_credito = "UPDATE constructora_personal.creditos SET saldo = saldo + '$cantidad_registrada' WHERE id_credito = '$id_credito'";
            $result_update_credito = $queries->insertData($sql_update_credito);
        }



        if (!empty($update_credit)) {

            $sql = "UPDATE constructora_personal.pagos_cotizaciones SET
            id_formas_pago = '$id_forma_pago',
            id_proveedores = '$id_proveedor',
            cantidad_pago = '$cantidad',  
            url_xml = '$ruta_sql_xml',
            url_pdf = '$ruta_sql_pdf',
            cfdi = '$cfdi',
            comentarios = '$comentarios',
            id_enterprise_payment = '$id_enterprise_payment',
            id_credito = '$id_credito'
            WHERE id_pagos_cotizaciones = '$id_pago'";


            $insert = $queries->insertData($sql);
            $last_id = $insert['last_id'];
            if (!empty($insert)) {
                $data = array(
                    'response' => true,
                    'message' => 'Se guardaron los archivos correctamente',
                    'last_id' => $last_id
                );
            }
        } else {
            $data = array(
                'response' => false,
                'message' => 'No se guardaron los archivos'
            );
        }
    } else {
        $data = array(
            'response' => false,
            'message' => 'El crédito no tiene saldo suficiente'
        );
    }
    echo json_encode($data);
}
