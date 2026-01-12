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
    <style>
        .tachado {
            text-decoration: line-through;
            color: gray;
        }
    </style>

    <ul class="list-group">
       
        <?php foreach ($tareas as $tarea): ?>
            <li>
                <span class="<?php echo ($tarea->finalizada == 1) ? 'tachado' : ''; ?>">
                <b><?php echo $tarea->titulo; ?></b>: 
                <?php echo $tarea->descripcion; ?> 
                </span>

                <a href='borrarTarea.php?id_tarea=<?php echo $tarea->id_tarea; ?>'>Borrar</a>
                <?php if($tarea->finalizada == 0): ?>
                    | <a href='actualizarTarea.php?id_tarea=<?php echo $tarea->id_tarea; ?>'>actualizar</a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

</body>
</html>