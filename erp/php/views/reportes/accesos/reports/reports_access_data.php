<?php

$sql_get_user_names = "SELECT
        DISTINCT per.id_lista_personal, (CONCAT(per.nombres, ' ', per.apellido_paterno, ' ', per.apellido_materno)) AS nombre
        FROM asteleco_viaticos_erp.gastos AS gas
        INNER JOIN asteleco_personal.lista_personal AS per ON per.id_lista_personal = gas.id_personal ORDER BY nombre ASC";
$getUsersName = $queries->getData($sql_get_user_names);
