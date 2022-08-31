<?php
set_time_limit(0);
include_once "petitions.php";

date_default_timezone_set('America/Mexico_City');

/* if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
} */
getGastos();

/* 


    $id_estado = $_POST['id_estado'];
 */

function getProyectosTipos()
{
    $queries = new Queries;

    $stmt = "SELECT distinct tipo_proyecto
        FROM asteleco_viaticos.proyectos WHERE tipo_proyecto != ''";

    $getProyectos = $queries->getData($stmt);

    if (!empty($getProyectos)) {
        foreach ($getProyectos as $proyectos) {
            $tipo_proyecto = $proyectos->tipo_proyecto;


            echo "Tipo de Proyecto: <strong>" . $tipo_proyecto . "</strong><br>";

            $stmt = "INSERT INTO asteleco_proyectos.tipos_proyecto (descripcion_tipo) VALUES ('$tipo_proyecto')";

            if ($queries->InsertData($stmt)) {
                echo "Tipo de Proyecto: <strong>" . $tipo_proyecto . "</strong> agregado<br>";
            } else {
                echo "Tipo de Proyecto: <strong>" . $tipo_proyecto . "</strong> no agregado<br>";
            }
        }
    }
}
function getProyectos()
{
    $queries = new Queries;

    $stmt = "SELECT proy_orig.*, t_proy.id_tipos_proyecto, t_proy.descripcion_tipo
        FROM asteleco_viaticos.proyectos AS proy_orig
        INNER JOIN asteleco_proyectos.tipos_proyecto AS t_proy ON proy_orig.tipo_proyecto = t_proy.descripcion_tipo";

    $getProyectos = $queries->getData($stmt);

    if (!empty($getProyectos)) {
        foreach ($getProyectos as $proyectos) {
            $consecutivo_proyecto = $proyectos->consecutivo_proyecto;
            $id_tipos_proyecto = $proyectos->id_tipos_proyecto;
            $descripcion_tipo = $proyectos->descripcion_tipo;
            $nombre_proyecto = $proyectos->nombre;
            $region = $proyectos->region;
            $ciudades = $proyectos->ciudades;
            $coordinador = $proyectos->coordinador;
            $fecha_inicio = $proyectos->fecha_inicio;
            $fecha_final_proyectada = $proyectos->fecha_final_proyectada;
            $fecha_cierre = $proyectos->fecha_cierre;
            $comentario = "PROYECTO MIGRADO DEL SISTEMA OBSOLETO AL ERP";
            $id_estado = 1;
            if ($fecha_cierre == "") {
                $id_estado = 0;
            }
            $id_colab_creador = 1;
            switch ($coordinador) {
                case 'Nancy A. Ferreira Mendoza':
                    $id_colab_creador = 16;
                    break;
                case 'Karina Valdez':
                    $id_colab_creador = 17;
                    break;
                case 'Tania López Solorzano':
                    $id_colab_creador = 18;
                    break;
                case 'Tania López Sanchez':
                    $id_colab_creador = 18;
                    break;
                case 'Tatiana Sanchez':
                    $id_colab_creador = 19;
                    break;
                default:
                    $id_colab_creador = 1;
                    break;
            }

            echo "<h1>Código de Proyecto: <strong>" . $consecutivo_proyecto . "</strong></h1>";
            echo "<h2>Tipo de Proyecto: <strong>" . $id_tipos_proyecto . " | " . $descripcion_tipo . "</strong></h2>";
            echo "<h3>Nombre del Proyecto: <strong>" . $nombre_proyecto . "</strong></h3>";
            echo "<h4>Región: <strong>" . $region . "</strong></h4>";
            echo "<h4>Ciudades: <strong>" . $ciudades . "</strong></h4>";
            echo "<h4>Coordinador: <strong>" . $id_colab_creador . " | " . $coordinador . "</strong></h4>";
            echo "<h4>Fecha de Inicio: <strong>" . $fecha_inicio . "</strong></h4>";
            echo "<h4>Fecha de Cierre: <strong>" . $fecha_cierre . "</strong></h4>";
            echo "<h4>Fecha de Cierre Proyectada: <strong>" . $fecha_final_proyectada . "</strong></h4>";
            echo "<h4>Comentario: <strong>" . $comentario . "</strong></h4>";


            $stmt_insert_address = "INSERT INTO asteleco_proyectos.direcciones_proyecto (direccion_estado) VALUES ('$ciudades')";
            $insert_address = $queries->InsertData($stmt_insert_address);
            $id_direccion = $queries->getLastId();

            $stmt_insert_proyecto = "INSERT INTO asteleco_proyectos.proyectos
            (id_tipos_proyecto,
            id_direcciones_proyecto,
            id_regiones,
            codigo_proyecto,
            nombre_proyecto,
            id_personal_creador,
            status,
            fecha_inicio,
            fecha_proyectada_cierre,
            fecha_cierre_real,
            descripcion,
            log_creacion,
            show_proyect)
                VALUES (
                '$id_tipos_proyecto',
                '$id_direccion',
                '$region',
                '$consecutivo_proyecto',
                '$nombre_proyecto',
                '$id_colab_creador',
                '$id_estado',
                '$fecha_inicio',
                '$fecha_final_proyectada',
                '$fecha_cierre',
                '$comentario',
                NOW(),
                1)";
            $insert_proyecto = $queries->InsertData($stmt_insert_proyecto);
            echo "<hr>";
            if ($insert_proyecto) {
                echo "<h1>Proyecto Insertado</h1>";
            } else {
                echo "<h1>Error al Insertar Proyecto</h1>";
            }
            echo "<hr>";
            echo "<hr>";
        }
    }
}

