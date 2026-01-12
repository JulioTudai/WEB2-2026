<?php

function getDB(){
    $servidor = "localhost";
    $db = "db_tareas";
    $usuario = "webadmin";
    $contrasenia =  "admin";

    try{
        $db = new PDO("mysql:host=$servidor;dbname=$db;charset=utf8", $usuario, $contrasenia);

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        die(); // Matamos el proceso si no hay base de datos
    }


}

function getTareas(){
    $db = getDB();

    $sentencia = $db->prepare("SELECT * FROM tareas");
    $sentencia->execute();

    // Obtenemos los datos en un arreglo de objetos
    $tareas = $sentencia->fetchAll(PDO::FETCH_OBJ);

    // Retornamos los datos (¡NO hacemos echo aquí!)
    return $tareas;
}

function insertarTarea($titulo,$descripcion,$finalizada){
    $db = getDB();

    $sentencia = $db->prepare("INSERT INTO tareas (titulo, descripcion, finalizada) VALUES (?,?,?)");

    $sentencia ->execute(array($titulo,$descripcion,$finalizada));
}
?>
