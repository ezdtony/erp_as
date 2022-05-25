<?php

class Access
{
    public function getAllSites()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_sites = "SELECT * FROM asteleco_accesos.sitios";
        
        $getSites = $queries->getData($sql_sites);

        return ($getSites);
    }

    public function getAllCentral()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_Central = "SELECT * FROM asteleco_accesos.centrales";
        
        $getCentral = $queries->getData($sql_Central);

        return ($getCentral);
    }
    public function getAllLockTypes()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_Central = "SELECT * FROM asteleco_accesos.tipos_cerraduras";
        
        $getCentral = $queries->getData($sql_Central);

        return ($getCentral);
    }
    public function getAllPerimeterTypes()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_perimeter = "SELECT * FROM asteleco_accesos.tipo_perimetro";
        
        $getPerimeter = $queries->getData($sql_perimeter);

        return ($getPerimeter);
    }

    public function getAllStates()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_States = "SELECT * FROM asteleco_matriz_direcciones.estados";
        
        $getStates = $queries->getData($sql_States);

        return ($getStates);
    }
    
}
