<?php
require('fpdf.php');
$id_acceso = $_GET['id_acceso'];

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $id_acceso = $_GET['id_acceso'];
        if (strlen($id_acceso) == 1) {
            $folio_acceso = 'FOLIO: ACC-000' . $id_acceso;
        } else if (strlen($id_acceso) == 2) {
            $folio_acceso = 'FOLIO: ACC-00' . $id_acceso;
        } else if (strlen($id_acceso) == 3) {
            $folio_acceso = 'FOLIO: ACC-0' . $id_acceso;
        } else if (strlen($id_acceso) == 4) {
            $folio_acceso = 'FOLIO: ACC-' . $id_acceso;
        }

        // Logo
        // Arial bold 15
        $this->SetFont('Arial', 'B', 19);
        // Movernos a la derecha
        $this->Cell(75);
        // Título
        //$this->Cell(LARGO,ALTO,'Check - List',BORDE,0,'C');
        $this->Cell(25, 5, 'Check - List', 0, 0, 'C');
        $this->Ln(18);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(25, 5, $folio_acceso, 0, 0, 'C');
        $this->Ln(10);
        $this->Image('../../../images/aslogo.png', 155, 8, 33);
        $this->Image('../../../images/logo_telcel.png', 10, 10, 38);


        // Salto de línea
        $this->Ln(5);
    }

    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-24);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Al firmar este documento el proveedor se hace completamente responsable del equipo e instalaciones.'), 0, 1, 'C');
        $this->Ln(5);
        $fecha_checklist = date("d / m / Y");
        $this->SetFont('Arial', 'I', 6);
        $this->Write(5, utf8_decode('Fecha de emisión:' . $fecha_checklist));
    }
}



include("../../models/accesos/checlist_model.php");

$pdf = new PDF();
$accesos = new Access;

$getAccesos = $accesos->getAccesoByID($id_acceso);


