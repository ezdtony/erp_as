<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once dirname(__DIR__ . '', 3) . '/assets/phpmailer/src/Exception.php';
include_once dirname(__DIR__ . '', 3) . '/assets/phpmailer/src/PHPMailer.php';
include_once dirname(__DIR__ . '', 3) . '/assets/phpmailer/src/SMTP.php';


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

function getColabsTable()
{

    $queries = new Queries;

    //$id_product = $_POST['id_product'];
    //$colab_name = $_POST['product_name'];
    $colsSearch = [
        "CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno)",
        'codigo_usuario',
        'descripcion_area',
        'descripcion_niveles_areas',
        'correo_sesion',
    ];
    $limit =  isset($_POST['limit']) ? $_POST['limit'] : 10;
    $actualPage =  isset($_POST['actualPage']) ? $_POST['actualPage'] : 0;

    if (!$actualPage) {
        $begin = 0;
        $actualPage = 1;
    } else {
        $begin = ($actualPage - 1) * $limit;
    }
    $where = "";
    if (isset($_POST['searchInput']) && ($_POST['searchInput'] != '')) {
        $searchInput = $_POST['searchInput'];
        $where .= " WHERE (";
        for ($i = 0; $i < count($colsSearch); $i++) {
            $where .= $colsSearch[$i] . " LIKE '%" . addslashes($searchInput) . "%' OR ";
        }
        $where = substr($where, 0, -3);
        $where .= ") AND status = 1 ";
    }


    if ($limit > 0) {
        $limit = " LIMIT $begin,  $limit";
    } else {
        $limit = "";
    }
    //echo $limit;
    $html = "";





    $sql = "SELECT SQL_CALC_FOUND_ROWS
    UPPER (CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno)) AS user_name,
    id_lista_personal, codigo_usuario, descripcion_area, descripcion_niveles_areas, 
    correo_sesion, password, status
    FROM asteleco_personal.lista_personal AS lp
    INNER JOIN asteleco_personal.niveles_areas AS nar ON nar.id_niveles_areas = lp.id_niveles_areas
    INNER JOIN asteleco_personal.areas AS ar ON ar.id_areas = nar.id_areas
    $where 
    GROUP BY id_lista_personal
    $limit
    ";

    $getColabs = $queries->getData($sql);

    $total_stock = 0;

    if (!empty($getColabs)) {
        $totalResults = count($getColabs);

        $sqlAllProdsFiltered = "SELECT FOUND_ROWS() AS founded";
        $getTotalProductsFiltered = $queries->getData($sqlAllProdsFiltered);
        if (!empty($getTotalProductsFiltered)) {
            $totalFiltered = ($getTotalProductsFiltered[0]->founded);
        }

        $sqlAllProds = "SELECT COUNT(id_lista_personal) AS founded
        FROM asteleco_personal.lista_personal AS lp
        INNER JOIN asteleco_personal.niveles_areas AS nar ON nar.id_niveles_areas = lp.id_niveles_areas
        INNER JOIN asteleco_personal.areas AS ar ON ar.id_areas = nar.id_areas
        ";
        $getTotalProducts = $queries->getData($sqlAllProds);
        if (!empty($getTotalProducts)) {
            $totalProds = ($getTotalProducts[0]->founded);
        }


        foreach ($getColabs as $colab) {

            $status = '';
            if ($colab->status == 1) {
                $status = 'checked';
            }
            $html .= '
            <tr id="trColab' . $colab->id_lista_personal . '">
            <td>' . $colab->user_name . '</td>
            <td>'.$colab->id_lista_personal .'</td>
            <td> <div>
            <input class="change_user_status" type="checkbox" id="' . $colab->id_lista_personal . '" data-switch="success" ' . $status . ' />
            <label for="' . $colab->id_lista_personal . '" data-on-label="Si" data-off-label="No" class="mb-0 d-block"></label>
        </div>
        </td>
        <td>'.$colab->descripcion_area .'</td>
        <td>'.$colab->descripcion_niveles_areas .'</td>
        <td>'.$colab->codigo_usuario .'</td>
        <td>'.$colab->codigo_usuario .'</td>
        <td>'.$colab->correo_sesion .'</td>
        <td>'.$colab->password .'</td>
        <td class="table-action">
        <a href="?submodule=detalle_info&id_user='.$colab->id_lista_personal.'" target="_blank"class="action-icon" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" title="Información detallada"> <i class="mdi mdi-information"></i></a>
        <a class="action-icon editUser" id='.$colab->id_lista_personal.'" data-bs-container="#tooltip-container2" data-bs-toggle="modal" data-bs-target="#editarUsuario" data-bs-toggle="tooltip" title="Editar información"> <i class="mdi mdi-circle-edit-outline"></i></a>
        <a class="action-icon deleteUser" id='.$colab->id_lista_personal.'" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" title="Eliminar usuario"> <i class="mdi mdi-delete"></i></a>
         </td>
        </tr>';
        }

        $pagNum = 1;
        if (($actualPage - 4) > 1) {
            $pagNum = $actualPage - 4;
        }
        $totalPages = ceil($totalProds / $_POST['limit']);

        $pagination = '';

        $stopNav = $pagNum + 9;
        if ($stopNav > $totalPages) {
            $stopNav = $totalPages;
        }
        $pagination .= '<nav>';
        $pagination .= '<ul class="nav nav-pills">';

        for ($i = $pagNum; $i <= $stopNav; $i++) {
            $active = $i == $actualPage ? "active" : "";
            $pagination .= '<li class="nav-item">';
            $pagination .= '<a class="nav-link changePage ' . $active . '" aria-current="page" href="#">' . $i . '</a>';
            $pagination .= '</li>';
        }







        $pagination .= '</ul>';
        $pagination .= '</nav>';

        $data = array(
            'response' => true,
            'html' => $html,
            'totalProds' => $totalProds,
            'totalResults' => $totalResults,
            'totalFiltered' => $totalFiltered,
            'totalPages' => $totalPages,
            'paginationNav' => $pagination
        );
    } else {

        $html .= '
                    </tbody>
                </table>';
        $data = array(
            'response' => false,
            'html' => $html
        );
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
    $fecha_nacimiento = $arr_fecha_nacimiento[2] . "-" . $arr_fecha_nacimiento[0] . "-" . $arr_fecha_nacimiento[1];
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

    $str_nombre = strtoupper(substr($nombre, 0, 2));
    $str_ap_paterno = substr($ap_paterno, 0, 1);
    $str_ap_materno = substr($ap_materno, 0, 1);
    $int_user = rand(10, 99);
    $codigo_usuario = $str_nombre  . $str_ap_paterno . $str_ap_materno . "-0" . $int_user;



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
                $create_saldo = "INSERT INTO asteleco_viaticos_erp.saldos (
                    id_saldoS,
                    id_personal,
                    saldo
                    ) VALUES (
                    NULL,
                    '$insert_personal_request[last_id]',
                    '0'
                    )";
                $insert_saldo = $queries->insertData($create_saldo);
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
    } else {
        $data = array(
            'response' => false,
            'message' => 'Error al actualizar el usuario'
        );
    }



    echo json_encode($data);
}
function changeSendViaticsMail()
{
    $id_user = $_POST['id_user'];
    $status = $_POST['status'];


    $queries = new Queries;

    $sqlGetnfo = "SELECT * FROM asteleco_viaticos_erp.enviar_correos WHERE  id_personal = '$id_user'";
    $execGetInfo = $queries->getData($sqlGetnfo);
    if (!empty($execGetInfo)) {
        $updateStatus = "UPDATE asteleco_viaticos_erp.enviar_correos SET enviar = '$status' WHERE id_personal = '$id_user'";
        $execUpdateStatus = $queries->insertData($updateStatus);
    } else {
        $insertStatus = "INSERT INTO asteleco_viaticos_erp.enviar_correos (id_enviar_correos, id_personal, enviar) VALUES (NULL, '$id_user', '$status')";
        $execUpdateStatus = $queries->insertData($insertStatus);
    }



    if (!empty($execUpdateStatus)) {
        $data = array(
            'response' => true,
            'message' => 'Se actualizó correctamente!!'

        );
    } else {
        $data = array(
            'response' => false,
            'message' => 'Error al actualizar el usuario'
        );
    }



    echo json_encode($data);
}

