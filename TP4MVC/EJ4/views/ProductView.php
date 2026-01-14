<?php

class ProductView {

    public function listProducts($productos) {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <base href="<?php echo BASE_URL ?>">
            <title>Lista de Productos</title>
            <style>
                /* Estilos básicos */
                body{background-color: #383737;}
                table { background-color: #383737; width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td {background-color: #383737; border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #383737; }
                tr:hover { background-color: #383737; }
                
                /* Estilo para el formulario */
                .form-container { background-color: #383737; padding: 20px; margin-bottom: 20px; border: 1px solid #ddd; }
                input, textarea { display: block; margin-bottom: 10px; width: 100%; padding: 5px; }
                button { padding: 10px 15px; background: #28a745; color: white; border: none; cursor: pointer; }
            </style>
        </head>
        <body>
            <h1>Listado de Productos</h1>

            <div class="form-container">
                <h3>Nuevo Producto</h3>
                <form action="agregar" method="POST">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" required>
                    
                    <label>Descripción:</label>
                    <textarea name="descripcion"></textarea>

                    <label>Precio:</label>
                    <input type="number" step="any" name="precio" required>

                    <button type="submit">Guardar</button>
                </form>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo $producto->id_producto; ?></td>
                            <td><b><?php echo $producto->nombre; ?></b></td>
                            <td>
                                <?php echo $producto->descripcion ? $producto->descripcion : "-"; ?>
                            </td>
                            <td>$<?php echo $producto->precio; ?></td>
                            <td class ="button"><a href='eliminar/<?php echo $producto->id_producto; ?>'>Eliminar</a> </td>
                            <td class ="button"><a href='editar/<?php echo $producto->id_producto; ?>'>Editar</a> </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </body>
        </html>
        <?php
    }

    public function showEditForm($producto) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <base href="<?php echo BASE_URL ?>">
        <title>Editar Producto</title>
        <style>
             /* (Usa los mismos estilos que ya tenías) */
            .form-container { max-width: 500px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; }
            input, textarea { width: 100%; margin-bottom: 10px; padding: 5px; }
            button { background: orange; color: white; border: none; padding: 10px; cursor: pointer;}
        </style>
    </head>
    <body>
        
        <div class="form-container">
            <h1>Editar Producto</h1>
            
            <form action="actualizar" method="POST">
                <input type="hidden" name="id_producto" value="<?php echo $producto->id_producto; ?>">

                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?php echo $producto->nombre; ?>" required>
                
                <label>Descripción:</label>
                <textarea name="descripcion"><?php echo $producto->descripcion; ?></textarea>

                <label>Precio:</label>
                <input type="number" step="any" name="precio" value="<?php echo $producto->precio; ?>" required>

                <button type="submit">Actualizar</button>
            </form>
            
            <a href="home">Cancelar</a>
        </div>
    </body>
    </html>
    <?php
    }
}
?>