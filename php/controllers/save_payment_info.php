<?php
include_once dirname(__DIR__ . '', 1) . "/models/petitions.php";
date_default_timezone_set('America/Mexico_City');
$id_cotizacion = $_POST['id_cotizacion'];
$id_proyecto = $_POST['id_proyecto'];
$comentarios_archivo = $_POST['comentarios_archivo'];

$fecha_archivo = date('Y-m-d');
$hora_archivo = date('H:i:s');
$fyh = $fecha_archivo . ' ' . $hora_archivo;

$proyecto_carpeta = "TG_MARIANO_ESCOBEDO";
$proyecto_carpeta = str_replace(' ', '_', $proyecto_carpeta);
$proyecto_subcarpeta = "SOLICITUDES_MATERIAL/cotizaciones/";

$nm_Archivo = "STGME-" . $fecha_archivo . "-" . time();
$extension = basename($_FILES["archivo"]["type"]);

$directorio_pdf =  dirname(__DIR__ . '', 2) . '/uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta;

$archivo_pdf = $directorio_pdf .  $nm_Archivo . "." . $extension;
$ruta_sql='uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta . "/".  $nm_Archivo . "." . $extension;
if (!file_exists($directorio_pdf)) {
    mkdir($directorio_pdf, 0777, true);
}

if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo_pdf)) {
    $sql = "INSERT INTO constructora_personal.rutas_archivos
     (id_ruta,
     tipo_archivo,
     nombre_archivo,
     ruta,
     id_proyecto,
        id_cotizacion,
        fecha_upload,
        comentarios
    )
        VALUES(
        NULL,
        '$extension',
        '$nm_Archivo',
        '$ruta_sql',
        '$id_proyecto',
        '$id_cotizacion',
        '$fyh',
        '$comentarios_archivo'
        )";

     $queries = new Queries;
     $insert = $queries->insertData($sql);
     $last_id = $insert['last_id'];



    if(!empty($insert)){
        $data = array(
            'response' => true,
            'message' => 'Se guardo el archivo',
            'last_id' => $last_id
        );
    }else{
        $data = array(
            'response' => false,
            'message' => 'No se guardo el archivo'
        );
    }
    echo json_encode($data);
}