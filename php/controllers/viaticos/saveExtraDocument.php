<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";
session_start();
date_default_timezone_set('America/Mexico_City');

$queries = new Queries;


//$proyecto = "ACCESOS XOCHIMILCO";
$id_gasto = $_POST['id_gasto'];
$descripcion_archivo_extra = $_POST['descripcion_archivo_extra'];
$get_proyectInfo = "SELECT proy.* FROM 
                    asteleco_viaticos_erp.gastos AS gas 
                    INNER JOIN asteleco_proyectos.proyectos as proy ON proy.id_proyectos = gas.id_proyectos
                    WHERE gas.id_gastos = $id_gasto";
$proyectInfo = $queries->getData($get_proyectInfo);

$proyecto = $proyectInfo[0]->codigo_proyecto;





$fecha_archivo = date('Y_m_d');
$hora_archivo = date('H:i:s');
$fyh = $fecha_archivo . ' ' . $hora_archivo;
$fecha_archivo2 = date('Y-m-d');
$fyh2 = $fecha_archivo2 . ' ' . $hora_archivo;

$str_user_name = $_SESSION['user'];
$user_name = str_replace(' ', '_', $str_user_name);

$proyecto_carpeta = $proyecto;
$proyecto_carpeta = str_replace(' ', '_', $proyecto_carpeta);
$proyecto_subcarpeta = "ARCHIVOS_EXTRA";

$nm_Archivo_img = "ast_extr_" . $fecha_archivo . "-" . time();
$extension_img = basename($_FILES["extra_document"]["type"]);

$directorio_img =  dirname(__DIR__ . '', 3) . '/uploads/' . $user_name . "/" . $proyecto_carpeta . "/" . $proyecto_subcarpeta;

$archivo_img = $directorio_img . "/" .  $nm_Archivo_img . "." . $extension_img;

$ruta_sql_img = 'uploads/' . $user_name . "/" . $proyecto_carpeta . "/" . $proyecto_subcarpeta . "/" .  $nm_Archivo_img . "." . $extension_img;



if (!file_exists($directorio_img)) {
    mkdir($directorio_img, 0777, true);
}

if (move_uploaded_file($_FILES["extra_document"]["tmp_name"], $archivo_img)) {

    $data = array(
        'response' => true,
        'message' => 'Se guardó el archivo correctamente'
    );
    //echo json_encode($data);

    $sql = "INSERT INTO asteleco_viaticos_erp.archivos_adicionales
    (
        id_gastos,
        ruta_archivo,
        datelog,
        descripcion_archivo
    ) VALUES(
        $id_gasto,
        '$ruta_sql_img',
        NOW(),
        '$descripcion_archivo_extra'
    )";
    $insert = $queries->insertData($sql);

    if (!empty($insert)) {
        $last_id = $insert['last_id'];

        $html = "";
        $html .= '<tr id="trArchivoExtra'.$last_id.'"><td>'.$descripcion_archivo_extra.'</td><td>'.$fyh2.'</td><td><a class="btn btn-secondary" href="'.$ruta_sql_img.'" target="_blank"><i class="fa-solid fa-file"></i></a></td></tr>';

        $data = array(
            'response' => true,
            'message' => 'Se guardó el archivo correctamente',
            'last_id' => $last_id,
            'html' => $html
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
