
<?php

include_once 'Connection.php';

$names=$_POST['name'];
$emails=$_POST['email'];
$messages=$_POST['mensaje'];



$conin = "INSERT INTO contacs (name, email, messsage) VALUES ('$names', '$emails', '$messages')";
/* $guarcon = $conexion->query($conin) */;
echo mysqli_query($conexion,$conin);





?>


