<?php
require_once 'db/dbConect.php';

class ProductModel{

    function showProducts(){
        $db = getDB();

        $sentencia = $db->prepare("SELECT * FROM productos");
        $sentencia->execute();
        
        return $sentencia->fetchAll(PDO::FETCH_OBJ);

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
}