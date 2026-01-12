<?php
require_once 'bd.php';
$tareas = getTareas();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
</head>
<body>
    <h1>Lista de Tareas</h1>

    <form action="insertar.php" method="POST">
        <label>Título:</label>
        <input type="text" name="titulo" required> 
        
        <label>Descripción:</label>
        <textarea name="descripcion" required></textarea>

        <button type="submit">Agregar</button>
    </form>
    <hr>

    <ul class="list-group">
        <?php foreach ($tareas as $tarea): ?>
            <li>
                <b><?php echo $tarea->titulo; ?></b>: 
                <?php echo $tarea->descripcion; ?> 
            </li>
        <?php endforeach; ?>
    </ul>

</body>
</html>