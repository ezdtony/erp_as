<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}

function deleteProveedor()
{
    $queries = new Queries;
    $id_proveedor = $_POST['id_proveedor'];

    $stmt = "DELETE FROM asteleco_compras.proveedores where id_proveedores = $id_proveedor";

    if ($queries->insertData($stmt)) {

        $data = array(
            'response' => true,
            'message' => 'Se eliminó el proveedor correctamente!!',
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al eliminar el proveedor'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}

function updateProveedor()
{
    $queries = new Queries;
    $id_proveedor = $_POST['id_proveedor'];
    $column_name = $_POST['column_name'];
    $value = $_POST['value'];

    $stmt = "UPDATE asteleco_compras.proveedores SET $column_name = '$value'
     where id_proveedores = $id_proveedor";

    if ($queries->insertData($stmt)) {

        $data = array(
            'response' => true,
            'message' => 'Se actualizó el proveedor correctamente!!',
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al eliminar el proveedor'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}

function deleteUmedida()
{
    $queries = new Queries;
    $id_umedida = $_POST['id_umedida'];

    $stmt = "DELETE FROM asteleco_compras.unidades_medida where id_unidades_medida = $id_umedida";

    if ($queries->insertData($stmt)) {

        $data = array(
            'response' => true,
            'message' => 'Se eliminó la unidad de medida correctamente!!',
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al eliminar la unidad de medida!!'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function updateUmedida()
{
    $queries = new Queries;
    $id_umedida = $_POST['id_umedida'];
    $column_name = $_POST['column_name'];
    $value = $_POST['value'];

    $stmt = "UPDATE asteleco_compras.unidades_medida SET $column_name = '$value'
     where id_unidades_medida = $id_umedida";

    if ($queries->insertData($stmt)) {

        $data = array(
            'response' => true,
            'message' => 'Se actualizó la unidad de medida correctamente!!',
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al actualizar la unidad de medida'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}

function deleteClasif()
{
    $queries = new Queries;
    $id_clasif = $_POST['id_clasif'];

    $stmt = "DELETE FROM asteleco_compras.clasificaciones_catalogo where id_clasificaciones_catalogo = $id_clasif";

    if ($queries->insertData($stmt)) {

        $data = array(
            'response' => true,
            'message' => 'Se eliminó la clasificación correctamente!!',
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al eliminar la clasificación!!'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function updateClasif()
{
    $queries = new Queries;
    $id_clasif = $_POST['id_clasif'];
    $column_name = $_POST['column_name'];
    $value = $_POST['value'];

    $stmt = "UPDATE asteleco_compras.clasificaciones_catalogo SET $column_name = '$value'
     where id_clasificaciones_catalogo = $id_clasif";

    if ($queries->insertData($stmt)) {

        $data = array(
            'response' => true,
            'message' => 'Se actualizó la unidad de medida correctamente!!',
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al actualizar la unidad de medida'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}


