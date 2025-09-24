<?php
session_start();
include 'conexion.php';

//verificamos  si se envio el dato y si el dato no esta vacio
$fecha_hora = (isset($_POST['fecha_hora']) && trim($_POST['fecha_hora']) !== '') ? trim($_POST['fecha_hora']) : null;
$potencia_ingresada= (isset($_POST['potencia_ingresada']) && trim($_POST['potencia_ingresada']) !== '') ? floatval(str_replace(',', '.', $_POST['potencia_ingresada'])) : null;

//validamos que los datos esten llenos
if($fecha_hora===null){
    $_SESSION['error'] = "El programa no ingreso la fecha y la hora";
    header("Location:CalculoPotencia.php");
    exit;
}
if($potencia_ingresada===null){
    $_SESSION['error'] = "Ingrese una potencia";
    header("Location:CalculoPotencia.php");
    exit;

}


//preparamos la consuta a la base de datos.
//DF= distancia focal
$DF_arduino="SELECT * FROM medicion_arduino WHERE Id=1";
$result=mysqli_query($conexion,$DF_arduino);

//verificamos si la consulta se ejecuto correctamente.
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

//comprobamos si devolvio algun registro.
if (mysqli_num_rows($result)== 1) {

        // convierte la fila en un array asociativo para poder acceder a los valores.
        $fila = mysqli_fetch_assoc($result); 
        
        $DF = $fila['Dato']; 

        //$redondearpi =round($potencia_ingresada/0.25) * 0.25;

        //PR=potencia resultante.
        $PR= 1/$DF;

        //Px=potencia a averiguar de la lente.
        //$Px=$PR-$redondearpi;
        $Px=$PR-$potencia_ingresada;

        // Redondear al múltiplo de 0.25 más cercano
        $redondearPx = round($Px/0.25) * 0.25;
        //echo $redondeadoPx;
        
        $insert="INSERT INTO registrar_medicion_lente(Fech_Hora_RML,Potencia_Ingresada_RML,
        Potencia_Resultante_RML,Estado_Validacion_RML,Distancia_Focal_RML,potencia_averiguada_lente) 
        VALUES('$fecha_hora',$potencia_ingresada,$PR,NULL,$DF,$redondearPx)";

        $ejecutarinsert=mysqli_query($conexion,$insert);

        if (!$ejecutarinsert) {
            die("Error al insertar: " . mysqli_error($conexion));
        }
        
        // Obtenemos el ID del registro insertado
        $id_insertado = mysqli_insert_id($conexion);
        
        // Mostrar el formulario de validación
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Ver y validar resultado</title>
            <link rel="stylesheet" type="text/css" href="mostrar_resultado.css">
        </head>
        <body>
            <form action='recibe_validacion.php' method='POST'>
                <h2>Resultado de la potencia de la lente y validación</h2>
                
                <input type='hidden' name='id_RML' value="<?= $id_insertado ?>">
                
                <div class="field-group">
                    <label>Fecha y hora:</label>
                    <button type="button" disabled ><?=date('d-m-Y, H:i:s', strtotime($fecha_hora)) ?></button>
                </div>

                <div class="field-group">
                    <label>Distancia Focal enviada por arduino:</label>
                    <button type="button" disabled ><?= $DF ?> m</button>
                </div>

                <div class="field-group">
                    <label>Potencia ingresada:</label>
                    <button type="button" disabled><?= $potencia_ingresada ?> Dioptrias</button>
                </div>

                <div class="field-group">
                    <label>Potencia resultante:</label>
                    <button type="button" disabled><?= $PR ?> Dioptrias</button>
                </div>

                <div class="field-group">
                    <label class="resaltar">Potencia Calculada de la Lente:</label>
                    <button type="button" class="resaltarB" disabled><?= $redondearPx ?> Dioptrias</button>
                </div>
                
                <div class="field-group vertical">
                    <label class="resaltar">Validar Potencia Calculada de la Lente:</label>
                    <select name='estado_validacion'>
                        <option value='Correcto'>Result Correcto</option>
                        <option value='Incorrecto'>Result Incorrecto</option>
                    </select>
                </div>
                
                <button type='submit' class='submit-btn'>Guardar Validación</button>
            </form>
            <hr>
            <!-- Enlace que pueden abrir desde afuera -->
            <p>
                Compartir este enlace con invitado:<br>
                <a href="vista_invitado.php?id=<?= $id_insertado ?>" target="_blank">
                    Abrir vista de invitado
                </a>
            </p>
        </body>
        </html>

<?php
} else {
    // No devolvió ningún registro
    echo "No se encontró ningún registro con Id=1";
}

?>