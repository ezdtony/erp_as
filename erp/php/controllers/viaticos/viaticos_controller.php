<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}

function saveDeposit()
{
    $id_user = $_POST['id_user'];
    $arr_fecha = explode("/", $_POST['fecha']);
    $fecha = $arr_fecha[2] . "-" . $arr_fecha[0] . "-" . $arr_fecha[1];
    $id_asingacion = $_POST['id_asingacion'];
    $sitio = $_POST['sitio'];
    $tipos_gasto = $_POST['tipos_gasto'];
    $importe = $_POST['importe'];
    $id_author = $_POST['id_author'];
    $id_proyecto = $_POST['id_proyecto'];
    $txt_proyecto = $_POST['txt_proyecto'];
    $cod_proyecto = $_POST['cod_proyecto'];

    $cod_proy = "";
    if (strlen($cod_proyecto > 0)) {
        $cod_proy = "<br>Consecutivo de proyecto: " . $cod_proyecto;
    }

    $queries = new Queries;

    $sql_insertar_deposito = "INSERT INTO asteleco_viaticos_erp.depositos (
        id_personal,
        id_asignacion_proyecto,
        id_tipos_gasto,
        id_personal_registro,
        sitio,
        cantidad,
        fecha,
        log_date,
        id_proyectos
    ) VALUES (
        '$id_user',
        '$id_asingacion',
        '$tipos_gasto',
        '$id_author',
        '$sitio',
        '$importe',
        '$fecha',
        NOW(),
        '$id_proyecto'
        )";
    //--- --- ---//
    //$last_id = $getInfoRequest['last_id'];
    if ($queries->insertData($sql_insertar_deposito)) {



        $stmt = "UPDATE asteleco_viaticos_erp.saldos
        SET 
        saldo = saldo + $importe
        WHERE id_personal = $id_user";

        if ($queries->insertData($stmt)) {
            $data = array(
                'response' => true,
                'message'                => '<h2>El depósito se registró correctamente!!</h2>' . $cod_proy . ''
            );
            //--- --- ---//

        } else {
            //--- --- ---//
            $data = array(
                'response' => false,
                'message'                => 'Error al registrar el depósito :('
            );
            //--- --- ---//
        }
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Error al actualizar el saldo del destinatario :('
        );
        //--- --- ---//
    }

    echo json_encode($data);
}


function editDeposit()
{
    $id_user = $_POST['id_user'];
    $arr_fecha = explode("/", $_POST['fecha']);
    $fecha = $arr_fecha[2] . "-" . $arr_fecha[0] . "-" . $arr_fecha[1];
    $id_asingacion = $_POST['id_asingacion'];
    $sitio = $_POST['sitio'];
    $tipos_gasto = $_POST['tipos_gasto'];
    $importe = $_POST['importe'];
    $id_author = $_POST['id_author'];
    $id_deposito = $_POST['id_deposit'];
    $id_proyecto = $_POST['id_proyecto'];

    $queries = new Queries;

    $getOgImport = "SELECT cantidad, id_personal FROM asteleco_viaticos_erp.depositos WHERE id_depositos = $id_deposito";
    $getInfoRequest = $queries->getData($getOgImport);
    $og_import = $getInfoRequest[0]->cantidad;
    $id_user_og = $getInfoRequest[0]->id_personal;

    $returnBalance = "UPDATE asteleco_viaticos_erp.saldos SET saldo = saldo - $og_import WHERE id_personal = $id_user_og";
    $updateBalance = $queries->insertData($returnBalance);

    $stmt = "UPDATE asteleco_viaticos_erp.saldos SET saldo = saldo + $importe WHERE id_personal = $id_user";

    $updateSaldo = $queries->insertData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($updateSaldo)) {
        $sql_insertar_deposito = "UPDATE asteleco_viaticos_erp.depositos 
        SET
            id_personal = $id_user ,
            id_asignacion_proyecto = $id_asingacion ,
            id_tipos_gasto = $tipos_gasto ,
            id_personal_registro = $id_author ,
            sitio = '$sitio' ,
            cantidad = $importe ,
            fecha = '$fecha' ,
            log_date = NOW(),
            id_proyectos = $id_proyecto
            WHERE id_depositos = $id_deposito";
        //--- --- ---//
        $insertar_deposito = $queries->insertData($sql_insertar_deposito);


        if (!empty($insertar_deposito)) {
            $data = array(
                'response' => true,
                'message'                => 'El depósito se actualizó correctamente!!'
            );
            //--- --- ---//

        } else {
            //--- --- ---//
            $data = array(
                'response' => false,
                'message'                => 'Error al actualizar el depósito :('
            );
            //--- --- ---//
        }
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Error al actualizar el saldo del destinatario :('
        );
        //--- --- ---//
    }

    echo json_encode($data);
}

