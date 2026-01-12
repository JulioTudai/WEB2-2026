<?php
require_once 'database/db.php';

class TareasModel {

    /**
     * Obtiene todas las tareas.
     */
    function getTareas() {
        $db = getDB();
        $sentencia = $db->prepare("SELECT * FROM tareas");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Inserta una nueva tarea.
     */
    function insertarTarea($titulo, $descripcion, $finalizada) {
        $db = getDB();
        $sentencia = $db->prepare("INSERT INTO tareas (titulo, descripcion, finalizada) VALUES (?,?,?)");
        $sentencia->execute([$titulo, $descripcion, $finalizada]);
    }

    /**
     * Elimina una tarea por ID.
     */
    function borrarTarea($id) {
        $db = getDB();
        $sentencia = $db->prepare("DELETE FROM tareas WHERE id_tarea = ?");
        $sentencia->execute([$id]);
    }

    /**
     * Finaliza una tarea por ID.
     */
    function finalizarTarea($id) {
        $db = getDB();
        $sentencia = $db->prepare("UPDATE tareas SET finalizada = 1 WHERE id_tarea = ?");
        $sentencia->execute([$id]);
    }
}
?>