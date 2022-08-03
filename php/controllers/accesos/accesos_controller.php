<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}


function getSiteZoneByIDCentral()
{
    $id_central = $_POST['id_central'];

    $queries = new Queries;

    $stmt = "SELECT zce.*
    FROM asteleco_accesos_erp.zonas_central  AS zce
    WHERE zce.id_centrales = $id_central
    ORDER BY descripcion ASC";

    $getInfoRequest = $queries->getData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data'                => $getInfoRequest
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => ''
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function SaveDirectionSite()
{

    $calle_sitio = $_POST['calle_sitio'];
    $sitio_colonia = $_POST['sitio_colonia'];
    $sitio_zipcode = $_POST['sitio_zipcode'];
    $estado_sitio = $_POST['estado_sitio'];
    $municipio_sitio = $_POST['municipio_sitio'];
    $calle_numero_sitio = $_POST['calle_numero_sitio'];
    $referencias_sitio = $_POST['referencias_sitio'];
    $latitud_sitio = $_POST['latitud_sitio'];
    $longitud_sitio = $_POST['longitud_sitio'];

    $queries = new Queries;

    $stmt = "INSERT INTO asteleco_accesos_erp.direcciones_accesos (
        direccion_calle,
        direccion_num_externo,
        direccion_colonia,
        direccion_municipio,
        direccion_estado,
        direccion_zipcode,
        direccion_referencias,
        latitud,
        longitud
        ) VALUES (
        '$calle_sitio',
        '$calle_numero_sitio',
        '$sitio_colonia',
        '$municipio_sitio',
        '$estado_sitio',
        '$sitio_zipcode',
        '$referencias_sitio',
        '$latitud_sitio',
        '$longitud_sitio'
        )";

    $getInfoRequest = $queries->insertData($stmt);
    $last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'last_id' => $last_id
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => ''
        );
        //--- --- ---//
    }

    echo json_encode($data);
}

function SaveNewSite()
{

    $num_sitio_astelecom = $_POST['num_sitio_astelecom'];
    $codigo_sitio = $_POST['codigo_sitio'];
    $nombre_sitio = $_POST['nombre_sitio'];
    $tipo_sitio = $_POST['tipo_sitio'];
    $id_central = $_POST['id_central'];
    $id_zona = $_POST['id_zona'];
    $tipo_cerradura = $_POST['tipo_cerradura'];
    $tipo_perimetro = $_POST['tipo_perimetro'];
    $id_direccion_sitio = $_POST['id_direccion_sitio'];
    $id_propietarios = $_POST['id_propietarios'];

    $queries = new Queries;

    $stmt = "INSERT INTO asteleco_accesos_erp.sitios (
       id_centrales,
       id_zonas_central,
       id_direcciones_accesos,
       id_propietarios,
       id_tipo_perimetro,
       id_tipos_sitio,
       id_tipos_cerraduras,
       codigo_sitio,
       nombre_sitio,
       no_sitio_astelecom,
       logdate
        ) VALUES (
        $id_central,
        $id_zona,
        $id_direccion_sitio,
        $id_propietarios,
        $tipo_perimetro,
        $tipo_sitio,
        $tipo_cerradura,
        '$codigo_sitio',
        '$nombre_sitio',
        '$num_sitio_astelecom',
        NOW()
        )";

    $getInfoRequest = $queries->insertData($stmt);
    $last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'last_id' => $last_id
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => ''
        );
        //--- --- ---//
    }

    echo json_encode($data);
}

function SaveSitePropiety()
{

    $nombre_propietario = $_POST['nombre_propietario'];
    $apellidos_propietario = $_POST['apellidos_propietario'];
    $telefono_prop_1 = $_POST['telefono_prop_1'];
    $numero_prop_2 = $_POST['numero_prop_2'];
    $mail_propietario = $_POST['mail_propietario'];

    $queries = new Queries;

    $stmt = "INSERT INTO asteleco_accesos_erp.propietarios (
       nombres,
         apellidos,
         numero_telefonico,
         numero_alternativo,
         correo_electronico
        ) VALUES (
        '$nombre_propietario',
        '$apellidos_propietario',
        '$telefono_prop_1',
        '$numero_prop_2',
        '$mail_propietario'
        )";

    $getInfoRequest = $queries->insertData($stmt);
    $last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'last_id' => $last_id
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => ''
        );
        //--- --- ---//
    }

    echo json_encode($data);
}

