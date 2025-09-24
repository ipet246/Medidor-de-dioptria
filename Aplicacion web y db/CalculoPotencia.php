<?php
include 'conexion.php';
session_start();

if (isset($_SESSION['error'])) {
    echo "<script>alert('" . htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') . "');</script>";
    unset($_SESSION['error']); // eliminamos el mensaje para que no aparezca al recargar
}

if (isset($_SESSION['exito'])) {
    echo "<script>alert('" . htmlspecialchars($_SESSION['exito'], ENT_QUOTES, 'UTF-8') . "');</script>";
    unset($_SESSION['exito']); // eliminamos el mensaje para que no aparezca al recargar
}
date_default_timezone_set('America/Argentina/Buenos_Aires');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular Potencia</title>
    <link rel="stylesheet" type="text/css" href="CalculoPotencia.css">
</head>
<body>
    <form action="recibe_potencia_ingresada.php" method="POST">
        
            <h2>Cálcular la potencia de la lente</h2>
 
            <br>
            <input type="hidden" name="fecha_hora" value="<?php echo date('Y-m-d H:i:s');?>">
            <div class="potencias-container">
                <label>Seleccione una Potencia:</label>
                
                <?php
                // Traer potencias desde la BD
                $sql = "SELECT id_potencia, potencia FROM potencias";
                $resultado = $conexion->query($sql);

                if ($resultado && $resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        echo '<div class="potencia-option">';
                        echo '<input type="radio" name="potencia_ingresada" value="' . $fila['potencia'] . '" id="potencia_' . $fila['id_potencia'] . '">';
                        echo '<label for="potencia_' . $fila['id_potencia'] . '">' . $fila['potencia']. ' Dioptrías</label>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="no-potencias">No hay potencias registradas.</div>';
                }
                ?>
            </div>
            </br>
            
            <button type="submit">Calcular Potencia de la Lente</button>
            

    </form>
</body>
</html>  