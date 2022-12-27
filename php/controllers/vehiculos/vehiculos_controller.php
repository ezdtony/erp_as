<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}




function saveGroupQuestion()
{


    $grupoPreguntas = $_POST['grupoPreguntas'];
    $riesgo = $_POST['riesgo'];
    $id_familias_preguntas = $_POST['id_familias_preguntas'];

    $queries = new Queries;

    $stmt_gpp = "INSERT INTO asteleco_vehiculos.grupos_preguntas 
                    (id_familias_preguntas ,
                    descripcion,
                    riesgo)
            VALUES (
                '$id_familias_preguntas',
                '$grupoPreguntas',
                '$riesgo'
            )
    ";

    $insertarGrpoPreg = $queries->InsertData($stmt_gpp);
    if (!empty($insertarGrpoPreg)) {
        $id_grupo = $insertarGrpoPreg['last_id'];
        //--- --- ---//
        $data = array(
            'response' => true,
            'id_grupo'                => $id_grupo,
            'message'                => 'Grupo de preguntas guardado correctamente'
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
function saveQuestion()
{

    $pregunta = $_POST['pregunta'];
    $TipoPregunta = $_POST['TipoPregunta'];
    $infoAdicional = $_POST['infoAdicional'];
    $id_grupo_pregunta = $_POST['id_grupo_pregunta'];


    $queries = new Queries;

    $stmt_gpp = "INSERT INTO asteleco_vehiculos.preguntas 
                    (id_tipos_preguntas ,
                    id_grupos_preguntas,
                    pregunta,
                    info_adicional)
            VALUES (
                '$TipoPregunta',
                '$id_grupo_pregunta',
                '$pregunta',
                '$infoAdicional'
            )
    ";

    $insertarGrpoPreg = $queries->InsertData($stmt_gpp);
    if (!empty($insertarGrpoPreg)) {
        $id_pregunta = $insertarGrpoPreg['last_id'];
        //--- --- ---//
        $data = array(
            'response' => true,
            'id_pregunta'                => $id_pregunta,
            'message'                => 'Pregunta guardada correctamente'
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


function updatePregunta()
{

    $editar_pregunta = $_POST['editar_pregunta'];
    $editar_TipoPregunta = $_POST['editar_TipoPregunta'];
    $editar_infoAdicional = $_POST['editar_infoAdicional'];
    $id_pregunta = $_POST['id_pregunta'];


    $queries = new Queries;

    $stmt_gpp = "UPDATE  asteleco_vehiculos.preguntas 
                    SET id_tipos_preguntas = '$editar_TipoPregunta',
                    pregunta = '$editar_pregunta',
                    info_adicional = '$editar_infoAdicional'
                    WHERE id_preguntas = '$id_pregunta'
    ";

    $insertarGrpoPreg = $queries->InsertData($stmt_gpp);
    if (!empty($insertarGrpoPreg)) {
        //--- --- ---//
        $data = array(
            'response' => true,
            'message'                => 'Pregunta actualizada correctamente'
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

function getTypeQuestions()
{

    $queries = new Queries;

    $stmt = "SELECT * FROM asteleco_vehiculos.tipos_preguntas";

    $getTypeQuestions = $queries->getData($stmt);

    if (!empty($getTypeQuestions)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $getTypeQuestions
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

function getInfoPregunta()
{

    $queries = new Queries;

    $id_pregunta = $_POST['id_pregunta'];

    $stmt = "SELECT * FROM asteleco_vehiculos.preguntas WHERE id_preguntas = $id_pregunta";

    $getTypeQuestions = $queries->getData($stmt);

    if (!empty($getTypeQuestions)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $getTypeQuestions
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
function deletePregunta()
{

    $id_pregunta = $_POST['id_pregunta'];


    $queries = new Queries;

    $stmt_gpp = "DELETE FROM asteleco_vehiculos.preguntas WHERE id_preguntas = $id_pregunta";

    $insertarGrpoPreg = $queries->InsertData($stmt_gpp);
    if (!empty($insertarGrpoPreg)) {
        //--- --- ---//
        $data = array(
            'response' => true,
            'message'                => 'Pregunta guardada correctamente'
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



function saveFamilyQuestion()
{


    $familiaPreguntas = $_POST['familiaPreguntas'];

    $queries = new Queries;

    $stmt_gpp = "INSERT INTO asteleco_vehiculos.familias_preguntas 
                    (descripcion)
            VALUES (
                '$familiaPreguntas'
            )
    ";

    $insertarGrpoPreg = $queries->InsertData($stmt_gpp);
    if (!empty($insertarGrpoPreg)) {
        $id_familias_preguntas = $insertarGrpoPreg['last_id'];
        //--- --- ---//
        $data = array(
            'response' => true,
            'id_familias_preguntas'                => $id_familias_preguntas,
            'message'                => 'Familia de preguntas guardado correctamente'
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
