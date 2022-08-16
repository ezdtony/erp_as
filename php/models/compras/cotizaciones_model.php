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
}
