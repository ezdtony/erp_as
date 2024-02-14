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
            'message'                => 'Pregunta eliminada correctamente'
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
function saveVehiculo()
{

    $placas = $_POST['placas'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $color = $_POST['color'];
    $nombre = $_POST['nombre'];
    $observaciones = $_POST['observaciones'];


    $queries = new Queries;

    $stmt_gpp = "INSERT INTO asteleco_vehiculos.vehiculos 
                    (nombre_vehiculo ,
                    marca,
                    placas,
                    modelo,
                    color,
                    observaciones)
            VALUES (
                '$nombre',
                '$marca',
                '$placas',
                '$modelo',
                '$color',
                '$observaciones'
            )
    ";

    $insertarGrpoPreg = $queries->InsertData($stmt_gpp);
    if (!empty($insertarGrpoPreg)) {
        $id_vehiculos = $insertarGrpoPreg['last_id'];
        //--- --- ---//
        $data = array(
            'response' => true,
            'id_vehiculos'                => $id_vehiculos,
            'message'                => 'Unidad registrada correctamente'
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

function getInfoVehiculo()
{

    $queries = new Queries;

    $id_vehiculos = $_POST['id_vehiculos'];

    $stmt = "SELECT * FROM asteleco_vehiculos.vehiculos WHERE id_vehiculos = $id_vehiculos";

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
function updateUnidad()
{

    $placas = $_POST['placas'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $color = $_POST['color'];
    $nombre = $_POST['nombre'];
    $observaciones = $_POST['observaciones'];
    $id_vehiculos = $_POST['id_vehiculos'];


    $queries = new Queries;

    $stmt_gpp = "UPDATE asteleco_vehiculos.vehiculos 
                    SET 
                    nombre_vehiculo  = '$nombre',
                    marca = '$marca',
                    placas = '$placas',
                    modelo = '$modelo',
                    color = '$color',
                    observaciones = '$observaciones'
                    WHERE id_vehiculos = $id_vehiculos
    ";

    $insertarGrpoPreg = $queries->InsertData($stmt_gpp);
    if (!empty($insertarGrpoPreg)) {
        //--- --- ---//
        $data = array(
            'response' => true,
            'message'                => 'Unidad actualizada correctamente'
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

function deleteVehiculo()
{

    $id_vehiculos = $_POST['id_vehiculos'];


    $queries = new Queries;

    $stmt_gpp = "DELETE FROM asteleco_vehiculos.vehiculos WHERE id_vehiculos = $id_vehiculos";

    $insertarGrpoPreg = $queries->InsertData($stmt_gpp);
    if (!empty($insertarGrpoPreg)) {
        //--- --- ---//
        $data = array(
            'response' => true,
            'message'                => 'Unidad eliminada correctamente'
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

function getAviablePersonalVehiculos()
{

    $queries = new Queries;

    $stmt = "SELECT 
    asu.id_asignaciones_unidades,
    psn.id_lista_personal AS id_personal,
    CONCAT(
    acad.shortname_nivel, ' ', 
    psn.nombres, ' ', 
    psn.apellido_paterno, ' ',
        psn.apellido_materno
    ) AS nombre_completo
    
    FROM asteleco_personal.lista_personal AS psn
    INNER JOIN asteleco_personal.niveles_academicos AS acad ON psn.id_niveles_academicos = acad.id_niveles_academicos
    INNER JOIN asteleco_personal.niveles_areas AS niveles_areas ON psn.id_niveles_areas = niveles_areas.id_niveles_areas
    LEFT JOIN asteleco_vehiculos.asignaciones_unidades AS asu ON psn.id_lista_personal = asu.id_personal AND asu.activa = 1
    WHERE  niveles_areas.id_areas > 3
        ";

    $getPersonalAviable = $queries->getData($stmt);

    $id_vehiculos = $_POST['id_vehiculos'];
    $id_asignado = "";
    $stmt_asigned = "SELECT 
    asu.id_asignaciones_unidades,
    psn.id_lista_personal AS id_personal,
    CONCAT(
    acad.shortname_nivel, ' ', 
    psn.nombres, ' ', 
    psn.apellido_paterno, ' ',
        psn.apellido_materno
    ) AS nombre_completo
    
    FROM asteleco_personal.lista_personal AS psn
    INNER JOIN asteleco_personal.niveles_academicos AS acad ON psn.id_niveles_academicos = acad.id_niveles_academicos
    INNER JOIN asteleco_personal.niveles_areas AS niveles_areas ON psn.id_niveles_areas = niveles_areas.id_niveles_areas
    LEFT JOIN asteleco_vehiculos.asignaciones_unidades AS asu ON psn.id_lista_personal = asu.id_personal AND asu.activa = 1
    WHERE asu.id_vehiculos ='$id_vehiculos'
        ";

    $getUserAsignado = $queries->getData($stmt_asigned);

    if (!empty($getUserAsignado)) {
        $id_asignado = $getUserAsignado[0]->id_personal;
    }

    if (!empty($getPersonalAviable)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $getPersonalAviable,
            'id_asignado'                => $id_asignado
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
function asignarVehiculosPersonal()
{

    $id_vehiculos = $_POST['id_vehiculos'];
    $id_personal = $_POST['id_personal'];


    $queries = new Queries;

    $stmt_get_au = "SELECT * FROM asteleco_vehiculos.asignaciones_unidades WHERE id_vehiculos = $id_vehiculos AND activa = 1";
    $getAU = $queries->getData($stmt_get_au);
    if (empty($getAU)) {
        $stmt_gpp = "INSERT INTO asteleco_vehiculos.asignaciones_unidades (id_vehiculos, id_personal, activa) VALUES ($id_vehiculos, $id_personal, 1)";
        $insertarGrpoPreg = $queries->InsertData($stmt_gpp);
    } else {
        $stmt_gpp = "UPDATE asteleco_vehiculos.asignaciones_unidades SET activa = '0' WHERE id_vehiculos = $id_vehiculos";
        $setAU = $queries->InsertData($stmt_gpp);

        $stmt_gpp = "INSERT INTO asteleco_vehiculos.asignaciones_unidades (id_vehiculos, id_personal, activa) VALUES ($id_vehiculos, $id_personal, 1)";
        $insertarGrpoPreg = $queries->InsertData($stmt_gpp);
    }

    if (!empty($insertarGrpoPreg)) {
        //--- --- ---//
        $data = array(
            'response' => true,
            'message'                => 'Unidad asignada correctamente'
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
function guardarRevision()
{

    $arr_questions = $_POST['arr_questions'];
    $id_vehiculos = $_POST['id_vehiculos'];
    $today_date = date("Y-m-d");


    $queries = new Queries;
    $stmt_update_past = "UPDATE asteleco_vehiculos.index_checlist_log SET activo = 0 WHERE id_vehiculo = $id_vehiculos AND DATE(date_log) = '$today_date'";
    $updatePast = $queries->InsertData($stmt_update_past);

    $stmt_gpp = "INSERT INTO asteleco_vehiculos.index_checlist_log 
                    (date_log,
                    id_personal,
                    activo,
                    id_vehiculo)
            VALUES (
                NOW(),
                $_SESSION[id_user],
                1,
                $id_vehiculos
            )
    ";

    $insertarIndex = $queries->InsertData($stmt_gpp);
    if (!empty($insertarIndex)) {
        $id_index = $insertarIndex['last_id'];

        for ($i = 0; $i < count($arr_questions); $i++) {
            $id_pregunta = $arr_questions[$i]['id_preguntas'];
            $pregunta = $arr_questions[$i]['pregunta'];
            $value = $arr_questions[$i]['value'];
            $stmt_gpp = "INSERT INTO asteleco_vehiculos.checklist_log 
                            (id_index_checlist_log,
                            id_pregunta,
                            pregunta,
                            respuesta_sys)
                    VALUES (
                        $id_index,
                        '$id_pregunta',
                        '$pregunta',
                        '$value'
                    )
            ";

            $insertarIndex = $queries->InsertData($stmt_gpp);
        }
        //--- --- ---//
        $data = array(
            'response' => true,
            'id_index'                => $id_index
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

function getRevisiones()
{

    $id_vehiculos = $_POST['id_vehiculos'];
    $today_date = date("Y-m-d");


    $queries = new Queries;
    $stmt_update_past = "SELECT icl.*, DATE(icl.date_log) AS fecha, CONCAT(psn.nombres, ' ', psn.apellido_paterno, ' ', psn.apellido_materno) AS nombre_completo,
    CONCAT(veh.nombre_vehiculo, ' ', veh.modelo, ' PLACAS:', veh.placas) AS vehiculo
    FROM asteleco_vehiculos.index_checlist_log AS icl
    INNER JOIN asteleco_personal.lista_personal AS psn ON icl.id_personal = psn.id_lista_personal
    INNER JOIN asteleco_vehiculos.vehiculos AS veh ON icl.id_vehiculo = veh.id_vehiculos
    WHERE activo = 1 AND id_vehiculo = $id_vehiculos";
    $getPast = $queries->getData($stmt_update_past);
    if (!empty($getPast)) {
        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $getPast
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

function reportVehicleRevision()
{
    //--- --- ---//
    $id_index_checlist = $_POST['id_index_checlist'];
    $id_vehiculo = $_POST['id_vehiculo'];


    $results = false;

    $vehicleInfo = array();
    $indexInfo = array();
    $familiaPreguntas = array();


    $queries = new Queries;
    //--- --- ---//
    $sqlGetVehicleInfo = "SELECT * FROM asteleco_vehiculos.vehiculos WHERE id_vehiculos = $id_vehiculo";
    $vehicleInfo = $queries->getData($sqlGetVehicleInfo);
    //--- --- ---//

    //--- --- ---//
    $sqlGetIndexInfo = "SELECT icl.*, DATE(icl.date_log) AS fecha, CONCAT(psn.nombres, ' ', psn.apellido_paterno, ' ', psn.apellido_materno) AS nombre_completo
    FROM asteleco_vehiculos.index_checlist_log AS icl
    INNER JOIN asteleco_personal.lista_personal AS psn ON icl.id_personal = psn.id_lista_personal
    WHERE icl.id_index_checlist_log = $id_index_checlist";
    $indexInfo = $queries->getData($sqlGetIndexInfo);
    //--- --- ---//

    //--- --- ---//
    $sqlGetFamiliaPreguntas = "SELECT * FROM asteleco_vehiculos.familias_preguntas";
    $familiaPreguntas = $queries->getData($sqlGetFamiliaPreguntas);
    //--- --- ---//

    //--- --- ---//
    $dataFamilies = array();
    foreach ($familiaPreguntas as $familias_preguntas) {
        $resultsGroups = array();
        $gruposPreguntas = array();
        $id_familias_preguntas = $familias_preguntas->id_familias_preguntas;
        $family = $familias_preguntas->descripcion;

        $sqlGetGruposPreguntas = "SELECT * FROM asteleco_vehiculos.grupos_preguntas WHERE id_familias_preguntas = $id_familias_preguntas";
        $gruposPreguntas = $queries->getData($sqlGetGruposPreguntas);

        foreach ($gruposPreguntas as $grupos_preguntas) {
            $grupoAndPreguntas = array();
            $preguntas = array();
            $id_grupos_preguntas = $grupos_preguntas->id_grupos_preguntas;
            $group = $grupos_preguntas->descripcion;

            $sqlGetPreguntas = "SELECT * FROM asteleco_vehiculos.preguntas WHERE id_grupos_preguntas = $id_grupos_preguntas";
            $preguntas = $queries->getData($sqlGetPreguntas);

            foreach ($preguntas as $pregunta) {
                $respuestas = array();
                $id_preguntas = $pregunta->id_preguntas;
                $question = $pregunta->pregunta;

                $sqlGetChecklistLog = "SELECT * FROM asteleco_vehiculos.checklist_log WHERE id_index_checlist_log = $id_index_checlist AND id_pregunta = $id_preguntas";
                $checklistLog = $queries->getData($sqlGetChecklistLog);

                foreach ($checklistLog as $checklist_log) {
                    $id_checklist_log = $checklist_log->id_checklist_log;
                    $respuesta_sys = $checklist_log->respuesta_sys;
                    if ($respuesta_sys == '') {
                        $respuesta_sys = '-';
                    }

                    $results_log = array(
                        'pregunta' => $question,
                        'respuesta_sys' => $respuesta_sys,
                    );
                    $respuestas[] = $results_log;
                }
                $grupoAndPreguntas[] = array(
                    'pregunta' => $question,
                    'respuestas' => $respuestas,
                );
            }
            $resultsGroups[] = array(
                'grupo' => $group,
                'preguntas' => $grupoAndPreguntas,
            );
        }

        $dataFamilies[] = array(
            'familia' => $family,
            'grupos' => $resultsGroups,
        );
    }


    $results = array(
        'response' => true,
        'data' => array(
            'vehicleInfo' => $vehicleInfo,
            'indexInfo' => $indexInfo,
            'dataFamilies' => $dataFamilies,
        )
    );

    echo json_encode($results);
}