foreach ($getAccesos as $acceso) {
    $pdf->AddPage();


    $pdf->SetLineWidth(0.5);
    $pdf->SetDrawColor(11, 16, 156);



    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(46, 7, "" . utf8_decode('Código y nombre del sitio:'), 'LTB', 0, 'L', 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(85, 7, "" . utf8_decode($acceso->sitio), 'RTB', 0, 'L', 0);


    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(13, 7, "" . utf8_decode(' Fecha:'), 'LTB', 0, 'L', 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(37, 7, "" . utf8_decode($acceso->fecha), 'RTB', 1, 'L', 0);



    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(31, 7, utf8_decode(' Actividad:'), 'LTB', 0, 'L', 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(50, 7, "" . utf8_decode($acceso->actividad), 'RTB', 0, 'L', 0);

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(30, 7, "" . utf8_decode('Hora de entrada:'), 'LTB', 0, 'L', 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(20, 7, "" . utf8_decode($acceso->hora), 'RTB', 0, 'L', 0);
    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(30, 7, "" . utf8_decode('Hora de salida:'), 'LTB', 0, 'L', 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(20, 7, "" . utf8_decode($acceso->hora_salida), 'RTB', 1, 'L', 0);

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(47, 7, utf8_decode('Responsable ASTELECOM:'), 'LTB', 0, 'L', 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(50, 7, "" . utf8_decode($acceso->personal_as), 'RTB', 0, 'L', 0);

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(43, 7, utf8_decode(' Responsable Proveedor:'), 'LTB', 0, 'L', 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(41, 7, "" . utf8_decode($acceso->lider_cuadrilla), 'RTB', 1, 'L', 0);

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(18, 7, utf8_decode(' Empresa:'), 'LTB', 0, 'L', 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(55, 7, "" . utf8_decode($acceso->empresa), 'RTB', 0, 'L', 0);
    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(15, 7, utf8_decode(' Zona:'), 'LTB', 0, 'L', 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(45, 7, "" . utf8_decode($acceso->nombre_central), 'RTB', 0, 'L', 0);
    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(15, 7, utf8_decode(' Central:'), 'LTB', 0, 'L', 0);
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(33, 7, "" . utf8_decode($acceso->zona), 'RTB', 1, 'L', 0);

    $pdf->Cell(200, 7, utf8_decode(' '), '', 1, 'L', 0);


    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(90, 7, utf8_decode(' Componentes y Estado del Sitio Indoor'), 'LRTB', 0, 'C', 0);
    $pdf->Cell(91, 7, utf8_decode(' Componentes y Estado del Sitio Outdoor'), 'LRTB', 1, 'C', 0);
    if ($acceso->id_tipos_sitio == "1") {
        $pdf->SetFont('Helvetica', 'B', 7);
        $pdf->Cell(45, 5, utf8_decode(' Acceso Prinicpal:'), 'LT', 0, 'C', 0);
        /* 
        $getAPRIinfo = $accesos->getAPinfo($acceso->id_sitios, '1');
        if (!empty($getAPRIinfo)) {
            $acc_pr = $getAPRIinfo[0]->cerradura;
        } else {
            $acc_pr = "SIN INFO.";
        }
        $pdf->Cell(45, 5, utf8_decode($acc_pr), 'LTR', 0, 'C', 0); */


        $pdf->Cell(45, 5, utf8_decode($acceso->acceso_principal), 'LTR', 0, 'C', 0);



        $pdf->Cell(45, 5, utf8_decode(' Acceso Prinicpal:'), 'LT', 0, 'C', 0);
        $pdf->Cell(46, 5, utf8_decode('N/A'), 'LTBR', 1, 'C', 0);


        $getAPRIinfo = $accesos->getAPinfo($acceso->id_sitios, '2');
        if (!empty($getAPRIinfo)) {
            $acc_vh = $getAPRIinfo[0]->cerradura;
        } else {
            $acc_vh = "SIN INFO.";
        }
        $pdf->Cell(45, 5, utf8_decode(' Acceso Vehícular:'), 'LTR', 0, 'C', 0);
        $pdf->Cell(45, 5, utf8_decode($acc_vh), 'LTB', 0, 'C', 0);

        $pdf->Cell(45, 5, utf8_decode(' Acceso Vehícular:'), 'LT', 0, 'C', 0);
        $pdf->Cell(46, 5, utf8_decode(' N/A'), 'LTR', 1, 'C', 0);

        $getAPRIinfo = $accesos->getAPinfo($acceso->id_sitios, '3');
        if (!empty($getAPRIinfo)) {
            $acc_cc = $getAPRIinfo[0]->cerradura;
        } else {
            $acc_cc = "SIN INFO.";
        }
        $pdf->Cell(45, 5, utf8_decode(' Centro de carga:'), 'LT', 0, 'C', 0);
        $pdf->Cell(45, 5, utf8_decode($acceso->centro_carga), 'LTB', 0, 'C', 0);

        $pdf->Cell(45, 5, utf8_decode(' Centro de carga:'), 'LT', 0, 'C', 0);
        $pdf->Cell(46, 5, utf8_decode(' N/A'), 'LTR', 1, 'C', 0);

        $getAPRIinfo = $accesos->getAPinfo($acceso->id_sitios, '4');
        if (!empty($getAPRIinfo)) {
            $acc_cen_c = $getAPRIinfo[0]->cerradura;
        } else {
            $acc_cen_c = "SIN INFO.";
        }
        $pdf->Cell(45, 5, utf8_decode(' Contnedor:'), 'LTB', 0, 'C', 0);
        $pdf->Cell(45, 5, utf8_decode($acceso->contenedor), 'LTB', 0, 'C', 0);
        $pdf->Cell(45, 5, utf8_decode(' Contnedor:'), 'LTB', 0, 'C', 0);
        $pdf->Cell(46, 5, utf8_decode(' N/A'), 'LTRB', 1, 'C', 0);
    } else {
        $pdf->SetFont('Helvetica', 'B', 7);
        $pdf->Cell(45, 5, utf8_decode(' Acceso Prinicpal:'), 'LT', 0, 'C', 0);
        $pdf->Cell(45, 5, utf8_decode(' N/A'), 'LT', 0, 'C', 0);

        $getAPRIinfo = $accesos->getAPinfo($acceso->id_sitios, '1');
        if (!empty($getAPRIinfo)) {
            $acc_pr = $getAPRIinfo[0]->cerradura;
        } else {
            $acc_pr = "SIN INFO.";
        }
        $pdf->Cell(45, 5, utf8_decode(' Acceso Prinicpal:'), 'LT', 0, 'C', 0);
        $pdf->Cell(46, 5, utf8_decode($acc_pr), 'LTR', 1, 'C', 0);


        $pdf->Cell(45, 5, utf8_decode(' Acceso Vehícular:'), 'LT', 0, 'C', 0);
        $pdf->Cell(45, 5, utf8_decode(' N/A'), 'LT', 0, 'C', 0);

        $getAPRIinfo = $accesos->getAPinfo($acceso->id_sitios, '2');
        if (!empty($getAPRIinfo)) {
            $acc_vh = $getAPRIinfo[0]->cerradura;
        } else {
            $acc_vh = "SIN INFO.";
        }
        $pdf->Cell(45, 5, utf8_decode(' Acceso Vehícular:'), 'LT', 0, 'C', 0);
        $pdf->Cell(46, 5, utf8_decode($acc_vh), 'LTR', 1, 'C', 0);

        $pdf->Cell(45, 5, utf8_decode(' Centro de carga:'), 'LT', 0, 'C', 0);
        $pdf->Cell(45, 5, utf8_decode(' N/A'), 'LT', 0, 'C', 0);

        $getAPRIinfo = $accesos->getAPinfo($acceso->id_sitios, '3');
        if (!empty($getAPRIinfo)) {
            $acc_cc = $getAPRIinfo[0]->cerradura;
        } else {
            $acc_cc = "SIN INFO.";
        }
        $pdf->Cell(45, 5, utf8_decode(' Centro de carga:'), 'LT', 0, 'C', 0);
        $pdf->Cell(46, 5, utf8_decode($acc_cc), 'LTR', 1, 'C', 0);


        $pdf->Cell(45, 5, utf8_decode(' Contnedor:'), 'LT', 0, 'C', 0);
        $pdf->Cell(45, 5, utf8_decode(' N/A'), 'LT', 0, 'C', 0);

        $getAPRIinfo = $accesos->getAPinfo($acceso->id_sitios, '4');
        if (!empty($getAPRIinfo)) {
            $acc_cen_c = $getAPRIinfo[0]->cerradura;
        } else {
            $acc_cen_c = "SIN INFO.";
        }
        $pdf->Cell(45, 5, utf8_decode(' Contnedor:'), 'LT', 0, 'C', 0);
        $pdf->Cell(46, 5, utf8_decode($acc_cen_c), 'LTR', 1, 'C', 0);
    }
    $pdf->Cell(200, 7, utf8_decode(' '), '', 1, 'L', 0);


    $getLogGabinetes = $accesos->getLogGabinetes($acceso->id_accesos);
    $pdf->SetFont('Helvetica', 'B', 12);
    $pdf->Cell(181, 7, utf8_decode('GABINETES'), 'LTRB', 1, 'C', 0);

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(61, 7, utf8_decode(' Nombre del Gabinete'), 'LTB', 0, 'C', 0);
    $pdf->Cell(61, 7, utf8_decode(' Baterías'), 'LTB', 0, 'C', 0);
    $pdf->Cell(59, 7, utf8_decode(' Cerradura'), 'LTBR', 1, 'C', 0);

    $getLogGabinetes = $accesos->getLogGabinetes($acceso->id_accesos);
}
if (empty($getLogGabinetes)) {
    $pdf->Cell(61, 8, utf8_decode(' -'), 'LTB', 0, 'C', 0);
    $pdf->Cell(61, 8, utf8_decode(' -'), 'LTB', 0, 'C', 0);
    $pdf->Cell(59, 8, utf8_decode(' -'), 'LTBR', 1, 'C', 0);

    $pdf->Cell(61, 8, utf8_decode(' -'), 'LTB', 0, 'C', 0);
    $pdf->Cell(61, 8, utf8_decode(' -'), 'LTB', 0, 'C', 0);
    $pdf->Cell(59, 8, utf8_decode(' -'), 'LTBR', 1, 'C', 0);

    $pdf->Cell(61, 8, utf8_decode(' -'), 'LTB', 0, 'C', 0);
    $pdf->Cell(61, 8, utf8_decode(' -'), 'LTB', 0, 'C', 0);
    $pdf->Cell(59, 8, utf8_decode(' -'), 'LTBR', 1, 'C', 0);
} else {
    foreach ($getLogGabinetes as $gabinetes) {
        $pdf->Cell(61, 8, utf8_decode($gabinetes->nombre_gabinete), 'LTB', 0, 'C', 0);
        $pdf->Cell(61, 8, utf8_decode($gabinetes->baterias_gabinete), 'LTB', 0, 'C', 0);
        $pdf->Cell(59, 8, utf8_decode($gabinetes->cerradura), 'LTBR', 1, 'C', 0);
    }

    $pdf->Cell(61, 8, utf8_decode(' '), 'LTB', 0, 'C', 0);
    $pdf->Cell(61, 8, utf8_decode(' '), 'LTB', 0, 'C', 0);
    $pdf->Cell(59, 8, utf8_decode(' '), 'LTBR', 1, 'C', 0);
}

$pdf->Cell(200, 3, utf8_decode(' '), '', 1, 'L', 0);
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(61, 7, utf8_decode('BREAKERS'), 'LBTR', 0, 'C', 0);
$pdf->Cell(5, 7, utf8_decode(''), '', 0, 'C', 0);
$pdf->Cell(115, 7, utf8_decode('ATERRIZAJES'), 'LBTR', 1, 'C', 0);

$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(15, 7, utf8_decode('Principal:'), 'LB', 0, 'L', 0);
$pdf->SetFont('Helvetica', 'I', 9);
$pdf->Cell(10, 7, utf8_decode($acceso->breaker_principal_acc), 'RB', 0, 'L', 0);
$pdf->SetFont('Helvetica', '', 9);
$pdf->Cell(10, 7, utf8_decode('Existentes:'), 'LB', 0, 'L', 0);
$pdf->SetFont('Helvetica', 'I', 9);
$pdf->Cell(26, 7, utf8_decode($acceso->breakers_existentes), 'RB', 0, 'C', 0);


$pdf->Cell(5, 7, utf8_decode(''), '', 0, 'C', 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(15, 7, utf8_decode('Torre:'), 'LB', 0, 'L', 0);
$pdf->SetFont('Helvetica', 'I', 9);
$pdf->Cell(10, 7, utf8_decode($acceso->at_torre_acc), 'RB', 0, 'L', 0);
$pdf->SetFont('Helvetica', '', 9);
$pdf->Cell(10, 7, utf8_decode('Centro Carga:'), 'LB', 0, 'L', 0);
$pdf->SetFont('Helvetica', 'I', 9);
$pdf->Cell(26, 7, utf8_decode($acceso->at_centro_carga_acc), 'RB', 0, 'C', 0);
$pdf->Cell(10, 7, utf8_decode('Contenedor:'), 'LB', 0, 'L', 0);
$pdf->SetFont('Helvetica', 'I', 9);
$pdf->Cell(44, 7, utf8_decode($acceso->at_escalerilla_acc), 'RB', 1, 'C', 0);


$pdf->Cell(200, 3, utf8_decode(' '), '', 1, 'L', 0);
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(61, 7, utf8_decode('STATUS DEL STIO'), 'LBTR', 0, 'C', 0);
$pdf->Cell(5, 7, utf8_decode(''), '', 0, 'C', 0);
$pdf->Cell(60, 7, utf8_decode('PERÍMETRO'), 'LBTR', 0, 'C', 0);
$pdf->Cell(5, 7, utf8_decode(''), '', 0, 'C', 0);
$pdf->Cell(50, 7, utf8_decode('LIMPIEZA'), 'LBTR', 1, 'C', 0);

$pdf->SetFont('Helvetica', '', 11);
$pdf->Cell(61, 7, utf8_decode($acceso->vandalismo), 'LRB', 0, 'C', 0);


$pdf->Cell(5, 7, utf8_decode(''), '', 0, 'C', 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(60, 7, utf8_decode($acceso->limpieza), 'LBR', 0, 'C', 0);
$pdf->Cell(5, 7, utf8_decode(''), '', 0, 'C', 0);
$pdf->Cell(50, 7, utf8_decode($acceso->tp_descripcion), 'LBR', 1, 'C', 0);


$pdf->Cell(200, 3, utf8_decode(' '), '', 1, 'L', 0);
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(181, 7, utf8_decode('COMENTARIOS DEL ACCESO'), 'LBTR', 1, 'C', 0);
$pdf->SetFont('Helvetica', 'I', 8);
$pdf->Cell(181, 15, utf8_decode($acceso->comentarios), 'LBTR', 0, 'C', 0);



$pdf->SetFont('Arial', 'I', 9);
$pdf->Cell(47, 4, utf8_decode(''), '', 0, 'C', 0);
$pdf->Cell(3, 60, utf8_decode(''), '', 1, 'C', 0);
$pdf->Cell(67, 4, utf8_decode($acceso->personal_as), '', 0, 'C', 0);
$pdf->Cell(30, 5, utf8_decode(''), '', 0, 'C', 0);
$pdf->Cell(64, 4, utf8_decode($acceso->lider_cuadrilla), '', 1, 'C', 0);


$getFirmaProveedor = $accesos->getFirmaProveedor($acceso->id_accesos);

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(42, 5, utf8_decode(''), '', 1, 'C', 0);
$pdf->Cell(75, 5, utf8_decode('Nombre y/o Firma Responsable ASTELECOM'), '', 0, 'C', 0);
$pdf->Cell(30, 5, utf8_decode(''), '', 0, 'C', 0);
$pdf->Cell(60, 5, utf8_decode('Nombre y/o identificación del proveedor'), '', 1, 'L', 0);



if (!empty($getFirmaProveedor)) {
    $bs_firma = $getFirmaProveedor[0]->firma_base_64;
    $dataURI    = $bs_firma;
    $img = explode(',', $dataURI, 2)[1];
    $pic = 'data://text/plain;base64,' . $img;
    $pdf->Image($pic, 130, 220, 0, 35, 'png');
}

if ($acceso->id_rutas_archivos_accesos == '') {
    $ruta_identificacion = "../../../images/no-fotos.png";
    $pdf->Image($ruta_identificacion, 100, 210, 0, 20, 'png');
} else {
    $getIdentificacionProveedor = $accesos->getIdentificacionProveedor($acceso->id_rutas_archivos_accesos);

    if (!empty($getIdentificacionProveedor)) {
        $ruta_identificacion = "../../../" . $getIdentificacionProveedor[0]->ruta_archivo;
        $tipo_archivo = $getIdentificacionProveedor[0]->tipo_archivo;
        if (file_exists($ruta_identificacion)) {
            $pdf->Image($ruta_identificacion, 100, 210, 0, 20, $tipo_archivo);
        } else {
            $ruta_identificacion = "../../../images/no-fotos.png";
            $pdf->Image($ruta_identificacion, 100, 210, 0, 20, 'png');
        }
    }
}


$pdf->Output();