function deleteDeposit()
{
    $id_deposito = $_POST['id_deposit'];

    $queries = new Queries;

    $getOgImport = "SELECT cantidad, id_personal FROM asteleco_viaticos_erp.depositos WHERE id_depositos = $id_deposito";
    $getInfoRequest = $queries->getData($getOgImport);
    $og_import = $getInfoRequest[0]->cantidad;
    $id_user_og = $getInfoRequest[0]->id_personal;

    $returnBalance = "UPDATE  asteleco_viaticos_erp.saldos SET saldo = saldo - $og_import WHERE id_personal = $id_user_og";
    $updateBalance = $queries->insertData($returnBalance);

    //$last_id = $getInfoRequest['last_id'];
    if (!empty($updateBalance)) {

        $sql_insertar_deposito = "DELETE FROM asteleco_viaticos_erp.depositos WHERE id_depositos = $id_deposito";
        //--- --- ---//
        $insertar_deposito = $queries->insertData($sql_insertar_deposito);
        if (!empty($insertar_deposito)) {
            $data = array(
                'response' => true,
                'message'                => 'El depósito se eliminó correctamente!!'
            );
            //--- --- ---//

        } else {
            //--- --- ---//
            $data = array(
                'response' => false,
                'message'                => 'Error al actualizar el depósito :('
            );
            //--- --- ---//
        }
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Error al actualizar el saldo del destinatario :('
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function deleteGasto()
{
    $id_gastos = $_POST['id_gasto'];

    $queries = new Queries;

    $getOgImport = "SELECT importe, id_personal FROM asteleco_viaticos_erp.gastos WHERE id_gastos = $id_gastos";
    $getInfoRequest = $queries->getData($getOgImport);
    $og_import = $getInfoRequest[0]->importe;
    $id_user_og = $getInfoRequest[0]->id_personal;

    $returnBalance = "UPDATE  asteleco_viaticos_erp.saldos SET saldo = saldo + $og_import WHERE id_personal = $id_user_og";
    $updateBalance = $queries->insertData($returnBalance);

    //$last_id = $getInfoRequest['last_id'];
    if (!empty($updateBalance)) {
        $getSeguimiento = "SELECT id_seguimiento_gastos FROM asteleco_viaticos_erp.seguimiento_gastos WHERE id_gastos = $id_gastos";
        $getInfoRequestSeguimiento = $queries->getData($getSeguimiento);

        if (!empty($getInfoRequestSeguimiento)) {
            $getInfoRequestSeguimiento = $getInfoRequestSeguimiento[0];
            $id_seguimiento_gastos = $getInfoRequestSeguimiento->id_seguimiento_gastos;
            $DELETESeguimiento = "DELETE FROM asteleco_viaticos_erp.seguimiento_gastos_log WHERE id_seguimiento_gastos = $id_seguimiento_gastos";
            $queries->insertData($DELETESeguimiento);
        }

        $sql_dlt_seg = "DELETE FROM asteleco_viaticos_erp.seguimiento_gastos WHERE id_gastos = $id_gastos";
        $queries->insertData($sql_dlt_seg);

        $sql_insertar_deposito = "DELETE FROM asteleco_viaticos_erp.gastos WHERE id_gastos = $id_gastos";
        //--- --- ---//
        $insertar_deposito = $queries->insertData($sql_insertar_deposito);
        if (!empty($insertar_deposito)) {
            $data = array(
                'response' => true,
                'message'                => 'El gasto se eliminó correctamente!!'
            );
            //--- --- ---//

        } else {
            //--- --- ---//
            $data = array(
                'response' => false,
                'message'                => 'Error al borrar el gasto :('
            );
            //--- --- ---//
        }
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Error al actualizar el saldo del destinatario :('
        );
        //--- --- ---//
    }

    echo json_encode($data);
}

/* function getComentarioGasto()
{
    $id_gastos = $_POST['id_gasto'];

    $queries = new Queries;

    $getOgImport = "SELECT importe, id_personal FROM asteleco_viaticos_erp.gastos WHERE id_gastos = $id_gastos";
    $getInfoRequest = $queries->getData($getOgImport);
    $og_import = $getInfoRequest[0]->importe;
    $id_user_og = $getInfoRequest[0]->id_personal;

    $returnBalance = "UPDATE  asteleco_viaticos_erp.saldos SET saldo = saldo + $og_import WHERE id_personal = $id_user_og";
    $updateBalance = $queries->insertData($returnBalance);

    //$last_id = $getInfoRequest['last_id'];
    if (!empty($updateBalance)) {
        $getSeguimiento = "SELECT id_seguimiento_gastos FROM asteleco_viaticos_erp.seguimiento_gastos WHERE id_gastos = $id_gastos";
        $getInfoRequestSeguimiento = $queries->getData($getSeguimiento);

        if(!empty($getInfoRequestSeguimiento)){
            $getInfoRequestSeguimiento = $getInfoRequestSeguimiento[0];
            $id_seguimiento_gastos = $getInfoRequestSeguimiento->id_seguimiento_gastos;
            $DELETESeguimiento = "DELETE FROM asteleco_viaticos_erp.seguimiento_gastos_log WHERE id_seguimiento_gastos = $id_seguimiento_gastos";
            $queries->insertData($DELETESeguimiento);

        }

        $sql_dlt_seg = "DELETE FROM asteleco_viaticos_erp.seguimiento_gastos WHERE id_gastos = $id_gastos";
        $queries->insertData($sql_dlt_seg);
        
        $sql_insertar_deposito = "DELETE FROM asteleco_viaticos_erp.gastos WHERE id_gastos = $id_gastos";
        //--- --- ---//
        $insertar_deposito = $queries->insertData($sql_insertar_deposito);
        if (!empty($insertar_deposito)) {
            $data = array(
                'response' => true,
                'message'                => 'El gasto se eliminó correctamente!!'
            );
            //--- --- ---//

        } else {
            //--- --- ---//
            $data = array(
                'response' => false,
                'message'                => 'Error al borrar el gasto :('
            );
            //--- --- ---//
        }
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Error al actualizar el saldo del destinatario :('
        );
        //--- --- ---//
    }

    echo json_encode($data);
} */
function saveSpent()
{
    $arr_fecha_compra = explode("/", $_POST['fecha_compra']);
    $fecha_compra = $arr_fecha_compra[2] . "-" . $arr_fecha_compra[0] . "-" . $arr_fecha_compra[1];
    $id_asignacion = $_POST['id_asignacion'];
    $id_proyecto = $_POST['id_proyecto'];
    $id_author = $_POST['id_author'];
    $sitio_gasto = $_POST['sitio_gasto'];
    $tipos_gasto = $_POST['tipos_gasto'];
    $importe_gasto = $_POST['importe_gasto'];
    $comentario_gasto = $_POST['comentario_gasto'];
    $coordenadas_gasto = $_POST['coordenadas_gasto'];

    $queries = new Queries;

    $sql_get_saldo = "SELECT saldo FROM asteleco_viaticos_erp.saldos WHERE id_personal = $id_author";
    $get_saldo = $queries->getData($sql_get_saldo);
    $saldo = $get_saldo[0]->saldo;
    if ($saldo >= $importe_gasto) {
        $sql_insertar_gasto = "INSERT INTO asteleco_viaticos_erp.gastos(
            id_gastos,
            id_formas_pago,
            id_asignaciones_proyectos,
            id_proyectos,
            id_status_type,
            id_tipos_gasto,
            id_personal,
            importe,
            fecha_registro,
            localidad,
            clasificacion,
            id_ruta_img,
            log_date,
            tipo_gasto_manual,
            coordenadas
        )VALUES(
            NULL,
            1,
            '$id_asignacion',
            '$id_proyecto',
            1,
            $tipos_gasto,
            $id_author,
            $importe_gasto,
            '$fecha_compra',
            '$sitio_gasto',
            '1',
            NULL,
            NOW(),
            '$comentario_gasto',
            '$coordenadas_gasto'
        )";
        $insertSpent = $queries->insertData($sql_insertar_gasto);



        //$last_id = $getInfoRequest['last_id'];
        if (!empty($insertSpent)) {
            $last_id = $insertSpent['last_id'];

            $returnBalance = "UPDATE asteleco_viaticos_erp.saldos SET saldo = saldo - $importe_gasto WHERE id_personal = $id_author";
            $updateBalance = $queries->insertData($returnBalance);

            if (!empty($updateBalance)) {
                $data = array(
                    'response' => true,
                    'message'                => 'Se registró el gasto!!',
                    'id_gasto' => $last_id
                );
                //--- --- ---//

            } else {
                //--- --- ---//
                $data = array(
                    'response' => false,
                    'message'                => 'Error al registrar el gasto :('
                );
                //--- --- ---//
            }
        } else {
            //--- --- ---//
            $data = array(
                'response' => false,
                'message'                => 'Error al actualizar el saldo del destinatario :('
            );
            //--- --- ---//
        }
    } else {
        $data = array(
            'response' => false,
            'message'                => 'No tiene saldo suficiente para realizar el gasto :('
        );
    }


    echo json_encode($data);
}
function saveSpentDeduciblePendiente()
{
    $arr_fecha_compra = explode("/", $_POST['fecha_compra']);
    $fecha_compra = $arr_fecha_compra[2] . "-" . $arr_fecha_compra[0] . "-" . $arr_fecha_compra[1];
    $id_asignacion = $_POST['id_asignacion'];
    $id_proyecto = $_POST['id_proyecto'];
    $id_author = $_POST['id_author'];
    $sitio_gasto = $_POST['sitio_gasto'];
    $tipos_gasto = $_POST['tipos_gasto'];
    $importe_gasto = $_POST['importe_gasto'];
    $comentario_gasto = $_POST['comentario_gasto'];
    $coordenadas_gasto = $_POST['coordenadas_gasto'];

    $queries = new Queries;

    $sql_get_saldo = "SELECT saldo FROM asteleco_viaticos_erp.saldos WHERE id_personal = $id_author";
    $get_saldo = $queries->getData($sql_get_saldo);
    $saldo = $get_saldo[0]->saldo;
    if ($saldo >= $importe_gasto) {
        $sql_insertar_gasto = "INSERT INTO asteleco_viaticos_erp.gastos(
            id_gastos,
            id_formas_pago,
            id_asignaciones_proyectos,
            id_proyectos,
            id_status_type,
            id_tipos_gasto,
            id_personal,
            importe,
            fecha_registro,
            localidad,
            clasificacion,
            id_ruta_img,
            log_date,
            tipo_gasto_manual,
            coordenadas
        )VALUES(
            NULL,
            1,
            '$id_asignacion',
            '$id_proyecto',
            6,
            $tipos_gasto,
            $id_author,
            $importe_gasto,
            '$fecha_compra',
            '$sitio_gasto',
            '2',
            NULL,
            NOW(),
            '$comentario_gasto',
            '$coordenadas_gasto'
        )";
        $insertSpent = $queries->insertData($sql_insertar_gasto);



        //$last_id = $getInfoRequest['last_id'];
        if (!empty($insertSpent)) {
            $last_id = $insertSpent['last_id'];

            $returnBalance = "UPDATE asteleco_viaticos_erp.saldos SET saldo = saldo - $importe_gasto WHERE id_personal = $id_author";
            $updateBalance = $queries->insertData($returnBalance);

            if (!empty($updateBalance)) {
                $data = array(
                    'response' => true,
                    'message'                => 'Se registró el gasto!!',
                    'id_gasto' => $last_id
                );
                //--- --- ---//

            } else {
                //--- --- ---//
                $data = array(
                    'response' => false,
                    'message'                => 'Error al registrar el gasto :('
                );
                //--- --- ---//
            }
        } else {
            //--- --- ---//
            $data = array(
                'response' => false,
                'message'                => 'Error al actualizar el saldo del destinatario :('
            );
            //--- --- ---//
        }
    } else {
        $data = array(
            'response' => false,
            'message'                => 'No tiene saldo suficiente para realizar el gasto :('
        );
    }


    echo json_encode($data);
}
function saveSpentDeducible()
{
    $arr_fecha_compra = explode("/", $_POST['fecha_compra']);
    $fecha_compra = $arr_fecha_compra[2] . "-" . $arr_fecha_compra[0] . "-" . $arr_fecha_compra[1];
    $id_asignacion = $_POST['id_asignacion'];
    $id_proyecto = $_POST['id_proyecto'];
    $id_author = $_POST['id_author'];
    $sitio_gasto = $_POST['sitio_gasto'];
    $tipos_gasto = $_POST['tipos_gasto'];
    $importe_gasto = $_POST['importe_gasto'];
    $folio_fiscal = $_POST['folio_fiscal'];
    $comentario_gasto = $_POST['comentario_gasto'];
    $coordenadas_gasto = $_POST['coordenadas_gasto'];

    $queries = new Queries;

    $sql_get_saldo = "SELECT saldo FROM asteleco_viaticos_erp.saldos WHERE id_personal = $id_author";
    $get_saldo = $queries->getData($sql_get_saldo);
    $saldo = $get_saldo[0]->saldo;
    if ($saldo >= $importe_gasto) {
        $sql_insertar_gasto = "INSERT INTO asteleco_viaticos_erp.gastos(
            id_gastos,
            id_formas_pago,
            id_asignaciones_proyectos,
            id_proyectos,
            id_status_type,
            id_tipos_gasto,
            id_personal,
            importe,
            fecha_registro,
            localidad,
            clasificacion,
            id_ruta_img,
            folio_fiscal,
            log_date,
            tipo_gasto_manual,
            coordenadas
        )VALUES(
            NULL,
            1,
            '$id_asignacion',
            '$id_proyecto',
            1,
            $tipos_gasto,
            $id_author,
            $importe_gasto,
            '$fecha_compra',
            '$sitio_gasto',
            '2',
            NULL,
            '$folio_fiscal',
            NOW(),
            '$comentario_gasto',
            '$coordenadas_gasto'
        )";
        $insertSpent = $queries->insertData($sql_insertar_gasto);



        //$last_id = $getInfoRequest['last_id'];
        if (!empty($insertSpent)) {
            $last_id = $insertSpent['last_id'];

            $returnBalance = "UPDATE asteleco_viaticos_erp.saldos SET saldo = saldo - $importe_gasto WHERE id_personal = $id_author";
            $updateBalance = $queries->insertData($returnBalance);

            if (!empty($updateBalance)) {
                $data = array(
                    'response' => true,
                    'message'                => 'Se registró el gasto!!',
                    'id_gasto' => $last_id
                );
                //--- --- ---//

            } else {
                //--- --- ---//
                $data = array(
                    'response' => false,
                    'message'                => 'Error al registrar el gasto :('
                );
                //--- --- ---//
            }
        } else {
            //--- --- ---//
            $data = array(
                'response' => false,
                'message'                => 'Error al actualizar el saldo del destinatario :('
            );
            //--- --- ---//
        }
    } else {
        $data = array(
            'response' => false,
            'message'                => 'No tiene saldo suficiente para realizar el gasto :('
        );
    }


    echo json_encode($data);
}
function updateSpent()
{
    $arr_fecha_compra = explode("/", $_POST['fecha_compra']);
    $fecha_compra = $arr_fecha_compra[2] . "-" . $arr_fecha_compra[0] . "-" . $arr_fecha_compra[1];
    $id_asignacion = $_POST['id_asignacion'];

    $id_gasto = $_POST['id_gasto'];

    $id_author = $_POST['id_author'];
    $sitio_gasto = $_POST['sitio_gasto'];
    $tipos_gasto = $_POST['tipos_gasto'];
    $importe_gasto = $_POST['importe_gasto'];

    $queries = new Queries;

    $sql_get_importe_og = "SELECT importe, id_personal FROM asteleco_viaticos_erp.gastos WHERE id_gastos = $id_gasto";
    $get_importe_og = $queries->getData($sql_get_importe_og);
    $importe_og = $get_importe_og[0]->importe;
    $id_personal_og = $get_importe_og[0]->id_personal;


    if (!empty($update_saldo)) {
        $sql_update_gasto = "UPDATE asteleco_viaticos_erp.gastos
            SET 
            id_asignaciones_proyectos = '$id_asignacion',
            id_tipos_gasto = '$tipos_gasto',
            id_personal = '$id_personal_og',
            importe = '$importe_gasto',
            fecha_registro = '$fecha_compra',
            localidad = '$sitio_gasto',
            log_date = NOW()
            WHERE id_gastos = $id_gasto";
        $insertSpent = $queries->insertData($sql_update_gasto);



        //$last_id = $getInfoRequest['last_id'];
        if (!empty($insertSpent)) {

            $sql_update_saldo = "UPDATE asteleco_viaticos_erp.saldos SET saldo = saldo + '$importe_og' WHERE id_personal = $id_personal_og";
            $update_saldo = $queries->insertData($sql_update_saldo);


            $returnBalance = "UPDATE asteleco_viaticos_erp.saldos SET saldo = saldo - $importe_gasto WHERE id_personal = $id_personal_og";
            $updateBalance = $queries->insertData($returnBalance);

            if (!empty($updateBalance)) {
                $data = array(
                    'response' => true,
                    'message'                => 'Se actualizó el gasto!!'
                );
                //--- --- ---//

            } else {
                //--- --- ---//
                $data = array(
                    'response' => false,
                    'message'                => 'Error al registrar el gasto :('
                );
                //--- --- ---//
            }
        } else {
            //--- --- ---//
            $data = array(
                'response' => false,
                'message'                => 'Error al actualizar el saldo del destinatario :('
            );
            //--- --- ---//
        }
    } else {
        $data = array(
            'response' => false,
            'message'                => 'Ocurrió un error al actualizar el gasto, por favor verifique que todos los campos estén llenos!!!'
        );
    }


    echo json_encode($data);
}

