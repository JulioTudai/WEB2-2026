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
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f4f4f4; }
                tr:hover { background-color: #f1f1f1; }
                
                /* Estilo para el formulario */
                .form-container { background: #f9f9f9; padding: 20px; margin-bottom: 20px; border: 1px solid #ddd; }
                input, textarea { display: block; margin-bottom: 10px; width: 100%; padding: 5px; }
                button { padding: 10px 15px; background: #28a745; color: white; border: none; cursor: pointer; }
            </style>
        </head>
        <body background: #0a030300;>
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
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </body>
        </html>
        <?php
    }
}
?>