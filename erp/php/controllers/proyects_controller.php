<?php
include_once dirname(__DIR__ . '', 1) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}




function saveProyect()
{


    $proyect_name = $_POST['proyect_name'];
    $proyect_code = $_POST['proyect_code'];
    $proyect_type = $_POST['proyect_type'];
    if ($proyect_code == "") {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        // Output: 54esmdr0qf

        $random_code = "CHU-RDM-" . (substr(str_shuffle($permitted_chars), 0, 3));
        $stmt_check_code = "SELECT * FROM constructora_personal.proyectos WHERE codigo_proyecto = '$random_code'";
        $queries = new Queries;
        $check_code = $queries->getData($stmt_check_code);
        if (!empty($check_code)) {
            $random_code = "CHU-DEF-" . (substr(str_shuffle($permitted_chars), 0, 3));
        }
        $proyect_code = $random_code;
    }

    $duracion_proyecto = $_POST['duracion_proyecto'];
    $estado = $_POST['estado'];
    $municipio = $_POST['municipio'];
    $colonia_proyecto = $_POST['colonia_proyecto'];
    $calle_proyecto = $_POST['calle_proyecto'];
    $dir_numero_proyecto = $_POST['dir_numero_proyecto'];
    $codigo_postal_proyecto = $_POST['codigo_postal_proyecto'];
    $comentarios_proyecto = $_POST['comentarios_proyecto'];
    $id_usuario = $_SESSION['id_user'];

    $arr_fecha = explode(" - ", $duracion_proyecto);
    $arr_fehca_inicio = explode("/", $arr_fecha[0]);
    $arr_fecha_fin = explode("/", $arr_fecha[1]);

    $fecha_inicio = $arr_fehca_inicio[2] . "-" . $arr_fehca_inicio[0] . "-" . $arr_fehca_inicio[1];
    $fecha_fin = $arr_fecha_fin[2] . "-" . $arr_fecha_fin[0] . "-" . $arr_fecha_fin[1];


    $queries = new Queries;

    $stmt_direccion = "INSERT INTO constructora_personal.direcciones 
                    (iddirecciones, 
                    direccion_calle,
                    direccion_numero,
                    direccion_colonia,
                    direccion_municipio,
                    direccion_estado,
                    direccion_codigo_postal)
            VALUES (
                NULL,
                '$calle_proyecto',
                '$dir_numero_proyecto',
                '$colonia_proyecto',
                '$municipio',
                '$estado',
                '$codigo_postal_proyecto'
            )
    ";

    $insertarDireccion = $queries->InsertData($stmt_direccion);
    if (!empty($insertarDireccion)) {
        $id_direccion = $insertarDireccion['last_id'];

        $stmt_proyecto = "INSERT INTO constructora_personal.proyectos (
                    id_proyectos, 
                    codigo_proyecto,
                    id_tipo_proyecto,
                    nombre_largo,
                    status,
                    id_personal_creador,
                    comentario,
                    fecha_inicio,
                    fecha_cierre_proyectada,
                    fecha_creacion,
                    id_direccion)
            VALUES (
                NULL,
                '$proyect_code',
                '$proyect_type',
                '$proyect_name',
                '1',
                '$id_usuario',
                '$comentarios_proyecto',
                '$fecha_inicio',
                '$fecha_fin',
                NOW(),
                '$id_direccion'
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

function getInfoProyect()
{
    $id_proyecto = $_POST['id_proyecto'];

    $queries = new Queries;

    $stmt = "SELECT 
        proy.id_proyectos, 
        proy.status, 
        proy.codigo_proyecto, 
        proy.nombre_largo,
        proy.comentario,
        proy.fecha_inicio,
        proy.fecha_cierre_proyectada,
        proy.fecha_creacion,
        CONCAT(
        tit.short_title, ' ', 
        psn.user_name, ' ', 
        psn.user_lastname
        ) AS creador_proyecto,
        CONCAT(
        direc.direccion_calle, ' ', 
        direc.direccion_numero, ', ',
        direc.direccion_colonia, ', ',
        direc.direccion_codigo_postal, ', ',
        mun.municipio, ', ',
        est.estado, ', Méx.'
    
        ) AS direccion_proyecto
    
        FROM constructora_personal.proyectos AS proy
        INNER JOIN constructora_personal.lista_personal AS psn ON proy.id_personal_creador = psn.id_lista_personal
        INNER JOIN constructora_personal.id_titulos AS tit ON psn.id_titulo = tit.id_titulo
        INNER JOIN constructora_personal.direcciones AS direc ON proy.id_direccion = direc.iddirecciones
        INNER JOIN constructora_personal.estados AS est ON direc.direccion_estado = est.id
        INNER JOIN constructora_personal.municipios AS mun ON direc.direccion_municipio = mun.id
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

function getPersonalAviable()
{
    $id_proyecto = $_POST['id_proyecto'];

    $queries = new Queries;

    $stmt = "SELECT 
    asp.id_asignaciones,
    psn.id_lista_personal AS id_personal,
    CONCAT(
    tit.short_title, ' ', 
    psn.user_name, ' ', 
    psn.user_lastname
    ) AS nombre_completo
    
    FROM constructora_personal.lista_personal AS psn
    INNER JOIN constructora_personal.id_titulos AS tit ON psn.id_titulo = tit.id_titulo
    LEFT JOIN constructora_personal.asignaciones_proyectos AS asp ON psn.id_lista_personal = asp.id_personal AND asp.id_proyecto = $id_proyecto AND asp.activo = 1
    WHERE asp.id_asignaciones IS NULL
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
function unassignPersonal()
{
    $id_asignacion = $_POST['id_asingacion'];

    $queries = new Queries;

    $stmt = "UPDATE constructora_personal.asignaciones_proyectos 
    SET  activo = 0
    WHERE id_asignaciones = $id_asignacion";

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

function cambiarStatusProyecto()
{
    $id_proyecto = $_POST['id_proyecto'];
    $prop = $_POST['prop'];

    $queries = new Queries;

    $stmt = "UPDATE constructora_personal.proyectos 
    SET  status = $prop
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

function getPersonalAssigned()
{
    $id_proyecto = $_POST['id_proyecto'];

    $queries = new Queries;

    $stmt = "SELECT 
    asp.id_asignaciones,
    psn.id_lista_personal AS id_personal,
    CONCAT(
    tit.short_title, ' ', 
    psn.user_name, ' ', 
    psn.user_lastname
    ) AS nombre_completo
    
    FROM constructora_personal.lista_personal AS psn
    INNER JOIN constructora_personal.id_titulos AS tit ON psn.id_titulo = tit.id_titulo
    LEFT JOIN constructora_personal.asignaciones_proyectos AS asp ON psn.id_lista_personal = asp.id_personal AND asp.id_proyecto = $id_proyecto
    WHERE asp.id_asignaciones IS NOT NULL AND asp.activo = 1
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
        $stmt_asignar = "INSERT INTO constructora_personal.asignaciones_proyectos 
        (
            id_asignaciones, 
        id_proyecto,
        id_personal,
        activo
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
