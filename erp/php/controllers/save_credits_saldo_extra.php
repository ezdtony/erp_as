<?php
include_once dirname(__DIR__ . '', 1) . "/models/petitions.php";
date_default_timezone_set('America/Mexico_City');

$id_credito = $_POST['id_credito'];
$fecha_pago = $_POST['fecha_pago'];
$cantidad = $_POST['cantidad'];
//$proveedor = $_POST['proveedor'];


$fecha_archivo = date('Y-m-d');
$hora_archivo = date('H:i:s');
$fyh = $fecha_archivo . ' ' . $hora_archivo;


$proyecto_carpeta = 'ARCHIVOS_DE_CREDITOS';
$proyecto_carpeta = str_replace(' ', '_', $proyecto_carpeta);
$proyecto_subcarpeta = "COMPROBANTES_PAGO";

//$nm_Archivo_pdf = "CRD-PDF-" . $fecha_archivo . "-" . time();
//$nm_Archivo_xml = "CRD-XML-" . $fecha_archivo . "-" . time();
$nm_Archivo_img = "CRD-IMG-" . $fecha_archivo . "-" . time();


//$target_file = basename($_FILES["img_payment"]["name"]);

//$extension_pdf = basename($_FILES["pdf_payment"]["type"]);
//$extension_xml = basename($_FILES["xml_payment"]["type"]);
$extension_img = basename($_FILES["img_payment"]["type"]);

//$FileType = pathinfo($target_file, PATHINFO_EXTENSION);

$directorio_pdf =  dirname(__DIR__ . '', 2) . '/uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta;
//$directorio_xml =  dirname(__DIR__ . '', 2) . '/uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta;
$directorio_img =  dirname(__DIR__ . '', 2) . '/uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta;

//$archivo_pdf = $directorio_pdf . "/" .  $nm_Archivo_pdf . "." . $extension_pdf;
//$archivo_xml = $directorio_xml . "/" .  $nm_Archivo_xml . "." . $FileType;
$archivo_img = $directorio_img . "/" .  $nm_Archivo_img . "." . $extension_img;

//$ruta_sql_pdf = 'uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta . "/" .  $nm_Archivo_pdf . "." . $extension_pdf;
//$ruta_sql_xml = 'uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta . "/" .  $nm_Archivo_xml . "." . $FileType;
$ruta_sql_img = 'uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta . "/" .  $nm_Archivo_img . "." . $extension_img;

$r_code = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);
$random_code = "CR-" . $r_code;

$queries = new Queries;
$sql_monto = "SELECT * FROM constructora_personal.creditos WHERE id_credito = '$id_credito'";
$arr_monto = $queries->getData($sql_monto);

if (!empty($arr_monto)) {
    foreach ($arr_monto as $arr_monto) {
        $monto = $arr_monto->monto;
        $saldo = $arr_monto->saldo;
    }
}

if ($monto > $cantidad) {
    $monto = $monto;
}else{
    $monto = $cantidad;
}

if (($saldo+$cantidad)>$monto) {
    $monto = $saldo+$cantidad;
}

if (!file_exists($directorio_pdf)) {
    mkdir($directorio_pdf, 0777, true);
}

//if ((move_uploaded_file($_FILES["pdf_payment"]["tmp_name"], $archivo_pdf)) && (move_uploaded_file($_FILES["xml_payment"]["tmp_name"], $archivo_xml)) && (move_uploaded_file($_FILES["img_payment"]["tmp_name"], $archivo_img))) {
if ((move_uploaded_file($_FILES["img_payment"]["tmp_name"], $archivo_img))) {

    $sql_update = "UPDATE constructora_personal.creditos SET monto = '$monto',  saldo = saldo + '$cantidad' WHERE id_credito = '$id_credito'";

    $queries = new Queries;

    $update = $queries->insertData($sql_update);
    //$last_id = $insert['last_id'];

    $sql_insert =  "INSERT INTO constructora_personal.depositos_creditos(
        id_depositos_creditos,
        id_credito,
        cantidad,
        fecha,
        ruta_img)
        VALUES(
            null,
            '$id_credito',
            '$cantidad',
            '$fecha_pago',
            '$ruta_sql_img'
            )
        ";

    $insert = $queries->insertData($sql_insert);

    if (!empty($insert)) {
        $data = array(
            'response' => true,
            'message' => 'Se agregó saldo al crédito correctamente'
        );
    } else {
        $data = array(
            'response' => false,
            'message' => 'No se guardaron los datos'
        );
    }
    echo json_encode($data);
}