function approveSpent()
{


    $id_gasto = $_POST['id_gasto'];
    $status = $_POST['status'];
    $column_name = $_POST['column_name'];

    $queries = new Queries;


    $sql_update_gasto = "UPDATE asteleco_viaticos_erp.gastos SET $column_name =  '$status' WHERE id_gastos = $id_gasto";
    $update_saldo = $queries->insertData($sql_update_gasto);

    $sql_get_spent_info = "SELECT * FROM asteleco_viaticos_erp.gastos WHERE id_gastos = $id_gasto";
    $get_spent_info = $queries->getData($sql_get_spent_info);
    if (!empty($get_spent_info)) {
        $ap_coordinacion = $get_spent_info[0]->ap_coordinacion;
        $ap_contabilidad = $get_spent_info[0]->ap_contabilidad;

        if ($ap_coordinacion == 1 && $ap_contabilidad == 1) {
            $status_gral = 4;
        } else if ($ap_coordinacion == 1 && $ap_contabilidad == 0) {
            $status_gral = 2;
        } else if ($ap_coordinacion == 0 && $ap_contabilidad == 1) {
            $status_gral = 3;
        } else if ($ap_coordinacion == 0 && $ap_contabilidad == 0) {
            $status_gral = 1;
        }
    }

    $sql_update_gasto_gral = "UPDATE asteleco_viaticos_erp.gastos SET id_status_type =  '$status_gral' WHERE id_gastos = $id_gasto";
    $update_saldo_gral = $queries->insertData($sql_update_gasto_gral);
    if (!empty($update_saldo_gral)) {
        $sql_get_spent_info = "SELECT gas.id_status_type, stt.descripcion AS txt_status, stt.clase_css
        FROM asteleco_viaticos_erp.gastos AS gas
        INNER JOIN asteleco_viaticos_erp.status_type stt ON stt.id_status_type = gas.id_status_type
        WHERE id_gastos = $id_gasto";
        $get_spent_info = $queries->getData($sql_get_spent_info);
        if (!empty($get_spent_info)) {
            $id_status_type = $get_spent_info[0]->id_status_type;
            $txt_status = $get_spent_info[0]->txt_status;
            $clase_css = $get_spent_info[0]->clase_css;
        } else {
            $id_status_type = 0;
        }
    }

    if (!empty($update_saldo)) {
        $data = array(
            'response' => true,
            'message'                => 'Petición realizada con éxito!!',
            'id_status_type' => $id_status_type,
            'txt_status' => $txt_status,
            'clase_css' => $clase_css
        );
    } else {
        $data = array(
            'response' => false,
            'message'                => 'Error al registrar el gasto :(',
            'id_status_type' => $id_status_type
        );
    }


    echo json_encode($data);
}
function changeSpentStatus()
{


    $id_gasto = $_POST['id_gasto'];
    $status = $_POST['status'];
    $column_name = $_POST['column_name'];

    $queries = new Queries;


    $sql_update_gasto = "UPDATE asteleco_viaticos_erp.gastos SET $column_name =  '$status' WHERE id_gastos = $id_gasto";
    $update_saldo = $queries->insertData($sql_update_gasto);

    $sql_get_spent_info = "SELECT * FROM asteleco_viaticos_erp.gastos WHERE id_gastos = $id_gasto";
    $get_spent_info = $queries->getData($sql_get_spent_info);
    if (!empty($get_spent_info)) {
        $status_gral = $get_spent_info[0]->id_status_type;
    }

    $sql_update_gasto_gral = "UPDATE asteleco_viaticos_erp.gastos SET id_status_type =  '$status_gral' WHERE id_gastos = $id_gasto";
    $update_saldo_gral = $queries->insertData($sql_update_gasto_gral);
    if (!empty($update_saldo_gral)) {
        $sql_get_spent_info = "SELECT gas.id_status_type, stt.descripcion AS txt_status, stt.clase_css
        FROM asteleco_viaticos_erp.gastos AS gas
        INNER JOIN asteleco_viaticos_erp.status_type stt ON stt.id_status_type = gas.id_status_type
        WHERE id_gastos = $id_gasto";
        $get_spent_info = $queries->getData($sql_get_spent_info);
        if (!empty($get_spent_info)) {
            $id_status_type = $get_spent_info[0]->id_status_type;
            $txt_status = $get_spent_info[0]->txt_status;
            $clase_css = $get_spent_info[0]->clase_css;
        } else {
            $id_status_type = 0;
        }
    }

    if (!empty($update_saldo)) {
        $data = array(
            'response' => true,
            'message'                => 'Petición realizada con éxito!!',
            'id_status_type' => $id_status_type,
            'txt_status' => $txt_status,
            'clase_css' => $clase_css
        );
    } else {
        $data = array(
            'response' => false,
            'message'                => 'Error al registrar el gasto :(',
            'id_status_type' => $id_status_type
        );
    }


    echo json_encode($data);
}

