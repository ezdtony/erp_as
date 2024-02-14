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

    $tipo_proyecto = $_POST['tipo_proyecto'];
    $region_proyecto = $_POST['region_proyecto'];
    $nombre_proyecto = $_POST['nombre_proyecto'];
    $arr_fecha_inicio = $_POST['fecha_inicio'];
    $fecha_inicio = date('Y-m-d', strtotime($arr_fecha_inicio));


    $estado_proyecto = $_POST['estado_proyecto'];
    $municipio_proyecto = $_POST['municipio_proyecto'];

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
    if (count($arr_proy) >= 2) {
        $cod_pr = (substr($arr_proy[0], 0, 3)) . "-" . (substr($arr_proy[1], 0, 3)) . "R" . $region_proyecto;
    } else {
        $cod_pr = substr($nombre_proyecto, 0, 3) . "R" . $region_proyecto;
    }
    $random_code = $cod_pr . "-" . (substr(str_shuffle($permitted_chars), 0, 3));

    $stmt_check_code = "SELECT * FROM asteleco_proyectos.proyectos WHERE codigo_proyecto = '$random_code'";
    $queries = new Queries;
    $check_code = $queries->getData($stmt_check_code);
    if (!empty($check_code)) {
        $random_code = $cod_pr . "--" . (substr(str_shuffle($permitted_chars), 0, 3)) . "R" . $region_proyecto;
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

function getPersonalAssigned()
{
    $id_proyecto = $_POST['id_proyecto'];

    $queries = new Queries;

    $stmt = "SELECT 
    asp.id_asignaciones_proyectos,
    psn.id_lista_personal AS id_personal,
    CONCAT(
    acad.shortname_nivel, ' ', 
    psn.nombres, ' ', 
    psn.apellido_paterno, ' ',
        psn.apellido_materno
    ) AS nombre_completo
    
    FROM asteleco_personal.lista_personal AS psn
    INNER JOIN asteleco_personal.niveles_academicos AS acad ON psn.id_niveles_academicos = acad.id_niveles_academicos
    LEFT JOIN asteleco_proyectos.asignaciones_proyectos AS asp ON psn.id_lista_personal = asp.	id_lista_personal AND asp.id_proyectos = $id_proyecto
    WHERE asp.id_asignaciones_proyectos IS NOT NULL AND asp.status = 1
        ";

    $getPersonalAviable = $queries->getData($stmt);

    if (!empty($getPersonalAviable)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $getPersonalAviable
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

function getPersonalAviable()
{
    $id_proyecto = $_POST['id_proyecto'];

    $queries = new Queries;

    $stmt = "SELECT 
    asp.id_asignaciones_proyectos,
    psn.id_lista_personal AS id_personal,
    CONCAT(
    acad.shortname_nivel, ' ', 
    psn.nombres, ' ', 
    psn.apellido_paterno, ' ',
        psn.apellido_materno
    ) AS nombre_completo
    
    FROM asteleco_personal.lista_personal AS psn
    INNER JOIN asteleco_personal.niveles_academicos AS acad ON psn.id_niveles_academicos = acad.id_niveles_academicos
    LEFT JOIN asteleco_proyectos.asignaciones_proyectos AS asp ON psn.id_lista_personal = asp.	id_lista_personal AND asp.id_proyectos = $id_proyecto AND asp.status = 1
    WHERE asp.id_asignaciones_proyectos IS  NULL 
        ";

    $getPersonalAviable = $queries->getData($stmt);

    if (!empty($getPersonalAviable)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $getPersonalAviable
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

function asignarPersonal()
{


    $id_proyecto = $_POST['id_proyecto'];
    $ids_personal = $_POST['ids_personal'];
    $queries = new Queries;

    for ($i = 0; $i < (count($ids_personal)); $i++) {
        $id_personal = $ids_personal[$i];
        $stmt_asignar = "INSERT INTO asteleco_proyectos.asignaciones_proyectos 
        (
            id_asignaciones_proyectos, 
            id_proyectos,
            id_lista_personal,
            status
                )
        VALUES (
            NULL,
            '$id_proyecto',
            '$id_personal',
            '1'
        )
        ";

        $asignarPersonal = $queries->InsertData($stmt_asignar);
    }






    if (!empty($asignarPersonal)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $asignarPersonal
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
function unassignPersonal()
{
    $id_asignacion = $_POST['id_asingacion'];

    $queries = new Queries;

    $stmt = "UPDATE asteleco_proyectos.asignaciones_proyectos 
    SET  status = 0
    WHERE id_asignaciones_proyectos = $id_asignacion";

    $setInactivo = $queries->insertData($stmt);

    if (!empty($setInactivo)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $setInactivo
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

function getInfoProyect()
{
    $id_proyecto = $_POST['id_proyecto'];

    $queries = new Queries;

    $stmt = "SELECT 
        proy.id_proyectos, 
        tip.descripcion_tipo AS tipo_proyecto, 
        proy.codigo_proyecto, 
        proy.nombre_proyecto,
        proy.descripcion,
        proy.fecha_inicio,
        proy.fecha_proyectada_cierre,
        CASE 
            WHEN proy.fecha_cierre_real IS NULL THEN '-'
            WHEN proy.fecha_cierre_real ='0000-00-00' THEN '-'
            WHEN proy.fecha_cierre_real IS NOT NULL THEN proy.fecha_cierre_real
        END AS fecha_cierre_real,
        proy.log_creacion,
        CASE 
            WHEN proy.fecha_proyectada_cierre IS NULL THEN '-'
            WHEN proy.fecha_proyectada_cierre ='0000-00-00' THEN '-'
            WHEN proy.fecha_proyectada_cierre IS NOT NULL THEN proy.fecha_proyectada_cierre
        END AS fecha_proyectada_cierre,
        proy.log_creacion,
        CONCAT(
        tit.shortname_nivel, ' ', 
        psn.nombres, ' ', 
        psn.apellido_paterno, ' ',
            psn.apellido_materno
        ) AS creador_proyecto,

        CONCAT(
        direc.direccion_calle, ' ', 
        direc.direccion_numero_ext, ', ',
        direc.direccion_colonia, ', C.P. ',
        direc.direccion_zipcode, ', ',
        direc.direccion_municipio, ', ',
        direc.direccion_estado, ', Méx.'
    
        ) AS direccion_proyecto
    
        FROM asteleco_proyectos.proyectos AS proy
        INNER JOIN asteleco_proyectos.tipos_proyecto AS tip ON proy.id_tipos_proyecto = tip.id_tipos_proyecto
        INNER JOIN asteleco_personal.lista_personal AS psn ON proy.id_personal_creador = psn.id_lista_personal
        INNER JOIN asteleco_personal.niveles_academicos AS tit ON psn.id_niveles_academicos = tit.id_niveles_academicos
        INNER JOIN asteleco_proyectos.direcciones_proyecto AS direc ON proy.id_direcciones_proyecto = direc.id_direcciones_proyecto
        WHERE proy.id_proyectos = $id_proyecto
        ";

    $getInfoProyect = $queries->getData($stmt);

    if (!empty($getInfoProyect)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $getInfoProyect
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

function deleteProyect()
{
    $id_proyecto = $_POST['id_proyect'];

    $queries = new Queries;

    $stmt = "UPDATE asteleco_proyectos.proyectos
    SET  show_proyect = 0
    WHERE id_proyectos = $id_proyecto";

    $setInactivo = $queries->insertData($stmt);

    if (!empty($setInactivo)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $setInactivo
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

function changeStatusProyect()
{
    $id_proyecto = $_POST['id_proyect'];
    $status = $_POST['status'];

    $queries = new Queries;

    $stmt = "UPDATE asteleco_proyectos.proyectos 
    SET  status = $status, fecha_cierre_real = NOW()
    WHERE id_proyectos = $id_proyecto";

    $setInactivo = $queries->insertData($stmt);

    if (!empty($setInactivo)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $setInactivo
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

function updateProyectCreator()
{

    $id_proyecto = $_POST['id_proyecto'];
    $id_personal = $_POST['id_personal'];

    $queries = new Queries;

    $stmt = "UPDATE asteleco_proyectos.proyectos 
    SET  id_personal_creador = '$id_personal'
    WHERE id_proyectos = $id_proyecto";

    $setInactivo = $queries->insertData($stmt);

    if (!empty($setInactivo)) {


        //--- --- ---//
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

    echo json_encode($data);
}
