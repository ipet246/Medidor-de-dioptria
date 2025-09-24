<?php
$server="localhost";
$user="root";
$pass="";
$base="lente_db";

$conexion=mysqli_connect($server,$user,$pass,$base);

if(!$conexion){

    die("Fallo la conexion".mysqli_connect_error());
}
//echo 'conexion exitosa';
?>