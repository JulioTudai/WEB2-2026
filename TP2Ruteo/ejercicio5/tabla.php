<?php
// Definimos la función que será llamada por el router
function showTabla($params = null) {
    // Si $params es un arreglo, el límite está en la posición 0. 
    // Si no, probamos usar el valor directo o default 10.
    if (is_array($params) && isset($params[0])) {
        $limit = $params[0];
    } else {
        $limit = 10; // Valor por defecto
    }
    
    // IMPORTANTE: Definimos la BASE_URL para que los links funcionen bien en subcarpetas
    // Ver diapositiva 22 del PDF de Ruteo
    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <base href="<?php echo BASE_URL; ?>">
    <title>Tabla de Multiplicar Ruteada</title>
    <style>
        table { border-collapse: collapse; margin-top: 20px; }
        td, th { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #fff9c4; font-weight: bold; }
        .menu a { margin-right: 15px; text-decoration: none; font-size: 1.2em; }
        .menu a:hover { text-decoration: underline; color: blue; }
    </style>
</head>
<body>

    <h1>Tabla de Multiplicar (Límite: <?php echo $limit; ?>)</h1>

    <div class="menu">
        <strong>Accesos directos:</strong>
        <a href="tabla/5">Tabla del 5</a>
        <a href="tabla/10">Tabla del 10</a>
        <a href="tabla/20">Tabla del 20</a>
        <a href="about">Ver About</a>
    </div>
    <hr>

    <table>
        <thead>
            <tr>
                <th>X</th>
                <?php for ($i = 1; $i <= $limit; $i++) echo "<th>$i</th>"; ?>
            </tr>
        </thead>
        <tbody>
            <?php for ($row = 1; $row <= $limit; $row++): ?>
            <tr>
                <th><?php echo $row; ?></th>
                <?php for ($col = 1; $col <= $limit; $col++): ?>
                    <td><?php echo $row * $col; ?></td>
                <?php endfor; ?>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>

</body>
</html>
<?php
}

// Función auxiliar para mostrar el About
function showAbout() {
    echo "<h1>About</h1><p>Esta es la calculadora ruteada del TP2.</p>";
}
?>