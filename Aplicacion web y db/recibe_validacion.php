<?php
session_start();
include 'conexion.php';

$id_RML = intval($_POST['id_RML']);
$estado_validacion = $_POST['estado_validacion'];

$update = "UPDATE registrar_medicion_lente 
           SET Estado_Validacion_RML='$estado_validacion' 
           WHERE Id_RML=$id_RML";

if (mysqli_query($conexion, $update)) {

    $_SESSION['exito']="Validacion guardada correctamente.";
     header("Location:CalculoPotencia.php");
     exit;
} else {
    echo "Error al guardar la validación: " . mysqli_error($conexion);
}
?>