<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 4 - Tabla de Multiplicar</title>
    <style>
        table { border-collapse: collapse; margin-top: 20px; }
        td, th { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #fff9c4; font-weight: bold; }
        .diagonal { background-color: #e0e0e0; }
    </style>
</head>
<body>

    <h1>Tabla de Multiplicar Dinámica</h1>

    <?php
        // 1. LÓGICA DE ENTRADA (Input del Usuario)
        // Definimos un valor por defecto por si el usuario entra por primera vez (ej: 10)
        $limit = 10;

        // Verificamos si nos enviaron un nuevo límite por GET
        // (Tal como vimos en la diapositiva 54 del PDF sobre $_GET)
        if (isset($_GET['limit'])) {
            // Si viene el dato, actualizamos la variable.
            // (int) asegura que tratemos el dato como número entero.
            $limit = (int)$_GET['limit']; 
        }
    ?>

    <form action="ejercicio4.php" method="GET">
        <label for="limit">Ingrese el límite de la tabla:</label>
        <input type="number" name="limit" id="limit" value="<?php echo $limit; ?>" min="1" required>
        <button type="submit">Generar Tabla</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>X</th>
                <?php
                    // Bucle para la primera fila de encabezados (1 al Límite)
                    for ($i = 1; $i <= $limit; $i++) {
                        echo "<th>$i</th>";
                    }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
                // Bucle Externo: Genera las FILAS
                for ($row = 1; $row <= $limit; $row++) {
                    echo "<tr>";
                    
                    // Primero imprimimos el encabezado de la fila (columna izquierda amarilla)
                    echo "<th>$row</th>";

                    // Bucle Interno: Genera las CELDAS de esa fila
                    for ($col = 1; $col <= $limit; $col++) {
                        // Calculamos la multiplicación
                        $resultado = $row * $col;

                        // Imprimimos la celda. Usamos interpolación de variables como aprendimos.
                        // Agrego una clase si es la diagonal principal (cuando fila == col)
                        if ($row == $col) {
                            echo "<td class='diagonal'>$resultado</td>";
                        } else {
                            echo "<td>$resultado</td>";
                        }
                    }

                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

</body>
</html>