function getUserProyects()
{
    $id_user = $_POST['id_user'];

    $queries = new Queries;

    $stmt = "SELECT pas.id_asignaciones_proyectos,proy.id_proyectos, proy.nombre_proyecto, proy.codigo_proyecto
    FROM asteleco_proyectos.asignaciones_proyectos  AS pas
    INNER JOIN asteleco_proyectos.proyectos AS proy ON pas.id_proyectos = proy.id_proyectos
    WHERE pas.id_lista_personal = '$id_user' AND pas.status = 1";

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
function sendViaticsMail()
{


    $id_user = $_POST['id_personal'];
    $month = date('m');
    $year = date('Y');


    $total_gastos = 0;
    $total_depositos = 0;
    $saldo = 0;
    $pendiente = 0;
    $queries = new Queries;

    /*  $updateStatus = "SELECT SUM(dep.cantidad) AS total_depositos, SUM(gas.importe) AS total_gastos, SUM(dep.cantidad) - SUM(gas.importe) AS saldo, per.correo_sesion, correo_personal,
    CONCAT(per.nombres,' ',per.apellido_paterno,' ',per.apellido_materno) AS nombre_completo
    FROM asteleco_personal.lista_personal AS per
    INNER JOIN asteleco_viaticos_erp.depositos AS dep ON per.id_lista_personal = dep.id_personal
    INNER JOIN asteleco_viaticos_erp.gastos AS gas ON per.id_lista_personal = gas.id_personal
    WHERE per.id_lista_personal = '$id_user' AND MONTH(dep.fecha) = '$month' AND MONTH(gas.fecha_registro) = '$month'";
    echo $updateStatus; */
    $sql_getGastos = "SELECT SUM(importe)  AS total_gastos
    FROM asteleco_viaticos_erp.gastos 
    WHERE `id_personal` = '$id_user' AND MONTH(fecha_registro) = '$month' AND YEAR(fecha_registro) = '$year'";
    $getGastos = $queries->getData($sql_getGastos);

    if (!empty($getGastos)) {
        $total_gastos = $getGastos[0]->total_gastos;
    }
    $sql_getDepositos = "SELECT SUM(cantidad)  AS total_depositos
    FROM asteleco_viaticos_erp.depositos 
    WHERE `id_personal` = '$id_user' AND MONTH(fecha) = '$month' AND YEAR(fecha) = '$year'";

    $getDepositos = $queries->getData($sql_getDepositos);

    if (!empty($getDepositos)) {
        $total_depositos = $getDepositos[0]->total_depositos;
    }
    $sql_getSaldo = "SELECT saldo 
    FROM asteleco_viaticos_erp.saldos
    WHERE `id_personal` = '$id_user'";

    $getSaldo = $queries->getData($sql_getSaldo);

    if (!empty($getSaldo)) {
        $saldo = $getSaldo[0]->saldo;
    }




    $sql_infoPersonal = "SELECT per.correo_sesion, correo_personal,
    CONCAT(per.nombres,' ',per.apellido_paterno,' ',per.apellido_materno) AS nombre_completo
    FROM asteleco_personal.lista_personal AS per
    WHERE `id_lista_personal` = '$id_user'";
    $infoPersonal = $queries->getData($sql_infoPersonal);


    if (!empty($infoPersonal)) {
        $correo_sesion = $infoPersonal[0]->correo_sesion;
        $correo_personal = $infoPersonal[0]->correo_personal;
        $nombre_completo = $infoPersonal[0]->nombre_completo;
    }

    $pendiente = $total_depositos - $total_gastos;
    $userData = array(
        'total_gastos' => $total_gastos,
        'total_depositos' => $total_depositos,
        'nombre_completo' => $nombre_completo,
        'correo_sesion' => $correo_sesion,
        'correo_personal' => $correo_personal,
        'pendiente' => $pendiente,
        'saldo' => $saldo
    );

    $dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "S&aacute;bado", "Domingo");
    $meses = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $monthNumber = date("n");
    $dayNumber = date("d");
    $dia_semana = date("w");
    $yearFecha = date("Y");
    $fecha_formato = $dias[$dia_semana] . " " . $dayNumber . ' de ' . $meses[$monthNumber] . ' de ' . $yearFecha;


    $html_cuerpo = '<!DOCTYPE html>
        <html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
        
        <head>
            <title></title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
            <style>
                * {
                    box-sizing: border-box;
                }
        
                body {
                    margin: 0;
                    padding: 0;
                }
        
                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: inherit !important;
                }
        
                #MessageViewBody a {
                    color: inherit;
                    text-decoration: none;
                }
        
                p {
                    line-height: inherit
                }
        
                .desktop_hide,
                .desktop_hide table {
                    mso-hide: all;
                    display: none;
                    max-height: 0px;
                    overflow: hidden;
                }
        
                @media (max-width:640px) {
                    .desktop_hide table.icons-inner {
                        display: inline-block !important;
                    }
        
                    .icons-inner {
                        text-align: center;
                    }
        
                    .icons-inner td {
                        margin: 0 auto;
                    }
        
                    .image_block img.big,
                    .row-content {
                        width: 100% !important;
                    }
        
                    .mobile_hide {
                        display: none;
                    }
        
                    .stack .column {
                        width: 100%;
                        display: block;
                    }
        
                    .mobile_hide {
                        min-height: 0;
                        max-height: 0;
                        max-width: 0;
                        overflow: hidden;
                        font-size: 0px;
                    }
        
                    .desktop_hide,
                    .desktop_hide table {
                        display: table !important;
                        max-height: none !important;
                    }
                }
            </style>
        </head>
        
        <body style="background-color: #DFDFDF; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
            <table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #DFDFDF;">
                <tbody>
                    <tr>
                        <td>
                            <table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="image_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
                                                                        <div class="alignment" align="center" style="line-height:10px"><img class="big" src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/top_rounded_15.png" style="display: block; height: auto; border: 0; width: 620px; max-width: 100%;" width="620" alt="Image" title="Image"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/hero_bg_2.jpg); background-position: top center; background-repeat: no-repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="text_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-left:60px;padding-right:60px;padding-top:60px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; font-family: Oswald, Lucida Sans Unicode, Lucida Grande, sans-serif; mso-line-height-alt: 21.6px; color: #FFFFFF; line-height: 1.8;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 61.2px;"><span style="font-size:34px;"><span style="font-size:34px;">Estimado </span><strong><span style="font-size:34px;"><span style="font-size:34px;background-color:#ffffff;"><span style="color:#003300;font-size:34px;background-color:#ffffff;">&nbsp;</span><span style="color:#003300;font-size:34px;background-color:#ffffff;"><span style="color:#008000;">' . $nombre_completo . '</span></span></span>,&nbsp;</span></strong></span></p>
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 43.2px;"><span style="font-size:24px;"><span style="font-size:24px;">Te recordamos que tienes hasta el día 25 de ' . $meses[$monthNumber] . ' de ' . date('Y') . ' para finalizar la comprobación de gastos pendientes</span></span></p>
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21.6px;">&nbsp;</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class="image_block block-2 mobile_hide" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
                                                                        <div class="alignment" align="center" style="line-height:10px"><img src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/smile.png" style="display: block; height: auto; border: 0; width: 64px; max-width: 100%;" width="64" alt="Image" title="Image"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <div class="spacer_block mobile_hide" style="height:125px;line-height:125px;font-size:1px;">&#8202;</div>
                                                            <div class="spacer_block mobile_hide" style="height:40px;line-height:40px;font-size:1px;">&#8202;</div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-3" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ebebeb; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-2" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-right: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="image_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;padding-top:15px;">
                                                                        <div class="alignment" align="center" style="line-height:10px"><img src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/calendar.png" style="display: block; height: auto; border: 0; width: 27px; max-width: 100%;" width="27" alt="Image" title="Image"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class="text_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:20px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">Correo enviado:</span> <strong>' . $fecha_formato . '</strong></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class="column column-3" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="image_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;padding-top:15px;">
                                                                        <div class="alignment" align="center" style="line-height:10px"><img src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/dollar.png" style="display: block; height: auto; border: 0; width: 14px; max-width: 100%;" width="14" alt="Image" title="Image"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class="text_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">Pendiente:</span>&nbsp;<strong>$ ' . $pendiente . '</strong></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-4" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="text_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:5px;padding-left:40px;padding-right:40px;padding-top:15px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-family: Oswald, Lucida Sans Unicode, Lucida Grande, sans-serif; font-size: 12px; mso-line-height-alt: 18px; color: #56B500; line-height: 1.5;">
                                                                                <p style="margin: 0; text-align: center; font-size: 12px; mso-line-height-alt: 36px;"><span style="font-size:24px;"><b>Detalle de saldo pendiente:</b></span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-5" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #56b500; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-right: 1px solid #519E0A; vertical-align: top; border-top: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #FFFFFF; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:13px;"><strong>Concepto</strong></span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class="column column-3" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #FFFFFF; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:13px;"><strong>Total</strong></span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-6" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                            <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:10px;padding-left:5px;padding-right:5px;padding-top:10px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">Depositos en el mes de ' . $meses[$monthNumber] . '</span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class="column column-2" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><strong>&nbsp;$ ' . $total_depositos . '</strong></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-7" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #F5F5F5; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; background-color: #F5F5F5; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="divider_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad">
                                                                        <div class="alignment" align="center">
                                                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tr>
                                                                                    <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #DFDFDF;"><span>&#8202;</span></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-8" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #F5F5F5; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                            <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:10px;padding-left:5px;padding-right:5px;padding-top:10px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">Total de gastos comprobados en el mes de ' . $meses[$monthNumber] . '</span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class="column column-3" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><strong>&nbsp;$ ' . $total_gastos . '</strong></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-9" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="divider_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad">
                                                                        <div class="alignment" align="left">
                                                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tr>
                                                                                    <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #DFDFDF;"><span>&#8202;</span></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-13" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="divider_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad">
                                                                        <div class="alignment" align="left">
                                                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tr>
                                                                                    <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #DFDFDF;"><span>&#8202;</span></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-14" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-2" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 0px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                            <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-left:25px;padding-top:5px;padding-bottom:25px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #56B500; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; mso-line-height-alt: 14.399999999999999px;">&nbsp;</p>
                                                                                <p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;"><span style="font-size:20px;">Saldo actual:</span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class="column column-3" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; background-color: #787878; border-bottom: 0px solid #DFDFDF; border-left: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-right: 0px;">
                                                            <table class="text_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:30px;padding-left:10px;padding-right:10px;padding-top:30px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #FFFFFF; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:18px;"><strong>$ ' . $saldo . '</strong></span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-14" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-2" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 0px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                            <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-left:25px;padding-top:5px;padding-bottom:25px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #56B500; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; mso-line-height-alt: 14.399999999999999px;">&nbsp;</p>
                                                                                <p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;"><span style="font-size:20px;">Total Pendiente por comprobar:</span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class="column column-3" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; background-color: #56B500; border-bottom: 0px solid #DFDFDF; border-left: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-right: 0px;">
                                                            <table class="text_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:30px;padding-left:10px;padding-right:10px;padding-top:30px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #FFFFFF; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:18px;"><strong>$ ' . $pendiente . '</strong></span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            
                            <table class="row row-22" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 10px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <div class="spacer_block" style="height:50px;line-height:50px;font-size:1px;">&#8202;</div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-23" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="image_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
                                                                        <div class="alignment" align="center" style="line-height:10px"><img class="big" src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/bottom_rounded_15.png" style="display: block; height: auto; border: 0; width: 620px; max-width: 100%;" width="620" alt="Image" title="Image"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-24" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #F0F0F0; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 15px; padding-bottom: 15px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="text_block block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 12px; text-align: center; mso-line-height-alt: 14.399999999999999px;"><strong>ASETLECOM © Todos los derechos reservados</strong></p>
                                                                                <p style="margin: 0; font-size: 12px; text-align: center; mso-line-height-alt: 14.399999999999999px;">Estamos donde el cliente nos necesita</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-25" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="icons_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad" style="vertical-align: middle; color: #9d9d9d; font-family: inherit; font-size: 15px; padding-bottom: 5px; padding-top: 5px; text-align: center;">
                                                                        <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                            <tr>
                                                                                <td class="alignment" style="vertical-align: middle; text-align: center;">
                                                                                    <!--[if vml]><table align="left" cellpadding="0" cellspacing="0" role="presentation" style="display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;"><![endif]-->
                                                                                    <!--[if !vml]><!-->
                                                                                    <table class="icons-inner" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;" cellpadding="0" cellspacing="0" role="presentation">
                                                                                        <!--<![endif]-->
                                                                                        <tr>
                                                                                            <td style="vertical-align: middle; text-align: center; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 6px;"><a href="https://www.designedwithbee.com/?utm_source=editor&utm_medium=bee_pro&utm_campaign=free_footer_link" target="_blank" style="text-decoration: none;"><img class="icon" alt="Designed with BEE" src="https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/53601_510656/Signature/bee.png" height="32" width="34" align="center" style="display: block; height: auto; margin: 0 auto; border: 0;"></a></td>
                                                                                            <td style="font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif; font-size: 15px; color: #9d9d9d; vertical-align: middle; letter-spacing: undefined; text-align: center;"><a href="https://www.designedwithbee.com/?utm_source=editor&utm_medium=bee_pro&utm_campaign=free_footer_link" target="_blank" style="color: #9d9d9d; text-decoration: none;">Designed with BEE</a></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table><!-- End -->
        </body>
        
        </html>';


    if (!empty($userData)) {
        mb_internal_encoding('UTF-8');

        // Esto le dice a PHP que generaremos cadenas UTF-8
        mb_http_output('UTF-8');



        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail.astelecom.com.mx';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'contabilidad@astelecom.com.mx';                     //SMTP username
            $mail->Password   = 'hcZnW7NCo3*';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;

            $mail->SMTPDebug = false;
            $mail->do_debug = 0;                           //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('contabilidad@astelecom.com.mx', 'Departamento de Contabilidad AS');
            $mail->addAddress($correo_sesion, utf8_decode($nombre_completo));     //Add a recipient
            /* $mail->addAddress('lmgger@hotmail.com');    */            //Name is optional
            $mail->addAddress($correo_personal);
            $mail->addReplyTo('contabilidad@astelecom.com.mx', 'Departamento de Contabilidad AS');
            /* $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com'); */

            //Attachments
            /* $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments */
            /* $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name */

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'AVISO CONTABILIDAD';
            $mail->Body    = $html_cuerpo;
            /* $mail->AltBody = 'Estimado colaborador. El departamento de contabilidad le hace llegar este correo de prueba.'; */

            $mail->send();
            /* echo 'Message has been sent'; */
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        $data = array(
            'response' => true,
            'message' => 'Se ha enviado el correo',
            'data' => $userData

        );
    } else {
        $data = array(
            'response' => false,
            'message' => 'Error al actualizar el usuario'
        );
    }



    echo json_encode($data);
}
function sendViaticsMailMasive()
{



    $month = date('m');
    $year = date('Y');



    $queries = new Queries;
    $sql_SendMails = "SELECT* FROM asteleco_viaticos_erp.enviar_correos
    WHERE `enviar` = '1'";
    $accountsToSend = $queries->getData($sql_SendMails);

    /*  $updateStatus = "SELECT SUM(dep.cantidad) AS total_depositos, SUM(gas.importe) AS total_gastos, SUM(dep.cantidad) - SUM(gas.importe) AS saldo, per.correo_sesion, correo_personal,
    CONCAT(per.nombres,' ',per.apellido_paterno,' ',per.apellido_materno) AS nombre_completo
    FROM asteleco_personal.lista_personal AS per
    INNER JOIN asteleco_viaticos_erp.depositos AS dep ON per.id_lista_personal = dep.id_personal
    INNER JOIN asteleco_viaticos_erp.gastos AS gas ON per.id_lista_personal = gas.id_personal
    WHERE per.id_lista_personal = '$id_user' AND MONTH(dep.fecha) = '$month' AND MONTH(gas.fecha_registro) = '$month'";
    echo $updateStatus; */
    $sended_mails = 0;
    foreach ($accountsToSend as $account) {
        $sended_mails++;
        $total_gastos = 0;
        $total_depositos = 0;
        $saldo = 0;
        $pendiente = 0;
        $id_user = $account->id_personal;
        $sql_getGastos = "SELECT SUM(importe)  AS total_gastos
            FROM asteleco_viaticos_erp.gastos 
            WHERE `id_personal` = '$id_user' AND MONTH(fecha_registro) = '$month' AND YEAR(fecha_registro) = '$year'";
        $getGastos = $queries->getData($sql_getGastos);

        if (!empty($getGastos)) {
            $total_gastos = $getGastos[0]->total_gastos;
        }
        $sql_getDepositos = "SELECT SUM(cantidad)  AS total_depositos
            FROM asteleco_viaticos_erp.depositos 
            WHERE `id_personal` = '$id_user' AND MONTH(fecha) = '$month' AND YEAR(fecha) = '$year'";

        $getDepositos = $queries->getData($sql_getDepositos);

        if (!empty($getDepositos)) {
            $total_depositos = $getDepositos[0]->total_depositos;
        }
        $sql_getSaldo = "SELECT saldo 
            FROM asteleco_viaticos_erp.saldos
            WHERE `id_personal` = '$id_user'";

        $getSaldo = $queries->getData($sql_getSaldo);

        if (!empty($getSaldo)) {
            $saldo = $getSaldo[0]->saldo;
        }




        $sql_infoPersonal = "SELECT per.correo_sesion, correo_personal,
            CONCAT(per.nombres,' ',per.apellido_paterno,' ',per.apellido_materno) AS nombre_completo
            FROM asteleco_personal.lista_personal AS per
            WHERE `id_lista_personal` = '$id_user'";
        $infoPersonal = $queries->getData($sql_infoPersonal);


        if (!empty($infoPersonal)) {
            $correo_sesion = $infoPersonal[0]->correo_sesion;
            $correo_personal = $infoPersonal[0]->correo_personal;
            $nombre_completo = $infoPersonal[0]->nombre_completo;
        }

        $pendiente = $total_depositos - $total_gastos;
        $userData = array(
            'total_gastos' => $total_gastos,
            'total_depositos' => $total_depositos,
            'nombre_completo' => $nombre_completo,
            'correo_sesion' => $correo_sesion,
            'correo_personal' => $correo_personal,
            'pendiente' => $pendiente,
            'saldo' => $saldo
        );

        $dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "S&aacute;bado", "Domingo");
        $meses = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $monthNumber = date("n");
        $dayNumber = date("d");
        $dia_semana = date("w");
        $yearFecha = date("Y");
        $fecha_formato = $dias[$dia_semana] . " " . $dayNumber . ' de ' . $meses[$monthNumber] . ' de ' . $yearFecha;


        $html_cuerpo = '<!DOCTYPE html>
        <html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
        
        <head>
            <title></title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
            <style>
                * {
                    box-sizing: border-box;
                }
        
                body {
                    margin: 0;
                    padding: 0;
                }
        
                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: inherit !important;
                }
        
                #MessageViewBody a {
                    color: inherit;
                    text-decoration: none;
                }
        
                p {
                    line-height: inherit
                }
        
                .desktop_hide,
                .desktop_hide table {
                    mso-hide: all;
                    display: none;
                    max-height: 0px;
                    overflow: hidden;
                }
        
                @media (max-width:640px) {
                    .desktop_hide table.icons-inner {
                        display: inline-block !important;
                    }
        
                    .icons-inner {
                        text-align: center;
                    }
        
                    .icons-inner td {
                        margin: 0 auto;
                    }
        
                    .image_block img.big,
                    .row-content {
                        width: 100% !important;
                    }
        
                    .mobile_hide {
                        display: none;
                    }
        
                    .stack .column {
                        width: 100%;
                        display: block;
                    }
        
                    .mobile_hide {
                        min-height: 0;
                        max-height: 0;
                        max-width: 0;
                        overflow: hidden;
                        font-size: 0px;
                    }
        
                    .desktop_hide,
                    .desktop_hide table {
                        display: table !important;
                        max-height: none !important;
                    }
                }
            </style>
        </head>
        
        <body style="background-color: #DFDFDF; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
            <table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #DFDFDF;">
                <tbody>
                    <tr>
                        <td>
                            <table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="image_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
                                                                        <div class="alignment" align="center" style="line-height:10px"><img class="big" src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/top_rounded_15.png" style="display: block; height: auto; border: 0; width: 620px; max-width: 100%;" width="620" alt="Image" title="Image"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/hero_bg_2.jpg); background-position: top center; background-repeat: no-repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="text_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-left:60px;padding-right:60px;padding-top:60px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; font-family: Oswald, Lucida Sans Unicode, Lucida Grande, sans-serif; mso-line-height-alt: 21.6px; color: #FFFFFF; line-height: 1.8;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 61.2px;"><span style="font-size:34px;"><span style="font-size:34px;">Estimado </span><strong><span style="font-size:34px;"><span style="font-size:34px;background-color:#ffffff;"><span style="color:#003300;font-size:34px;background-color:#ffffff;">&nbsp;</span><span style="color:#003300;font-size:34px;background-color:#ffffff;"><span style="color:#008000;">' . $nombre_completo . '</span></span></span>,&nbsp;</span></strong></span></p>
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 43.2px;"><span style="font-size:24px;"><span style="font-size:24px;">Te recordamos que tienes hasta el día 25 de ' . $meses[$monthNumber] . ' de ' . date('Y') . ' para finalizar la comprobación de gastos pendientes</span></span></p>
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21.6px;">&nbsp;</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class="image_block block-2 mobile_hide" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
                                                                        <div class="alignment" align="center" style="line-height:10px"><img src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/smile.png" style="display: block; height: auto; border: 0; width: 64px; max-width: 100%;" width="64" alt="Image" title="Image"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <div class="spacer_block mobile_hide" style="height:125px;line-height:125px;font-size:1px;">&#8202;</div>
                                                            <div class="spacer_block mobile_hide" style="height:40px;line-height:40px;font-size:1px;">&#8202;</div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-3" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ebebeb; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-2" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-right: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="image_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;padding-top:15px;">
                                                                        <div class="alignment" align="center" style="line-height:10px"><img src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/calendar.png" style="display: block; height: auto; border: 0; width: 27px; max-width: 100%;" width="27" alt="Image" title="Image"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class="text_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:20px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">Correo enviado:</span> <strong>' . $fecha_formato . '</strong></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class="column column-3" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="image_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;padding-top:15px;">
                                                                        <div class="alignment" align="center" style="line-height:10px"><img src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/dollar.png" style="display: block; height: auto; border: 0; width: 14px; max-width: 100%;" width="14" alt="Image" title="Image"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class="text_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">Pendiente:</span>&nbsp;<strong>$ ' . $pendiente . '</strong></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-4" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="text_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:5px;padding-left:40px;padding-right:40px;padding-top:15px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-family: Oswald, Lucida Sans Unicode, Lucida Grande, sans-serif; font-size: 12px; mso-line-height-alt: 18px; color: #56B500; line-height: 1.5;">
                                                                                <p style="margin: 0; text-align: center; font-size: 12px; mso-line-height-alt: 36px;"><span style="font-size:24px;"><b>Detalle de saldo pendiente:</b></span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-5" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #56b500; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-right: 1px solid #519E0A; vertical-align: top; border-top: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #FFFFFF; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:13px;"><strong>Concepto</strong></span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class="column column-3" width="33.333333333333336%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #FFFFFF; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:13px;"><strong>Total</strong></span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-6" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                            <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:10px;padding-left:5px;padding-right:5px;padding-top:10px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">Depositos en el mes de ' . $meses[$monthNumber] . '</span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class="column column-2" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><strong>&nbsp;$ ' . $total_depositos . '</strong></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-7" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #F5F5F5; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; background-color: #F5F5F5; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="divider_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad">
                                                                        <div class="alignment" align="center">
                                                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tr>
                                                                                    <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #DFDFDF;"><span>&#8202;</span></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-8" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #F5F5F5; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                            <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:10px;padding-left:5px;padding-right:5px;padding-top:10px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="color:#999999;font-size:14px;">Total de gastos comprobados en el mes de ' . $meses[$monthNumber] . '</span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class="column column-3" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><strong>&nbsp;$ ' . $total_gastos . '</strong></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-9" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="divider_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad">
                                                                        <div class="alignment" align="left">
                                                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tr>
                                                                                    <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #DFDFDF;"><span>&#8202;</span></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-13" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="divider_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad">
                                                                        <div class="alignment" align="left">
                                                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tr>
                                                                                    <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #DFDFDF;"><span>&#8202;</span></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-14" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-2" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 0px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                            <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-left:25px;padding-top:5px;padding-bottom:25px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #56B500; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; mso-line-height-alt: 14.399999999999999px;">&nbsp;</p>
                                                                                <p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;"><span style="font-size:20px;">Saldo actual:</span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class="column column-3" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; background-color: #787878; border-bottom: 0px solid #DFDFDF; border-left: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-right: 0px;">
                                                            <table class="text_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:30px;padding-left:10px;padding-right:10px;padding-top:30px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #FFFFFF; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:18px;"><strong>$ ' . $saldo . '</strong></span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-14" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-2" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 0px solid #DFDFDF; border-right: 0px solid #DFDFDF; vertical-align: top; border-top: 0px; border-left: 0px;">
                                                            <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-left:25px;padding-top:5px;padding-bottom:25px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #56B500; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; mso-line-height-alt: 14.399999999999999px;">&nbsp;</p>
                                                                                <p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;"><span style="font-size:20px;">Total Pendiente por comprobar:</span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class="column column-3" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; background-color: #56B500; border-bottom: 0px solid #DFDFDF; border-left: 1px solid #DFDFDF; vertical-align: top; border-top: 0px; border-right: 0px;">
                                                            <table class="text_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:30px;padding-left:10px;padding-right:10px;padding-top:30px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #FFFFFF; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:18px;"><strong>$ ' . $pendiente . '</strong></span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            
                            <table class="row row-22" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 10px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <div class="spacer_block" style="height:50px;line-height:50px;font-size:1px;">&#8202;</div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-23" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="image_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
                                                                        <div class="alignment" align="center" style="line-height:10px"><img class="big" src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/bottom_rounded_15.png" style="display: block; height: auto; border: 0; width: 620px; max-width: 100%;" width="620" alt="Image" title="Image"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-24" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #F0F0F0; background-image: url(https://d1oco4z2z1fhwp.cloudfront.net/templates/default/121/groovepaper_1.png); background-position: top center; background-repeat: repeat;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 15px; padding-bottom: 15px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="text_block block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 12px; text-align: center; mso-line-height-alt: 14.399999999999999px;"><strong>ASETLECOM © Todos los derechos reservados</strong></p>
                                                                                <p style="margin: 0; font-size: 12px; text-align: center; mso-line-height-alt: 14.399999999999999px;">Estamos donde el cliente nos necesita</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-25" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 620px;" width="620">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="icons_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad" style="vertical-align: middle; color: #9d9d9d; font-family: inherit; font-size: 15px; padding-bottom: 5px; padding-top: 5px; text-align: center;">
                                                                        <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                            <tr>
                                                                                <td class="alignment" style="vertical-align: middle; text-align: center;">
                                                                                    <!--[if vml]><table align="left" cellpadding="0" cellspacing="0" role="presentation" style="display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;"><![endif]-->
                                                                                    <!--[if !vml]><!-->
                                                                                    <table class="icons-inner" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;" cellpadding="0" cellspacing="0" role="presentation">
                                                                                        <!--<![endif]-->
                                                                                        <tr>
                                                                                            <td style="vertical-align: middle; text-align: center; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 6px;"><a href="https://www.designedwithbee.com/?utm_source=editor&utm_medium=bee_pro&utm_campaign=free_footer_link" target="_blank" style="text-decoration: none;"><img class="icon" alt="Designed with BEE" src="https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/53601_510656/Signature/bee.png" height="32" width="34" align="center" style="display: block; height: auto; margin: 0 auto; border: 0;"></a></td>
                                                                                            <td style="font-family: Oxygen, Trebuchet MS, Helvetica, sans-serif; font-size: 15px; color: #9d9d9d; vertical-align: middle; letter-spacing: undefined; text-align: center;"><a href="https://www.designedwithbee.com/?utm_source=editor&utm_medium=bee_pro&utm_campaign=free_footer_link" target="_blank" style="color: #9d9d9d; text-decoration: none;">Designed with BEE</a></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table><!-- End -->
        </body>
        
        </html>';


        if (!empty($userData)) {
            mb_internal_encoding('UTF-8');

            // Esto le dice a PHP que generaremos cadenas UTF-8
            mb_http_output('UTF-8');



            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'mail.astelecom.com.mx';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'contabilidad@astelecom.com.mx';                     //SMTP username
                $mail->Password   = 'hcZnW7NCo3*';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;

                $mail->SMTPDebug = false;
                $mail->do_debug = 0;                           //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('contabilidad@astelecom.com.mx', 'Departamento de Contabilidad AS');
                $mail->addAddress($correo_sesion, utf8_decode($nombre_completo));     //Add a recipient
                /* $mail->addAddress('lmgger@hotmail.com');    */            //Name is optional
                $mail->addAddress($correo_personal);
                $mail->addReplyTo('contabilidad@astelecom.com.mx', 'Departamento de Contabilidad AS');
                /* $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com'); */

                //Attachments
                /* $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments */
                /* $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name */

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'AVISO CONTABILIDAD';
                $mail->Body    = $html_cuerpo;
                /* $mail->AltBody = 'Estimado colaborador. El departamento de contabilidad le hace llegar este correo de prueba.'; */

                $mail->send();
                /* echo 'Message has been sent'; */
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            $data = array(
                'response' => true,
                'message' => 'Se ha enviado el correo',
                'data' => $userData

            );
        } else {
            $data = array(
                'response' => false,
                'message' => 'Error al actualizar el usuario'
            );
        }
    }





    echo json_encode($data);
}
