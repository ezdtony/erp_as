<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}

function getUserData()
{
    /* INFO GENERAL */
    $queries = new Queries;

    $id_user = $_POST['id_user'];

    $get_user_data = "SELECT usr.id_lista_personal,
        usr.id_niveles_areas,
        usr.id_niveles_academicos,
        usr.id_direcciones_personal,
        usr.id_contacto_personal,
        usr.nombres,
        usr.apellido_paterno,
        usr.apellido_materno,
        usr.codigo_usuario,
        usr.correo_sesion,
        usr.password,
        usr.fecha_nacimiento,
        usr.curp,
        usr.rfc,
        usr.nss,
        usr.genero,
        usr.estado_civil,
        dir.direccion_calle,
        dir.direccion_numero_int,
        dir.direccion_numero_ext,
        dir.direccion_colonia,
        dir.direccion_municipio,
        dir.direccion_zipcode,
        dir.direccion_estado,
        cont.id_contacto_personal,
        cont.telefono_principal,
        cont.telefono_secundario,
        cont.correo_electronico,
        cont.telefono_familiar_1,
        cont.telefono_familiar_2,
        niv.id_areas,
        niv.id_niveles_areas
    FROM asteleco_personal.lista_personal AS usr
    INNER JOIN asteleco_personal.contacto_personal AS cont ON usr.id_contacto_personal = cont.id_contacto_personal
    INNER JOIN asteleco_personal.direcciones_personal AS dir ON usr.id_direcciones_personal = dir.id_direcciones_personal
    INNER JOIN asteleco_personal.niveles_areas AS niv ON usr.id_niveles_areas = niv.id_niveles_areas
    WHERE usr.id_lista_personal = '$id_user'";
    $userData = $queries->getData($get_user_data);
    if (!empty($userData)) {
        $data = array(
            'response' => true,
            'data'                => $userData
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
