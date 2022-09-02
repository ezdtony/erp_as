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

    $queries = new Queries;

    $stmt = "UPDATE asteleco_viaticos_erp.saldos 
    SET 
    saldo = saldo + $importe
    WHERE id_personal = $id_user";

    $updateSaldo = $queries->insertData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($updateSaldo)) {

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
        $insertar_deposito = $queries->insertData($sql_insertar_deposito);
        if (!empty($insertar_deposito)) {
            $data = array(
                'response' => true,
                'message'                => 'El depósito se registró correctamente!!'
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

    $sql_get_importe_og = "SELECT importe FROM asteleco_viaticos_erp.gastos WHERE id_gastos = $id_gasto";
    $get_importe_og = $queries->getData($sql_get_importe_og);
    $importe_og = $get_importe_og[0]->importe;

    $sql_update_saldo = "UPDATE asteleco_viaticos_erp.saldos SET saldo = saldo + '$importe_og' WHERE id_personal = $id_author";
    $update_saldo = $queries->insertData($sql_update_saldo);

    if (!empty($update_saldo)) {
        $sql_update_gasto = "UPDATE asteleco_viaticos_erp.gastos
            SET 
            id_asignaciones_proyectos = '$id_asignacion',
            id_tipos_gasto = '$tipos_gasto',
            id_personal = '$id_author',
            importe = '$importe_gasto',
            fecha_registro = '$fecha_compra',
            localidad = '$sitio_gasto',
            log_date = NOW()
            WHERE id_gastos = $id_gasto";
        $insertSpent = $queries->insertData($sql_update_gasto);



        //$last_id = $getInfoRequest['last_id'];
        if (!empty($insertSpent)) {


            $returnBalance = "UPDATE asteleco_viaticos_erp.saldos SET saldo = saldo - $importe_gasto WHERE id_personal = $id_author";
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
            'message'                => 'No tiene saldo suficiente para realizar el gasto :('
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
