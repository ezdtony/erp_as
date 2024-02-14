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

function updateUser()
{
    /* INFO GENERAL */
    $queries = new Queries;

    $id_user = $_POST['id_user'];
    $id_niveles_areas = $_POST['id_niveles_areas'];
    $id_academic_level = $_POST['id_academic_level'];
    $id_genero = $_POST['id_genero'];
    $nombre = $_POST['nombre'];
    $ap_paterno = $_POST['ap_paterno'];
    $ap_materno = $_POST['ap_materno'];
    $curp = $_POST['curp'];
    $nss = $_POST['nss'];

    $arr_fecha_nacimiento = explode("/", $_POST['fecha_nacimiento']);
    $fecha_nacimiento = $arr_fecha_nacimiento[2] . "-" . $arr_fecha_nacimiento[0] . "-" . $arr_fecha_nacimiento[1];
    $rfc = $_POST['rfc'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $colonia = $_POST['colonia'];
    $cp = $_POST['cp'];
    $id_municipio = $_POST['id_municipio'];
    $id_estado = $_POST['id_estado'];
    $telefono_pricnipal = $_POST['telefono_pricnipal'];
    $telefono_secundario = $_POST['telefono_secundario'];
    $correo_personal = $_POST['correo_personal'];
    $telefono_familiar_pricnipal = $_POST['telefono_familiar_pricnipal'];
    $telefono_familiar_2 = $_POST['telefono_familiar_2'];
    $email_login = $_POST['email_login'];
    $password_login = $_POST['password_login'];

    $str_nombre = strtoupper(substr($nombre, 0, 2));
    $str_ap_paterno = substr($ap_paterno, 0, 1);
    $str_ap_materno = substr($ap_materno, 0, 1);
    $int_user = rand(10, 99);
    $codigo_usuario = $str_nombre  . $str_ap_paterno . $str_ap_materno . "-0" . $int_user;




    $sql_update_user_info = "UPDATE asteleco_personal.lista_personal SET
                            id_niveles_areas = '$id_niveles_areas',
                            id_niveles_academicos = '$id_academic_level',
                            nombres = '$nombre',
                            apellido_paterno = '$ap_paterno',
                            apellido_materno = '$ap_materno',
                            curp = '$curp',
                            rfc = '$rfc',
                            nss = '$nss',
                            fecha_nacimiento = '$fecha_nacimiento',
                            genero = '$id_genero',
                            correo_sesion = '$email_login',
                            password = '$password_login',
                            codigo_usuario = '$codigo_usuario'
                            WHERE id_lista_personal = '$id_user'";
    $update_user_info = $queries->insertData($sql_update_user_info);

    if (!empty($update_user_info)) {
        $sql_get_forgein_key = "SELECT id_direcciones_personal, id_contacto_personal FROM asteleco_personal.lista_personal WHERE id_lista_personal = '$id_user'";
        $get_forgein_key = $queries->getData($sql_get_forgein_key);
        $id_direcciones_personal = $get_forgein_key[0]->id_direcciones_personal;
        $id_contacto_personal = $get_forgein_key[0]->id_contacto_personal;

        $sql_update_user_contact = "UPDATE asteleco_personal.contacto_personal SET
                            telefono_principal = '$telefono_pricnipal',
                            telefono_secundario = '$telefono_secundario',
                            correo_electronico = '$correo_personal',
                            telefono_familiar_1 = '$telefono_familiar_pricnipal',
                            telefono_familiar_2 = '$telefono_familiar_2'
                            WHERE id_contacto_personal = '$id_contacto_personal'";
        $update_user_contact = $queries->insertData($sql_update_user_contact);

        if (!empty($update_user_contact)) {
            $sql_update_direccion = "UPDATE asteleco_personal.direcciones_personal SET
            direccion_calle = '$calle',
            direccion_numero_ext = '$numero',
            direccion_colonia = '$colonia',
            direccion_municipio = '$id_municipio',
            direccion_zipcode = '$cp',
            direccion_estado = '$id_estado'
            WHERE id_direcciones_personal = '$id_direcciones_personal'";
            $update_user_direction = $queries->insertData($sql_update_direccion);
            if (!empty($update_user_direction)) {
                $data = array(
                    'response' => true
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
        }
    }



    echo json_encode($data);
}

function deleteUser()
{
    /* INFO GENERAL */
    $queries = new Queries;

    $id_user = $_POST['id_user'];

    $sql_get_forgein_key = "SELECT id_direcciones_personal, id_contacto_personal FROM asteleco_personal.lista_personal WHERE id_lista_personal = '$id_user'";
    $get_forgein_key = $queries->getData($sql_get_forgein_key);
    $id_direcciones_personal = $get_forgein_key[0]->id_direcciones_personal;
    $id_contacto_personal = $get_forgein_key[0]->id_contacto_personal;

    $sql_delete_user_archives = "DELETE FROM asteleco_personal.archivos_usuarios WHERE id_lista_personal = '$id_user'";
    $delete_user_archives = $queries->insertData($sql_delete_user_archives);

    if (!empty($delete_user_archives)) {

        $sql_delete_user = "DELETE FROM asteleco_personal.lista_personal WHERE id_lista_personal = '$id_user'";
        $delete_user = $queries->insertData($sql_delete_user);

        if (!empty($delete_user)) {

            $sql_delete_user_contact = "DELETE FROM asteleco_personal.contacto_personal WHERE id_contacto_personal = '$id_contacto_personal'";
            $delete_user_contact = $queries->insertData($sql_delete_user_contact);


            if (!empty($delete_user_contact)) {

                $sql_delete_user_direction = "DELETE FROM asteleco_personal.direcciones_personal WHERE id_direcciones_personal = '$id_direcciones_personal'";
                $delete_user_direction = $queries->insertData($sql_delete_user_direction);

                if (!empty($delete_user_direction)) {
                    $data = array(
                        'response' => true
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
            }
        }
    }




    echo json_encode($data);
}
