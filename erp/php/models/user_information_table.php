<?php

class UserArchives
{
    public function getArchivesCount($id_user_data)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;
        $sql_user_archives = "SELECT
        arc.nombre_archivo,
        arc.ruta_archivo,
        arc.id_archivos_usuarios,
        cat.tipo_archivo,
        cat.html_input_type,
        cat.nombre_archivo AS nombre_catalogo
        FROM asteleco_personal.archivos_usuarios AS arc
        INNER JOIN asteleco_personal.catalogo_archivos AS cat ON arc.id_catalogo_archivos = cat.id_catalogo_archivos
        WHERE cat.id_catalogo_archivos > '1' AND arc.id_lista_personal = '$id_user_data' AND ruta_archivo IS NOT NULL ";
        $getUserArchives = $queries->getData($sql_user_archives);

        return count($getUserArchives);
    }
    public function getProfilePic($id_user_data)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;

        $sql_get_profile_picture = "SELECT
        arc.ruta_archivo
        FROM asteleco_personal.archivos_usuarios AS arc
        INNER JOIN asteleco_personal.catalogo_archivos AS cat ON arc.id_catalogo_archivos = cat.id_catalogo_archivos
        WHERE arc.id_lista_personal = '$id_user_data' AND cat.id_catalogo_archivos = '1'";
        $getProfilePicture = $queries->getData($sql_get_profile_picture);
        $ruta_profile = "images/user_default.png";
        if (!empty($getProfilePicture)) {
            $ruta_profile = $getProfilePicture[0]->ruta_archivo;
        }

        return $ruta_profile;
    }
    public function getInfoTableSendMail($id_user)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;

        $sql_get_profile_picture = "SELECT * FROM asteleco_viaticos_erp.enviar_correos WHERE id_personal = '$id_user' AND enviar = '1'";
        $getProfilePicture = $queries->getData($sql_get_profile_picture);

        return $getProfilePicture;
    }


    public function getMoneyInfo($id_user)
    {
        include_once('php/models/petitions.php');
        $queries = new Queries;

        $month = date('m');
        $year = date('Y');

        $sql_getGastos = "SELECT 
        CASE 
            WHEN SUM(importe) IS NULL THEN '0'
            ELSE SUM(importe)
        END
        AS total_gastos
            FROM asteleco_viaticos_erp.gastos 
            WHERE `id_personal` = '$id_user' AND MONTH(fecha_registro) = '$month' AND YEAR(fecha_registro) = '$year'";
        $getGastos = $queries->getData($sql_getGastos);

        if (!empty($getGastos)) {
            $total_gastos = $getGastos[0]->total_gastos;
        } else {
            $total_gastos = 0;
        }
        $sql_getDepositos = "SELECT 
        CASE 
            WHEN SUM(cantidad) IS NULL THEN '0'
            ELSE SUM(cantidad)
        END
        AS total_depositos
            FROM asteleco_viaticos_erp.depositos 
            WHERE `id_personal` = '$id_user' AND MONTH(fecha) = '$month' AND YEAR(fecha) = '$year'";

        $getDepositos = $queries->getData($sql_getDepositos);

        if (!empty($getDepositos)) {

            $total_depositos = $getDepositos[0]->total_depositos;
        } else {
            $total_depositos = 0;
        }

        $pendiente = $total_depositos - $total_gastos;

        $user_data = array(
            'total_depositos' => $total_depositos,
            'total_gastos' => $total_gastos,
            'pendiente' => $pendiente
        );
        return $user_data;
    }
}