function getSeguimientoGasto()
{


    $id_gasto = $_POST['id_gasto'];

    $queries = new Queries;


    $sqlGetSeguimientos = "SELECT sgl.*, CONCAT(pers.nombres, ' ', pers.apellido_paterno, ' ', pers.apellido_materno) AS nombre
    FROM  asteleco_viaticos_erp.seguimiento_gastos AS sg
    INNER JOIN asteleco_viaticos_erp.seguimiento_gastos_log AS sgl ON sg.id_seguimiento_gastos = sgl.id_seguimiento_gastos
    INNER JOIN asteleco_personal.lista_personal AS pers ON pers.id_lista_personal = sgl.id_personal
     WHERE sg.id_gastos = $id_gasto ORDER BY sgl.date_log ASC";
    $getSeguimientos = $queries->getData($sqlGetSeguimientos);
    $html_chat = "";

    if (!empty($getSeguimientos)) {

        foreach ($getSeguimientos as $seguimientos) {

            $mensaje = $seguimientos->mensaje;
            $id_personal = $seguimientos->id_personal;
            $nombre = $seguimientos->nombre;
            $date_log = $seguimientos->date_log;
            $id_seguimiento_gastos_log = $seguimientos->id_seguimiento_gastos_log;
            $arr_date_log = explode(" ", $date_log);
            $arr_date_only = explode("-", $arr_date_log[0]);

            $date = $arr_date_only[2] . " / " . $arr_date_only[1] . " / " . $arr_date_only[0];
            $time = $arr_date_log[1];

            if ($seguimientos->id_personal == $_SESSION['id_user']) {

                $html_chat .= '<li class="clearfix odd" id="divComentario' . $id_seguimiento_gastos_log . '">';
                $html_chat .= '<div class="chat-avatar">';
                $html_chat .= '<img src="images/user_default_chat.png" class="rounded" alt="dominic">';
                $html_chat .= '<i></i>';
                $html_chat .= '</div>';
                $html_chat .= '<div class="conversation-text">';
                $html_chat .= '<div class="ctext-wrap">';
                $html_chat .= '<i>' . $nombre . '</i>';
                $html_chat .= '<p>';
                $html_chat .= '' . $mensaje . '';
                $html_chat .= '</p><br>';
                $html_chat .= '<figcaption class="blockquote-footer">' . $date . '  ' . $time . '</figcaption>';
                $html_chat .= '</p>';
                $html_chat .= '</div>';
                $html_chat .= '</div>';
                $html_chat .= '<div class="conversation-actions dropdown">';
                $html_chat .= '<button class="btn btn-sm btn-link" data-bs-toggle="dropdown" aria-expanded="false"><i class="uil uil-ellipsis-v"></i></button>';
                $html_chat .= '';
                $html_chat .= '<div class="dropdown-menu">';
                /* $html_chat .= '<a data-id-comentario="' . $id_seguimiento_gastos_log . '" class="dropdown-item editarCommentarioGasto" href="#">Editar</a>'; */
                $html_chat .= '<a data-id-comentario="' . $id_seguimiento_gastos_log . '" class="dropdown-item borrarCommentarioGasto" href="#">Borrar</a>';
                $html_chat .= '</div>';
                $html_chat .= '</div>';
                $html_chat .= '</li>';
            } else {
                $html_chat .= '<li class="clearfix">';
                $html_chat .= '<div class="chat-avatar">';
                $html_chat .= '<img src="images/user_chat.png" class="rounded" alt="Shreyu N">';
                $html_chat .= '<i></i>';
                $html_chat .= '</div>';
                $html_chat .= '<div class="conversation-text">';
                $html_chat .= '<div class="ctext-wrap">';
                $html_chat .= '<i>' . $nombre . '</i>';
                $html_chat .= '<p>';
                $html_chat .= '' . $mensaje . '';
                $html_chat .= '</p><br>';
                $html_chat .= '<figcaption class="blockquote-footer">' . $date . '  ' . $time . '</figcaption>';
                $html_chat .= '</div>';
                $html_chat .= '</div>';
                $html_chat .= '</li>';
            }
        }
    }
    if (!empty($getSeguimientos)) {
        $data = array(
            'response' => true,
            'message'                => 'Petición realizada con éxito!!',
            'html' => $html_chat
        );
    } else {
        $data = array(
            'response' => false,
            'message'                => 'Error al obtener la información',
        );
    }


    echo json_encode($data);
}

