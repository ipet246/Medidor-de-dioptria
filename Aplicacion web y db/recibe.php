<?php
include 'conexion.php';

// Recibir JSON crudo
$json = file_get_contents("php://input");

// Decodificar JSON a array asociativo
$data = json_decode($json, true);

// Verificar que venga la clave "distancia"
if (isset($data["distancia"])) {
    $DatoArduino = floatval($data["distancia"]);

    $sql = "UPDATE medicion_arduino SET Dato = $DatoArduino WHERE Id = 1";

    if ($conexion->query($sql) === TRUE) {
        echo "Dato actualizado correctamente: " . $DatoArduino;
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }
} else {
    echo "No se recibió ningún dato válido.";
}

$conexion->close();
?>
