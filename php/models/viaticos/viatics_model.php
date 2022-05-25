<?php

class ViaticsInformation
{
    public function getAllDeposits()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT
        CONCAT( pers.nombres,' ', pers.apellido_paterno, ' ', pers.apellido_materno) AS nombre_completo,
        CONCAT( aut.nombres,' ', aut.apellido_paterno, ' ', aut.apellido_materno) AS author,
        proy.nombre_proyecto,
        tg.descripcion AS descripcion_tipo_gasto,
        dep.*
        FROM asteleco_viaticos.depositos AS dep	
        INNER JOIN asteleco_personal.lista_personal AS pers ON dep.id_personal = pers.id_lista_personal
        INNER JOIN asteleco_personal.lista_personal AS aut ON dep.id_personal_registro = aut.id_lista_personal
        INNER JOIN asteleco_proyectos.asignaciones_proyectos AS asig ON asig.id_asignaciones_proyectos = dep.id_asignacion_proyecto
        INNER JOIN asteleco_proyectos.proyectos AS proy ON asig.id_proyectos = proy.id_proyectos
        INNER JOIN asteleco_viaticos.tipos_gasto AS tg ON dep.id_tipos_gasto = tg.id_tipos_gasto

        ";
        $getDeposits = $queries->getData($sql_deposits);

        return ($getDeposits);
    }

    public function getSaldoPorUsuario($id_user)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_saldo = "SELECT saldo FROM asteleco_viaticos.saldos WHERE id_personal = '$id_user'";
        $getSaldo = $queries->getData($sql_saldo);

        return ($getSaldo);
    }
    public function getAllGastos()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_saldo = "SELECT gas.*, proy.codigo_proyecto, proy.nombre_proyecto, stat.id_status_type, stat.descripcion AS estatus, stat.clase_css, rut_fac.ruta_archivo AS ruta_pdf, 
        rut.ruta_archivo AS ruta_img, CONCAT( pers.nombres,' ', pers.apellido_paterno, ' ', pers.apellido_materno) AS usuario_gasto
        FROM asteleco_viaticos.gastos AS gas
        INNER JOIN asteleco_personal.lista_personal AS pers ON pers.id_lista_personal = gas.id_personal
        INNER JOIN asteleco_viaticos.status_type AS stat ON stat.id_status_type = gas.id_status_type
        INNER JOIN asteleco_proyectos.asignaciones_proyectos AS asig ON asig.id_asignaciones_proyectos = gas.id_asignaciones_proyectos
        INNER JOIN asteleco_proyectos.proyectos AS proy ON asig.id_proyectos = proy.id_proyectos
        INNER JOIN asteleco_viaticos.rutas_archivos AS rut ON rut.id_rutas_archivos = gas.id_ruta_img
        LEFT JOIN asteleco_viaticos.rutas_archivos AS rut_fac ON rut_fac.id_rutas_archivos = gas.id_ruta_pdf";
        $getSaldo = $queries->getData($sql_saldo);

        return ($getSaldo);
    }
    public function getGastosByUser($id_user)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_saldo = "SELECT gas.*, proy.codigo_proyecto, proy.nombre_proyecto, stat.descripcion AS estatus, stat.clase_css, rut_fac.ruta_archivo AS ruta_pdf, rut.ruta_archivo AS ruta_img
        FROM asteleco_viaticos.gastos AS gas
        INNER JOIN asteleco_viaticos.status_type AS stat ON stat.id_status_type = gas.id_status_type
        INNER JOIN asteleco_proyectos.asignaciones_proyectos AS asig ON asig.id_asignaciones_proyectos = gas.id_asignaciones_proyectos
        INNER JOIN asteleco_proyectos.proyectos AS proy ON asig.id_proyectos = proy.id_proyectos
        INNER JOIN asteleco_viaticos.rutas_archivos AS rut ON rut.id_rutas_archivos = gas.id_ruta_img
        LEFT JOIN asteleco_viaticos.rutas_archivos AS rut_fac ON rut_fac.id_rutas_archivos = gas.id_ruta_pdf
         WHERE id_personal = '$id_user'";
        $getSaldo = $queries->getData($sql_saldo);

        return ($getSaldo);
    }

    public function getProyectsByUser($id_user)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_saldo = "SELECT 
        proy.id_proyectos,
        proy.`codigo_proyecto`,
        proy.`nombre_proyecto`,
        proy.`descripcion`,
        proy.`fecha_inicio`,
        asig.id_asignaciones_proyectos,
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
        INNER JOIN asteleco_proyectos.asignaciones_proyectos AS asig ON asig.id_proyectos = proy.id_proyectos
        WHERE  proy.show_proyect = 1 AND  asig.id_lista_personal = '$id_user'";
        $getSaldo = $queries->getData($sql_saldo);

        return ($getSaldo);
    }
    public function getStatusTypes()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_saldo = "SELECT * FROM asteleco_viaticos.status_type";
        $getSaldo = $queries->getData($sql_saldo);

        return ($getSaldo);
    }

    public function getAllUserBalances()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT
        CONCAT( pers.nombres,' ', pers.apellido_paterno, ' ', pers.apellido_materno) AS nombre_usuario,
        sald.saldo
        FROM asteleco_viaticos.saldos AS sald
        INNER JOIN asteleco_personal.lista_personal AS pers ON sald.id_personal = pers.id_lista_personal
        ";
        $getDeposits = $queries->getData($sql_deposits);

        return ($getDeposits);
    }
}