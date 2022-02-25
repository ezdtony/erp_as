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

        $stmt = "SELECT usr.*, area.description, area.id_area, al.id_areas_level,al.level_description 
        FROM constructora_personal.lista_personal AS usr
        INNER JOIN constructora_personal.areas_level AS al ON al.id_areas_level = usr.id_areas_level
        INNER JOIN constructora_personal.areas AS area ON area.id_area = al.id_area
        
        WHERE (usr.user_email = '$user' OR usr.user_code = '$user') AND usr.user_pass='$password'";
         
    $getUserInfo = $queries->getData($stmt);

    if (!empty($getUserInfo)) {

        foreach ($getUserInfo as $key) {
            $_SESSION['user']=$key->user_name." ".$key->user_lastname;
            $_SESSION['user_short']=$key->user_name;
            $_SESSION['id_user']=$key->id_lista_personal;
            $_SESSION['id_area']=$key->id_area;
            $_SESSION['id_areas_level']=$key->id_areas_level;
            $_SESSION['txt_area']=$key->description;
            $_SESSION['txt_area_level']=$key->level_description;
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