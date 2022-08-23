<?php

class Compras
{
    public function getUtilizaciones()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_compras.utilizaciones";
        $getDeposits = $queries->getData($sql_deposits);

        return ($getDeposits);
    }

    public function getCotizaciones($id_user)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_cotizaciones = "SELECT coti.*, proy.nombre_proyecto, DATE(coti.date_log) AS fecha,
        (SELECT COUNT(*) FROM asteleco_compras.desglose_cotizacion AS desg WHERE desg.`id_cotizaciones` = coti.id_cotizaciones) AS partidas,
        (SELECT COUNT(*) FROM asteleco_compras.desglose_cotizacion AS desg WHERE desg.`id_cotizaciones` = coti.id_cotizaciones AND cotizada='1') AS partidas_completas,
        sta.descripcion AS status_descripcion, class_bootstrap
        FROM asteleco_compras.cotizaciones AS coti
        INNER JOIN asteleco_proyectos.proyectos AS proy ON coti.id_proyecto = proy.id_proyectos
        INNER JOIN asteleco_compras.status_cotizaciones AS sta ON coti.status_cotizacion = sta.id_status_cotizaciones
        WHERE coti.id_usuario_created = '$id_user'";
        $getCotizaciones = $queries->getData($sql_cotizaciones);
        return ($getCotizaciones);
    }
    public function getCotizacionesAdmin($id_user)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_cotizaciones = "SELECT coti.*, proy.nombre_proyecto, DATE(coti.date_log) AS fecha,
        (SELECT COUNT(*) FROM asteleco_compras.desglose_cotizacion AS desg WHERE desg.`id_cotizaciones` = coti.id_cotizaciones) AS partidas,
        (SELECT COUNT(*) FROM asteleco_compras.desglose_cotizacion AS desg WHERE desg.`id_cotizaciones` = coti.id_cotizaciones AND cotizada='1') AS partidas_completas,
        sta.descripcion AS status_descripcion, class_bootstrap
        FROM asteleco_compras.cotizaciones AS coti
        INNER JOIN asteleco_proyectos.proyectos AS proy ON coti.id_proyecto = proy.id_proyectos
        INNER JOIN asteleco_compras.status_cotizaciones AS sta ON coti.status_cotizacion = sta.id_status_cotizaciones";
        $getCotizaciones = $queries->getData($sql_cotizaciones);
        return ($getCotizaciones);
    }
    public function getDesgloseCotizacion($id_cotizaciones)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_compras.desglose_cotizacion WHERE id_cotizaciones = '$id_cotizaciones'";
        $getDeposits = $queries->getData($sql_deposits);

        return ($getDeposits);
    }
    public function getCotizacionInfo($id_cotizaciones)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT coti.*, proy.nombre_proyecto, DATE(coti.date_log) AS fecha,
        (CONCAT(per.nombres, ' ', per.apellido_paterno, ' ', per.apellido_materno)) AS nombre
        FROM asteleco_compras.cotizaciones AS coti
        INNER JOIN asteleco_personal.lista_personal AS per ON coti.id_usuario_created = per.id_lista_personal
        INNER JOIN asteleco_proyectos.proyectos AS proy ON coti.id_proyecto = proy.id_proyectos
        WHERE coti.id_cotizaciones = '$id_cotizaciones'";
        $getDeposits = $queries->getData($sql_deposits);

        return ($getDeposits);
    }
    public function getStatusTypes()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_compras.status_cotizaciones";
        $getDeposits = $queries->getData($sql_deposits);

        return ($getDeposits);
    }
}
