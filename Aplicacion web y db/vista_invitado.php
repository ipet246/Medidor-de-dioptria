<?php
include 'conexion.php';

// Verificamos que venga el ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("ID inválido");
}

$SQL="SELECT Id_RML,Fech_Hora_RML,Potencia_Ingresada_RML,Potencia_Resultante_RML,
      Distancia_Focal_RML,potencia_averiguada_lente 
      FROM registrar_medicion_lente";

$resultSQL=mysqli_query($conexion,$SQL);

//verificamos si la consulta se ejecuto correctamente.
if (!$resultSQL) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

//comprobamos si devolvio algun registro.
if (mysqli_num_rows($result$SQL)== 1){
    // convierte la fila en un array asociativo para poder acceder a los valores.
    $fila = mysqli_fetch_assoc($resultSQL);

    ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Vista Invitado</title>
            <link rel="stylesheet" type="text/css" href="mostrar_resultado.css">
        </head>
        <body>

            <form>
                <h2>Resultado de la potencia de la lente</h2>
                
                <div class="field-group">
                    <label>Fecha y hora:</label>
                    <button type="button" disabled ><?=$fila['Fech_Hora_RML'] ?></button>
                </div>

                <div class="field-group">
                    <label>Distancia Focal enviada por arduino:</label>
                    <button type="button" disabled ><?=$fila['Distancia_Focal_RML']?> m</button>
                </div>

                <div class="field-group">
                    <label>Potencia ingresada:</label>
                    <button type="button" disabled><?= $fila['Potencia_Ingresada_RML'] ?> Dioptrias</button>
                </div>

                <div class="field-group">
                    <label>Potencia resultante:</label>
                    <button type="button" disabled><?= $fila['Potencia_Resultante_RML']?> Dioptrias</button>
                </div>

                <div class="field-group">
                    <label class="resaltar">Potencia Calculada de la Lente:</label>
                    <button type="button" class="resaltarB" disabled><?= $fila['potencia_averiguada_lente']?> Dioptrias</button>
                </div>
            
            </form>
        </body>
        </html>
<?php
} else {
    echo "No se encontró el resultado con ese ID";
}
?>
