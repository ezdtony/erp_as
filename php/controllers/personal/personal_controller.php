<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}


function getAreaLevelsByAreaID()
{
    $id_area = $_POST['id_area'];

    $queries = new Queries;

    $stmt = "SELECT id_niveles_areas, descripcion_niveles_areas
    FROM asteleco_personal.`niveles_areas`  AS niv_ar
    WHERE niv_ar.id_areas = $id_area
    ORDER BY descripcion_niveles_areas ASC";

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

function saveNewUser()
{
    /* INFO GENERAL */

    $id_area_level = $_POST['id_area_level'];
    $id_academic_level = $_POST['id_academic_level'];
    $id_genero = $_POST['id_genero'];
    $nombre = $_POST['nombre'];
    $ap_paterno = $_POST['ap_paterno'];
    $ap_materno = $_POST['ap_materno'];
    $curp = $_POST['curp'];
    $nss = $_POST['nss'];
    $arr_fecha_nacimiento = explode("/", $_POST['fecha_nacimiento']);
    $fecha_nacimiento = $arr_fecha_nacimiento[2] . "-" . $arr_fecha_nacimiento[1] . "-" . $arr_fecha_nacimiento[0];
    $rfc = $_POST['rfc'];
    $id_estado_civil = $_POST['id_estado_civil'];

    /* INFO DIRECCION */
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $colonia = $_POST['colonia'];
    $cp = $_POST['cp'];
    $id_municipio = $_POST['id_municipio'];
    $id_estado = $_POST['id_estado'];

    /* INFO CONTACTO */
    $telefono_pricnipal = $_POST['telefono_pricnipal'];
    $telefono_secundario = $_POST['telefono_secundario'];
    $correo_personal = $_POST['correo_personal'];
    $telefono_familiar_pricnipal = $_POST['telefono_familiar_pricnipal'];
    $telefono_familiar_secundario = $_POST['telefono_familiar_secundario'];

    /* INFO LOGIN */
    $email_login = $_POST['email_login'];
    $password_login = $_POST['password_login'];

    $str_nombre = substr($nombre, 0, 2);
    $str_ap_paterno = substr($ap_paterno, 0, 2);
    $str_ap_materno = substr($ap_materno, 0, 2);
    $int_user = rand(10, 99);
    $codigo_usuario = $str_nombre . "-" . $str_ap_paterno . $str_ap_materno . "-" . $int_user;



    $queries = new Queries;

    $sql_direccion = "INSERT INTO asteleco_personal.direcciones_personal (
        id_direcciones_personal,
        direccion_calle,
        direccion_numero_int,
        direccion_numero_ext,
        direccion_colonia,
        direccion_municipio,
        direccion_zipcode,
        direccion_estado
    ) VALUES (
        NULL,
        '$calle',
        '',
        '$numero',
        '$colonia',
        '$id_municipio',
        '$cp',
        '$id_estado'
    )";

    $insertDireccion = $queries->insertData($sql_direccion);

    if (!empty($insertDireccion)) {
        $dir_last_id = $insertDireccion['last_id'];

        $sql_contacto = "INSERT INTO asteleco_personal.contacto_personal(
            id_contacto_personal,
            telefono_principal,
            telefono_secundario,
            correo_electronico,
            telefono_familiar_1,
            telefono_familiar_2 
            ) VALUES (
                NULL,
                '$telefono_pricnipal',
                '$telefono_secundario',
                '$correo_personal',
                '$telefono_familiar_pricnipal',
                '$telefono_familiar_secundario'
            )";
        $insert_contacto = $queries->insertData($sql_contacto);

        if (!empty($insert_contacto)) {
            $contacto_last_id = $insert_contacto['last_id'];
            $insert_personal = "INSERT INTO asteleco_personal.lista_personal (
                id_lista_personal,
                id_niveles_areas ,
                id_niveles_academicos,
                id_direcciones_personal,
                id_contacto_personal,
                nombres,
                apellido_paterno,
                apellido_materno,
                codigo_usuario,
                correo_sesion,
                password,
                fecha_nacimiento,
                curp,
                rfc,
                nss,
                genero,
                estado_civil
                ) VALUES (
                NULL,
                '$id_area_level',
                '$id_academic_level',
                '$dir_last_id',
                '$contacto_last_id',
                '$nombre',
                '$ap_paterno',
                '$ap_materno',
                '$codigo_usuario',
                '$email_login',
                '$password_login',
                '$fecha_nacimiento',
                '$curp',
                '$rfc',
                '$nss',
                '$id_genero',
                '$id_estado_civil'
                )";

            $insert_personal_request = $queries->insertData($insert_personal);
            if (!empty($insert_personal_request)) {

                $get_archives_catalog = "SELECT * FROM asteleco_personal.catalogo_archivos";
                $request_archives_catalog = $queries->getData($get_archives_catalog);
                foreach ($request_archives_catalog as $archive) {

                    $id_catalogo_archivos = $archive->id_catalogo_archivos;
                    $insert_personal_archives = "INSERT INTO asteleco_personal.archivos_usuarios (
                        id_archivos_usuarios,
                        id_lista_personal,
                        id_catalogo_archivos
                        ) VALUES (
                        NULL,
                        '$insert_personal_request[last_id]',
                        '$id_catalogo_archivos')";
                    $insert_personal_archives_request = $queries->insertData($insert_personal_archives);
                }
                $data = array(
                    'response' => true,
                    'message' => 'Usuario registrado correctamente!!',
                    'user_code' => $codigo_usuario,
                    'user_email' => $email_login,
                    'user_password' => $password_login

                );
            } else {
                $data = array(
                    'response' => false,
                    'message' => 'Error al registrar el usuario'
                );
            }
        }


        //--- --- ---//

    }

    echo json_encode($data);
}
function changeStatusUser()
{
    $id_user = $_POST['id_user'];
    $status = $_POST['status'];


    $queries = new Queries;



    $updateStatus = "UPDATE asteleco_personal.lista_personal SET status = '$status' WHERE id_lista_personal = '$id_user'";
    $execUpdateStatus = $queries->insertData($updateStatus);
    if (!empty($execUpdateStatus)) {
        $data = array(
            'response' => true,
            'message' => 'Se actualizó correctamente!!'

        );
    }else{
        $data = array(
            'response' => false,
            'message' => 'Error al actualizar el usuario'
        );
    }
    


    echo json_encode($data);
}
