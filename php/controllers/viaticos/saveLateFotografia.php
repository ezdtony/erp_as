<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";
date_default_timezone_set('America/Mexico_City');

$proyecto = $_POST['proyecto'];
//$proyecto = "ACCESOS XOCHIMILCO";
$id_gasto = $_POST['last_id'];


$fecha_archivo = date('Y_m_d');
$hora_archivo = date('H:i:s');
$fyh = $fecha_archivo . ' ' . $hora_archivo;

$str_user_name = $_POST['user_name'];
$user_name = str_replace(' ', '_', $str_user_name);

$proyecto_carpeta = $proyecto;
$proyecto_carpeta = str_replace(' ', '_', $proyecto_carpeta);
$proyecto_subcarpeta = "TICKETS_COMPRA";

$nm_Archivo_img = "ast_img_" . $fecha_archivo . "-" . time();
$extension_img = basename($_FILES["fotografia"]["type"]);

$directorio_img =  dirname(__DIR__ . '', 3) . '/uploads/' . $user_name . "/" . $proyecto_carpeta . "/" . $proyecto_subcarpeta;

$archivo_img = $directorio_img . "/" .  $nm_Archivo_img . "." . $extension_img;

$ruta_sql_img = 'uploads/' . $user_name . "/" . $proyecto_carpeta . "/" . $proyecto_subcarpeta . "/" .  $nm_Archivo_img . "." . $extension_img;

$queries = new Queries;


if (!file_exists($directorio_img)) {
    mkdir($directorio_img, 0777, true);
}

if (move_uploaded_file($_FILES["fotografia"]["tmp_name"], $archivo_img)) {

    $data = array(
        'response' => true,
        'message' => 'Se guardó el archivo correctamente'
    );
    //echo json_encode($data);

    $sql = "INSERT INTO asteleco_viaticos_erp.rutas_archivos
    (
        id_rutas_archivos,
        ruta_archivo,
        nombre_archivo,
        tipo_archivo,
        fecha_subido,
        log_date
    ) VALUES(
        NULL,
        '$ruta_sql_img',
        '$nm_Archivo_img',
        '$extension_img',
        '$fecha_archivo',
        NOW()
    )";

    $queries = new Queries;
    $insert = $queries->insertData($sql);
    $last_id = $insert['last_id'];

    $sql_update_gasto = "UPDATE asteleco_viaticos_erp.gastos SET id_ruta_img = '$last_id' WHERE id_gastos = '$id_gasto'";
    
    $update_sql= $queries->insertData($sql_update_gasto);



    if (!empty($update_sql)) {
        $data = array(
            'response' => true,
            'message' => 'Se guardó la fotografía correctamente',
            'last_id' => $last_id
        );
    } else {
        $data = array(
            'response' => false,
            'message' => 'No se guardaron los archivos'
        );
    }
    echo json_encode($data);
} else {
    $data = array(
        'response' => false,
        'message' => 'No se guardó el archivo'
    );
    echo json_encode($data);
}
