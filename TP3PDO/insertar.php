<?php
require_once 'bd.php';

// 1. Verificamos que los datos vengan por POST y no estén vacíos
if (!empty($_POST['titulo']) && !empty($_POST['descripcion'])) {
    
    // 2. Capturamos los datos del formulario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $finalizada = 0; // Por defecto, una tarea nueva NO está finalizada

    // 3. Llamamos a tu función en bd.php
    insertarTarea($titulo, $descripcion, $finalizada);

    // 4. Redireccionamos al home para ver la tarea nueva (Slide 47)
    header("Location: Tareas.php");
} else {
    echo "Error: Faltan datos obligatorios.";
}
?>