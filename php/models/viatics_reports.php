<?php

class Viatics
{
    public function getUserRegisters($id_user_data,$fecha_1, $fecha_2)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_user_archives = "SELECT gas.*, tgas.descripcion AS tipo_gasto, 
        stat.descripcion AS estatus,
        rimg.ruta_archivo AS ruta_img,
        rpdf.ruta_archivo AS ruta_pdf,
        (CONCAT(per.nombres, ' ', per.apellido_paterno, ' ', per.apellido_materno)) AS nombre
        FROM asteleco_viaticos_erp.gastos AS gas
        INNER JOIN asteleco_viaticos_erp.tipos_gasto AS tgas ON gas.id_tipos_gasto = tgas.id_tipos_gasto
        INNER JOIN asteleco_viaticos_erp.status_type AS stat ON gas.id_status_type = stat.id_status_type
        INNER JOIN asteleco_personal.lista_personal AS per ON per.id_lista_personal = gas.id_personal
        LEFT JOIN asteleco_viaticos_erp.rutas_archivos AS rimg ON rimg.id_rutas_archivos = gas.id_ruta_img

        LEFT JOIN asteleco_viaticos_erp.rutas_archivos AS rpdf ON rpdf.id_rutas_archivos = gas.id_ruta_pdf
        WHERE id_personal = '$id_user_data' AND fecha_registro BETWEEN '$fecha_1' AND '$fecha_2'";
        
        $getUserArchives = $queries->getData($sql_user_archives);

        return ($getUserArchives);
    }
    public function getUserProyects($id_user_data)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_user_archives = "SELECT DISTINCT(proyecto) FROM asteleco_viaticos_old.registros_principal 
        WHERE nombre = '$id_user_data'";
        $getUserArchives = $queries->getData($sql_user_archives);

        return ($getUserArchives);
    }
    public function getUserSpend($id_user_data)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_user_archives = "SELECT DISTINCT(tgasto) FROM asteleco_viaticos_old.registros_principal 
        WHERE nombre = '$id_user_data'";
        $getUserArchives = $queries->getData($sql_user_archives);

        return ($getUserArchives);
    }
    public function getUserRegistersByProyect($id_user_data,$fecha_1, $fecha_2,$proyecto)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_user_archives = "SELECT * FROM asteleco_viaticos_old.registros_principal 
        WHERE nombre = '$id_user_data' AND fecha BETWEEN '$fecha_1' AND '$fecha_2' AND proyecto = '$proyecto'";
        $getUserArchives = $queries->getData($sql_user_archives);

        return ($getUserArchives);
    }
    public function getUserRegistersBySpendType($id_user_data,$fecha_1, $fecha_2,$tgasto)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_user_archives = "SELECT * FROM asteleco_viaticos_old.registros_principal 
        WHERE nombre = '$id_user_data' AND fecha BETWEEN '$fecha_1' AND '$fecha_2' AND tgasto = '$tgasto'";
        $getUserArchives = $queries->getData($sql_user_archives);

        return ($getUserArchives);
    }
    public function getUserDeposits($id_user_data,$fecha_1, $fecha_2)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_user_archives = "SELECT * FROM asteleco_viaticos_old.depositos 
        WHERE destinatario = '$id_user_data' AND fecha BETWEEN '$fecha_1' AND '$fecha_2'";
        $getUserArchives = $queries->getData($sql_user_archives);

        return ($getUserArchives);
    }

    public function getProyectSpend($id_proyect)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_user_archives = "SELECT * FROM asteleco_viaticos_old.registros_principal 
        WHERE proyecto = '$id_proyect' ";
        $getUserArchives = $queries->getData($sql_user_archives);

        return ($getUserArchives);
    }

    public function getProyectsExpenses($proyecto,$fecha_1, $fecha_2)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_proyects_expenses = "SELECT DISTINCT *
         FROM asteleco_viaticos_old.registros_principal AS gas
         WHERE gas.proyecto = '$proyecto' AND gas.fecha BETWEEN '$fecha_1' AND '$fecha_2' ORDER BY id_reg DESC";
         //
        $getProyectsExpenses = $queries->getData($sql_proyects_expenses);

        return ($getProyectsExpenses);
    }

    public function getProyectsExpensesByType($tipo,$fecha_1, $fecha_2)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_proyects_expenses = "SELECT DISTINCT *
         FROM asteleco_viaticos_old.registros_principal AS gas
         WHERE gas.tgasto = '$tipo' AND gas.fecha BETWEEN '$fecha_1' AND '$fecha_2' ORDER BY id_reg DESC";
         //
        $getProyectsExpenses = $queries->getData($sql_proyects_expenses);

        return ($getProyectsExpenses);
    }

    public function getProyectsSpends($proyecto, $fecha_1, $fecha_2)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_proyects_spends = "SELECT *
         FROM asteleco_viaticos_old.depositos AS dep
         WHERE dep.proyecto = '$proyecto' AND dep.fecha BETWEEN '$fecha_1' AND '$fecha_2' ORDER BY id_deposito DESC";
         //  AND dep.fecha BETWEEN '$fecha_1' AND '$fecha_2'";
        $getProyectsSpends = $queries->getData($sql_proyects_spends);

        return ($getProyectsSpends);
    }

    public function getExpensesTypes()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_proyects_spends = "SELECT *
         FROM asteleco_viaticos_old.tipos_gasto WHERE status = '1' ORDER BY tipo ASC ";
         //  AND dep.fecha BETWEEN '$fecha_1' AND '$fecha_2'";
        $getProyectsSpends = $queries->getData($sql_proyects_spends);

        return ($getProyectsSpends);
    }

    public function getProyectsUp()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_proyects = "SELECT * 
         FROM asteleco_viaticos_old.proyectos";
        $getProyects = $queries->getData($sql_proyects);

        return ($getProyects);
    }
}
