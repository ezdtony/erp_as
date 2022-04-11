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
  
}
