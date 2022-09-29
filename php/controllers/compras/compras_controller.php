<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}


function guardarCotizacion()
{
    $queries = new Queries;
    $arr_data = $_POST['arr_data'];

    $id_proyecto = $arr_data[0][0];
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    // Output: 54esmdr0qf
    $cd1 = (substr(str_shuffle($permitted_chars), 0, 3));
    $cd2 = (substr(str_shuffle($permitted_chars), 0, 3));
    $cd3 = (substr(str_shuffle($permitted_chars), 0, 3));
    $random_code = "CMPY" . $id_proyecto . "-" . $cd1 . "-" . $cd2;
    $fyh = date('Y-m-d H:i:s');
    $stmt = "INSERT INTO asteleco_compras.cotizaciones 
                 (
                    id_status_cotizaciones,
                    id_proyecto,
                    codigo_solicitud,
                    id_personal_registro,
                    date_log
                 )
                 VALUES(
                    '1',
                    '$id_proyecto',
                    '$random_code',
                     $_SESSION[id_user],
                     NOW()
                 )";
    $saveIndex = $queries->insertData($stmt);
    $id_index = $saveIndex['last_id'];

    $insertado = 1;

    for ($i = 1; $i < count($arr_data[1][0]); $i++) {


        $id_catalogo_material         = $arr_data[1][0][$i][0][0];
        $id_medidas_de_longitud       = $arr_data[1][0][$i][1][0];
        $marca                        = $arr_data[1][0][$i][2][0];
        $no_partida                   = $arr_data[1][0][$i][3][0];
        $cantidad                     = $arr_data[1][0][$i][4][0];
        $observaciones                = $arr_data[1][0][$i][5][0];


        $stmt_desgloce = "INSERT INTO asteleco_compras.desglose_cotizacion
                 (
                    id_cotizaciones,
                    id_catalogo_material,
                    id_medidas_de_longitud,
                    id_status_partidas,
                    id_marcas,
                    id_proveedores,
                    no_partida,
                    cantidad,
                    comentarios,
                    marca,
                    date_log
                 ) 
                 VALUES(
                    '$id_index',
                    '$id_catalogo_material',
                    '$id_medidas_de_longitud',
                    '1',
                    '1',
                    '1',
                    '$no_partida',
                    '$cantidad',
                    '$observaciones',
                    '$marca',
                    NOW()
                 )";
        $insertPartida = $queries->insertData($stmt_desgloce);
        if (!empty($insertPartida)) {
            $insertado++;
        }
    }

    if ($insertado == count($arr_data[1][0])) {
        $data = array(
            'response' => true,
            'message' => 'Se guardaron todas las partidas'
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
function updatePartida()
{
    $queries = new Queries;

    $id_desglose_cotizacion = $_POST['id_desglose_cotizacion'];
    $column_name = $_POST['column_name'];
    $value = $_POST['value'];

    $stmt = "UPDATE asteleco_compras.desglose_cotizacion 
    SET $column_name = '$value' 
    WHERE id_desglose_cotizacion = '$id_desglose_cotizacion'";

    if ($queries->insertData($stmt)) {
        $data = array(
            'response' => true,
            'message' => 'Se actualizó la partida'
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al actualizar la partida'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function deletePartida()
{
    $queries = new Queries;

    $id_desglose_cotizacion = $_POST['id_desglose_cotizacion'];

    $stmt = "DELETE FROM asteleco_compras.desglose_cotizacion WHERE id_desglose_cotizacion = '$id_desglose_cotizacion'";

    if ($queries->insertData($stmt)) {
        $data = array(
            'response' => true,
            'message' => 'Se eliminó la partida'
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al eliminar la partida'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}

function guardarNuevoConceptoCatalogo()
{
    $queries = new Queries;

    $nombre_material = $_POST['nombre_material'];
    $id_clasificacion = $_POST['id_clasificacion'];
    $id_unidad_medida = $_POST['id_unidad_medida'];
    $apply_ul = $_POST['apply_ul'];


    //GENERAR CÓDIGO DE MATERIAL
    $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $additional_chars = substr(str_shuffle($permitted_chars), 0, 3);

    $stmt_get_clasif_details = "SELECT * FROM asteleco_compras.clasificaciones_catalogo WHERE id_clasificaciones_catalogo = '$id_unidad_medida'";
    $getClasifDetails = $queries->getData($stmt_get_clasif_details);
    $getClasifDetails = $getClasifDetails[0];
    $nombre_corto = $getClasifDetails->nombre_corto;



    $stmt = "INSERT INTO asteleco_compras.catalogo_material 
    (id_clasificaciones_catalogo,
    id_unidades_medida,
    descripcion_material,
    aplica_ul,
    date_log)
    VALUES(
        '$id_clasificacion',
        '$id_unidad_medida',
        '$nombre_material',
        '$apply_ul',
        NOW()
    )";

    if ($guardar_material = $queries->insertData($stmt)) {
        $last_id = $guardar_material['last_id'];

        $codigo_material = $nombre_corto . "-" . $additional_chars . "-00" . $last_id;
        $stmt_update = "UPDATE asteleco_compras.catalogo_material SET codigo_astelecom = '$codigo_material' WHERE id_catalogo_material = '$last_id'";

        if ($queries->insertData($stmt_update)) {
            //--- --- ---//
            $data = array(
                'response' => true,
                'message' => 'Se guardó el nuevo material correctamente'
            );
        } else {
            $data = array(
                'response' => true,
                'message' => 'Se guardó el nuevo material correctamente, pero no se actualizó el código'
            );
        }
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al eliminar la partida'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}

function getMaterialesPorClasificacion()
{
    $queries = new Queries;

    $id_clasificacion = $_POST['id_clasificacion'];

    $stmt = "SELECT * FROM asteleco_compras.catalogo_material WHERE id_clasificaciones_catalogo= '$id_clasificacion'";
    $getMateriales = $queries->getData($stmt);
    if (!empty($getMateriales)) {
        $data = array(
            'response' => true,
            'data' => $getMateriales
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Al parecer no hay material registrado bajo esta clasificación'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function getMedidasLongitud()
{
    $queries = new Queries;

    $id_unidad_longitud = $_POST['id_unidad_longitud'];

    $stmt = "SELECT ul.*, ml.* 
    FROM asteleco_compras.medidas_de_longitud AS ml
    INNER JOIN asteleco_compras.unidades_de_longitud AS ul ON ml.id_unidades_de_longitud = ul.id_unidades_de_longitud
    WHERE ml.id_unidades_de_longitud = '$id_unidad_longitud'";
    $getMateriales = $queries->getData($stmt);
    if (!empty($getMateriales)) {
        $data = array(
            'response' => true,
            'data' => $getMateriales
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Al parecer no hay material registrado bajo esta clasificación'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function updateStatusCotizacion()
{
    $queries = new Queries;

    $id_cotizacion = $_POST['id_cotizacion'];
    $column_name = 'id_status_cotizaciones';
    $value = $_POST['id_status_cotizacion'];

    $stmt = "UPDATE asteleco_compras.cotizaciones
    SET $column_name = '$value'
    WHERE id_cotizaciones = '$id_cotizacion'";

    if ($queries->insertData($stmt)) {
        $stmt_get_properties = "SELECT *
        FROM  asteleco_compras.status_cotizaciones
        WHERE id_status_cotizaciones = '$value'";
        $getInfoRequest = $queries->getData($stmt_get_properties);
        $data = array(
            'response' => true,
            'message' => 'Se actualizó la partida',
            'data' => $getInfoRequest
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al actualizar la cotización'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function updateStatusPartida()
{
    $queries = new Queries;

    $id_partida = $_POST['id_partida'];
    $cotizada = $_POST['cotizada'];

    $stmt = "UPDATE asteleco_compras.desglose_cotizacion
    SET cotizada = '$cotizada'
    WHERE id_desglose_cotizacion = '$id_partida'";

    if ($data_sql = $queries->insertData($stmt)) {

        $data = array(
            'response' => true,
            'message' => 'Se actualizó la partida'
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al actualizar la partida'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
