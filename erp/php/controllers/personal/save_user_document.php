<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";
date_default_timezone_set('America/Mexico_City');
$queries = new Queries;

$id_archivos_usuarios = $_POST['id_archivos_usuarios'];


$fecha_archivo = date('Y-m-d');
$hora_archivo = date('H:i:s');
$fyh = $fecha_archivo . ' ' . $hora_archivo;
$campo_archivo = "";
$codigo_usuario = "";

$sql_user_info = "SELECT 
                    usr.*, 
                    cat.nombre_archivo
                    FROM asteleco_personal.archivos_usuarios AS arc
                    INNER JOIN asteleco_personal.lista_personal AS usr ON arc.id_lista_personal = usr.id_lista_personal
                    INNER JOIN asteleco_personal.catalogo_archivos AS cat ON arc.id_catalogo_archivos = cat.id_catalogo_archivos
                    WHERE arc.id_archivos_usuarios = '$id_archivos_usuarios'";

$userInfo = $queries->getData($sql_user_info);
foreach ($userInfo as $info_user) {
    $campo_archivo = substr($info_user->nombre_archivo, 0, 3);
    $codigo_usuario = $info_user->codigo_usuario;
}

$usuario_carpeta = $codigo_usuario;
$usuario_subcarpeta = "archivos/";


$nm_Archivo = $campo_archivo."-".$codigo_usuario . "-" . $fecha_archivo . "-" . time();
$extension = basename($_FILES["archivo"]["type"]);

$directorio_archivo =  dirname(__DIR__ . '', 3) . '/uploads/archivo_colaboradores/' . $usuario_carpeta . "/" . $usuario_subcarpeta;

$archivo_pdf = $directorio_archivo .  $nm_Archivo . "." . $extension;
$ruta_sql = 'uploads/archivo_colaboradores/' . $usuario_carpeta . "/" . $usuario_subcarpeta . "" .  $nm_Archivo . "." . $extension;
if (!file_exists($directorio_archivo)) {
    mkdir($directorio_archivo, 0777, true);
}

if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo_pdf)) {
    $sql = "UPDATE asteleco_personal.archivos_usuarios SET 
    ruta_archivo = '$ruta_sql',
    nombre_archivo = '$nm_Archivo',
    fecha_carga = '$fyh',
    activo = '1' 
    WHERE id_archivos_usuarios = '$id_archivos_usuarios'";

    if (!empty($queries->insertData($sql))) {
        $data = array(
            'response' => true,
            'message' => 'Se guardo el archivo'
        );
    } else {
        $data = array(
            'response' => false,
            'message' => 'No se guardo el archivo'
        );
    }
    echo json_encode($data);
}
