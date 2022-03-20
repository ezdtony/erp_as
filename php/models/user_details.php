<?php

$sql_user = "SELECT 
    ar.id_areas, 
    ar.descripcion_area,
    niv_ar.descripcion_niveles_areas AS puesto_area, 
    CONCAT (
        ar.descripcion_area, ' - ',
        niv_ar.descripcion_niveles_areas
    ) AS descripcion_area,
    CONCAT (
        aca.shortname_nivel, ' ',
        usr.nombres, ' ',
        usr.apellido_paterno, ' ',
        usr.apellido_materno
    ) AS nombre_usuario,
    CONCAT(
        dir.direccion_calle, ' ',
        dir.direccion_numero_int, ', ',
        dir.direccion_colonia, ', ',
        dir.direccion_municipio, ', ',
        dir.direccion_zipcode, ', ',
        dir.direccion_estado, ', Méx. '
        
    ) AS direccion_usuario,
    usr.*,
    con.*
    FROM asteleco_personal.lista_personal AS usr 
    INNER JOIN asteleco_personal.niveles_academicos AS aca ON usr.id_niveles_academicos = aca.id_niveles_academicos
    INNER JOIN asteleco_personal.contacto_personal AS con ON usr.id_contacto_personal = con.id_contacto_personal 
    INNER JOIN asteleco_personal.direcciones_personal AS dir ON usr.id_direcciones_personal = dir.id_direcciones_personal
    INNER JOIN asteleco_personal.niveles_areas AS niv_ar ON usr.id_niveles_areas = niv_ar.id_niveles_areas 
    INNER JOIN asteleco_personal.areas AS ar ON ar.id_areas = niv_ar.id_areas
    WHERE usr.id_lista_personal = $id_user_data";
$userInfo = $queries->getData($sql_user);

$sql_archives_table_structure = "SELECT
    *
        FROM asteleco_personal.catalogo_archivos AS cat
        ";
$getArchivesTableStructure = $queries->getData($sql_archives_table_structure);
foreach ($getArchivesTableStructure as $archives_structure) {
   
    $sql_user_archives_table_structure = "SELECT * 
        FROM asteleco_personal.archivos_usuarios AS arc 
        WHERE arc.id_catalogo_archivos = '$archives_structure->id_catalogo_archivos' 
        AND arc.id_lista_personal = '$id_user_data'";

    $getUserArchivesTableStructure = $queries->getData($sql_user_archives_table_structure);
    if (empty($getUserArchivesTableStructure)) {
        $insert_user_archives = "
            INSERT INTO asteleco_personal.archivos_usuarios (
                id_lista_personal,
                id_catalogo_archivos
            )
            VALUES (
                '$id_user_data',
                '$archives_structure->id_catalogo_archivos'
            )";
        $queries->insertData($insert_user_archives);
    }
}

$sql_user_archives = "SELECT
arc.nombre_archivo,
arc.ruta_archivo,
arc.id_archivos_usuarios,
cat.tipo_archivo,
cat.html_input_type,
cat.class_css,
cat.btn_class_color,
cat.nombre_archivo AS nombre_catalogo
FROM asteleco_personal.archivos_usuarios AS arc
INNER JOIN asteleco_personal.catalogo_archivos AS cat ON arc.id_catalogo_archivos = cat.id_catalogo_archivos
WHERE arc.id_lista_personal = '$id_user_data' ORDER BY cat.id_catalogo_archivos";
$getUserArchives = $queries->getData($sql_user_archives);

$sql_get_profile_picture = "SELECT
    arc.ruta_archivo
    FROM asteleco_personal.archivos_usuarios AS arc
    INNER JOIN asteleco_personal.catalogo_archivos AS cat ON arc.id_catalogo_archivos = cat.id_catalogo_archivos
    WHERE arc.id_lista_personal = '$id_user_data' AND cat.id_catalogo_archivos = '1'";
$getProfilePicture = $queries->getData($sql_get_profile_picture);



