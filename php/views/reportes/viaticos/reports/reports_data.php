<?php

$sql_get_user_names = "SELECT
        DISTINCT(nombre)
        FROM asteleco_viaticos_old.registros_principal";
$getUsersName = $queries->getData($sql_get_user_names);
