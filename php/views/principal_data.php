<?php
include "php/controllers/login.php";

date_default_timezone_set('America/Mexico_City');
$user_name = "";
$id_area = "";
if (!isset($_SESSION['user'])) {
    header('Location: LogIn.php?#');
} else {
    $id_user = $_SESSION['id_user'];
    $user_name = $_SESSION['user'];
    $user_name_short = $_SESSION['user_short'];
    $id_area = $_SESSION['id_area'];
    $id_area_level = $_SESSION['id_areas_level'];
    $txt_area = $_SESSION['txt_area'];
    $txt_area_level = $_SESSION['txt_area_level'];




    $queries = new Queries;
    $estados = "SELECT * FROM uvzuyqbs_constructora.estados";

    $getStates = $queries->getData($estados);


    $sql_materiales = "SELECT * FROM uvzuyqbs_constructora.matriz_materiales";
    $getMateriales = $queries->getData($sql_materiales);

    $sql_proyect_types = "SELECT * FROM uvzuyqbs_constructora.tipos_proyecto";
    $getProyectTypes = $queries->getData($sql_proyect_types);

    $sql_personal = "SELECT 
            psn.id_lista_personal AS id_personal,
            CONCAT(
            tit.short_title, ' ', 
            psn.user_name, ' ', 
            psn.user_lastname
            ) AS nombre_completo

            FROM uvzuyqbs_constructora.lista_personal AS psn
            INNER JOIN uvzuyqbs_constructora.id_titulos AS tit ON psn.id_titulo = tit.id_titulo
            ";
    $getPersonal = $queries->getData($sql_personal);

    if ($id_area == 4) {
        $sql_proyectos = "SELECT 
        proy.id_proyectos, 
        proy.status, 
        proy.codigo_proyecto, 
        proy.nombre_largo,
        proy.comentario,
        proy.fecha_inicio,
        proy.fecha_cierre_proyectada,
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

        FROM uvzuyqbs_constructora.proyectos AS proy 
        INNER JOIN uvzuyqbs_constructora.lista_personal AS psn 
        INNER JOIN uvzuyqbs_constructora.id_titulos AS tit ON psn.id_titulo = tit.id_titulo
        INNER JOIN uvzuyqbs_constructora.direcciones AS direc ON proy.id_direccion = direc.iddirecciones
        INNER JOIN uvzuyqbs_constructora.estados AS est ON direc.direccion_estado = est.id
        INNER JOIN uvzuyqbs_constructora.municipios AS mun ON direc.direccion_municipio = mun.id
        INNER JOIN uvzuyqbs_constructora.asignaciones_proyectos AS asp ON psn.id_lista_personal = asp.id_personal AND proy.id_proyectos = asp.id_proyecto AND asp.activo = 1
        WHERE proy.`status` = '1'    AND psn.id_lista_personal = $id_user
        ORDER BY id_proyectos   DESC
      ";
    } else if ($id_area <= 3 OR $id_area >= 5) {
        $sql_lista_residentes = "SELECT lp.`id_lista_personal`,
        lp.`user_code`,
        lp.`user_pass`,
        lp.`user_email`,
        lp.phone_number,
        lp.active,
        lp.birthdate,
        CONCAT(
               tit.short_title, ' ',
               lp.user_name, ' ',
               lp.user_lastname
               ) AS nombre_completo,
                area.description, area.id_area, al.id_areas_level,al.level_description,
       CONCAT(
               direc.direccion_calle, ' ',
               direc.direccion_numero, ', ',
               direc.direccion_colonia, ', ',
               direc.direccion_codigo_postal, ', ',
               mun.municipio, ', ',
               est.estado, ', Méx.'
               ) AS direccion_personal

            FROM uvzuyqbs_constructora.lista_personal AS lp
            INNER JOIN uvzuyqbs_constructora.id_titulos AS tit ON lp.id_titulo = tit.id_titulo
            INNER JOIN uvzuyqbs_constructora.areas_level AS al ON al.id_areas_level = lp.id_areas_level
            INNER JOIN uvzuyqbs_constructora.areas AS area ON area.id_area = al.id_area
            INNER JOIN uvzuyqbs_constructora.direcciones AS direc ON lp.`id_direccion` = direc.iddirecciones
            INNER JOIN uvzuyqbs_constructora.estados AS est ON direc.direccion_estado = est.id
        INNER JOIN uvzuyqbs_constructora.municipios AS mun ON direc.direccion_municipio = mun.id;";


        $getListaResidentes = $queries->getData($sql_lista_residentes);
        $sql_proyectos = "SELECT 
        proy.id_proyectos, 
        proy.status, 
        proy.codigo_proyecto, 
        proy.nombre_largo,
        proy.comentario,
        proy.fecha_inicio,
        proy.fecha_cierre_proyectada,
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

        FROM uvzuyqbs_constructora.proyectos AS proy
        INNER JOIN uvzuyqbs_constructora.lista_personal AS psn ON proy.id_personal_creador = psn.id_lista_personal
        INNER JOIN uvzuyqbs_constructora.id_titulos AS tit ON psn.id_titulo = tit.id_titulo
        INNER JOIN uvzuyqbs_constructora.direcciones AS direc ON proy.id_direccion = direc.iddirecciones
        INNER JOIN uvzuyqbs_constructora.estados AS est ON direc.direccion_estado = est.id
        INNER JOIN uvzuyqbs_constructora.municipios AS mun ON direc.direccion_municipio = mun.id
        ORDER BY id_proyectos DESC
    ;
";
    }
    $getProyects = $queries->getData($sql_proyectos);
}
$sql_utilizacion = "SELECT * FROM uvzuyqbs_constructora.utilizaciones";

$getUtilizacion = $queries->getData($sql_utilizacion);

$sql_areas = "SELECT * FROM uvzuyqbs_constructora.areas";

$getAreas = $queries->getData($sql_areas);

$sql_academicos = "SELECT * FROM uvzuyqbs_constructora.id_titulos";

$getTitulosAc = $queries->getData($sql_academicos);

$sql_proveedores = "SELECT * FROM uvzuyqbs_constructora.proveedores";
$getProveedores = $queries->getData($sql_proveedores);


$sql_utilizaciones = "SELECT * FROM uvzuyqbs_constructora.utilizaciones";
$getUtilizaciones = $queries->getData($sql_utilizaciones);

$sql_mediciones = "SELECT * FROM uvzuyqbs_constructora.medicion_tipo";
$getMediciones = $queries->getData($sql_mediciones);