function getFulInfoSite()
{

    $id_site = $_POST['id_sitio'];

    $queries = new Queries;

    $stmt = "SELECT 
    sites.*,
    centrales.nombre_central,
    zonas_central.descripcion AS nombre_zona,
    CONCAT(dirac.direccion_calle, ' ', dirac.direccion_num_externo, ', ', dirac.direccion_colonia, ', ', dirac.direccion_municipio, ', ', dirac.direccion_zipcode, ', ', dirac.direccion_estado) AS direccion_sitio,
    dirac.direccion_referencias,
    dirac.latitud,
    dirac.longitud,
    CASE 
    WHEN prop_site.id_propietarios = '1' THEN 'SIN PROPIETARIO'
    ELSE CONCAT(prop_site.nombres, ' ', prop_site.apellidos) 
    END AS nombre_propietario,
    prop_site.numero_telefonico AS telefono_propietario,
    prop_site.numero_alternativo AS telefono_alternativo_propietario,
    prop_site.correo_electronico AS mail_propietario,
    tip_per.descripcion AS tipo_perimetro,
    tip_sit.descripcion AS tipo_sitio,
    tip_cer.descripcion AS tipo_cerradura,
    status_op.descripcion AS status_operacion
     FROM asteleco_accesos_erp.sitios AS sites
     INNER JOIN asteleco_accesos_erp.centrales AS centrales ON centrales.id_centrales = sites.id_centrales
     INNER JOIN asteleco_accesos_erp.zonas_central AS zonas_central ON zonas_central.id_zonas_central = sites.id_zonas_central
     INNER JOIN asteleco_accesos_erp.direcciones_accesos AS dirac ON dirac.id_direcciones_accesos = sites.id_direcciones_accesos
     INNER JOIN asteleco_accesos_erp.propietarios AS prop_site ON prop_site.id_propietarios = sites.id_propietarios
    INNER JOIN asteleco_accesos_erp.tipo_perimetro AS tip_per ON tip_per.id_tipo_perimetro = sites.id_tipo_perimetro
    INNER JOIN asteleco_accesos_erp.tipos_sitio AS tip_sit ON tip_sit.id_tipos_sitio = sites.id_tipos_sitio
    INNER JOIN asteleco_accesos_erp.tipos_cerraduras AS tip_cer ON tip_cer.id_tipos_cerraduras = sites.id_tipos_cerraduras
    INNER JOIN asteleco_accesos_erp.status_operaciones AS status_op ON status_op.id_status_operaciones = sites.status
    WHERE sites.id_sitios = $id_site";

    $getInfoRequest = $queries->getData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'data' => $getInfoRequest
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => ''
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function getGabinetesInfo()
{

    $id_site = $_POST['id_sitio'];

    $queries = new Queries;

    $stmt = "SELECT gab.*, cerr.descripcion AS cerradura
    FROM asteleco_accesos_erp.gabinetes AS gab 
    INNER JOIN asteleco_accesos_erp.tipos_cerraduras AS cerr ON cerr.id_tipos_cerraduras = gab.id_tipos_cerraduras
    WHERE gab.id_sitios = $id_site";

    $getInfoRequest = $queries->getData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {
        $html_gabinetes = '';
        foreach ($getInfoRequest as $gabinetes) {


            $html_gabinetes .= '<div class="col-md-4"  id="gab' . $gabinetes->id_gabinetes . '">';
            $html_gabinetes .= '<div class="card border-secondary border">';
            $html_gabinetes .= '<div class="card-body">';
            $html_gabinetes .= '<h5 class="card-title">' . $gabinetes->nombre_gabinete . '          <span class="badge badge-outline-warning editGabineteNombre"  data-id-gabinete="' . $gabinetes->id_gabinetes . '"><i class="dripicons-pencil"></i></span></h5>';
            $html_gabinetes .= '<p class="card-text">Baterías: ' . $gabinetes->baterias_gabinete . '          <span class="badge badge-outline-warning editGabineteBaterias"  data-id-gabinete="' . $gabinetes->id_gabinetes . '"><i class="dripicons-pencil"></i></span></p>';
            //$html_gabinetes .= '<p class="card-text">Estado: óptimo</p>';
            $html_gabinetes .= '<button type="button" class="btn btn-danger deleteGabinete" data-id-gabinete="' . $gabinetes->id_gabinetes . '"><i class="uil uil-trash-alt"></i></button>';
            $html_gabinetes .= '</div>';
            $html_gabinetes .= '</div>';
            $html_gabinetes .= '</div>';
        }
        //--- --- ---//
        $data = array(
            'response' => true,
            'data' => $getInfoRequest,
            'html' => $html_gabinetes
        );
        //--- --- ---//
    } else {
        $html_gabinetes = '<div class="col-md-12">';
        $html_gabinetes .= '<div class="card-body">';
        $html_gabinetes .= '<div class="card">';
        $html_gabinetes .= '<h3 class="card-title">No hay gabinetes registrados</h3>';
        $html_gabinetes .= '</div>';
        $html_gabinetes .= '</div>';
        $html_gabinetes .= '</div>';

        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => '',
            'html' => $html_gabinetes
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function getSiteContactOwner()
{

    $id_site = $_POST['id_sitio'];

    $queries = new Queries;

    $stmt = "SELECT prop.*
    FROM asteleco_accesos_erp.propietarios AS prop 
    INNER JOIN asteleco_accesos_erp.sitios AS sites ON sites.id_propietarios = prop.id_propietarios
    WHERE sites.id_sitios = $id_site";

    $getInfoRequest = $queries->getData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {
        $html_owner_info = '';
        foreach ($getInfoRequest as $owner) {


            $html_owner_info .= '<div class="mt-3">';
            $html_owner_info .= '<hr class="">';
            $html_owner_info .= '<p class="mt-4 mb-1"><strong><i class="uil uil-user"></i> Nombre:</strong></p>';
            $html_owner_info .= '<p>' . $owner->nombres . ' ' . $owner->apellidos . '    <span class="badge badge-outline-warning editOwnerName" data-id-owner="' . $owner->id_propietarios . '"><i class="dripicons-pencil"></i></span></p>';
            $html_owner_info .= '<p class="mt-3 mb-1"><strong><i class="uil uil-phone"></i> Número de teléfono:</strong></p>';
            $html_owner_info .= '<p> ' . $owner->numero_telefonico . '    <span class="badge badge-outline-warning editOwnerPhone"  data-id-owner="' . $owner->id_propietarios . '"><i class="dripicons-pencil"></i></span></p>';
            $html_owner_info .= '<p class="mt-3 mb-1"><strong><i class="uil uil-fast-mail"></i> Correo electrónico:</h4></strong></p>';

            $html_owner_info .= '<p> ' . $owner->correo_electronico . '      <span class="badge badge-outline-warning editOwnerMail"  data-id-owner="' . $owner->id_propietarios . '"><i class="dripicons-pencil"></i></span></p>';
            $html_owner_info .= '</div>';
        }
        //--- --- ---//
        $data = array(
            'response' => true,
            'data' => $getInfoRequest,
            'html' => $html_owner_info
        );
        //--- --- ---//
    } else {
        $html_owner_info = '<div class="col-md-12">';
        $html_owner_info .= '<div class="card-body">';
        $html_owner_info .= '<div class="card">';
        $html_owner_info .= '<h3 class="card-title">No hay información de contacto registrada</h3>';
        $html_owner_info .= '</div>';
        $html_owner_info .= '</div>';
        $html_owner_info .= '</div>';

        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => '',
            'html' => $html_owner_info
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function editSiteName()
{

    $id_sitio = $_POST['id_sitio'];
    $column_name = $_POST['column_name'];
    $site_code = $_POST['site_code'];
    $site_name = $_POST['site_name'];
    $queries = new Queries;

    $stmt = "UPDATE asteleco_accesos_erp.sitios SET nombre_sitio = '$site_name', codigo_sitio = '$site_code' 
    WHERE id_sitios = $id_sitio";

    $getInfoRequest = $queries->InsertData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {

        //--- --- ---//
        $data = array(
            'response' => true,
            'data' => $getInfoRequest
        );
        //--- --- ---//
    } else {


        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => ''
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function getZonesByCentral()
{

    $id_central = $_POST['id_central'];

    $queries = new Queries;

    $stmt = "SELECT *
    FROM asteleco_accesos_erp.zonas_central
    WHERE id_centrales = $id_central";

    $getInfoRequest = $queries->getData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {

        //--- --- ---//
        $data = array(
            'response' => true,
            'data' => $getInfoRequest
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'No se encontraron zonas para esta central',
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function getSitesByCentral()
{

    $id_central = $_POST['id_central'];

    $queries = new Queries;

    $stmt = "SELECT *
    FROM asteleco_accesos_erp.sitios
    WHERE id_centrales = $id_central";

    $getInfoRequest = $queries->getData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {

        //--- --- ---//
        $data = array(
            'response' => true,
            'data' => $getInfoRequest
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'No se encontraron sitios para esta central',
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function getSitesByZone()
{

    $id_zonas_central = $_POST['id_zona'];

    $queries = new Queries;

    $stmt = "SELECT *
    FROM asteleco_accesos_erp.sitios
    WHERE id_zonas_central = $id_zonas_central";

    $getInfoRequest = $queries->getData($stmt);
    //$last_id = $getInfoRequest['last_id'];
    if (!empty($getInfoRequest)) {

        //--- --- ---//
        $data = array(
            'response' => true,
            'data' => $getInfoRequest
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => 'No se encontraron sitios para esta zona',
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function saveGabinete()
{
    $id_sitio = $_POST['id_sitio'];
    $nombre_gabinete = $_POST['nombre_gabinete'];
    $baterias_gabinete = $_POST['baterias_gabinete'];
    $cerraduras_gabinetes = $_POST['cerraduras_gabinetes'];

    $queries = new Queries;

    $stmt = "INSERT INTO asteleco_accesos_erp.gabinetes
             (id_sitios,
             id_tipos_cerraduras,
             nombre_gabinete,
             baterias_gabinete) VALUES
             ($id_sitio,
             $cerraduras_gabinetes,
             '$nombre_gabinete',
             $baterias_gabinete)";



    if ($getInfoRequest = $queries->insertData($stmt)) {
        $last_id = $getInfoRequest['last_id'];
        //--- --- ---//
        $data = array(
            'response' => true,
            'message' => 'Se ha guardado el gabinete correctamente',
            'last_id' => $last_id
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message' => 'No se pudo guardar el gabinete'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function getGabinetesStio()
{
    $id_sitio = $_POST['id_sitio'];

    $queries = new Queries;
    $getAccessGates = array();
    $stmt = "SELECT *, tip_cer.descripcion AS cerradura 
    FROM asteleco_accesos_erp.gabinetes AS gab
    INNER JOIN asteleco_accesos_erp.tipos_cerraduras AS tip_cer ON tip_cer.id_tipos_cerraduras = gab.id_tipos_cerraduras
    WHERE gab.id_sitios = $id_sitio";

    $stmt_puertas_acceso = "SELECT * FROM asteleco_accesos_erp.cerraduras_sitios WHERE id_sitios = $id_sitio";
    $getAccessGates = $queries->getData($stmt_puertas_acceso);

    $stmt_electricidad = "SELECT at_torre, at_centro_carga, at_escalerilla,
    planta_emergencia, breaker_principal, breakers_existentes, status
                          FROM asteleco_accesos_erp.sitios WHERE id_sitios = $id_sitio";
    $getElectricity = $queries->getData($stmt_electricidad);

    $stmt_get_perimetro_limpieza = "SELECT 
    per.id_tipo_perimetro,
    lim.id_tipos_limpieza,
    per.descripcion AS perimetro,
    lim.descripcion AS limpieza
    FROM asteleco_accesos_erp.sitios AS sit
    INNER JOIN asteleco_accesos_erp.tipo_perimetro AS per ON per.id_tipo_perimetro = sit.perimetro
    INNER JOIN asteleco_accesos_erp.tipos_limpieza AS lim ON lim.id_tipos_limpieza = sit.limpieza
    WHERE id_sitios = $id_sitio";
    $getPerimLimp = $queries->getData($stmt_get_perimetro_limpieza);



    $html_gabinetes = '';
    if (!empty($getInfoRequest = $queries->getData($stmt))) {
        foreach ($getInfoRequest as $gabinetes) {
            $id_gabinete = $gabinetes->id_gabinetes;
            $nombre_gabinete = $gabinetes->nombre_gabinete;
            $baterias_gabinete = $gabinetes->baterias_gabinete;
            $cerradura = $gabinetes->cerradura;

            $html_gabinetes .= '<div class="col-md-6" id="divGabinete' . $id_gabinete . '">';
            $html_gabinetes .= '<div class="card border-primary border">';
            $html_gabinetes .= '<div class="card-body">';
            $html_gabinetes .= '<h5 class="card-title text-primary">'  . $nombre_gabinete .  '</h5>';
            $html_gabinetes .= '<p class="card-text">';
            $html_gabinetes .= 'Baterías: "' . $baterias_gabinete;
            $html_gabinetes .= '</p>';
            $html_gabinetes .= '<p class="card-text">';
            $html_gabinetes .= 'Cerradura: ' . $cerradura;
            $html_gabinetes .= '</p>';
            $html_gabinetes .= '<button type="button" class="btn btn-light deleteGabinete" data-id-gabinete="' . $id_gabinete . '" title="Eliminar"><i class="mdi mdi-trash-can"></i> </button>';
            $html_gabinetes .= '</div>';
            $html_gabinetes .= '</div>';
            $html_gabinetes .= '</div>';
        }
        //--- --- ---//
        $data = array(
            'response' => true,
            'html_gabinetes' => $html_gabinetes,
            'access_gates' => $getAccessGates,
            'electricity' => $getElectricity,
            'perim_limp' => $getPerimLimp
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'html_gabinetes' => $html_gabinetes,
            'access_gates' => $getAccessGates,
            'electricity' => $getElectricity,
            'perim_limp' => $getPerimLimp,
            'message' => 'No se encontraron gabinetes para este sitio'
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function deleteGabinete()
{
    $id_gabinete = $_POST['id_gabinete'];

    $queries = new Queries;

    $stmt = "DELETE FROM asteleco_accesos_erp.gabinetes WHERE id_gabinetes = $id_gabinete";
    if ($getInfoRequest = $queries->insertData($stmt)) {
        //$last_id = $getInfoRequest['last_id'];
        //--- --- ---//
        $data = array(
            'response' => true
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function updateCerradurasSitio()
{

    $id_sitio = $_POST['id_sitio'];
    $id_tipos_cerraduras = $_POST['id_tipos_cerraduras'];
    $id_puertas_acceso = $_POST['id_puertas_acceso'];

    $queries = new Queries;

    $stmt = "SELECT * FROM asteleco_accesos_erp.cerraduras_sitios WHERE id_sitios = $id_sitio AND id_puertas_de_acceso = $id_puertas_acceso";
    $getInfoRequest = $queries->getData($stmt);

    if (!empty($getInfoRequest)) {
        $stmt = "UPDATE asteleco_accesos_erp.cerraduras_sitios 
        SET
        id_tipos_cerraduras = $id_tipos_cerraduras
        WHERE id_sitios = $id_sitio AND id_puertas_de_acceso = $id_puertas_acceso
        ";
    } else {
        $stmt = "INSERT INTO 
        asteleco_accesos_erp.cerraduras_sitios
         (id_sitios, id_tipos_cerraduras, id_puertas_de_acceso) 
         VALUES ($id_sitio, $id_tipos_cerraduras, $id_puertas_acceso)";
    }

    if ($getInfoRequest = $queries->insertData($stmt)) {
        //$last_id = $getInfoRequest['last_id'];
        //--- --- ---//
        $data = array(
            'response' => true
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function updateSiteElectricity()
{

    $id_sitio = $_POST['id_sitio'];
    $attr_bd = $_POST['attr_bd'];
    $table = $_POST['table'];

    $queries = new Queries;

    $stmt = "UPDATE asteleco_accesos_erp.sitios SET $table = $attr_bd WHERE id_sitios = $id_sitio";
    if ($getInfoRequest = $queries->insertData($stmt)) {
        //$last_id = $getInfoRequest['last_id'];
        //--- --- ---//
        $data = array(
            'response' => true
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false
        );
        //--- --- ---//
    }
    echo json_encode($data);
}
function updateStatusVandalismo()
{

    $id_sitio = $_POST['id_sitio'];
    $attr_bd = $_POST['attr_bd'];
    $id_status_operaciones = $_POST['id_status_operaciones'];
    $id_user = $_POST['id_user'];
    $today = date("Y-m-d");

    $queries = new Queries;

    $stmt = "UPDATE asteleco_accesos_erp.sitios SET status = $id_status_operaciones WHERE id_sitios = $id_sitio";
    if ($getInfoRequest = $queries->insertData($stmt)) {
        $check_stmt = "SELECT * FROM asteleco_accesos_erp.vandalismos 
        WHERE id_sitios = $id_sitio AND DATE(datelog) = '$today'";
        $getInfoRequest = $queries->getData($check_stmt);
        if (empty($getInfoRequest)) {
            $stmt = "INSERT INTO asteleco_accesos_erp.vandalismos(
                id_personal, status, id_sitios, id_status_operaciones, datelog
            ) VALUES(
                $id_user,
                $attr_bd,
                $id_sitio,
                $id_status_operaciones,
                NOW()
            )";
            if ($getInfoRequest = $queries->insertData($stmt)) {
                //$last_id = $getInfoRequest['last_id'];
                //--- --- ---//
                $data = array(
                    'response' => true
                );
                //--- --- ---//
            } else {
                //--- --- ---//
                $data = array(
                    'response' => false
                );
                //--- --- ---//
            }
        } else {
            $stmt = "UPDATE asteleco_accesos_erp.vandalismos 
            SET
            id_personal = $id_user,
            status = $attr_bd,
            id_sitios = $id_sitio,
            id_status_operaciones = $id_status_operaciones,
            datelog = NOW()
            WHERE id_sitios = $id_sitio AND DATE(datelog) = '$today'
            ";
            if ($getInfoRequest = $queries->insertData($stmt)) {
                //$last_id = $getInfoRequest['last_id'];
                //--- --- ---//
                $data = array(
                    'response' => true
                );
                //--- --- ---//
            } else {
                //--- --- ---//
                $data = array(
                    'response' => false
                );
                //--- --- ---//
            }
        }
    } else {
        //--- --- ---//
        $data = array(
            'response' => false
        );
        //--- --- ---//
    }
    echo json_encode($data);
}
function saveIdentificacionProveedor()
{

    $folder = $_POST['folder'];
    $module_name = $_POST['module_name'];
    //$file_name = $_POST['name'];
    $extension_file = basename($_FILES["formData"]["type"]);
    $file_name = $folder . "_" . time() . ".$extension_file";

    //$route = '/xampp/htdocs/documentos_alumnos/' . $_POST['student'] . '/' . $folder;
    $route2 =  dirname(__DIR__ . '', 3) . '/uploads/' . $module_name . "/" . $folder . "/";
    $route =  dirname(__DIR__ . '', 3) . '/uploads/' . $module_name . "/" . $folder . "/" . $file_name;
    $route_db = '/uploads/' . $module_name . '/' . $folder . "/" . $file_name;
    if (!file_exists($route2)) {
        mkdir($route2, 0777, true);
    }
    if (move_uploaded_file($_FILES["formData"]["tmp_name"], $route)) {

        $queries = new Queries;
        $data = array(
            'response' => true,
            'message' => 'Se cargó correctamente el archivo',
        );
        $stmt = "INSERT INTO asteleco_accesos_erp.rutas_archivos_accesos (
            nombre_archivo,
            ruta_archivo,
            tipo_archivo,
            log_fecha_registro
        ) VALUES
        (
            '$file_name',
            '$route_db',
            '$extension_file',
            NOW())";
        $last_id = 0;
        $getInfoRequest = $queries->insertData($stmt);
        $last_id = $getInfoRequest['last_id'];

        if ($last_id = !0) {
            $last_id_arch = $getInfoRequest['last_id'];
            $data = array(
                'response' => true,
                'message' => 'Se cargó correctamente el archivo',
                'id_archivo' => $last_id_arch
            );
        } else {
            $data = array(
                'response' => false,
                'message' => 'No se pudo cargar el archivo',
            );
        }
    } else {
        $data = array(
            'response' => false,
            'message' => 'No se pudo cargar el archivo',
        );
    }
    // echo $file_name;

    //$move = '';

    /* 
    $file = $route . '/' . $file_name;

    if (!file_exists($route)) {
        mkdir($route, 0777, true);
    }

    if (move_uploaded_file($_FILES['formData']['tmp_name'], $file)) {

        $response = 1;

        $movement = array(
            'movimiento'        => $move,
            'curp'              => $_POST['student'],
            'documento'         => $file_name
        );
        $movement = json_encode($movement);
        setLog(module, $movement, $_SESSION['colab']);
    }

    $data['response'] = $response;
     */
    echo json_encode($data);
}

function saveAcceso()
{

    $id_sitio = $_POST['id_sitio'];
    $empresa = $_POST['empresa'];
    $actividad = $_POST['actividad'];
    $fecha = date('Y-m-d');
    $hora_ingreso = $_POST['hora_ingreso'];
    $proveedor = $_POST['proveedor'];
    $ayudantes = $_POST['ayudantes'];
    $firma_b64 = $_POST['firma_b64'];
    $hora_salida = $_POST['hora_salida'];
    $comentarios = $_POST['comentarios'];
    $id_imagen = $_POST['id_imagen'];
    $id_user = $_POST['id_user'];

    $queries = new Queries;
    
    $stmt_get_info_site = "SELECT 
        vandal.descripcion as descripcion_vandalismo,
        tip.descripcion as limpieza_tipo,
        breakers_existentes,
        at_torre,
        at_centro_carga,
        at_escalerilla,
        breaker_principal
        FROM asteleco_accesos_erp.sitios AS sit
        INNER JOIN asteleco_accesos_erp.tipos_limpieza AS tip ON tip.id_tipos_limpieza = sit.limpieza
        INNER JOIN asteleco_accesos_erp.status_operaciones AS vandal ON vandal.id_status_operaciones = sit.status
        WHERE sit.id_sitios = $id_sitio";
    $get_info_site = $queries->getData($stmt_get_info_site);
    if (!empty($get_info_site)) {
        $status_acceso = "1";
        $breaker_principal = $get_info_site[0]->breaker_principal;
        $at_torre = $get_info_site[0]->at_torre;
        $at_escalerilla = $get_info_site[0]->at_escalerilla;
        $at_centro_carga = $get_info_site[0]->at_centro_carga;
        $breakers_existentes = $get_info_site[0]->breakers_existentes;
        $limpieza_tipo = $get_info_site[0]->limpieza_tipo;
        $descripcion_vandalismo = $get_info_site[0]->descripcion_vandalismo;
    }
    $stmt_puertas_acceso_principal = "SELECT 
       tc.descripcion 
       FROM  asteleco_accesos_erp.cerraduras_sitios AS cs
       INNER JOIN asteleco_accesos_erp.tipos_cerraduras AS tc ON tc.id_tipos_cerraduras = cs.id_tipos_cerraduras
       WHERE cs.id_sitios = $id_sitio AND cs.id_puertas_de_acceso = 1";
    $get_puertas_acceso_principal = $queries->getData($stmt_puertas_acceso_principal);
    if (!empty($get_puertas_acceso_principal)) {
        $puertas_acceso_principal = $get_puertas_acceso_principal[0]->descripcion;
    } else {
        $puertas_acceso_principal = "";
    }

    $stmt_puertas_acceso_vehicular = "SELECT 
       tc.descripcion 
       FROM  asteleco_accesos_erp.cerraduras_sitios AS cs
       INNER JOIN asteleco_accesos_erp.tipos_cerraduras AS tc ON tc.id_tipos_cerraduras = cs.id_tipos_cerraduras
       WHERE cs.id_sitios = $id_sitio AND cs.id_puertas_de_acceso = 2";
    $get_puertas_acceso_vehicular = $queries->getData($stmt_puertas_acceso_vehicular);
    if (!empty($get_puertas_acceso_vehicular)) {
        $puertas_acceso_vehicular = $get_puertas_acceso_vehicular[0]->descripcion;
    } else {
        $puertas_acceso_vehicular = "";
    }
    $stmt_puertas_acceso_centro_carga = "SELECT 
       tc.descripcion 
       FROM  asteleco_accesos_erp.cerraduras_sitios AS cs
       INNER JOIN asteleco_accesos_erp.tipos_cerraduras AS tc ON tc.id_tipos_cerraduras = cs.id_tipos_cerraduras
       WHERE cs.id_sitios = $id_sitio AND cs.id_puertas_de_acceso = 3";
    $get_puertas_acceso_centro_carga = $queries->getData($stmt_puertas_acceso_centro_carga);
    if (!empty($get_puertas_acceso_centro_carga)) {
        $puertas_acceso_centro_carga = $get_puertas_acceso_centro_carga[0]->descripcion;
    } else {
        $puertas_acceso_centro_carga = "";
    }
    $stmt_puertas_acceso_contenedor = "SELECT 
       tc.descripcion 
       FROM  asteleco_accesos_erp.cerraduras_sitios AS cs
       INNER JOIN asteleco_accesos_erp.tipos_cerraduras AS tc ON tc.id_tipos_cerraduras = cs.id_tipos_cerraduras
       WHERE cs.id_sitios = $id_sitio AND cs.id_puertas_de_acceso = 4";
    $get_puertas_acceso_contenedor = $queries->getData($stmt_puertas_acceso_contenedor);
    if (!empty($get_puertas_acceso_contenedor)) {
        $puertas_acceso_contenedor = $get_puertas_acceso_contenedor[0]->descripcion;
    } else {
        $puertas_acceso_contenedor = "";
    }

    $stmt = "INSERT INTO asteleco_accesos_erp.accesos (
            id_sitios,
            id_personal_as,
            empresa,
            fecha,
            hora,
            hora_salida,
            actividad,
            lider_cuadrilla,
            ayudantes,
            status_acceso,
            breaker_principal,
            at_torre,
            at_escalerilla,
            at_centro_carga,
            breakers_existentes,
            comentarios,
            limpieza,
            vandalismo,
            acceso_principal,
            acceso_vehicular,
            centro_carga,
            contenedor,
            id_rutas_archivos_accesos
        ) VALUES
        (
            $id_sitio,
            $id_user,
            '$empresa',
            '$fecha',
            '$hora_ingreso',
            '$hora_salida',
            '$actividad',
            '$proveedor',
            '$ayudantes',
            '$status_acceso',
            '$breaker_principal',
            '$at_torre',
            '$at_escalerilla',
            '$at_centro_carga',
            '$breakers_existentes',
            '$comentarios',
            '$limpieza_tipo',
            '$descripcion_vandalismo',
            '$puertas_acceso_principal',
            '$puertas_acceso_vehicular',
            '$puertas_acceso_centro_carga',
            '$puertas_acceso_contenedor',
            $id_imagen
        )";

    $last_id = 0;
    $getInfoRequest = $queries->insertData($stmt);
    $id_accesos = $getInfoRequest['last_id'];
    $last_id = $id_accesos;
    $stmt = "INSERT INTO asteleco_accesos_erp.firmas_accesos (
        id_accesos,
        firma_base_64
    ) VALUES(
        '$id_accesos',
        '$firma_b64'
    )";
    $getInfoRequest = $queries->insertData($stmt);

    if ($last_id = !0) {
        $data = array(
            'response' => true,
            'message' => 'Se registro el acceso correctamente',
            'id_archivo' => $last_id
        );
    } else {
        $data = array(
            'response' => false,
            'message' => 'No se pudo registrar el acceso'
        );
    }

    echo json_encode($data);
}
