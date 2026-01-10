<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 5 - formularios get y post</title>
</head>
<body>

<h1>Formulario de Datos Personales</h1>

<?php
    // --- LÓGICA DEL SERVIDOR (Server-Side) ---

    // Definimos variables vacías para evitar errores de "undefined variable"
    $nombre = "";
    $apellido = "";
    $edad = "";
    $error = "";

    // Detectamos si llegaron datos (ya sea por POST o GET)
    // $_SERVER["REQUEST_METHOD"] nos dice qué método se usó.
    if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {

        // Usamos $_REQUEST para capturar los datos sin importar si vinieron por GET o POST
        // (Ver teoría más abajo sobre $_REQUEST)
        // Usamos el operador ternario '??' (PHP 7+) o isset para evitar warnings si falta el campo
        //$nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
        //este if hace lo mismo pero solo de forma nw
        if(isset($_REQUEST['nombre'])){
            $nombre = $_REQUEST['nombre'];
        }else{
            $nombre = null;
        }
        $apellido = isset($_REQUEST['apellido']) ? $_REQUEST['apellido'] : null;
        $edad = isset($_REQUEST['edad']) ? $_REQUEST['edad'] : null;

        // VALIDACIÓN DEL SERVIDOR: Ningún campo puede estar vacío
        if (empty($nombre) || empty($apellido) || empty($edad)) {
            $error = "¡Error! Todos los campos son obligatorios.";
        } else {
            // Si pasamos la validación, mostramos el mensaje de éxito
            echo "<div style='background-color: #d4edda; padding: 10px; border: 1px solid #c3e6cb; color: #155724;'>";
            echo "<h3>¡Datos Recibidos Correctamente!</h3>";
            echo "<ul>";
            echo "<li><strong>Nombre:</strong> $nombre</li>";
            echo "<li><strong>Apellido:</strong> $apellido</li>";
            echo "<li><strong>Edad:</strong> $edad</li>";
            echo "</ul>";
            echo "</div>";
        }
    }
?>

<<?php 
    if (!empty($error)) { 
?>
    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb;">
        <?php echo $error; ?>
    </div>
<?php 
    } // Cerramos la llave aquí
?>

<hr>

<form action="ejercicio5.php" method="POST">
    <p>
        <label for="nombre">Nombre:</label><br>
        <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
    </p>
    <p>
        <label for="apellido">Apellido:</label><br>
        <input type="text" name="apellido" id="apellido" value="<?php echo $apellido; ?>">
    </p>
    <p>
        <label for="edad">Edad:</label><br>
        <input type="number" name="edad" id="edad" value="<?php echo $edad; ?>">
    </p>

    <button type="submit">Enviar Mis Datos</button>
</form>

</body>
</html>