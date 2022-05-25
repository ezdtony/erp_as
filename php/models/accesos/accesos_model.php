<?php

class Access
{
    public function getAllSites()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_sites = "SELECT sites.*, 
        CASE 
        WHEN sites.empresa_responsable IS NULL THEN 'S/I'
        WHEN sites.empresa_responsable = '' THEN 'S/I'
        ELSE sites.empresa_responsable
        END AS empresa_sitio,
        centr.nombre_central,
        zonas.descripcion AS zona, 
        stat.descripcion AS status_sitio, 
        tipos.descripcion AS tipo_sitio
        FROM asteleco_accesos.sitios AS sites
        INNER JOIN asteleco_accesos.centrales AS centr ON centr.id_centrales = sites.id_centrales
        INNER JOIN asteleco_accesos.zonas_central AS zonas ON zonas.id_zonas_central = sites.id_zonas_central
        INNER JOIN asteleco_accesos.tipos_sitio AS tipos ON tipos.id_tipos_sitio = sites.id_tipos_sitio
        INNER JOIN asteleco_accesos.status_operaciones AS stat ON stat.id_status_operaciones = sites.status
        ";
        
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
