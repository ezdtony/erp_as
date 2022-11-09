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

function saveHerramientaKit()
{
    $queries = new Queries;

    $nombre_de_herramienta = $_POST['nombre_de_herramienta'];
    $marca_de_herramienta = $_POST['marca_de_herramienta'];
    $modelo_herramienta = $_POST['modelo_herramienta'];
    $numero_serie_herramienta = $_POST['numero_serie_herramienta'];
    $selectStatusHerramienta = $_POST['selectStatusHerramienta'];
    $selectAlmacenHerramienta = $_POST['selectAlmacenHerramienta'];
    $comentarios_herramienta = $_POST['comentarios_herramienta'];
    $id_kit = $_POST['id_kit'];


    $stmt = "INSERT INTO asteleco_herramienta.herramienta (
        id_kits_herramienta,
        id_almacenes,
        id_status_herramienta,
        descripcion_herramienta,
        marca,
        modelo,
        comentarios,
        no_serie) VALUES
    (
        '$id_kit',
        '$selectAlmacenHerramienta',
        '$selectStatusHerramienta',
        '$nombre_de_herramienta',
        '$marca_de_herramienta',
        '$modelo_herramienta',
        '$comentarios_herramienta',
        '$numero_serie_herramienta'
        )";
    $insert_data = $queries->insertData($stmt);
    if (!empty($insert_data)) {
        $last_id = $insert_data['last_id'];
        $str_code = mb_strtoupper(substr(str_replace(' ', '', $nombre_de_herramienta), 0, 2));
        $code = $str_code . '-00' . $last_id;
        $stmt = "UPDATE asteleco_herramienta.herramienta SET codigo_herramienta = '$code' WHERE id_herramienta = '$last_id'";
        $queries->insertData($stmt);
        $data = array(
            'response' => true,
            'message' => 'Se guardó correctamente la herramienta',
            'last_id' => $last_id,
            'code' => $code,
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

function getStatusHerramienta()
{
    $queries = new Queries;
    $id_herramienta = $_POST['last_id'];
    $id_selected = $_POST['id_selected'];

    $stmt = "SELECT * FROM asteleco_herramienta.status_herramienta";
    $get_data = $queries->getData($stmt);
    if (!empty($get_data)) {
        $html = '';
        $html .= '<select id="statusHerramienta" class="form-select mb-3" data-id-herramienta="' . $id_herramienta . '">';
        $html .= '<option value="" disabled>Selecciona una opción</option>';
        foreach ($get_data as $value) {
            if ($value->id_status_herramienta == $id_selected) {
                $html .= '<option selected value="' . $value->id_status_herramienta . '">' . $value->descripcion . '</option>';
            } else {
                $html .= '<option value="' . $value->id_status_herramienta . '">' . $value->descripcion . '</option>';
            }
        }
        $html .= '</select>';
        $data = array(
            'response' => true,
            'html' => $html
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

function getAlmacenHerramienta()
{
    $queries = new Queries;
    $id_herramienta = $_POST['last_id'];
    $id_selected = $_POST['id_selected'];

    $stmt = "SELECT * FROM asteleco_herramienta.almacenes";
    $get_data = $queries->getData($stmt);
    if (!empty($get_data)) {
        $html = '';
        $html .= '<select id="almacenesHerramienta" class="form-select mb-3" data-id-herramienta="' . $id_herramienta . '">';
        $html .= '<option value="" disabled>Selecciona una opción</option>';
        foreach ($get_data as $value) {
            if ($value->id_almacenes == $id_selected) {
                $html .= '<option selected value="' . $value->id_almacenes . '">' . $value->nombre_almacen . '</option>';
            } else {
                $html .= '<option value="' . $value->id_almacenes . '">' . $value->nombre_almacen . '</option>';
            }
        }
        $html .= '</select>';
        $data = array(
            'response' => true,
            'html' => $html
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
function updateStatusHerramienta()
{
    $queries = new Queries;

    $id_status = $_POST['id_status'];
    $id_herramienta = $_POST['id_herramienta'];

    $stmt = "UPDATE asteleco_herramienta.herramienta SET id_status_herramienta = '$id_status' WHERE id_herramienta = '$id_herramienta'";
    if ($queries->insertData($stmt)) {

        $data = array(
            'response' => true,
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al actualizar el status'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}

function updateAlmacenHerramienta()
{
    $queries = new Queries;

    $id_almacen = $_POST['id_almacen'];
    $id_herramienta = $_POST['id_herramienta'];

    $stmt = "UPDATE asteleco_herramienta.herramienta SET id_almacenes = '$id_almacen' WHERE id_herramienta = '$id_herramienta'";
    if ($queries->insertData($stmt)) {

        $data = array(
            'response' => true,
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al actualizar el status'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}

function deleteHerramienta()
{
    $queries = new Queries;

    $id_almacen = $_POST['id_almacen'];
    $id_herramienta = $_POST['id_herramienta'];

    $stmt = "DELETE FROM asteleco_herramienta.herramienta  WHERE id_herramienta = '$id_herramienta'";
    if ($queries->insertData($stmt)) {

        $data = array(
            'response' => true,
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al actualizar el status'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function getPersonalAssignedKit()
{
    $id_kit = $_POST['id_kit'];

    $queries = new Queries;

    $stmt = "SELECT 
    asp.id_asignaciones_material,
    psn.id_lista_personal AS id_personal,
    CONCAT(
    acad.shortname_nivel, ' ', 
    psn.nombres, ' ', 
    psn.apellido_paterno, ' ',
        psn.apellido_materno
    ) AS nombre_completo
    
    FROM asteleco_personal.lista_personal AS psn
    INNER JOIN asteleco_personal.niveles_academicos AS acad ON psn.id_niveles_academicos = acad.id_niveles_academicos
    INNER JOIN asteleco_herramienta.asignaciones_kits AS asp ON psn.id_lista_personal = asp.id_personal AND asp.id_kits_herramienta = $id_kit
        ";

    $getPersonalAviable = $queries->getData($stmt);

    if (!empty($getPersonalAviable)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $getPersonalAviable
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
function unassignPersonalKit()
{
    $id_asingacion = $_POST['id_asingacion'];

    $queries = new Queries;

    $stmt = "DELETE FROM asteleco_herramienta.asignaciones_kits WHERE id_asignaciones_material = $id_asingacion";


    if ($queries->insertData($stmt)) {


        //--- --- ---//
        $data = array(
            'response' => true,
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

function asignarKit()
{
    $queries = new Queries;

    $id_kit = $_POST['id_kit'];
    $ids_personal = $_POST['ids_personal'];

    foreach ($ids_personal as $id_personal) {
        $stmt = "INSERT INTO asteleco_herramienta.asignaciones_kits (id_kits_herramienta, id_personal, fecha_asignacion) 
        VALUES ('$id_kit', 
        '$id_personal',
        NOW())";

        if ($queries->insertData($stmt)) {
            $data = array(
                'response' => true,
            );
            //--- --- ---//
        } else {
            //--- --- ---//
            $data = array(
                'response' => false,
                'message'                => 'Ocurrió un error al actualizar el status'
            );
            //--- --- ---//
        }
    }

    echo json_encode($data);
}
