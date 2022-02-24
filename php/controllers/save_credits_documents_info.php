<?php
include_once dirname(__DIR__ . '', 1) . "/models/petitions.php";
date_default_timezone_set('America/Mexico_City');

$fiscal_code = $_POST['fiscal_code'];
$fecha_pago = $_POST['fecha_pago'];
$monto_pago = $_POST['monto_pago'];
$proveedor = $_POST['proveedor'];


$fecha_archivo = date('Y-m-d');
$hora_archivo = date('H:i:s');
$fyh = $fecha_archivo . ' ' . $hora_archivo;


$proyecto_carpeta = 'ARCHIVOS DE CREDITOS';
$proyecto_carpeta = str_replace(' ', '_', $proyecto_carpeta);
$proyecto_subcarpeta = "COMPROBANTES_PAGO";

$nm_Archivo_pdf = "CRD-PDF-" . $fecha_archivo . "-" . time();
$nm_Archivo_xml = "CRD-XML-" . $fecha_archivo . "-" . time();
$nm_Archivo_img = "CRD-IMG-" . $fecha_archivo . "-" . time();


$target_file = basename($_FILES["xml_payment"]["name"]);

$extension_pdf = basename($_FILES["pdf_payment"]["type"]);
$extension_xml = basename($_FILES["xml_payment"]["type"]);
$extension_img = basename($_FILES["img_payment"]["type"]);

$FileType = pathinfo($target_file, PATHINFO_EXTENSION);

$directorio_pdf =  dirname(__DIR__ . '', 2) . '/uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta;
$directorio_xml =  dirname(__DIR__ . '', 2) . '/uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta;
$directorio_img =  dirname(__DIR__ . '', 2) . '/uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta;

$archivo_pdf = $directorio_pdf . "/" .  $nm_Archivo_pdf . "." . $extension_pdf;
$archivo_xml = $directorio_xml . "/" .  $nm_Archivo_xml . "." . $FileType;
$archivo_img = $directorio_img . "/" .  $nm_Archivo_img . "." . $extension_img;

$ruta_sql_pdf = 'uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta . "/" .  $nm_Archivo_pdf . "." . $extension_pdf;



$ruta_sql_xml = 'uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta . "/" .  $nm_Archivo_xml . "." . $FileType;

$ruta_sql_img = 'uploads/' . $proyecto_carpeta . "/" . $proyecto_subcarpeta . "/" .  $nm_Archivo_img . "." . $extension_img;

$r_code = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);
$random_code = "CR-" . $r_code ;

$queries = new Queries;
$check_code = "SELECT * FROM uvzuyqbs_constructora.creditos WHERE credit_code = '$random_code'";
$arr_code = $queries->getData($check_code);
if (!empty($arr_code)) {
    $random_code = "CD-" . $r_code;
}



if (!file_exists($directorio_pdf)) {
    mkdir($directorio_pdf, 0777, true);
}

if ((move_uploaded_file($_FILES["pdf_payment"]["tmp_name"], $archivo_pdf)) && (move_uploaded_file($_FILES["xml_payment"]["tmp_name"], $archivo_xml)) && (move_uploaded_file($_FILES["img_payment"]["tmp_name"], $archivo_img))) {

    $sql = "INSERT INTO uvzuyqbs_constructora.creditos
    (
        id_credito,
        credit_code,
        proveedor,
        monto,
        saldo,
    fecha_pago,
    folio_fiscal,
    ruta_pdf,
    ruta_xml,
    ruta_img,
    date_log
    ) VALUES(
        NULL,
        '$random_code',
        '$proveedor',
     '$monto_pago',
        '$monto_pago',
     '$fecha_pago',
        '$fiscal_code',
    '$ruta_sql_xml',
    '$ruta_sql_pdf',
    '$ruta_sql_img',
    '$fyh'
    )";

    $queries = new Queries;
    $insert = $queries->insertData($sql);
    $last_id = $insert['last_id'];



    if (!empty($insert)) {
        $data = array(
            'response' => true,
            'message' => 'Se guardó el crédito correctamente',
            'last_id' => $last_id
        );
    } else {
        $data = array(
            'response' => false,
            'message' => 'No se guardaron los archivos'
        );
    }
    echo json_encode($data);
}
