<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}


function guardarCotizacion()
{
    $queries = new Queries;
    $arr_data = $_POST['arr_data'];

    $id_proyecto = $arr_data[0][0];
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    // Output: 54esmdr0qf
    $cd1 = (substr(str_shuffle($permitted_chars), 0, 3));
    $cd2 = (substr(str_shuffle($permitted_chars), 0, 3));
    $cd3 = (substr(str_shuffle($permitted_chars), 0, 3));
    $random_code = "CMPY" . $id_proyecto . "-" . $cd1 . "-" . $cd2;
    $fyh = date('Y-m-d H:i:s');
    $stmt = "INSERT INTO asteleco_compras.cotizaciones 
                 (
                    id_status_cotizaciones,
                    id_proyecto,
                    codigo_solicitud,
                    id_personal_registro,
                    date_log
                 )
                 VALUES(
                    '1',
                    '$id_proyecto',
                    '$random_code',
                     $_SESSION[id_user],
                     NOW()
                 )";
    $saveIndex = $queries->insertData($stmt);
    $id_index = $saveIndex['last_id'];

    $insertado = 1;

    for ($i = 1; $i < count($arr_data[1][0]); $i++) {


        $id_catalogo_material         = $arr_data[1][0][$i][0][0];
        $id_medidas_de_longitud       = $arr_data[1][0][$i][1][0];
        $marca                        = $arr_data[1][0][$i][2][0];
        $no_partida                   = $arr_data[1][0][$i][3][0];
        $cantidad                     = $arr_data[1][0][$i][4][0];
        $observaciones                = $arr_data[1][0][$i][5][0];


        $stmt_desgloce = "INSERT INTO asteleco_compras.desglose_cotizacion
                 (
                    id_cotizaciones,
                    id_catalogo_material,
                    id_medidas_de_longitud,
                    id_status_partidas,
                    id_marcas,
                    id_proveedores,
                    no_partida,
                    cantidad,
                    comentarios,
                    marca,
                    date_log
                 ) 
                 VALUES(
                    '$id_index',
                    '$id_catalogo_material',
                    '$id_medidas_de_longitud',
                    '1',
                    '1',
                    '1',
                    '$no_partida',
                    '$cantidad',
                    '$observaciones',
                    '$marca',
                    NOW()
                 )";
        $insertPartida = $queries->insertData($stmt_desgloce);
        if (!empty($insertPartida)) {
            $insertado++;
        }
    }

    if ($insertado == count($arr_data[1][0])) {
        $data = array(
            'response' => true,
            'message' => 'Se guardaron todas las partidas'
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
function updatePartida()
{
    $queries = new Queries;

    $id_desglose_cotizacion = $_POST['id_desglose_cotizacion'];
    $column_name = $_POST['column_name'];
    $value = $_POST['value'];

    $stmt = "UPDATE asteleco_compras.desglose_cotizacion 
    SET $column_name = '$value' 
    WHERE id_desglose_cotizacion = '$id_desglose_cotizacion'";

    if ($queries->insertData($stmt)) {
        $data = array(
            'response' => true,
            'message' => 'Se actualizó la partida'
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al actualizar la partida'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function deletePartida()
{
    $queries = new Queries;

    $id_desglose_cotizacion = $_POST['id_desglose_cotizacion'];

    $stmt = "DELETE FROM asteleco_compras.desglose_cotizacion WHERE id_desglose_cotizacion = '$id_desglose_cotizacion'";

    if ($queries->insertData($stmt)) {
        $data = array(
            'response' => true,
            'message' => 'Se eliminó la partida'
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al eliminar la partida'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}

function guardarNuevoConceptoCatalogo()
{
    $queries = new Queries;

    $nombre_material = $_POST['nombre_material'];
    $id_clasificacion = $_POST['id_clasificacion'];
    $id_unidad_medida = $_POST['id_unidad_medida'];
    $apply_ul = $_POST['apply_ul'];


    //GENERAR CÓDIGO DE MATERIAL
    $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $additional_chars = substr(str_shuffle($permitted_chars), 0, 3);

    $stmt_get_clasif_details = "SELECT * FROM asteleco_compras.clasificaciones_catalogo WHERE id_clasificaciones_catalogo = '$id_unidad_medida'";
    $getClasifDetails = $queries->getData($stmt_get_clasif_details);
    $getClasifDetails = $getClasifDetails[0];
    $nombre_corto = $getClasifDetails->nombre_corto;



    $stmt = "INSERT INTO asteleco_compras.catalogo_material 
    (id_clasificaciones_catalogo,
    id_unidades_medida,
    descripcion_material,
    aplica_ul,
    date_log)
    VALUES(
        '$id_clasificacion',
        '$id_unidad_medida',
        '$nombre_material',
        '$apply_ul',
        NOW()
    )";

    if ($guardar_material = $queries->insertData($stmt)) {
        $last_id = $guardar_material['last_id'];

        $codigo_material = $nombre_corto . "-" . $additional_chars . "-00" . $last_id;
        $stmt_update = "UPDATE asteleco_compras.catalogo_material SET codigo_astelecom = '$codigo_material' WHERE id_catalogo_material = '$last_id'";

        if ($queries->insertData($stmt_update)) {
            //--- --- ---//
            $data = array(
                'response' => true,
                'message' => 'Se guardó el nuevo material correctamente'
            );
        } else {
            $data = array(
                'response' => true,
                'message' => 'Se guardó el nuevo material correctamente, pero no se actualizó el código'
            );
        }
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al eliminar la partida'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}

function getMaterialesPorClasificacion()
{
    $queries = new Queries;

    $id_clasificacion = $_POST['id_clasificacion'];

    $stmt = "SELECT * FROM asteleco_compras.catalogo_material WHERE id_clasificaciones_catalogo= '$id_clasificacion'";
    $getMateriales = $queries->getData($stmt);
    if (!empty($getMateriales)) {
        $data = array(
            'response' => true,
            'data' => $getMateriales
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Al parecer no hay material registrado bajo esta clasificación'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function getMedidasLongitud()
{
    $queries = new Queries;

    $id_unidad_longitud = $_POST['id_unidad_longitud'];

    $stmt = "SELECT ul.*, ml.* 
    FROM asteleco_compras.medidas_de_longitud AS ml
    INNER JOIN asteleco_compras.unidades_de_longitud AS ul ON ml.id_unidades_de_longitud = ul.id_unidades_de_longitud
    WHERE ml.id_unidades_de_longitud = '$id_unidad_longitud'";
    $getMateriales = $queries->getData($stmt);
    if (!empty($getMateriales)) {
        $data = array(
            'response' => true,
            'data' => $getMateriales
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Al parecer no hay material registrado bajo esta clasificación'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function getListaArchivosCotizacion()
{
    $queries = new Queries;

    $id_cotizacion = $_POST['id_cotizacion'];

    $stmt = "SELECT doc.*, coti.codigo_solicitud, proy.codigo_proyecto, proy.nombre_proyecto, DATE(coti.date_log) AS fecha_cotizacion, descripcion_status_cotizaciones,
    CONCAT(per.nombres,' ',per.apellido_paterno,' ',per.apellido_materno) AS nombre_usuario
    FROM asteleco_compras.documentos_cotizacion AS doc
    INNER JOIN asteleco_compras.cotizaciones AS coti ON doc.id_cotizaciones = coti.id_cotizaciones
    INNER JOIN asteleco_compras.status_cotizaciones AS status ON coti.id_status_cotizaciones = status.id_status_cotizaciones
    INNER JOIN asteleco_proyectos.proyectos AS proy ON coti.id_proyecto = proy.id_proyectos
    INNER JOIN asteleco_personal.lista_personal AS per ON per.id_lista_personal = doc.id_personal_registro
    WHERE doc.id_cotizaciones = '$id_cotizacion'";
    $getMateriales = $queries->getData($stmt);
    if (!empty($getMateriales)) {
        $getMateriales_archives = $getMateriales[0];
        $html_table = '';
        $html_table .= '<p class="h1">Código cotización: ' . mb_strtoupper($getMateriales_archives->codigo_solicitud) . '</p>';
        $html_table .= '<p class="h2">Proyecto: ' . mb_strtoupper($getMateriales_archives->codigo_proyecto) . ' | ' . mb_strtoupper($getMateriales_archives->nombre_proyecto) . '</p>';
        $html_table .= '<p class="h2">Status: ' . mb_strtoupper($getMateriales_archives->descripcion_status_cotizaciones) . '</p>';
        $html_table .= '<br>';

        $html_table .= '<table id="table_archives_cotizacion" class="table table-bordered table-centered mb-0 table-responsive">';
        $html_table .= '            <thead>';
        $html_table .= '                <tr>';
        $html_table .= '                    <th>Descripción del archivo</th>';
        $html_table .= '                    <th>Tipo de archivo</th>';
        $html_table .= '                    <th>Subido por</th>';
        $html_table .= '                    <th>Fecha de carga</th>';
        $html_table .= '                    <th>Descargar</th>';
        $html_table .= '                    <th class="text-center">Eliminar</th>';
        $html_table .= '                </tr>';
        $html_table .= '            </thead>';
        $html_table .= '            <tbody>';
        for ($i = 0; $i < count($getMateriales); $i++) {

            $html_table .= '                <tr>';
            $html_table .= '                    <td>' . $getMateriales[$i]->nombre_documento . '</td>';
            $html_table .= '                    <td>' . $getMateriales[$i]->tipo_archivo . '</td>';
            $html_table .= '                    <td>' . $getMateriales[$i]->nombre_usuario . '</td>';
            $html_table .= '                    <td>' . $getMateriales[$i]->logdate . '</td>';
            $html_table .= '                    <td class="table-action text-center">';
            $html_table .= '                        <a href="/erp/' . $getMateriales[$i]->ruta_documento . '" target="_blank" class="btn btn-primary btn-sm"><i class="mdi mdi-cloud-download"></i></a>';
            $html_table .= '                    </td>';
            $html_table .= '                    <td class="table-action text-center">';
            $html_table .= '                        <a class="action-icon delete_doc_cotizacion" id="doc-cotizacion' . $getMateriales[$i]->id_documentos_cotizacion . '" id-doc-cotizacion="' . $getMateriales[$i]->id_documentos_cotizacion . '"> <i class="mdi mdi-delete"></i></a>';
            $html_table .= '                    </td>';
            $html_table .= '                </tr>';
        }

        $html_table .= '            </tbody>';
        $html_table .= '        </table>';
        $data = array(
            'response' => true,
            'data' => $getMateriales,
            'html_table' => $html_table
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Al parecer no hay material registrado bajo esta clasificación'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function deleteDocCotizacion()
{
    $queries = new Queries;

    $id_documentos_cotizacion = $_POST['id_documentos_cotizacion'];

    $stmt = "DELETE FROM asteleco_compras.documentos_cotizacion
    WHERE id_documentos_cotizacion = '$id_documentos_cotizacion'";
    if (!empty($queries->insertData($stmt))) {
        $data = array(
            'response' => true
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al eliminar el archivo'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}


function updateStatusCotizacion()
{
    $queries = new Queries;

    $id_cotizacion = $_POST['id_cotizacion'];
    $column_name = 'id_status_cotizaciones';
    $value = $_POST['id_status_cotizacion'];

    $stmt = "UPDATE asteleco_compras.cotizaciones
    SET $column_name = '$value'
    WHERE id_cotizaciones = '$id_cotizacion'";

    if ($queries->insertData($stmt)) {
        $stmt_get_properties = "SELECT *
        FROM  asteleco_compras.status_cotizaciones
        WHERE id_status_cotizaciones = '$value'";
        $getInfoRequest = $queries->getData($stmt_get_properties);
        $data = array(
            'response' => true,
            'message' => 'Se actualizó la partida',
            'data' => $getInfoRequest
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al actualizar la cotización'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function updateStatusPartida()
{
    $queries = new Queries;

    $id_partida = $_POST['id_partida'];
    $cotizada = $_POST['cotizada'];

    $stmt = "UPDATE asteleco_compras.desglose_cotizacion
    SET cotizada = '$cotizada'
    WHERE id_desglose_cotizacion = '$id_partida'";

    if ($data_sql = $queries->insertData($stmt)) {

        $data = array(
            'response' => true,
            'message' => 'Se actualizó la partida'
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al actualizar la partida'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}

function saveDocumentosCotizaciones()
{

    $folder = $_POST['folder'];
    $module_name = $_POST['module_name'];
    $id_cotizacion = $_POST['id_cotizacion'];
    $file_name_usr = $_POST['name'];
    $extension_file = basename($_FILES["formData"]["type"]);
    $file_name = $folder . "_" . time() . ".$extension_file";

    //$route = '/xampp/htdocs/documentos_alumnos/' . $_POST['student'] . '/' . $folder;
    $route2 =  dirname(__DIR__ . '', 3) . '/uploads/' . $module_name . "/" . $folder . "/";
    $route =  dirname(__DIR__ . '', 3) . '/uploads/' . $module_name . "/" . $folder . "/" . $file_name;
    $route_db = '/uploads/' . $module_name . '/' . $folder . "/" . $file_name;
    if (!file_exists($route2)) {
        mkdir($route2, 0777, true);
    }
    if (move_uploaded_file($_FILES["formData"]["tmp_name"], $route)) {

        $queries = new Queries;
        $data = array(
            'response' => true,
            'message' => 'Se cargó correctamente el archivo',
        );
        $stmt = "INSERT INTO asteleco_compras.documentos_cotizacion (
            id_cotizaciones,
            nombre_documento,
            tipo_archivo,
            ruta_documento,
            id_personal_registro,
            logdate
        ) VALUES
        (
            '$id_cotizacion',
            '$file_name_usr',
            '$extension_file',
            '$route_db',
            '$_SESSION[id_user]',
            NOW())";
        $last_id = 0;
        $getInfoRequest = $queries->insertData($stmt);
        $last_id = $getInfoRequest['last_id'];

        if ($last_id = !0) {
            $last_id_arch = $getInfoRequest['last_id'];
            $data = array(
                'response' => true,
                'message' => 'Se cargó correctamente el archivo',
                'id_archivo' => $last_id_arch
            );
        } else {
            $data = array(
                'response' => false,
                'message' => 'No se pudo cargar el archivo',
            );
        }
    } else {
        $data = array(
            'response' => false,
            'message' => 'No se pudo cargar el archivo',
        );
    }
    // echo $file_name;

    //$move = '';

    /* 
    $file = $route . '/' . $file_name;

    if (!file_exists($route)) {
        mkdir($route, 0777, true);
    }

    if (move_uploaded_file($_FILES['formData']['tmp_name'], $file)) {

        $response = 1;

        $movement = array(
            'movimiento'        => $move,
            'curp'              => $_POST['student'],
            'documento'         => $file_name
        );
        $movement = json_encode($movement);
        setLog(module, $movement, $_SESSION['colab']);
    }

    $data['response'] = $response;
     */
    echo json_encode($data);
}
function saveProveedor()
{
    $queries = new Queries;
    $nombre_proveedor = $_POST['nombre_proveedor'];
    $mail_proveedor = $_POST['mail_proveedor'];
    $telefono_proveedor = $_POST['telefono_proveedor'];
    $empresa_proveedor = $_POST['empresa_proveedor'];

    $stmt = "INSERT INTO asteleco_compras.proveedores (
        nombre_contacto,
        correo_contacto,
        telefono_contacto,
        empresa_proveedor
    ) VALUES
    (
        '$nombre_proveedor',
        '$mail_proveedor',
        '$telefono_proveedor',
        '$empresa_proveedor')";
    $insert_proov = $queries->insertData($stmt);
    if (!empty($insert_proov)) {
        $last_id = $insert_proov['last_id'];
        $data = array(
            'response' => true,
            'message' => 'Se agregó correctamente el proveedor',
            'lastId' => $last_id
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al agregar el proveedor'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function saveClasificacion()
{
    $queries = new Queries;
    $abreviatura_clasi = $_POST['abreviatura_clasi'];
    $clasificacion = $_POST['clasificacion'];

    $stmt = "INSERT INTO asteleco_compras.clasificaciones_catalogo (
        nombre_corto,
        clasificacion
    ) VALUES
    (
        '$abreviatura_clasi',
        '$clasificacion')";
    $insert_proov = $queries->insertData($stmt);
    if (!empty($insert_proov)) {
        $last_id = $insert_proov['last_id'];

        $data = array(
            'response' => true,
            'message' => 'Se agregó correctamente la clasificación',
            'lastId' => $last_id
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al agregar la clasificación'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function saveUnidadMedidaLongitud()
{
    $queries = new Queries;
    $medida = $_POST['medida'];
    $select_um = $_POST['select_um'];


    $stmt = "INSERT INTO asteleco_compras.medidas_de_longitud (
        id_unidades_de_longitud,
        medida_de_longitud_long
    ) VALUES
    (
        '$select_um',
        '$medida')";

    if ($queries->insertData($stmt)) {

        $data = array(
            'response' => true,
            'message' => 'Se agregó correctamente la medida'
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error  al agregar la medida'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function updateUserInfo()
{
    $queries = new Queries;

    $id_personal = $_POST['id_personal'];
    $column_name = $_POST['column_name'];
    $value = $_POST['value'];

    $stmt = "UPDATE asteleco_personal.lista_personal SET $column_name = '$value' WHERE id_lista_personal = '$id_personal'";

    if ($queries->insertData($stmt)) {
        $data = array(
            'response' => true,
            'message' => 'Se actualizó la información correctamente'
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al actualizar la información'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
