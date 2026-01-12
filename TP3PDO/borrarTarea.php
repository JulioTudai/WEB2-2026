<?php
require_once 'bd.php';



if(isset($_GET['id_tarea']) && !empty($_GET['id_tarea'])){

    $idTareaEliminar = $_GET['id_tarea'];

    borrarTarea($idTareaEliminar);
}

header("Location: Tareas.php");
?>