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
    $id_area = $_SESSION['id_area'];
    $id_area_level = $_SESSION['id_areas_level'];
    $txt_area = $_SESSION['txt_area'];
    $txt_area_level = $_SESSION['txt_area_level'];


    $queries = new Queries;
    


    $sql_proyect_types = "SELECT * FROM asteleco_proyectos.tipos_proyecto";
    $getProyectTypes = $queries->getData($sql_proyect_types);

    $sql_regiones = "SELECT * FROM asteleco_proyectos.regiones";
    $getRegions = $queries->getData($sql_regiones);

    $estados = "SELECT * FROM asteleco_matriz_direcciones.estados";
    $getStates = $queries->getData($estados);

    $estados = "SELECT * FROM asteleco_matriz_direcciones.estados";
    $getStates = $queries->getData($estados);

    $todos_proyectos = "SELECT 
    proy.id_proyectos,
    proy.`codigo_proyecto`,
    proy.`nombre_proyecto`,
    proy.`descripcion`,
    proy.`fecha_inicio`,
    proy.`status`,
    reg.nombre_region,
    CONCAT(
        direc.direccion_calle, ', ',
        direc.direccion_numero_ext, ', ',
        direc.direccion_colonia, ', ',
        direc.direccion_zipcode, '. '
    ) AS direccion_local,
    CONCAT (
        direc.direccion_municipio, ', ',
        direc.direccion_estado, ', ',
        'Méx.'
    ) AS direccion_zona,
    direc.*
    FROM asteleco_proyectos.`proyectos`AS proy
    INNER JOIN asteleco_proyectos.regiones AS reg ON proy.id_regiones = reg.id_regiones
    INNER JOIN asteleco_proyectos.direcciones_proyecto AS direc ON proy.id_direcciones_proyecto = direc.id_direcciones_proyecto
    WHERE proy.show_proyect = 1
    ";
    $getAllProyects = $queries->getData($todos_proyectos);

    $sql_lista_personal = "SELECT ar.id_areas, ar.descripcion_area,CONCAT(usr.nombres, ' ', usr.apellido_paterno, ' ', usr.apellido_materno) AS nombre_completo, niv_ar.descripcion_niveles_areas AS puesto_area, usr.* 
    FROM asteleco_personal.lista_personal AS usr INNER JOIN asteleco_personal.niveles_areas AS niv_ar ON usr.id_niveles_areas = niv_ar.id_niveles_areas INNER JOIN asteleco_personal.areas AS ar ON ar.id_areas = niv_ar.id_areas";

    $getAllUsers = $queries->getData($sql_lista_personal);

    $sql_get_all_areas = "SELECT * FROM asteleco_personal.areas";
    $getAllAreas = $queries->getData($sql_get_all_areas);

    $sql_academicos = "SELECT * FROM asteleco_personal.niveles_academicos";
    $getAcademicLevels = $queries->getData($sql_academicos);


    $viatics_types = "SELECT tg.*
    FROM asteleco_viaticos.tipos_gasto AS tg
    WHERE tg.id_clases_gasto = 1";
    $getViaticsTypes = $queries->getData($viatics_types);


    $sql_archives_table_structure = "SELECT count(*) as total_archives
    FROM asteleco_personal.catalogo_archivos AS cat
    WHERE cat.id_catalogo_archivos > '1'
    ";
    $getArchivesTableStructure = $queries->getData($sql_archives_table_structure);

    /* 
    $queries = new Queries;
   


    $sql_materiales = "SELECT * FROM constructora_personal.matriz_materiales";
    $getMateriales = $queries->getData($sql_materiales);

   

    $sql_personal = "SELECT 
            psn.id_lista_personal AS id_personal,
            CONCAT(
            tit.short_title, ' ', 
            psn.user_name, ' ', 
            psn.user_lastname
            ) AS nombre_completo

            FROM constructora_personal.lista_personal AS psn
            INNER JOIN constructora_personal.id_titulos AS tit ON psn.id_titulo = tit.id_titulo
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

        FROM constructora_personal.proyectos AS proy 
        INNER JOIN constructora_personal.lista_personal AS psn 
        INNER JOIN constructora_personal.id_titulos AS tit ON psn.id_titulo = tit.id_titulo
        INNER JOIN constructora_personal.direcciones AS direc ON proy.id_direccion = direc.iddirecciones
        INNER JOIN constructora_personal.estados AS est ON direc.direccion_estado = est.id
        INNER JOIN constructora_personal.municipios AS mun ON direc.direccion_municipio = mun.id
        INNER JOIN constructora_personal.asignaciones_proyectos AS asp ON psn.id_lista_personal = asp.id_personal AND proy.id_proyectos = asp.id_proyecto AND asp.activo = 1
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

            FROM constructora_personal.lista_personal AS lp
            INNER JOIN constructora_personal.id_titulos AS tit ON lp.id_titulo = tit.id_titulo
            INNER JOIN constructora_personal.areas_level AS al ON al.id_areas_level = lp.id_areas_level
            INNER JOIN constructora_personal.areas AS area ON area.id_area = al.id_area
            INNER JOIN constructora_personal.direcciones AS direc ON lp.`id_direccion` = direc.iddirecciones
            INNER JOIN constructora_personal.estados AS est ON direc.direccion_estado = est.id
        INNER JOIN constructora_personal.municipios AS mun ON direc.direccion_municipio = mun.id;";


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

        FROM constructora_personal.proyectos AS proy
        INNER JOIN constructora_personal.lista_personal AS psn ON proy.id_personal_creador = psn.id_lista_personal
        INNER JOIN constructora_personal.id_titulos AS tit ON psn.id_titulo = tit.id_titulo
        INNER JOIN constructora_personal.direcciones AS direc ON proy.id_direccion = direc.iddirecciones
        INNER JOIN constructora_personal.estados AS est ON direc.direccion_estado = est.id
        INNER JOIN constructora_personal.municipios AS mun ON direc.direccion_municipio = mun.id
        ORDER BY id_proyectos DESC
    ;
";
    }
    $getProyects = $queries->getData($sql_proyectos); */
}
/* $sql_utilizacion = "SELECT * FROM constructora_personal.utilizaciones";

$getUtilizacion = $queries->getData($sql_utilizacion);

$sql_areas = "SELECT * FROM constructora_personal.areas";

$getAreas = $queries->getData($sql_areas);

$sql_academicos = "SELECT * FROM constructora_personal.id_titulos";

$getTitulosAc = $queries->getData($sql_academicos);

$sql_proveedores = "SELECT * FROM constructora_personal.proveedores";
$getProveedores = $queries->getData($sql_proveedores);


$sql_utilizaciones = "SELECT * FROM constructora_personal.utilizaciones";
$getUtilizaciones = $queries->getData($sql_utilizaciones);

$sql_mediciones = "SELECT * FROM constructora_personal.medicion_tipo";
$getMediciones = $queries->getData($sql_mediciones);
 */