function saveSeguimientoGasto()
{
    $id_gasto = $_POST['id_gasto'];
    $comentario_gasto = $_POST['comentario_gasto'];

    $queries = new Queries;

    $sql_get_index = "SELECT * FROM asteleco_viaticos_erp.seguimiento_gastos WHERE id_gastos = $id_gasto";
    $get_index = $queries->getData($sql_get_index);
    if (!empty($get_index)) {
        $id_seguimiento_gastos = $get_index[0]->id_seguimiento_gastos;

        $sql_insertar_comentario = "INSERT INTO asteleco_viaticos_erp.seguimiento_gastos_log(
            id_seguimiento_gastos,
            mensaje,
            id_personal,
            date_log
            )VALUES(
            '$id_seguimiento_gastos',
            '$comentario_gasto',
            $_SESSION[id_user],
            NOW()
            )";
        $insertCommentary = $queries->insertData($sql_insertar_comentario);



        //$last_id = $getInfoRequest['last_id'];
        if (!empty($insertCommentary)) {
            $id_seguimiento_gastos_log = $insertCommentary['last_id'];

            $data = array(
                'response' => true,
                'message'                => 'Se registró el comentario!!',
                'id_seguimiento_gastos_log' => $id_seguimiento_gastos_log
            );
            //--- --- ---//

        } else {
            //--- --- ---//
            $data = array(
                'response' => false,
                'message'                => 'Error al registrar el comentario :('
            );
            //--- --- ---//
        }
    } else {

        $sql_insert_index = "INSERT INTO asteleco_viaticos_erp.seguimiento_gastos (id_gastos, date_log) VALUES(
            $id_gasto,
            NOW()
        )";
        $insert_index = $queries->insertData($sql_insert_index);
        if (!empty($insert_index)) {
            $id_seguimiento_gastos = $insert_index['last_id'];

            $sql_insertar_comentario = "INSERT INTO asteleco_viaticos_erp.seguimiento_gastos_log(
            id_seguimiento_gastos,
            mensaje,
            id_personal,
            date_log
            )VALUES(
            '$id_seguimiento_gastos',
            '$comentario_gasto',
            $_SESSION[id_user],
            NOW()
            )";
            $insertCommentary = $queries->insertData($sql_insertar_comentario);



            //$last_id = $getInfoRequest['last_id'];
            if (!empty($insertCommentary)) {
                $id_seguimiento_gastos_log = $insertCommentary['last_id'];

                $data = array(
                    'response' => true,
                    'message'                => 'Se registró el comentario!!',
                    'id_seguimiento_gastos_log' => $id_seguimiento_gastos_log
                );
                //--- --- ---//
            } else {
                //--- --- ---//
                $data = array(
                    'response' => false,
                    'message'                => 'Error al actualizar el saldo del destinatario :('
                );
                //--- --- ---//
            }
        }
    }


    echo json_encode($data);
}
function deleteSeguimientoGasto()
{
    $id_comentario = $_POST['id_comentario'];

    $queries = new Queries;

    $sql_insertar_comentario = "DELETE FROM asteleco_viaticos_erp.seguimiento_gastos_log WHERE id_seguimiento_gastos_log = $id_comentario;";
    $insertCommentary = $queries->insertData($sql_insertar_comentario);



    //$last_id = $getInfoRequest['last_id'];
    if (!empty($insertCommentary)) {

        $data = array(
            'response' => true,
            'message'                => 'Se eliminó el comentario!!',
        );
        //--- --- ---//

    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'Error al eliminar el comentario :('
        );
        //--- --- ---//
    }



    echo json_encode($data);
}