function getSaldos()
{
    $queries = new Queries;

    $stmt = "SELECT * FROM asteleco_personal.lista_personal";

    $getUsers = $queries->getData($stmt);

    if (!empty($getUsers)) {
        foreach ($getUsers as $Users) {
            $nombres = $Users->nombres;
            $apellido_paterno = $Users->apellido_paterno;
            $apellido_materno = $Users->apellido_materno;
            $nombre_completo = $nombres . " " . $apellido_paterno . " " . $apellido_materno;
            $id_lista_personal = $Users->id_lista_personal;
            echo "<h2>Nombre de Usuario: <strong>" . $nombre_completo . "</strong></h2>";
            //echo "<hr>";
            $stmt_saldo = "SELECT * FROM asteleco_viaticos.saldos WHERE nombre = '$nombre_completo'";

            $getUsers = $queries->getData($stmt_saldo);

            if (!empty($getUsers)) {
                foreach ($getUsers as $Users) {
                    $saldo = $Users->saldo;
                    $saldo = number_format($saldo, 2, '.');
                    $saldo = str_replace(",", "", $saldo);
                    echo "<h3>Saldo: <strong>" . $saldo . "</strong></h3>";
                    $stmt_update_saldo_erp = "SELECT * FROM asteleco_viaticos_erp.saldos 
                     WHERE id_personal = '$id_lista_personal'";
                    $getSaldo = $queries->getData($stmt_update_saldo_erp);
                    if (!empty($getSaldo)) {
                        $stmt_update_saldo_erp = "UPDATE asteleco_viaticos_erp.saldos 
                        SET saldo = '$saldo' WHERE id_personal = '$id_lista_personal'";
                        if ($queries->insertData($stmt_update_saldo_erp)) {
                            echo "Saldo actualizado<br>";
                        } else {
                            echo "Saldo no actualizado<br>";
                        }
                    } else {
                        $stmt_update_saldo_erp = "INSERT INTO asteleco_viaticos_erp.saldos 
                        (saldo, id_personal) VALUES('$saldo','$id_lista_personal')";
                        if ($queries->insertData($stmt_update_saldo_erp)) {
                            echo "Saldo INSERTADO<br>";
                        } else {
                            echo "Saldo no INSERTADO<br>";
                        }
                    }
                }
            } else {
                echo "No hay saldo<br>";
            }
            echo "<hr>";
            echo "<hr>";
            /* $stmt = "INSERT INTO asteleco_proyectos.tipos_proyecto (descripcion_tipo) VALUES ('$destinatario')";

            if ($queries->InsertData($stmt)) {
                echo "Tipo de Proyecto: <strong>" . $tipo_proyecto . "</strong> agregado<br>";
            } else {
                echo "Tipo de Proyecto: <strong>" . $tipo_proyecto . "</strong> no agregado<br>";
            } */
        }
    }
}
function getDepositos()
{
    $queries = new Queries;

    $stmt = "SELECT * FROM asteleco_personal.lista_personal";

    $getUsers = $queries->getData($stmt);

    if (!empty($getUsers)) {
        foreach ($getUsers as $Users) {
            $nombres = $Users->nombres;
            $apellido_paterno = $Users->apellido_paterno;
            $apellido_materno = $Users->apellido_materno;
            $nombre_completo = $nombres . " " . $apellido_paterno . " " . $apellido_materno;
            $id_lista_personal = $Users->id_lista_personal;
            echo "<h2>Nombre de Usuario: <strong>" . $nombre_completo . "</strong></h2>";
            echo "<hr>";
            //echo "<hr>";
            $stmt_saldo = "SELECT * FROM asteleco_viaticos.depositos WHERE destinatario LIKE '$nombre_completo'";

            $getUsers = $queries->getData($stmt_saldo);

            if (!empty($getUsers)) {
                foreach ($getUsers as $Users) {
                    $importe = $Users->importe;
                    $importe = number_format($importe, 2, '.');
                    $codigo_proyecto = $Users->proyecto;
                    $sitio = $Users->sitio;
                    $tipo_gasto = $Users->tgasto;
                    $fecha = $Users->fecha;
                    $proyecto = $Users->proyecto;
                    $stmt_get_proyecto = "SELECT * from asteleco_proyectos.proyectos WHERE codigo_proyecto = '$proyecto'";
                    $get_proyecto = $queries->getData($stmt_get_proyecto);
                    if (!empty($get_proyecto)) {
                        foreach ($get_proyecto as $proyecto) {
                            $id_proyecto = $proyecto->id_proyectos;
                        }
                    } else {
                        $id_proyecto = "";
                        $proyecto = "";
                    }
                    $stmt_get_tipo_gasto = "SELECT * FROM asteleco_viaticos_erp.tipos_gasto WHERE descripcion LIKE '$tipo_gasto'";
                    $get_tipo_gasto = $queries->getData($stmt_get_tipo_gasto);
                    if (!empty($get_tipo_gasto)) {
                        $id_tipo_gasto = $get_tipo_gasto[0]->id_tipos_gasto;
                    }
                    echo "<h4>Importe: <strong>" . $importe . "</strong></h4>";
                    echo "<h4>Codigo Proyecto: <strong>" . $codigo_proyecto . "</strong></h4>";
                    echo "<h4>Sitio: <strong>" . $sitio . "</strong></h4>";
                    echo "<h4>Tipo Gasto: <strong>" . $id_tipo_gasto . " | " . $tipo_gasto . "</strong></h4>";
                    echo "<h4>Fecha: <strong>" . $fecha . "</strong></h4><br>";

                    $stmt_insert_deposito = "INSERT INTO asteleco_viaticos_erp.depositos(
                        id_personal,
                        id_tipos_gasto,
                        id_personal_registro,
                        sitio,
                        cantidad,
                        fecha,
                        log_date,
                        id_proyectos
                    )
                    VALUES(
                        '$id_lista_personal',
                        '$id_tipo_gasto',
                        '1',
                        '$sitio',
                        '$importe',
                        '$fecha',
                        NOW(),
                        '$id_proyecto'
                    )";
                    if ($queries->insertData($stmt_insert_deposito)) {
                        echo "Deposito agregado<br>";
                    } else {
                        echo "Deposito no agregado<br>";
                    }

                    /* 
                    if ($queries->insertData($stmt_update_saldo_erp)) {
                        echo "Saldo actualizado<br>";
                    } else {
                        echo "Saldo no actualizado<br>";
                    } */
                }
            } else {
                echo "No hay saldo<br>";
            }
            echo "<hr>";
            echo "<hr>";
            /* $stmt = "INSERT INTO asteleco_proyectos.tipos_proyecto (descripcion_tipo) VALUES ('$destinatario')";

            if ($queries->InsertData($stmt)) {
                echo "Tipo de Proyecto: <strong>" . $tipo_proyecto . "</strong> agregado<br>";
            } else {
                echo "Tipo de Proyecto: <strong>" . $tipo_proyecto . "</strong> no agregado<br>";
            } */
        }
    }
}
function getGastos()
{
    $queries = new Queries;

    $stmt = "SELECT * FROM asteleco_personal.lista_personal";

    $getUsers = $queries->getData($stmt);

    if (!empty($getUsers)) {
        foreach ($getUsers as $Users) {
            $nombres = $Users->nombres;
            $apellido_paterno = $Users->apellido_paterno;
            $apellido_materno = $Users->apellido_materno;
            $nombre_completo = $nombres . " " . $apellido_paterno . " " . $apellido_materno;

            $id_lista_personal = $Users->id_lista_personal;
            echo "<h2>Nombre de Usuario: <strong>" . $nombre_completo . "</strong></h2>";
            echo "<hr>";
            //echo "<hr>";
            $stmt_saldo = "SELECT * FROM asteleco_viaticos.registros_principal WHERE nombre LIKE '$nombre_completo'";

            $getUsers = $queries->getData($stmt_saldo);

            if (!empty($getUsers)) {
                foreach ($getUsers as $Users) {

                    $proyecto = $Users->proyecto;

                    $stmt_get_proyecto = "SELECT * from asteleco_proyectos.proyectos WHERE codigo_proyecto = '$proyecto'";
                    $get_proyecto = $queries->getData($stmt_get_proyecto);
                    if (!empty($get_proyecto)) {
                        foreach ($get_proyecto as $proy) {
                            $id_proyectos = $proy->id_proyectos;
                        }
                    } else {
                        $id_proyectos = "";
                        $proyecto = "";
                    }

                    $id_formas_pago = 4;
                    $id_asignaciones_proyectos = 'NULL';
                    $id_status_type = 4;

                    $importe = $Users->importe;
                    $importe = number_format($importe, 2, '.');
                    $fecha = $Users->fecha;
                    $str_clasificacion = $Users->clasificacion;
                    switch ($str_clasificacion) {
                        case 'Deducible':
                            $clasificacion = 2;
                            break;
                        case 'No deducible':
                            $clasificacion = 1;
                            break;

                        default:
                            $clasificacion = 0;
                            break;
                    }
                    $localidad = $Users->lugar;
                    $coordenadas = $Users->coordenadas;
                    $status = $Users->aprobado;

                    switch ($status) {
                        case '1':
                            $ap_coordinacion = 1;
                            $ap_contabilidad = 1;
                            break;
                        case '0':
                            $ap_coordinacion = 0;
                            $ap_contabilidad = 0;
                            break;
                        default:
                            $ap_coordinacion = 0;
                            $ap_contabilidad = 0;
                            break;
                    }
                    $folio_fiscal = $Users->ffiscal;
                    $comentarios_administrador = $Users->admin_commit;
                    $comentarios_usuario = $Users->user_commit;

                    $ruta_img = $Users->ruta_img;
                    if ($ruta_img == "Pendiente") {
                        $ruta_img = "null";
                        $id_ruta_img = "1";
                    } else {
                        $nombre_archivo = "ast_arch_migr" . date("YmdHis");
                        $tipo_archivo = "jpg";
                        $fecha_subido = $fecha;
                        $stmt_insert_ruta_archivo = "INSERT INTO asteleco_viaticos_erp.rutas_archivos(
                            ruta_archivo,
                            nombre_archivo,
                            tipo_archivo,
                            activo,
                            fecha_subido,
                            log_date
                        ) VALUES(
                            '$ruta_img',
                            '$nombre_archivo',
                            '$tipo_archivo',
                            '1',
                            '$fecha_subido',
                            NOW()
                        )";
                        if ($queries->insertData($stmt_insert_ruta_archivo)) {
                            echo "Ruta IMG de archivo agregada<br>";
                            $id_ruta_img = $queries->getLastId();
                        } else {
                            echo "Ruta IMG de archivo no agregada<br>";
                            $id_ruta_img = "1";
                        }
                    }

                    $ruta_pdf = $Users->ruta_pdf;

                    if ($ruta_pdf == "Pendiente") {
                        $ruta_pdf = "null";
                        $id_ruta_pdf = "null";
                    } else {
                        $nombre_archivo = "ast_arch_migr" . date("YmdHis");
                        $tipo_archivo = "pdf";
                        $fecha_subido = $fecha;
                        $stmt_insert_ruta_archivo = "INSERT INTO asteleco_viaticos_erp.rutas_archivos(
                            ruta_archivo,
                            nombre_archivo,
                            tipo_archivo,
                            activo,
                            fecha_subido,
                            log_date
                        ) VALUES(
                            '$ruta_pdf',
                            '$nombre_archivo',
                            '$tipo_archivo',
                            '1',
                            '$fecha_subido',
                            NOW()
                        )";
                        if ($queries->insertData($stmt_insert_ruta_archivo)) {
                            echo "Ruta PDF de archivo agregada<br>";
                            $id_ruta_pdf = $queries->getLastId();
                        } else {
                            echo "Ruta PDF de archivo no agregada<br>";
                            $id_ruta_pdf = "null";
                        }
                    }

                    $tipo_gasto = $Users->tgasto;


                    $stmt_get_tipo_gasto = "SELECT * FROM asteleco_viaticos_erp.tipos_gasto WHERE descripcion LIKE '$tipo_gasto'";
                    $get_tipo_gasto = $queries->getData($stmt_get_tipo_gasto);
                    if (!empty($get_tipo_gasto)) {
                        $id_tipo_gasto = $get_tipo_gasto[0]->id_tipos_gasto;
                    }
                    echo "<h4>Importe: <strong>" . $importe . "</strong></h4>";
                    echo "<h4>Tipo Gasto: <strong>" . $id_tipo_gasto . " | " . $tipo_gasto . "</strong></h4>";
                    echo "<h4>Fecha: <strong>" . $fecha . "</strong></h4><br>";
                    echo "<h4>Status: <strong>" . $status . "</strong></h4>";


                    $stmt_insert_gasto = "INSERT INTO asteleco_viaticos_erp.gastos(
                        id_formas_pago,
                        id_asignaciones_proyectos,
                        id_proyectos,
                        id_status_type,
                        id_tipos_gasto,
                        id_personal,
                        importe,
                        fecha_registro,
                        clasificacion,
                        localidad,
                        coordenadas,
                        status,
                        ap_coordinacion,
                        ap_contabilidad,
                        folio_fiscal,
                        comentarios_usuario,
                        comentarios_administrador,
                        id_ruta_img,
                        id_ruta_pdf,
                        string_proyecto,
                        log_date) VALUES(
                            '$id_formas_pago',
                            null,
                            '$id_proyectos',
                            '$id_status_type',
                            '$id_tipo_gasto',
                            '$id_lista_personal',
                            '$importe',
                            '$fecha',
                            '$clasificacion',
                            '$localidad',
                            '$coordenadas',
                            '$status',
                            '$ap_coordinacion',
                            '$ap_contabilidad',
                            '$folio_fiscal',
                            '$comentarios_usuario',
                            '$comentarios_administrador',
                            '$id_ruta_img',
                            '$id_ruta_pdf',
                            '$proyecto',
                            NOW())";
                    if ($queries->insertData($stmt_insert_gasto)) {
                        echo "Gasto agregado<br>";
                    } else {
                        echo "Gasto no agregado<br>";
                    }

                    /* 
                    if ($queries->insertData($stmt_update_saldo_erp)) {
                        echo "Saldo actualizado<br>";
                    } else {
                        echo "Saldo no actualizado<br>";
                    } */
                }
            } else {
                echo "No hay saldo<br>";
            }
            echo "<hr>";
            echo "<hr>";
            /* $stmt = "INSERT INTO asteleco_proyectos.tipos_proyecto (descripcion_tipo) VALUES ('$destinatario')";

            if ($queries->InsertData($stmt)) {
                echo "Tipo de Proyecto: <strong>" . $tipo_proyecto . "</strong> agregado<br>";
            } else {
                echo "Tipo de Proyecto: <strong>" . $tipo_proyecto . "</strong> no agregado<br>";
            } */
        }
    }
}
function getTiposGasto()
{
    $queries = new Queries;

    $stmt = "SELECT * FROM asteleco_viaticos.tipos_gasto";

    $getUsers = $queries->getData($stmt);

    if (!empty($getUsers)) {
        foreach ($getUsers as $Users) {
            $tipo = $Users->tipo;
            echo "<h2>Tipo de Gasto: <strong>" . $tipo . "</strong></h2>";
            //echo "<hr>";
            $stmt_saldo = "SELECT * FROM asteleco_viaticos.saldos WHERE nombre = '$tipo'";

            $getUsers = $queries->getData($stmt_saldo);
            echo "<hr>";
            echo "<hr>";
            /* $stmt = "INSERT INTO asteleco_proyectos.tipos_proyecto (descripcion_tipo) VALUES ('$destinatario')";

            if ($queries->InsertData($stmt)) {
                echo "Tipo de Proyecto: <strong>" . $tipo_proyecto . "</strong> agregado<br>";
            } else {
                echo "Tipo de Proyecto: <strong>" . $tipo_proyecto . "</strong> no agregado<br>";
            } */
        }
    }
}
function generatePassword($length)
{
    $key = "";
    $pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $max = strlen($pattern) - 1;
    for ($i = 0; $i < $length; $i++) {
        $key .= substr($pattern, mt_rand(0, $max), 1);
    }
    return $key;
}

