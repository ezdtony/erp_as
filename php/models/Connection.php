<?php
error_reporting(0);
// Conectar a la base de datos 
$server ="localhost";
$user = "root";
$password ="astelecom";
$bd ="asteleco_contac";
$conexion = mysqli_connect($server, $user, $password, $bd);
if($conexion -> connect_error){
    die('Error al  conectar la base de datos'. $conexion->connect_error);
}else{
    echo"te conectaste exitosamente";
}


?>