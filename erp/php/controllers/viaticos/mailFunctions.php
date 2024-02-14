<?php
include_once dirname(__DIR__ . '', 2) . "/models/petitions.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once dirname(__DIR__ . '', 3) . '/assets/phpmailer/src/Exception.php';
include_once dirname(__DIR__ . '', 3) . '/assets/phpmailer/src/PHPMailer.php';
include_once dirname(__DIR__ . '', 3) . '/assets/phpmailer/src/SMTP.php';


session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}

function sendViaticsMailSpentUpdate()
{


    $id_user = $_SESSION['id_user'];
    $id_gasto = $_POST['id_gasto'];
    $month = date('m');
    $year = date('Y');


    $total_gastos = 0;
    $total_depositos = 0;
    $saldo = 0;
    $pendiente = 0;
    $queries = new Queries;

    /*  $updateStatus = "SELECT SUM(dep.cantidad) AS total_depositos, SUM(gas.importe) AS total_gastos, SUM(dep.cantidad) - SUM(gas.importe) AS saldo, per.correo_sesion, correo_personal,
    CONCAT(per.nombres,' ',per.apellido_paterno,' ',per.apellido_materno) AS nombre_completo
    FROM asteleco_personal.lista_personal AS per
    INNER JOIN asteleco_viaticos_erp.depositos AS dep ON per.id_lista_personal = dep.id_personal
    INNER JOIN asteleco_viaticos_erp.gastos AS gas ON per.id_lista_personal = gas.id_personal
    WHERE per.id_lista_personal = '$id_user' AND MONTH(dep.fecha) = '$month' AND MONTH(gas.fecha_registro) = '$month'";
    echo $updateStatus; */




    $sql_infoPersonal = "SELECT per.correo_sesion, correo_personal,
    CONCAT(per.nombres,' ',per.apellido_paterno,' ',per.apellido_materno) AS nombre_completo
    FROM asteleco_personal.lista_personal AS per
    WHERE `id_lista_personal` = '$id_user'";
    $infoPersonal = $queries->getData($sql_infoPersonal);


    if (!empty($infoPersonal)) {
        /* $correo_sesion = $infoPersonal[0]->correo_sesion;
        $correo_personal = $infoPersonal[0]->correo_personal; */
        $nombre_completo = $infoPersonal[0]->nombre_completo;
    }

    $userData = array(
        'nombre_completo' => $nombre_completo,
    );

    $dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "S&aacute;bado", "Domingo");
    $meses = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $monthNumber = date("n");
    $dayNumber = date("d");
    $dia_semana = date("w");
    $yearFecha = date("Y");
    $fecha_formato = $dias[$dia_semana] . " " . $dayNumber . ' de ' . $meses[$monthNumber] . ' de ' . $yearFecha;


   $html_cuerpo = '<!DOCTYPE html>
   <html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
   
   <head>
       <title></title>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
       <!--[if !mso]><!-->
       <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
       <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
       <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet" type="text/css">
       <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet" type="text/css">
       <!--<![endif]-->
       <style>
           * {
               box-sizing: border-box;
           }
   
           body {
               margin: 0;
               padding: 0;
           }
   
           a[x-apple-data-detectors] {
               color: inherit !important;
               text-decoration: inherit !important;
           }
   
           #MessageViewBody a {
               color: inherit;
               text-decoration: none;
           }
   
           p {
               line-height: inherit
           }
   
           .desktop_hide,
           .desktop_hide table {
               mso-hide: all;
               display: none;
               max-height: 0px;
               overflow: hidden;
           }
   
           @media (max-width:700px) {
               .desktop_hide table.icons-inner {
                   display: inline-block !important;
               }
   
               .icons-inner {
                   text-align: center;
               }
   
               .icons-inner td {
                   margin: 0 auto;
               }
   
               .row-content {
                   width: 100% !important;
               }
   
               .mobile_hide {
                   display: none;
               }
   
               .stack .column {
                   width: 100%;
                   display: block;
               }
   
               .mobile_hide {
                   min-height: 0;
                   max-height: 0;
                   max-width: 0;
                   overflow: hidden;
                   font-size: 0px;
               }
   
               .desktop_hide,
               .desktop_hide table {
                   display: table !important;
                   max-height: none !important;
               }
           }
       </style>
   </head>
   
   <body style="background-color: #f9f9f9; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
       <table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f9f9f9;">
           <tbody>
               <tr>
                   <td>
                       <table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                           <tbody>
                               <tr>
                                   <td>
                                       <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #cbdbef; color: #000000; width: 680px;" width="680">
                                           <tbody>
                                               <tr>
                                                   <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 20px; padding-bottom: 20px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                       <table class="image_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                           <tr>
                                                               <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;padding-top:70px;">
                                                                   <div class="alignment" align="center" style="line-height:10px"><img src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/4971/check-icon.png" style="display: block; height: auto; border: 0; width: 93px; max-width: 100%;" width="93" alt="Check Icon" title="Check Icon"></div>
                                                               </td>
                                                           </tr>
                                                       </table>
                                                       <table class="text_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                           <tr>
                                                               <td class="pad" style="padding-bottom:25px;padding-left:20px;padding-right:20px;padding-top:10px;">
                                                                   <div style="font-family: Georgia, "Times New Roman", serif">
                                                                       <div class style="font-size: 14px; font-family: Georgia, Times, "Times New Roman", serif; mso-line-height-alt: 16.8px; color: #2f2f2f; line-height: 1.2;">
                                                                           <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:42px;">Comprobación recibida</span></p>
                                                                       </div>
                                                                   </div>
                                                               </td>
                                                           </tr>
                                                       </table>
                                                       <table class="text_block block-4" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                           <tr>
                                                               <td class="pad" style="padding-bottom:80px;padding-left:30px;padding-right:30px;padding-top:10px;">
                                                                   <div style="font-family: sans-serif">
                                                                       <div class style="font-size: 14px; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 21px; color: #2f2f2f; line-height: 1.5;">
                                                                           <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 24px;"><span style="font-size:16px;">Hola <strong><u>Diana Farfán</u></strong>,</span></p>
                                                                           <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;">&nbsp;</p>
                                                                           <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 24px;"><span style="font-size:16px;">Te informamos que el usuario <strong>'.$nombre_completo.' </strong>ha comprobado el gasto correspondiente al folio <strong><span style># '.$id_gasto.'</span></strong> el día <strong><span style>'.$fecha_formato.'.</span></strong></span></p>
                                                                           <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;">&nbsp;</p>
                                                                           <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;"><span style="color:#000000;">Ingresa al ERP para comprobar el status del gasto.</span></p>
                                                                       </div>
                                                                   </div>
                                                               </td>
                                                           </tr>
                                                       </table>
                                                   </td>
                                               </tr>
                                           </tbody>
                                       </table>
                                   </td>
                               </tr>
                           </tbody>
                       </table>
                       <table class="row row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                           <tbody>
                               <tr>
                                   <td>
                                       <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #5d77a9; color: #000000; width: 680px;" width="680">
                                           <tbody>
                                               <tr>
                                                   <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                       <table class="image_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                           <tr>
                                                               <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;padding-top:20px;">
                                                                   <div class="alignment" align="center" style="line-height:10px"><img src="https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/807136_791017/android-chrome-384x384.png" style="display: block; height: auto; border: 0; width: 136px; max-width: 100%;" width="136" alt="Yourlogo Light" title="Yourlogo Light"></div>
                                                               </td>
                                                           </tr>
                                                       </table>
                                                   </td>
                                               </tr>
                                           </tbody>
                                       </table>
                                   </td>
                               </tr>
                           </tbody>
                       </table>
                       <table class="row row-3" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                           <tbody>
                               <tr>
                                   <td>
                                       <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
                                           <tbody>
                                               <tr>
                                                   <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                       <table class="icons_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                           <tr>
                                                               <td class="pad" style="vertical-align: middle; color: #9d9d9d; font-family: inherit; font-size: 15px; padding-bottom: 5px; padding-top: 5px; text-align: center;">
                                                                   <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                       <tr>
                                                                           <td class="alignment" style="vertical-align: middle; text-align: center;">
                                                                               <!--[if vml]><table align="left" cellpadding="0" cellspacing="0" role="presentation" style="display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;"><![endif]-->
                                                                               <!--[if !vml]><!-->
                                                                               <table class="icons-inner" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;" cellpadding="0" cellspacing="0" role="presentation">
                                                                                   <!--<![endif]-->
                                                                                   <tr>
                                                                                       <td style="vertical-align: middle; text-align: center; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 6px;"><a href="https://www.designedwithbee.com/?utm_source=editor&utm_medium=bee_pro&utm_campaign=free_footer_link" target="_blank" style="text-decoration: none;"><img class="icon" alt="Designed with BEE" src="https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/53601_510656/Signature/bee.png" height="32" width="34" align="center" style="display: block; height: auto; margin: 0 auto; border: 0;"></a></td>
                                                                                       <td style="font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 15px; color: #9d9d9d; vertical-align: middle; letter-spacing: undefined; text-align: center;"><a href="https://www.designedwithbee.com/?utm_source=editor&utm_medium=bee_pro&utm_campaign=free_footer_link" target="_blank" style="color: #9d9d9d; text-decoration: none;">Designed with BEE</a></td>
                                                                                   </tr>
                                                                               </table>
                                                                           </td>
                                                                       </tr>
                                                                   </table>
                                                               </td>
                                                           </tr>
                                                       </table>
                                                   </td>
                                               </tr>
                                           </tbody>
                                       </table>
                                   </td>
                               </tr>
                           </tbody>
                       </table>
                   </td>
               </tr>
           </tbody>
       </table><!-- End -->
   </body>
   
   </html>';


    if (!empty($userData)) {
        mb_internal_encoding('UTF-8');

        // Esto le dice a PHP que generaremos cadenas UTF-8
        mb_http_output('UTF-8');



        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail.astelecom.com.mx';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'contabilidad@astelecom.com.mx';                     //SMTP username
            $mail->Password   = 'rv82*ZehP2G9';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;

            $mail->SMTPDebug = false;
            $mail->do_debug = 0;                           //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('contabilidad@astelecom.com.mx', 'Departamento de Contabilidad AS');
            /* $mail->addAddress($correo_sesion, utf8_decode($nombre_completo)); */     //Add a recipient
            /* $mail->addAddress('lmgger@hotmail.com');    */          
              //Name is optional
            $mail->addAddress("diana.farfan@astelecom.com.mx");
            $mail->addAddress("antoniogonzalez.rt@gmail.com");
            $mail->addReplyTo('contabilidad@astelecom.com.mx', 'Departamento de Contabilidad AS');
            /* $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com'); */

            //Attachments
            /* $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments */
            /* $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name */

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'AVISO CONTABILIDAD';
            $mail->Body    = $html_cuerpo;
            /* $mail->AltBody = 'Estimado colaborador. El departamento de contabilidad le hace llegar este correo de prueba.'; */

            $mail->send();
            /* echo 'Message has been sent'; */
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        $data = array(
            'response' => true,
            'message' => 'Se ha enviado el correo',
            'data' => $userData

        );
    } else {
        $data = array(
            'response' => false,
            'message' => 'Error al actualizar el usuario'
        );
    }



    echo json_encode($data);
}
