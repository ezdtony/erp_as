<?php
include_once dirname(__DIR__ . '', 1) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}




function getAreaLevelsByAreaCode()
{
    $id_area = $_POST['id_area'];

    $queries = new Queries;

    $stmt = "SELECT * 
        FROM constructora_personal.areas_level 
        WHERE id_area = $id_area";

    $getAreaLevelsByAreaCode = $queries->getData($stmt);

    if (!empty($getAreaLevelsByAreaCode)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $getAreaLevelsByAreaCode
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

function saveUser()
{
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $titulo = $_POST['titulo'];
    $area = $_POST['area'];
    $puesto = $_POST['puesto'];
    $telefono = $_POST['telefono'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $colonia = $_POST['colonia'];
    $cp = $_POST['cp'];
    $municipio = $_POST['municipio'];
    $estado = $_POST['estado'];
    $correo_electronico = $_POST['correo_electronico'];
    $password = $_POST['password'];

    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    // Output: 54esmdr0qf
    $random_str = mb_strtoupper(substr(str_shuffle($permitted_chars), 0, 3));

    $cod_nombre = substr($nombre, 0, 2);
    $cod_apellidos = substr($apellido, 0, 2);

    $cod_user = $cod_nombre . "-" . $cod_apellidos . "-" .  $random_str;


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
                '$calle',
                '$numero',
                '$colonia',
                '$municipio',
                '$estado',
                '$cp'
            )
    ";

    $insertarDireccion = $queries->InsertData($stmt_direccion);
    if (!empty($insertarDireccion)) {
        $id_direccion = $insertarDireccion['last_id'];
        $stmt = "INSERT INTO constructora_personal.lista_personal (
            id_lista_personal,
            id_areas_level,
            id_titulo,
            user_code,
            user_email,
            phone_number,
            user_name,
            user_lastname,
            user_pass,
            registered_date,
            id_direccion
        ) VALUES (
            NULL,
            '$puesto',
            '$titulo',
            '$cod_user',
            '$correo_electronico',
            '$telefono',
            '$nombre',
            '$apellido',
            '$password',
            NOW(),
            '$id_direccion'
        )";

        $insertUser = $queries->InsertData($stmt);

        if (!empty($insertUser)) {


            //--- --- ---//
            $data = array(
                'response' => true,
                'data'                => $insertUser
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
    }



    echo json_encode($data);
}
function changeStatusUser()
{
    $id_user = $_POST['id_user'];
    $active = $_POST['active'];


    $queries = new Queries;

    $stmt = "UPDATE constructora_personal.lista_personal
        SET active = '$active'
        WHERE id_lista_personal = $id_user";

    $updateUser = $queries->InsertData($stmt);

    if (!empty($updateUser)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $updateUser
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
function deleteUser()
{
    $id_user = $_POST['id_user'];


    $queries = new Queries;

    $stmt = "DELETE FROM constructora_personal.lista_personal
        WHERE id_lista_personal = $id_user";

    $deleteUser = $queries->InsertData($stmt);

    if (!empty($deleteUser)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $deleteUser
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

function changeStatusProveedor()
{
    $id_user = $_POST['id_user'];
    $active = $_POST['active'];


    $queries = new Queries;

    $stmt = "UPDATE constructora_personal.proveedores
        SET status = '$active'
        WHERE id_proveedores = $id_user";

    $updateUser = $queries->InsertData($stmt);

    if (!empty($updateUser)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $updateUser
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
function deleteProveedor()
{
    $id_user = $_POST['id_user'];


    $queries = new Queries;

    $stmt = "DELETE FROM constructora_personal.proveedores
        WHERE id_proveedores = $id_user";

    $deleteUser = $queries->InsertData($stmt);

    if (!empty($deleteUser)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $deleteUser
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
function saveProveedor()
{
    $nombre = $_POST['nombre'];
    $empresa = $_POST['empresa'];
    $telefono = $_POST['telefono'];
    $correo_electronico = $_POST['correo_electronico'];

    $queries = new Queries;
    $stmt_proveedor = "INSERT INTO constructora_personal.proveedores 
                    (id_proveedores , 
                    nombre_proveedor,
                    empresa_proveedor,
                    correo_proveedor,
                    num_telefonico)
            VALUES (
                NULL,
                '$nombre',
                '$empresa',
                '$correo_electronico',
                '$telefono'
            )
    ";

    $insertarProveedor = $queries->InsertData($stmt_proveedor);
    if (!empty($insertarProveedor)) {



        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $insertarProveedor
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
function saveUtilizacion()
{
    $nombre = $_POST['nombre'];

    $queries = new Queries;
    $stmt_proveedor = "INSERT INTO constructora_personal.utilizaciones 
                    (id_utilizacion , 
                    descripcion)
            VALUES (
                NULL,
                '$nombre'
            )
    ";

    $insertarProveedor = $queries->InsertData($stmt_proveedor);
    if (!empty($insertarProveedor)) {



        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $insertarProveedor
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
function saveMedicion()
{
    $nombre = $_POST['nombre'];

    $queries = new Queries;
    $stmt_proveedor = "INSERT INTO constructora_personal.medicion_tipo 
                    (id_medicion_tipo , 
                    descripcion)
            VALUES (
                NULL,
                '$nombre'
            )
    ";

    $insertarProveedor = $queries->InsertData($stmt_proveedor);
    if (!empty($insertarProveedor)) {



        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $insertarProveedor
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
