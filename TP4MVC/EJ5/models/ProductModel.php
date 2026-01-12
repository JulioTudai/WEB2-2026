<?php
require_once 'db/dbConect.php';

class ProductModel{

    function showProducts(){
        $db = getDB();

        $sentencia = $db->prepare("SELECT * FROM productos");
        $sentencia->execute();
        
        return $sentencia->fetchAll(PDO::FETCH_OBJ);

    }
}