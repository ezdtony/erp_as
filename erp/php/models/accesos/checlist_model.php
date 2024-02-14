<?php

class Access
{
    public function getAccesoByID($id_acceso)
    {
        include_once('../../models/petitions.php');
        $queries = new Queries;
        $sql_Acceso = "SELECT acc.*, 
        sit.id_sitios,
        CONCAT(sit.codigo_sitio, ' | ', sit.nombre_sitio) AS sitio, 
        nombre_central, 
        zon.descripcion AS zona, 
        CONCAT(per.nombres, ' ', per.apellido_paterno, ' ', per.apellido_materno) AS personal_as,
        CASE
            WHEN hora_salida = '00:00:00' THEN '-'
            ELSE hora_salida
        END AS hora_salida,
        CASE
            WHEN acc.breaker_principal = '1' THEN 'Si'
            ELSE 'No'
        END AS breaker_principal_acc,
        CASE
            WHEN acc.at_torre = '1' THEN 'Si'
            ELSE 'No'
        END AS at_torre_acc,
        CASE
            WHEN acc.at_centro_carga = '1' THEN 'Si'
            ELSE 'No'
        END AS at_centro_carga_acc,
        CASE
            WHEN acc.at_escalerilla = '1' THEN 'Si'
            ELSE 'No'
        END AS at_escalerilla_acc,
        tip_sit.id_tipos_sitio,
        tip_sit.descripcion AS tipo_sitio,
        tp.descripcion AS tp_descripcion
        FROM asteleco_accesos_erp.accesos AS acc
        INNER JOIN asteleco_accesos_erp.sitios AS sit ON sit.id_sitios = acc.id_sitios
        INNER JOIN asteleco_accesos_erp.centrales AS ces ON ces.id_centrales = sit.id_centrales
        INNER JOIN asteleco_accesos_erp.zonas_central AS zon ON zon.id_zonas_central = sit.id_zonas_central
        INNER JOIN asteleco_accesos_erp.tipos_sitio AS tip_sit ON tip_sit.id_tipos_sitio = sit.id_tipos_sitio
        INNER JOIN asteleco_accesos_erp.tipo_perimetro AS tp ON tp.id_tipo_perimetro = sit.id_tipo_perimetro
        INNER JOIN asteleco_personal.lista_personal AS per ON per.id_lista_personal = acc.id_personal_as 
        where id_accesos = $id_acceso
        ";

        $getAcceso = $queries->getData($sql_Acceso);

        return ($getAcceso);
    }

    public function getAPinfo($id_sitio, $id_puertas_de_acceso)
    {
        include_once('../../models/petitions.php');
        $queries = new Queries;
        $sql_Central = "SELECT cerr_s.*, descripcion AS cerradura
                    FROM asteleco_accesos_erp.cerraduras_sitios AS cerr_s
                    INNER JOIN asteleco_accesos_erp.tipos_cerraduras AS t_cerr ON cerr_s.id_tipos_cerraduras = t_cerr.id_tipos_cerraduras
                    WHERE id_sitios = $id_sitio AND cerr_s.id_puertas_de_acceso = $id_puertas_de_acceso";

        $getCentral = $queries->getData($sql_Central);

        return ($getCentral);
    }

    public function getLogGabinetes($id_accesos)
    {
        include_once('../../models/petitions.php');
        $queries = new Queries;
        $sql_Central = "SELECT gab.*, descripcion AS cerradura
                    FROM asteleco_accesos_erp.log_gabinetes_accesos AS gab
                    INNER JOIN asteleco_accesos_erp.tipos_cerraduras AS cer ON cer.id_tipos_cerraduras = gab.id_tipos_cerraduras
                    WHERE accesos_id_accesos = $id_accesos";

        $getCentral = $queries->getData($sql_Central);

        return ($getCentral);
    }
    public function getFirmaProveedor($id_accesos)
    {
        include_once('../../models/petitions.php');
        $queries = new Queries;
        $sql_Central = "SELECT * FROM asteleco_accesos_erp.firmas_accesos
                    WHERE id_accesos = $id_accesos";
        $getCentral = $queries->getData($sql_Central);

        return ($getCentral);
    }
    public function getIdentificacionProveedor($id_rutas_archivos_accesos)
    {
        include_once('../../models/petitions.php');
        $queries = new Queries;
        $sql_Central = "SELECT * FROM asteleco_accesos_erp.rutas_archivos_accesos
                    WHERE id_rutas_archivos_accesos = $id_rutas_archivos_accesos";
        $getCentral = $queries->getData($sql_Central);

        return ($getCentral);
    }
    
    
    
}
