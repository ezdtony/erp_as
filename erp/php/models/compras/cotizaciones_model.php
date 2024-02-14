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
    public function getClasificaciones()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_compras.clasificaciones_catalogo";
        $getDeposits = $queries->getData($sql_deposits);

        return ($getDeposits);
    }

    public function getCotizaciones($id_user)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_cotizaciones = "SELECT cotiz_index.id_cotizaciones, cotiz_index.id_status_cotizaciones, codigo_solicitud, DATE(cotiz_index.date_log) AS fecha_index,
        CONCAT(proy.codigo_proyecto, ' | ',proy.nombre_proyecto) AS proyecto, descripcion_status_cotizaciones, class_bootstrap_cotizaciones,
        (SELECT COUNT(*) FROM asteleco_compras.desglose_cotizacion AS desg WHERE desg.`id_cotizaciones` = cotiz_index.id_cotizaciones) AS partidas,
        (SELECT COUNT(*) FROM asteleco_compras.desglose_cotizacion AS desg WHERE desg.`id_cotizaciones` = cotiz_index.id_cotizaciones AND cotizada='1') AS partidas_completas
        FROM asteleco_compras.cotizaciones AS cotiz_index 
        INNER JOIN asteleco_proyectos.proyectos AS proy ON cotiz_index.id_proyecto = proy.id_proyectos
        INNER JOIN asteleco_compras.status_cotizaciones AS stt_ct ON cotiz_index.id_status_cotizaciones = stt_ct.id_status_cotizaciones
        WHERE cotiz_index.id_personal_registro = '$id_user'";
        $getCotizaciones = $queries->getData($sql_cotizaciones);
        return ($getCotizaciones);
    }
    public function getCotizacionesAdmin()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_cotizaciones = "SELECT cotiz_index.id_cotizaciones, cotiz_index.id_status_cotizaciones, codigo_solicitud, DATE(cotiz_index.date_log) AS fecha_index,
        CONCAT(proy.codigo_proyecto, ' | ',proy.nombre_proyecto) AS proyecto, descripcion_status_cotizaciones, class_bootstrap_cotizaciones, stt_ct.descripcion_status_cotizaciones, stt_ct.class_bootstrap_cotizaciones,
        (SELECT COUNT(*) FROM asteleco_compras.desglose_cotizacion AS desg WHERE desg.`id_cotizaciones` = cotiz_index.id_cotizaciones) AS partidas, stt_ct.id_status_cotizaciones,
        (SELECT COUNT(*) FROM asteleco_compras.desglose_cotizacion AS desg WHERE desg.`id_cotizaciones` = cotiz_index.id_cotizaciones AND cotizada='1') AS partidas_completas
        FROM asteleco_compras.cotizaciones AS cotiz_index 
        INNER JOIN asteleco_proyectos.proyectos AS proy ON cotiz_index.id_proyecto = proy.id_proyectos
        INNER JOIN asteleco_compras.status_cotizaciones AS stt_ct ON cotiz_index.id_status_cotizaciones = stt_ct.id_status_cotizaciones
        ORDER BY cotiz_index.id_cotizaciones DESC";
        $getCotizaciones = $queries->getData($sql_cotizaciones);
        return ($getCotizaciones);
    }
    public function getDesgloseCotizacion($id_cotizaciones)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT dc.id_desglose_cotizacion, dc.no_partida, dc.cantidad, dc.comentarios, dc.cotizada,
        CONCAT (cm.codigo_astelecom, ' | ', cm.descripcion_material, ' ', ul.medida_de_longitud_long, udl.simbolo) AS descripcion_material,
        um.unidades_medida_long, marca as nombre_marca, status_partidas, class_bootstrap_status_partidas, empresa_proveedor
         FROM asteleco_compras.desglose_cotizacion AS dc
         INNER JOIN asteleco_compras.catalogo_material AS cm ON (cm.id_catalogo_material = dc.id_catalogo_material)
         INNER JOIN asteleco_compras.medidas_de_longitud AS ul ON (dc.id_medidas_de_longitud = ul.id_medidas_de_longitud)
         INNER JOIN asteleco_compras.unidades_de_longitud AS udl ON udl.id_unidades_de_longitud = ul.id_unidades_de_longitud
         INNER JOIN asteleco_compras.unidades_medida AS um ON (um.id_unidades_medida = cm.id_unidades_medida)
         INNER JOIN asteleco_compras.status_partidas AS stp ON (stp.id_status_partidas = dc.id_status_partidas)
         INNER JOIN asteleco_compras.proveedores AS prov ON (dc.id_proveedores = prov.id_proveedores)
         WHERE id_cotizaciones = '$id_cotizaciones'";
        //INNER JOIN asteleco_compras.marcas AS marc ON (marc.id_marcas = dc.id_marcas)
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
        INNER JOIN asteleco_personal.lista_personal AS per ON coti.id_personal_registro = per.id_lista_personal
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
    public function getCatalogoMaterial()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT cat.*, umed.*, clascat.*
        FROM asteleco_compras.catalogo_material AS cat
        INNER JOIN asteleco_compras.unidades_medida AS umed ON umed.id_unidades_medida = cat.id_unidades_medida
        INNER JOIN asteleco_compras.clasificaciones_catalogo AS clascat ON clascat.id_clasificaciones_catalogo = cat.id_clasificaciones_catalogo
        ";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }
    public function getClasificacionesMaterial()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_compras.clasificaciones_catalogo";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }
    public function getUnidadesMedida()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_compras.unidades_medida";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }
    public function getUnidadesLongitud()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_compras.unidades_de_longitud WHERE id_unidades_de_longitud >1";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }
    public function getMedidasLongitud()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT ml.*, ul.simbolo FROM asteleco_compras.medidas_de_longitud AS ml
        INNER JOIN asteleco_compras.unidades_de_longitud AS ul ON ul.id_unidades_de_longitud = ml.id_unidades_de_longitud
        WHERE ml.id_unidades_de_longitud >1";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }
    public function getProveeddores()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_compras.proveedores";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }
    public function getMarcas()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_compras.marcas";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }
    public function getArchivesCountCotizacion($id_cotizaciones)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT *
        FROM asteleco_compras.documentos_cotizacion 
        WHERE id_cotizaciones = '$id_cotizaciones'";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }
    public function getKitsHerramienta()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_herramienta.kits_herramienta";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }
    public function getKitsHerramientaUser($id_user)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT kh.* FROM asteleco_herramienta.kits_herramienta AS kh
                INNER JOIN asteleco_herramienta.asignaciones_kits  AS ask ON kh.id_kits_herramienta = ask.id_kits_herramienta
                 WHERE id_personal = '$id_user'";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }
    public function getTiposKitsHerramienta()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT *
        FROM asteleco_herramienta.tipos_kits_herramienta ORDER BY descripcion_tipo ASC";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }
    /* public function getTiposKitsHerramienta()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT kh.*, tkh.descripcion_tipo AS descripcion_tipo_kit_herramienta
        FROM asteleco_herramienta.kits_herramienta AS kh
        INNER JOIN asteleco_herramienta.tipos_kits_herramienta AS tkh ON tkh.id_tipos_kits_herramienta = kh.id_tipos_kits_herramienta";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    } */
    public function getAlmacenes()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_herramienta.almacenes";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }

    public function getInventarioHerramientaAdmin()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_herramienta.herramienta";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }
    public function getStatusHerramienta()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_herramienta.status_herramienta";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }
    public function getAlmacenesHerramienta()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_herramienta.almacenes";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }
    
    public function getInventarioHerramientaPorKit($id_kit)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_herramienta.herramienta WHERE id_kits_herramienta = $id_kit";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }

    public function getAlmacenesByID($id_almacenes)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_herramienta.almacenes WHERE id_almacenes = $id_almacenes";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }

    public function getStatusHerramientaByID($id_status_herramienta)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_deposits = "SELECT * FROM asteleco_herramienta.status_herramienta WHERE id_status_herramienta = $id_status_herramienta";
        $getCatalogo = $queries->getData($sql_deposits);

        return ($getCatalogo);
    }

}