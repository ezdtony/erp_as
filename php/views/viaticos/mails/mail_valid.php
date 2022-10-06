<?php
// Valida si los campos están vacios
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "Sin argumentos";
	return false;
   }
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];
	
// Crea el correo electrónico y envía el mensaje
$to = 'antoniogonzalez.rt@gmail.com'; // Agregua tu dirección de correo electrónico entre el "" reemplazando msevillab@gmail.com - Aquí es donde el formulario enviará un mensaje.
$email_subject = "AVISO COMPROBACIÓN DE GASTOS";
$email_body = "Estimado colaborador.\n\n"."Estos son los detalles:\n\nNombre: $name\n\nCorreo: $email_address\n\nMensaje:\n$message";
$headers = "Desde: msevillab@gmail.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Responder a: $email_address";	
mail($to,$email_subject,$email_body,$headers);
return true;
