<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}

function saveAlmacen()
{
    $queries = new Queries;
    $nombre_almacen = $_POST['nombre_almacen'];
    $direccion_almacen = $_POST['direccion_almacen'];

    $stmt = "INSERT INTO asteleco_herramienta.almacenes (
        nombre_almacen,
        direccion_almacen
    ) VALUES
    (
        '$nombre_almacen',
        '$direccion_almacen')";

    if ($queries->insertData($stmt)) {

        $data = array(
            'response' => true,
            'message' => 'Se registro correctamente el almacen',
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al agregar el proveedor'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function saveTipoKit()
{
    $queries = new Queries;
    $abreviatura_tipo_kit = $_POST['abreviatura_tipo_kit'];
    $descripcion_tipo_kit = $_POST['descripcion_tipo_kit'];

    $stmt = "INSERT INTO asteleco_herramienta.tipos_kits_herramienta (
        nombre_corto,
        descripcion_tipo
    ) VALUES
    (
        '$abreviatura_tipo_kit',
        '$descripcion_tipo_kit')";

    if ($queries->insertData($stmt)) {

        $data = array(
            'response' => true,
            'message' => 'Se registro correctamente el tipo de kit',
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al agregar el proveedor'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function saveKit()
{
    $queries = new Queries;
    $select_id_tipos_kits_herramienta = $_POST['select_id_tipos_kits_herramienta'];
    $nombre_de_kit = $_POST['nombre_de_kit'];

    $stmt = "INSERT INTO asteleco_herramienta.kits_herramienta (
        nombre_kit,
        id_tipos_kits_herramienta
    ) VALUES
    (
        '$nombre_de_kit',
        '$select_id_tipos_kits_herramienta')";

    if ($queries->insertData($stmt)) {

        $data = array(
            'response' => true,
            'message' => 'Se registro correctamente el kit',
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al agregar el proveedor'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
