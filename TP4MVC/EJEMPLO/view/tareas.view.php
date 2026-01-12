<?php

class TareasView {

    // Esta función es la encargada de generar TODA la salida HTML
    public function mostrarTareas($tareas) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <base href="<?php echo BASE_URL ?>">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>ToDo List MVC</title>
            <style>
                .tachado { text-decoration: line-through; color: gray; }
            </style>
        </head>
        <body>
            <h1>Lista de Tareas (Versión MVC)</h1>

            <form action="agregar" method="POST">
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
                        <span class="<?php echo ($tarea->finalizada == 1) ? 'tachado' : ''; ?>">
                            <b><?php echo $tarea->titulo; ?></b>: 
                            <?php echo $tarea->descripcion; ?> 
                        </span>

                        <a href='eliminar/<?php echo $tarea->id_tarea; ?>'>Borrar</a>
                        
                        <?php if($tarea->finalizada == 0): ?>
                            | <a href='finalizar/<?php echo $tarea->id_tarea; ?>'>Finalizar</a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </body>
        </html>
        <?php
    }
}
?>