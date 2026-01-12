<?php

class ProductView{

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
                /* Un poco de CSS básico para que la tabla se vea decente */
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f4f4f4; }
                tr:hover { background-color: #f1f1f1; }
            </style>
        </head>
        <body>
            <h1>Listado de Productos</h1>

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
                                <?php 
                                    // Si la descripción es nula, mostramos un guión
                                    echo $producto->descripcion ? $producto->descripcion : "-"; 
                                ?>
                            </td>
                            <td>$<?php echo $producto->precio; ?></td>
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