<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}


function getSiteZoneByIDCentral()
{
    $id_central = $_POST['id_central'];

    $queries = new Queries;

    $stmt = "SELECT zce.*
    FROM asteleco_accesos.zonas_central  AS zce
    WHERE zce.id_centrales = $id_central
    ORDER BY descripcion ASC";

    $getInfoRequest = $queries->getData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $getInfoRequest
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
function SaveDirectionSite()
{

    $calle_sitio = $_POST['calle_sitio'];
    $sitio_colonia = $_POST['sitio_colonia'];
    $sitio_zipcode = $_POST['sitio_zipcode'];
    $estado_sitio = $_POST['estado_sitio'];
    $municipio_sitio = $_POST['municipio_sitio'];
    $calle_numero_sitio = $_POST['calle_numero_sitio'];
    $referencias_sitio = $_POST['referencias_sitio'];
    $latitud_sitio = $_POST['latitud_sitio'];
    $longitud_sitio = $_POST['longitud_sitio'];

    $queries = new Queries;

    $stmt = "INSERT INTO asteleco_accesos.direcciones_accesos (
        direccion_calle,
        direccion_num_externo,
        direccion_colonia,
        direccion_municipio,
        direccion_estado,
        direccion_zipcode,
        direccion_referencias,
        latitud,
        longitud
        ) VALUES (
        '$calle_sitio',
        '$calle_numero_sitio',
        '$sitio_colonia',
        '$municipio_sitio',
        '$estado_sitio',
        '$sitio_zipcode',
        '$referencias_sitio',
        '$latitud_sitio',
        '$longitud_sitio'
        )";

    $getInfoRequest = $queries->insertData($stmt);
    $last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'last_id' => $last_id
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

function SaveNewSite()
{

    $num_sitio_astelecom = $_POST['num_sitio_astelecom'];
    $codigo_sitio = $_POST['codigo_sitio'];
    $nombre_sitio = $_POST['nombre_sitio'];
    $tipo_sitio = $_POST['tipo_sitio'];
    $id_central = $_POST['id_central'];
    $id_zona = $_POST['id_zona'];
    $tipo_cerradura = $_POST['tipo_cerradura'];
    $tipo_perimetro = $_POST['tipo_perimetro'];
    $id_direccion_sitio = $_POST['id_direccion_sitio'];
    $id_propietarios = $_POST['id_propietarios'];

    $queries = new Queries;

    $stmt = "INSERT INTO asteleco_accesos.sitios (
       id_centrales,
       id_zonas_central,
       id_direcciones_accesos,
       id_propietarios,
       id_tipo_perimetro,
       id_tipos_sitio,
       id_tipos_cerraduras,
       codigo_sitio,
       nombre_sitio,
       no_sitio_astelecom,
       logdate
        ) VALUES (
        $id_central,
        $id_zona,
        $id_direccion_sitio,
        $id_propietarios,
        $tipo_perimetro,
        $tipo_sitio,
        $tipo_cerradura,
        '$codigo_sitio',
        '$nombre_sitio',
        '$num_sitio_astelecom',
        NOW()
        )";

    $getInfoRequest = $queries->insertData($stmt);
    $last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'last_id' => $last_id
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

function SaveSitePropiety()
{

    $nombre_propietario = $_POST['nombre_propietario'];
    $apellidos_propietario = $_POST['apellidos_propietario'];
    $telefono_prop_1 = $_POST['telefono_prop_1'];
    $numero_prop_2 = $_POST['numero_prop_2'];
    $mail_propietario = $_POST['mail_propietario'];

    $queries = new Queries;

    $stmt = "INSERT INTO asteleco_accesos.propietarios (
       nombres,
         apellidos,
         numero_telefonico,
         numero_alternativo,
         correo_electronico
        ) VALUES (
        '$nombre_propietario',
        '$apellidos_propietario',
        '$telefono_prop_1',
        '$numero_prop_2',
        '$mail_propietario'
        )";

    $getInfoRequest = $queries->insertData($stmt);
    $last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'last_id' => $last_id
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