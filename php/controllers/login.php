<?php
include_once dirname(__DIR__.'',1 )."/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}




function getUserInfo()
{
    $user = $_POST['user'];
    $password = $_POST['password'];

    $queries = new Queries;

        $stmt = "SELECT ar.id_areas, ar.descripcion_area,  niv_ar.descripcion_niveles_areas AS puesto_area, usr.* 
        FROM asteleco_personal.lista_personal AS usr INNER JOIN asteleco_personal.niveles_areas AS niv_ar ON usr.id_niveles_areas = niv_ar.id_niveles_areas INNER JOIN asteleco_personal.areas AS ar ON ar.id_areas = niv_ar.id_areas
        
        WHERE (usr.correo_sesion = '$user' OR usr.codigo_usuario = '$user') AND usr.password='$password' AND usr.status = 1";    
         
    $getUserInfo = $queries->getData($stmt);

    if (!empty($getUserInfo)) {

        foreach ($getUserInfo as $key) {
            $_SESSION['user']=$key->nombres." ".$key->apellido_paterno." ".$key->apellido_materno;
            $_SESSION['id_user']=$key->id_lista_personal;
            $_SESSION['id_area']=$key->id_areas;
            $_SESSION['id_areas_level']=$key->id_niveles_areas;
            $_SESSION['txt_area']=$key->descripcion_area;
            $_SESSION['txt_area_level']=$key->puesto_area;
        }
        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $getUserInfo
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