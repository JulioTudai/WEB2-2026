<?php
require_once 'db/dbConect.php';

class ProductModel{

    function showProducts(){
        $db = getDB();

        $sentencia = $db->prepare("SELECT * FROM productos");
        $sentencia->execute();
        
        return $sentencia->fetchAll(PDO::FETCH_OBJ);

    }

    function getProduct($id){
        $db = getDB();

        $sentencia = $db->prepare("SELECT * FROM productos WHERE id_producto = ?");
        $sentencia -> execute([$id]);
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    function add($n,$d,$p){

        $db = getDB();

        $sentencia = $db->prepare("INSERT INTO productos (nombre, descripcion, precio) VALUES (?,?,?)");
        $sentencia->execute([$n, $d, $p]);

    }

    function delete($id){

        $db = getDB();

        $sentencia = $db->prepare("DELETE FROM productos WHERE id_producto =?");
        $sentencia->execute([$id]);
    }



    function update($id, $nombre, $descripcion, $precio){

    $db = getDB(); 
    // 2. Sintaxis SQL corregida: UPDATE no usa paréntesis ni VALUES
    // 4. Seguridad: El ID también debe ser un signo de pregunta (?)
    $sentencia = $db->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ? WHERE id_producto = ?");

    // 5. El ID se pasa al final del array porque es el último signo de pregunta
    $sentencia->execute([$nombre, $descripcion, $precio, $id]);
}

}