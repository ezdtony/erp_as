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
    $random_code = "PY" . $id_proyecto . "-" . $cd1 . "-" . $cd2;
    $fyh = date('Y-m-d H:i:s');
    $stmt = "INSERT INTO asteleco_compras.cotizaciones 
                 (
                    id_proyecto,
                    codigo_cotizacion,
                    status_cotizacion,
                    id_usuario_created,
                    date_log
                 )
                 VALUES(
                    '$id_proyecto',
                    '$random_code',
                    '1',
                     $_SESSION[id_user],
                     NOW()
                 )";
    $saveIndex = $queries->insertData($stmt);
    $id_index = $saveIndex['last_id'];

    $insertado = 1;

    for ($i = 1; $i < count($arr_data[1][0]); $i++) {

        $num_partida        = $arr_data[1][0][$i][0][0];
        $txt_material       = $arr_data[1][0][$i][1][0];
        $unidad_medicion    = $arr_data[1][0][$i][2][0];
        $cantidad           = $arr_data[1][0][$i][3][0];
        $observaciones      = $arr_data[1][0][$i][4][0];
        $utilizacion        = $arr_data[1][0][$i][5][0];


        $stmt_desgloce = "INSERT INTO asteleco_compras.desglose_cotizacion
                 (
                    id_cotizaciones,
                    no_partida,
                    descripcion_partida,
                    cantidad,
                    unidad_medida,
                    comentarios,
                    utilizacion,
                    date_log
                 ) 
                 VALUES(
                    '$id_index',
                    '$num_partida',
                    '$txt_material',
                    '$cantidad',
                    '$unidad_medicion',
                    '$observaciones',
                    '$utilizacion',
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

    $stmt_get_clasif_details = "SELECT * FROM asteleco_compras.clasificaciones_catalogo";
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
