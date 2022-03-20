<?php

class Viatics
{
    public function getUserRegisters($id_user_data,$fecha_1, $fecha_2)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_user_archives = "SELECT * FROM asteleco_viaticos_old.registros_principal 
        WHERE nombre = '$id_user_data' AND fecha BETWEEN '$fecha_1' AND '$fecha_2'";
        $getUserArchives = $queries->getData($sql_user_archives);

        return ($getUserArchives);
    }
}
