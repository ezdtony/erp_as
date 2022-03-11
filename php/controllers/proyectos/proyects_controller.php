<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}




function saveProyect()
{

    $id_usuario = $_SESSION['id_user'];

    $tipo_proyecto =$_POST['tipo_proyecto'];
    $region_proyecto =$_POST['region_proyecto'];
    $nombre_proyecto =$_POST['nombre_proyecto'];
    $arr_fecha_inicio =$_POST['fecha_inicio'];
    $fecha_inicio = date('Y-m-d', strtotime($arr_fecha_inicio));


    $estado_proyecto =$_POST['estado_proyecto'];
    $municipio_proyecto =$_POST['municipio_proyecto'];

    $descripcion_proyecto = $_POST['descripcion_proyecto'];
    $fecha_cierre = $_POST['fecha_cierre'];
    /* $arr_fecha_cierre = explode("/",$_POST['fecha_cierre']);
    $fecha_cierre = $arr_fecha_cierre[2]."-".$arr_fecha_cierre[0]."-".$arr_fecha_cierre[1]; */
    $colonia_direccion = $_POST['colonia_direccion'];
    $zip_direccion = $_POST['zip_direccion'];
    $calle_direccion = $_POST['calle_direccion'];
    $num_ext_direccion = $_POST['num_ext_direccion'];
    $num_int_direccion = $_POST['num_int_direccion'];


    
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        // Output: 54esmdr0qf
        $arr_proy = explode(" ", $nombre_proyecto);
        if (count($arr_proy) >=2 ) {
            $cod_pr = (substr($arr_proy[0], 0, 3))."-".(substr($arr_proy[1], 0, 3))."R".$region_proyecto;
        }else{
            $cod_pr = substr($nombre_proyecto, 0, 3)."R".$region_proyecto;
        }
        $random_code = $cod_pr. "-". (substr(str_shuffle($permitted_chars), 0, 3));

        $stmt_check_code = "SELECT * FROM asteleco_proyectos.proyectos WHERE codigo_proyecto = '$random_code'";
        $queries = new Queries;
        $check_code = $queries->getData($stmt_check_code);
        if (!empty($check_code)) {
            $random_code = $cod_pr . "--". (substr(str_shuffle($permitted_chars), 0, 3))."R".$region_proyecto;
        }
        $proyect_code = $random_code;

    $queries = new Queries;

    $stmt_direccion = "INSERT INTO asteleco_proyectos.direcciones_proyecto 
                    (id_direcciones_proyecto , 
                    direccion_calle,
                    direccion_numero_int,
                    direccion_numero_ext,
                    direccion_colonia,
                    direccion_municipio,
                    direccion_zipcode,
                    direccion_estado)
            VALUES (
                NULL,
                '$calle_direccion',
                '$num_int_direccion',
                '$num_ext_direccion',
                '$colonia_direccion',
                '$municipio_proyecto',
                '$zip_direccion',
                '$estado_proyecto'
            )
    ";

    $insertarDireccion = $queries->InsertData($stmt_direccion);
    if (!empty($insertarDireccion)) {
        $id_direccion = $insertarDireccion['last_id'];

        $stmt_proyecto = "INSERT INTO asteleco_proyectos.proyectos (
                    id_proyectos, 
                    id_tipos_proyecto,
                    id_direcciones_proyecto ,
                    id_regiones ,
                    codigo_proyecto,
                    nombre_proyecto,
                    descripcion,
                    id_personal_creador,
                    status,
                    fecha_inicio,
                    fecha_proyectada_cierre,
                    log_creacion)
            VALUES (
                NULL,
                '$tipo_proyecto',
                '$id_direccion',
                '$region_proyecto',
                '$proyect_code',
                '$nombre_proyecto',
                '$descripcion_proyecto',
                '$id_usuario',
                '1',
                '$fecha_inicio',
                '$fecha_cierre',
                NOW()
            )";


        $insertarProyecto = $queries->InsertData($stmt_proyecto);
        if (!empty($insertarProyecto)) {


            //--- --- ---//
            $data = array(
                'response' => true,
                'data'                => $insertarProyecto,
                'proyect_code'        => $proyect_code,
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
    } else {
    }


    echo json_encode($data);
}
