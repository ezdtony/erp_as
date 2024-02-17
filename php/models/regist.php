
<?php
include_once 'Connection.php';

$name=$_POST['name'];
$email=$_POST['email'];
$mess=$_POST['mensaje'];

$query="INSERT INTO contacs (name,email,messsage) 
 VALUES ('$name','$email','$mess')";
 echo mysqli_query($conexion,$query);


?>

