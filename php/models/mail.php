<?php
/* Leer el contenido del archivo HTML */
/* include '../views/foot.php'; */

$names = isset($_POST['name']) ? $_POST['name'] : null;
$emails = isset($_POST['email']) ? $_POST['email'] : null;
$messages = isset($_POST['mensaje']) ? $_POST['mensaje'] : null;
 
/* diseño del correo */
//$body = "Nombre:" . $names . "<br>Correo:" . $emails ."<br>Mensaje:" . $messages ;
ob_start();  // Inicia el almacenamiento en el búfer de salida
include '../views/desemail.php';  // Incluye el contenido de desemail.php
$body = ob_get_clean();  // Obtiene el contenido del búfer de salida y limpia el búfer
//echo $body;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../lib/phpmailer/Exception.php';
require '../../lib/phpmailer/PHPMailer.php';
require '../../lib/phpmailer/SMTP.php';


/* 
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
 */

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.astelecom.com.mx';       /* 'mail.astelecom.com.mx' */                //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'contacto@astelecom.com.mx';                 // accede de a la cuenta SMTP username
    $mail->Password   = 'vRrhGV;0mvnb';  /*   'vRrhGV;0mvnb'  */                          //SMTP password
    $mail->SMTPSecure = 'ssl';                                 //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom ($emails, $names);
    $mail->addAddress ('contacto@astelecom.com.mx','ASTELECOM');                    //Add a recipient
    /* $mail->addAddress('ellen@example.com');                         //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com'); */

    //Attachments
   /*  $mail->addAttachment('/var/tmp/file.tar.gz');                    //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');                 //Optional name
 */
    //Content
    $mail->isHTML(true);                                              //Set email format to HTML
    $mail->Subject = 'Contacto';
    $mail->Body= $body;                                                 //manda los datos del form
    $mail->CharSet ='UTF-8'; 
    /* $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; */

    $mail->send(); /* Se eliminaron lienas de alertas en las ultimas */

    echo"se envio el correo";
       
} catch (Exception $e) {
    echo "Error no se mando hay: {$mail->ErrorInfo}";

}