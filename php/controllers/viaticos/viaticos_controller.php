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

    $queries = new Queries;

    $stmt = "UPDATE asteleco_viaticos.saldos 
    SET 
    saldo = saldo + $importe
    WHERE id_personal = $id_user";

    $updateSaldo = $queries->insertData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($updateSaldo)) {

        $sql_insertar_deposito = "INSERT INTO asteleco_viaticos.depositos (
            id_personal,
            id_asignacion_proyecto,
            id_tipos_gasto,
            id_personal_registro,
            sitio,
            cantidad,
            fecha,
            log_date
        ) VALUES (
            '$id_user',
            '$id_asingacion',
            '$tipos_gasto',
            '$id_author',
            '$sitio',
            '$importe',
            '$fecha',
            NOW()
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

    $queries = new Queries;

    $getOgImport = "SELECT cantidad, id_personal FROM asteleco_viaticos.depositos WHERE id_depositos = $id_deposito";
    $getInfoRequest = $queries->getData($getOgImport);
    $og_import = $getInfoRequest[0]->cantidad;
    $id_user_og = $getInfoRequest[0]->id_personal;

    $returnBalance = "UPDATE  asteleco_viaticos.saldos SET saldo = saldo - $og_import WHERE id_personal = $id_user_og";
    $updateBalance = $queries->insertData($returnBalance);

    $stmt = "UPDATE asteleco_viaticos.saldos 
    SET 
    saldo = saldo + $importe
    WHERE id_personal = $id_user";

    $updateSaldo = $queries->insertData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($updateSaldo)) {

        $sql_insertar_deposito = "UPDATE asteleco_viaticos.depositos 
        SET
            id_personal = $id_user ,
            id_asignacion_proyecto = $id_asingacion ,
            id_tipos_gasto = $tipos_gasto ,
            id_personal_registro = $id_author ,
            sitio = '$sitio' ,
            cantidad = $importe ,
            fecha = '$fecha' ,
            log_date = NOW() 
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

    $getOgImport = "SELECT cantidad, id_personal FROM asteleco_viaticos.depositos WHERE id_depositos = $id_deposito";
    $getInfoRequest = $queries->getData($getOgImport);
    $og_import = $getInfoRequest[0]->cantidad;
    $id_user_og = $getInfoRequest[0]->id_personal;

    $returnBalance = "UPDATE  asteleco_viaticos.saldos SET saldo = saldo - $og_import WHERE id_personal = $id_user_og";
    $updateBalance = $queries->insertData($returnBalance);

    //$last_id = $getInfoRequest['last_id'];
    if (!empty($updateBalance)) {

        $sql_insertar_deposito = "DELETE FROM asteleco_viaticos.depositos WHERE id_depositos = $id_deposito";
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

function saveSpent()
{
    $arr_fecha_compra = explode("/",$_POST['fecha_compra']);
    $fecha_compra = $arr_fecha_compra[2] . "-" . $arr_fecha_compra[0] . "-" . $arr_fecha_compra[1];
    $id_asignacion = $_POST['id_asignacion'];
    $id_proyecto = $_POST['id_proyecto'];
    $id_author = $_POST['id_author'];
    $sitio_gasto = $_POST['sitio_gasto'];
    $tipos_gasto = $_POST['tipos_gasto'];
    $importe_gasto = $_POST['importe_gasto'];

    $queries = new Queries;

    $sql_get_saldo = "SELECT saldo FROM asteleco_viaticos.saldos WHERE id_personal = $id_author";
    $get_saldo = $queries->getData($sql_get_saldo);
    $saldo = $get_saldo[0]->saldo;
    if ($saldo >= $importe_gasto) {
        $sql_insertar_gasto = "INSERT INTO asteleco_viaticos.gastos(
            id_gastos,
            id_formas_pago,
            id_asignaciones_proyectos,
            id_status_type,
            id_tipos_gasto,
            id_personal,
            importe,
            fecha_registro,
            localidad,
            clasificacion,
            id_ruta_img,
            log_date
        )VALUES(
            NULL,
            1,
            '$id_asignacion',
            1,
            $tipos_gasto,
            $id_author,
            $importe_gasto,
            '$fecha_compra',
            '$sitio_gasto',
            '1',
            NULL,
            NOW()
        )";
        $insertSpent = $queries->insertData($sql_insertar_gasto);
    
    
    
        //$last_id = $getInfoRequest['last_id'];
        if (!empty($insertSpent)) {
            $last_id = $insertSpent['last_id'];
    
            $returnBalance = "UPDATE asteleco_viaticos.saldos SET saldo = saldo - $importe_gasto WHERE id_personal = $id_author";
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
    }else{
        $data = array(
            'response' => false,
            'message'                => 'No tiene saldo suficiente para realizar el gasto :('
        );
    }
   

    echo json_encode($data);
}
function saveSpentDeduciblePendiente()
{
    $arr_fecha_compra = explode("/",$_POST['fecha_compra']);
    $fecha_compra = $arr_fecha_compra[2] . "-" . $arr_fecha_compra[0] . "-" . $arr_fecha_compra[1];
    $id_asignacion = $_POST['id_asignacion'];
    $id_proyecto = $_POST['id_proyecto'];
    $id_author = $_POST['id_author'];
    $sitio_gasto = $_POST['sitio_gasto'];
    $tipos_gasto = $_POST['tipos_gasto'];
    $importe_gasto = $_POST['importe_gasto'];

    $queries = new Queries;

    $sql_get_saldo = "SELECT saldo FROM asteleco_viaticos.saldos WHERE id_personal = $id_author";
    $get_saldo = $queries->getData($sql_get_saldo);
    $saldo = $get_saldo[0]->saldo;
    if ($saldo >= $importe_gasto) {
        $sql_insertar_gasto = "INSERT INTO asteleco_viaticos.gastos(
            id_gastos,
            id_formas_pago,
            id_asignaciones_proyectos,
            id_status_type,
            id_tipos_gasto,
            id_personal,
            importe,
            fecha_registro,
            localidad,
            clasificacion,
            id_ruta_img,
            log_date
        )VALUES(
            NULL,
            1,
            '$id_asignacion',
            6,
            $tipos_gasto,
            $id_author,
            $importe_gasto,
            '$fecha_compra',
            '$sitio_gasto',
            '2',
            NULL,
            NOW()
        )";
        $insertSpent = $queries->insertData($sql_insertar_gasto);
    
    
    
        //$last_id = $getInfoRequest['last_id'];
        if (!empty($insertSpent)) {
            $last_id = $insertSpent['last_id'];
    
            $returnBalance = "UPDATE asteleco_viaticos.saldos SET saldo = saldo - $importe_gasto WHERE id_personal = $id_author";
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
    }else{
        $data = array(
            'response' => false,
            'message'                => 'No tiene saldo suficiente para realizar el gasto :('
        );
    }
   

    echo json_encode($data);
}
function saveSpentDeducible()
{
    $arr_fecha_compra = explode("/",$_POST['fecha_compra']);
    $fecha_compra = $arr_fecha_compra[2] . "-" . $arr_fecha_compra[0] . "-" . $arr_fecha_compra[1];
    $id_asignacion = $_POST['id_asignacion'];
    $id_proyecto = $_POST['id_proyecto'];
    $id_author = $_POST['id_author'];
    $sitio_gasto = $_POST['sitio_gasto'];
    $tipos_gasto = $_POST['tipos_gasto'];
    $importe_gasto = $_POST['importe_gasto'];
    $folio_fiscal = $_POST['folio_fiscal'];

    $queries = new Queries;

    $sql_get_saldo = "SELECT saldo FROM asteleco_viaticos.saldos WHERE id_personal = $id_author";
    $get_saldo = $queries->getData($sql_get_saldo);
    $saldo = $get_saldo[0]->saldo;
    if ($saldo >= $importe_gasto) {
        $sql_insertar_gasto = "INSERT INTO asteleco_viaticos.gastos(
            id_gastos,
            id_formas_pago,
            id_asignaciones_proyectos,
            id_status_type,
            id_tipos_gasto,
            id_personal,
            importe,
            fecha_registro,
            localidad,
            clasificacion,
            id_ruta_img,
            folio_fiscal,
            log_date
        )VALUES(
            NULL,
            1,
            '$id_asignacion',
            1,
            $tipos_gasto,
            $id_author,
            $importe_gasto,
            '$fecha_compra',
            '$sitio_gasto',
            '2',
            NULL,
            '$folio_fiscal',
            NOW()
        )";
        $insertSpent = $queries->insertData($sql_insertar_gasto);
    
    
    
        //$last_id = $getInfoRequest['last_id'];
        if (!empty($insertSpent)) {
            $last_id = $insertSpent['last_id'];
    
            $returnBalance = "UPDATE asteleco_viaticos.saldos SET saldo = saldo - $importe_gasto WHERE id_personal = $id_author";
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
    }else{
        $data = array(
            'response' => false,
            'message'                => 'No tiene saldo suficiente para realizar el gasto :('
        );
    }
   

    echo json_encode($data);
}