function eliminar_acentos($cadena)
{

    //Reemplazamos la A y a
    $cadena = str_replace(
        array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
        array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
        $cadena
    );

    //Reemplazamos la E y e
    $cadena = str_replace(
        array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
        array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
        $cadena
    );

    //Reemplazamos la I y i
    $cadena = str_replace(
        array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
        array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
        $cadena
    );

    //Reemplazamos la O y o
    $cadena = str_replace(
        array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
        array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
        $cadena
    );

    //Reemplazamos la U y u
    $cadena = str_replace(
        array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
        array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
        $cadena
    );

    //Reemplazamos la N, n, C y c
    $cadena = str_replace(
        array('Ñ', 'ñ', 'Ç', 'ç'),
        array('N', 'n', 'C', 'c'),
        $cadena
    );

    return $cadena;
}


function getUsers()
{
    $queries = new Queries;

    $stmt = "SELECT DISTINCT destinatario FROM asteleco_viaticos.`depositos`  WHERE destinatario != '' ORDER by destinatario asc";

    $getUsers = $queries->getData($stmt);

    if (!empty($getUsers)) {
        foreach ($getUsers as $Users) {
            $destinatario = $Users->destinatario;
            $arr_nombre = explode(' ', $destinatario);
            $count_name = count($arr_nombre);
            if ($count_name > 4) {
                $nombre = $arr_nombre[0] . " " . $arr_nombre[1];
                $apellido = $arr_nombre[2] . " " . $arr_nombre[3] . " " . $arr_nombre[4];
                $ap_paterno = $arr_nombre[2];
                $ap_materno = $arr_nombre[3] . " " . $arr_nombre[4];
            } else if ($count_name > 3) {
                $nombre = $arr_nombre[0] . " " . $arr_nombre[1];
                $apellido = $arr_nombre[2] . " " . $arr_nombre[3];
                $ap_paterno = $arr_nombre[2];
                $ap_materno = $arr_nombre[3];
            } else {
                $nombre = $arr_nombre[0];
                $apellido = $arr_nombre[1] . " " . $arr_nombre[2];
                $ap_paterno = $arr_nombre[1];
                $ap_materno = $arr_nombre[2];
            }
            $nombre_completo = $nombre . " " . $apellido;
            $str_nombre = strtoupper(substr($nombre, 0, 2));
            $str_ap_paterno = substr($ap_paterno, 0, 1);
            $str_ap_materno = substr($ap_materno, 0, 1);
            $int_user = rand(10, 99);
            $codigo_usuario = $str_nombre  . $str_ap_paterno . $str_ap_materno . "-0" . $int_user;
            $correo_login = strtolower(eliminar_acentos($nombre . "." . $ap_paterno . "@astelecom.com.mx"));
            $correo_login = str_replace(" ", "", $correo_login);

            $password = generatePassword(6);

            $id_niveles_area  = 15;
            $id_niveles_academicos = 2;
            $id_direcciones_personal = 1;
            $id_contacto_personal = 1;
            $fecha_nacimiento = '1999-01-01';

            echo "<h2>Nombre de Usuario: <strong>" . $nombre . "</strong></h2>";
            echo "<h2>Apellido de Usuario: <strong>" . $apellido . "</strong></h2>";
            echo "<h3>Nombre Completo de Usuario: <strong>" . $nombre_completo . "</strong></h3>";
            echo "<h3>Correo de Usuario: <strong>" . $correo_login . "</strong></h3>";
            echo "<h3>Codigo de Usuario: <strong>" . $codigo_usuario . "</strong></h3>";
            echo "<h3>Password: <strong>" . $password . "</strong></h3>";
            echo "<hr>";

            $stmt_insert_user = " INSERT INTO asteleco_personal.lista_personal 
            (
                id_niveles_areas,
                id_niveles_academicos,
                id_direcciones_personal,
                id_contacto_personal,
                nombres,
                apellido_paterno,
                apellido_materno,
                codigo_usuario,
                correo_sesion,
                password,
                fecha_nacimiento
            ) VALUES(
                '$id_niveles_area',
                '$id_niveles_academicos',
                '$id_direcciones_personal',
                '$id_contacto_personal',
                '$nombre',
                '$ap_paterno',
                '$ap_materno',
                '$codigo_usuario',
                '$correo_login',
                '$password',
                '$fecha_nacimiento'
                );
            ";
            if ($queries->InsertData($stmt_insert_user)) {
                $id_usuario = $queries->getLastId();
                $stmt_insert_saldo_usuario = "INSERT INTO asteleco_viaticos_erp.saldos (id_personal, saldo) VALUES ('$id_usuario', '0')";
                $queries->InsertData($stmt_insert_saldo_usuario);
                echo "Usuario: <strong>" . $nombre . "</strong> agregado<br>";
            } else {
                echo "Usuario: <strong>" . $nombre . "</strong> no agregado<br>";
            }

            echo "<hr>";

            echo "<hr>";
            /* $stmt = "INSERT INTO asteleco_proyectos.tipos_proyecto (descripcion_tipo) VALUES ('$destinatario')";

            if ($queries->InsertData($stmt)) {
                echo "Tipo de Proyecto: <strong>" . $tipo_proyecto . "</strong> agregado<br>";
            } else {
                echo "Tipo de Proyecto: <strong>" . $tipo_proyecto . "</strong> no agregado<br>";
            } */
        }
    }
}
