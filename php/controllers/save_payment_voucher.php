<?php
include_once dirname(__DIR__ . '', 1) . "/models/petitions.php";
date_default_timezone_set('America/Mexico_City');

$id_cotizacion = $_POST['id_cotizacion'];
$comentarios_archivo = $_POST['comentarios_archivo'];

$comentarios_archivo = $_POST['comentarios_archivo'];
$id_cotizacion = $_POST['id_cotizacion'];
$fecha_pago = $_POST['fecha_pago'];
$id_usuario = $_POST['id_usuario'];

$fecha_pago = $_POST['fecha_pago'];
$fecha_archivo = date('Y-m-d');
$hora_archivo = date('H:i:s');
$fyh = $fecha_archivo . ' ' . $hora_archivo;

$txt_proyecto = $_POST['txt_proyecto'];
$arr_codigo_proyecto = $_POST['codigo_proyecto'];
$codigo_proyecto = $arr_codigo_proyecto;

$proyecto_carpeta = $txt_proyecto;
$proyecto_carpeta = str_replace(' ', '_', $proyecto_carpeta);
$proyecto_subcarpeta = "COMPROBANTES_PAGO/";

$nm_Archivo = $codigo_proyecto."-" . $fecha_archivo . "-" . time();
$extension = basename($_FILES["archivo"]["type"]);

$directorio_pdf =  dirname(__DIR__ . '', 2) . '/uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta;

$archivo_pdf = $directorio_pdf .  $nm_Archivo . "." . $extension;
$ruta_sql = 'uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta .   $nm_Archivo . "." . $extension;
if (!file_exists($directorio_pdf)) {
    mkdir($directorio_pdf, 0777, true);
}

if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo_pdf)) {
    $sql = "INSERT INTO uvzuyqbs_constructora.pagos_cotizaciones
     (id_pagos_cotizaciones,
     id_formas_pago,
     id_cotizaciones_index,
     url_factura,
     fecha_pago,
     fecha_registro,
     id_usuario_que_pago
    )
        VALUES(
        NULL,
        '1',
        '$id_cotizacion',
        '$ruta_sql',
        '$fecha_pago',
        '$fyh',
        '$id_usuario'
        )";

    $queries = new Queries;
    $insert = $queries->insertData($sql);
    $last_id = $insert['last_id'];



    if (!empty($insert)) {
        $data = array(
            'response' => true,
            'message' => 'Se guardo el archivo',
            'last_id' => $last_id
        );
    } else {
        $data = array(
            'response' => false,
            'message' => 'No se guardo el archivo'
        );
    }
    echo json_encode($data);
}
