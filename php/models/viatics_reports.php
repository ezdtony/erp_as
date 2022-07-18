<?php

class Viatics
{
    public function getUserRegisters($id_user_data, $fecha_1, $fecha_2)
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
        $sql_user_archives = "SELECT DISTINCT proy.id_proyectos, codigo_proyecto, nombre_proyecto, CONCAT (codigo_proyecto, ' - ', nombre_proyecto) AS proyecto
        FROM asteleco_viaticos_erp.gastos AS gas
        INNER JOIN asteleco_proyectos.proyectos AS proy ON proy.id_proyectos = gas.id_proyectos
         WHERE id_personal = '$id_user_data'";
        $getUserArchives = $queries->getData($sql_user_archives);

        return ($getUserArchives);
    }
    public function getUserSpend($id_user_data)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_user_archives = "SELECT DISTINCT gasty.id_tipos_gasto, gasty.descripcion AS tipo_gasto FROM
         asteleco_viaticos_erp.gastos AS gas
         INNER JOIN asteleco_viaticos_erp.tipos_gasto AS gasty ON gasty.id_tipos_gasto = gas.id_tipos_gasto
         WHERE id_personal = '$id_user_data'";
        $getUserArchives = $queries->getData($sql_user_archives);

        return ($getUserArchives);
    }
    public function getUserRegistersByProyect($id_user_data, $fecha_1, $fecha_2, $proyecto)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_user_archives = "SELECT *, tgas.descripcion AS tipo_gasto, stat.descripcion AS estatus, rpdf.ruta_archivo AS ruta_pdf, rimg.ruta_archivo AS ruta_img,
        (CONCAT(per.nombres, ' ', per.apellido_paterno, ' ', per.apellido_materno)) AS nombre,
        CONCAT (codigo_proyecto, ' - ', nombre_proyecto) AS proyecto
        FROM asteleco_viaticos_erp.gastos AS gas
        INNER JOIN asteleco_personal.lista_personal AS per ON per.id_lista_personal = gas.id_personal
        INNER JOIN asteleco_proyectos.proyectos AS proy ON proy.id_proyectos = gas.id_proyectos
        INNER JOIN asteleco_viaticos_erp.tipos_gasto AS tgas ON gas.id_tipos_gasto = tgas.id_tipos_gasto
        INNER JOIN asteleco_viaticos_erp.status_type AS stat ON gas.id_status_type = stat.id_status_type
        LEFT JOIN asteleco_viaticos_erp.rutas_archivos AS rimg ON rimg.id_rutas_archivos = gas.id_ruta_img
        LEFT JOIN asteleco_viaticos_erp.rutas_archivos AS rpdf ON rpdf.id_rutas_archivos = gas.id_ruta_pdf
        WHERE gas.id_personal = '$id_user_data' AND gas.fecha_registro BETWEEN '$fecha_1' AND '$fecha_2' AND gas.id_proyectos = '$proyecto'";
        $getUserArchives = $queries->getData($sql_user_archives);

        return ($getUserArchives);
    }
    public function getUserRegistersBySpendType($id_user_data, $fecha_1, $fecha_2, $tgasto)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_user_archives = "SELECT gas.*, tgas.descripcion AS tipo_gasto, tgas.id_tipos_gasto,
        stat.descripcion AS estatus,
        rimg.ruta_archivo AS ruta_img,
        rpdf.ruta_archivo AS ruta_pdf,
        CONCAT (codigo_proyecto, ' - ', nombre_proyecto) AS proyecto,
        (CONCAT(per.nombres, ' ', per.apellido_paterno, ' ', per.apellido_materno)) AS nombre
        FROM asteleco_viaticos_erp.gastos AS gas
        INNER JOIN asteleco_viaticos_erp.tipos_gasto AS tgas ON gas.id_tipos_gasto = tgas.id_tipos_gasto
        INNER JOIN asteleco_viaticos_erp.status_type AS stat ON gas.id_status_type = stat.id_status_type
        INNER JOIN asteleco_personal.lista_personal AS per ON per.id_lista_personal = gas.id_personal
        INNER JOIN asteleco_proyectos.proyectos AS proy ON proy.id_proyectos = gas.id_proyectos
        LEFT JOIN asteleco_viaticos_erp.rutas_archivos AS rimg ON rimg.id_rutas_archivos = gas.id_ruta_img
        LEFT JOIN asteleco_viaticos_erp.rutas_archivos AS rpdf ON rpdf.id_rutas_archivos = gas.id_ruta_pdf
        WHERE id_personal = '$id_user_data' AND fecha_registro BETWEEN '$fecha_1' AND '$fecha_2' AND tgas.id_tipos_gasto = '$tgasto'";
        $getUserArchives = $queries->getData($sql_user_archives);

        return ($getUserArchives);
    }
    public function getUserDeposits($id_user_data, $fecha_1, $fecha_2)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_user_archives = "SELECT dep.*, codigo_proyecto, nombre_proyecto, CONCAT (codigo_proyecto, ' - ', nombre_proyecto) AS proyecto, tgas.descripcion AS tipo_gasto,
        (CONCAT(per.nombres, ' ', per.apellido_paterno, ' ', per.apellido_materno)) AS nombre
        FROM asteleco_viaticos_erp.depositos AS dep
        INNER JOIN asteleco_viaticos_erp.tipos_gasto AS tgas ON dep.id_tipos_gasto = tgas.id_tipos_gasto
        INNER JOIN asteleco_personal.lista_personal AS per ON per.id_lista_personal = dep.id_personal
        INNER JOIN asteleco_proyectos.proyectos AS proy ON proy.id_proyectos = dep.id_proyectos
        WHERE id_personal = '$id_user_data' AND fecha BETWEEN '$fecha_1' AND '$fecha_2'";
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

    public function getProyectsExpenses($proyecto, $fecha_1, $fecha_2)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_proyects_expenses = "SELECT dep.*, codigo_proyecto, nombre_proyecto, CONCAT (codigo_proyecto, ' - ', nombre_proyecto) AS proyecto, tgas.descripcion AS tipo_gasto,
        (CONCAT(per.nombres, ' ', per.apellido_paterno, ' ', per.apellido_materno)) AS nombre
        FROM asteleco_viaticos_erp.depositos AS dep
        INNER JOIN asteleco_viaticos_erp.tipos_gasto AS tgas ON dep.id_tipos_gasto = tgas.id_tipos_gasto
        INNER JOIN asteleco_personal.lista_personal AS per ON per.id_lista_personal = dep.id_personal
        INNER JOIN asteleco_proyectos.proyectos AS proy ON proy.id_proyectos = dep.id_proyectos
        WHERE fecha BETWEEN '$fecha_1' AND '$fecha_2' AND dep.id_proyectos = '$proyecto'";
        //
        $getProyectsExpenses = $queries->getData($sql_proyects_expenses);

        return ($getProyectsExpenses);
    }

    public function getProyectsExpensesByType($tipo, $fecha_1, $fecha_2)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_proyects_expenses = "SELECT gas.*, tgas.descripcion AS tipo_gasto, tgas.id_tipos_gasto,
        stat.descripcion AS estatus,
        rimg.ruta_archivo AS ruta_img,
        rpdf.ruta_archivo AS ruta_pdf,
        CONCAT (codigo_proyecto, ' - ', nombre_proyecto) AS proyecto,
        (CONCAT(per.nombres, ' ', per.apellido_paterno, ' ', per.apellido_materno)) AS nombre
        FROM asteleco_viaticos_erp.gastos AS gas
        INNER JOIN asteleco_viaticos_erp.tipos_gasto AS tgas ON gas.id_tipos_gasto = tgas.id_tipos_gasto
        INNER JOIN asteleco_viaticos_erp.status_type AS stat ON gas.id_status_type = stat.id_status_type
        INNER JOIN asteleco_personal.lista_personal AS per ON per.id_lista_personal = gas.id_personal
        INNER JOIN asteleco_proyectos.proyectos AS proy ON proy.id_proyectos = gas.id_proyectos
        LEFT JOIN asteleco_viaticos_erp.rutas_archivos AS rimg ON rimg.id_rutas_archivos = gas.id_ruta_img
        LEFT JOIN asteleco_viaticos_erp.rutas_archivos AS rpdf ON rpdf.id_rutas_archivos = gas.id_ruta_pdf
        WHERE fecha_registro BETWEEN '$fecha_1' AND '$fecha_2' AND tgas.id_tipos_gasto = '$tipo'";
        //
        $getProyectsExpenses = $queries->getData($sql_proyects_expenses);

        return ($getProyectsExpenses);
    }

    public function getProyectsSpends($proyecto, $fecha_1, $fecha_2)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_proyects_spends = "SELECT gas.*, tgas.descripcion AS tipo_gasto, tgas.id_tipos_gasto,
        stat.descripcion AS estatus,
        rimg.ruta_archivo AS ruta_img,
        rpdf.ruta_archivo AS ruta_pdf,
        CONCAT (codigo_proyecto, ' - ', nombre_proyecto) AS proyecto,
        (CONCAT(per.nombres, ' ', per.apellido_paterno, ' ', per.apellido_materno)) AS nombre
        FROM asteleco_viaticos_erp.gastos AS gas
        INNER JOIN asteleco_viaticos_erp.tipos_gasto AS tgas ON gas.id_tipos_gasto = tgas.id_tipos_gasto
        INNER JOIN asteleco_viaticos_erp.status_type AS stat ON gas.id_status_type = stat.id_status_type
        INNER JOIN asteleco_personal.lista_personal AS per ON per.id_lista_personal = gas.id_personal
        INNER JOIN asteleco_proyectos.proyectos AS proy ON proy.id_proyectos = gas.id_proyectos
        LEFT JOIN asteleco_viaticos_erp.rutas_archivos AS rimg ON rimg.id_rutas_archivos = gas.id_ruta_img
        LEFT JOIN asteleco_viaticos_erp.rutas_archivos AS rpdf ON rpdf.id_rutas_archivos = gas.id_ruta_pdf
        WHERE fecha_registro BETWEEN '$fecha_1' AND '$fecha_2' AND gas.id_proyectos = '$proyecto'";
        //  AND dep.fecha BETWEEN '$fecha_1' AND '$fecha_2'";
        $getProyectsSpends = $queries->getData($sql_proyects_spends);

        return ($getProyectsSpends);
    }

    public function getExpensesTypes()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_proyects_spends = "SELECT DISTINCT tgas.*
         FROM asteleco_viaticos_erp.tipos_gasto AS tgas
         INNER JOIN asteleco_viaticos_erp.gastos AS gas ON gas.id_tipos_gasto = tgas.id_tipos_gasto
          ORDER BY descripcion ASC ";
        //  AND dep.fecha BETWEEN '$fecha_1' AND '$fecha_2'";
        $getProyectsSpends = $queries->getData($sql_proyects_spends);

        return ($getProyectsSpends);
    }

    public function getProyectsUp()
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_proyects = "SELECT DISTINCT proy.*, CONCAT (codigo_proyecto, ' - ', nombre_proyecto) AS proyecto
         FROM asteleco_viaticos_erp.gastos AS gas
         INNER JOIN asteleco_proyectos.proyectos AS proy ON proy.id_proyectos = gas.id_proyectos
         ";
        $getProyects = $queries->getData($sql_proyects);

        return ($getProyects);
    }
}
