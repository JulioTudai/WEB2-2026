<?php
require_once 'bd.php';

// 1. Verificamos que llegue el ID
if (isset($_GET['id_tarea']) && !empty($_GET['id_tarea'])) {
    
    $id = $_GET['id_tarea'];
    
    // 2. Llamamos a la función nueva
    actualizarTarea($id);
}

// 3. Volvemos a la lista
header("Location: Tareas.php");
?>