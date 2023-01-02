<?php

class ModeloVehiculos
{
    public function getGruposPreguntas($id_familias_preguntas)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_vehiculos.grupos_preguntas WHERE id_familias_preguntas = $id_familias_preguntas";
        $getDeposits = $queries->getData($sql_deposits);

        return ($getDeposits);
    }
    public function getFamiliasPreguntas()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_vehiculos.familias_preguntas";
        $getDeposits = $queries->getData($sql_deposits);

        return ($getDeposits);
    }
    public function getTiposPreguntas()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_vehiculos.tipos_preguntas";
        $getDeposits = $queries->getData($sql_deposits);

        return ($getDeposits);
    }

    public function getVehiculos()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_vehiculos.vehiculos";
        $getDeposits = $queries->getData($sql_deposits);

        return ($getDeposits);
    }
    
    public function getPreguntas($id_grupos_preguntas)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT preg.*, tp.descripcion AS tipo_pregunta
        FROM asteleco_vehiculos.preguntas AS preg
        INNER JOIN asteleco_vehiculos.tipos_preguntas AS tp ON tp.id_tipos_preguntas = preg.id_tipos_preguntas
        WHERE id_grupos_preguntas = $id_grupos_preguntas";
        $getDeposits = $queries->getData($sql_deposits);

        return ($getDeposits);
    }

    public function getVehiculosUser($id_personal)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT veh.*, au.id_asignaciones_unidades FROM asteleco_vehiculos.vehiculos AS veh
                            INNER JOIN asteleco_vehiculos.asignaciones_unidades AS au ON au.id_vehiculos = veh.id_vehiculos
                            WHERE au.id_personal = $id_personal AND au.activa = 1";
        $getDeposits = $queries->getData($sql_deposits);

        return ($getDeposits);
    }
    public function getPosiblesRespuestas($id_tipos_preguntas)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT pr.* FROM asteleco_vehiculos.posibles_respuestas AS pr
                            WHERE pr.id_tipos_preguntas = $id_tipos_preguntas";
        $getDeposits = $queries->getData($sql_deposits);

        return ($getDeposits);
    }
    
}