function getArchivosExtra()
{


    $id_gasto = $_POST['id_gasto'];

    $queries = new Queries;


    $sqlGetArchivosExtra = "SELECT * FROM  asteleco_viaticos_erp.archivos_adicionales WHERE id_gastos = '$id_gasto' order by id_archivos_adicionales ASC";
    $getArchivosExtra = $queries->getData($sqlGetArchivosExtra);
    $html_chat = "";

    if (!empty($getArchivosExtra)) {

        foreach ($getArchivosExtra as $archivos_extra) {

            $ruta_archivo = $archivos_extra->ruta_archivo;
            $datelog = $archivos_extra->datelog;
            $descripcion_archivo = $archivos_extra->descripcion_archivo;
            $id_archivos_adicionales = $archivos_extra->id_archivos_adicionales;

            $html_chat .= '<tr id="trArchivoExtra' . $id_archivos_adicionales . '">';
            $html_chat .= '<td>' . $descripcion_archivo . '</td>';
            $html_chat .= '<td>' . $datelog . '</td>';
            $html_chat .= '<td><a class="btn btn-secondary" href="' . $ruta_archivo . '" target="_blank"><i class="fa-solid fa-file"></i></a></td>';
            $html_chat .= '</tr>';
        }
    }
    if (!empty($getArchivosExtra)) {
        $data = array(
            'response' => true,
            'message'                => 'Petición realizada con éxito!!',
            'html' => $html_chat
        );
    } else {
        $data = array(
            'response' => false,
            'message'                => 'Error al obtener la información',
        );
    }


    echo json_encode($data);
}