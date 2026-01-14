<?php
require_once 'models/ProductModel.php';
require_once 'views/ProductView.php';

class ProductController{

    private $modelProduct;
    private $viewProduct;

    public function __construct(){

        $this->modelProduct = new ProductModel();
        $this->viewProduct =  new ProductView();
    }

    function showProducts(){

        $productsList = $this->modelProduct->showProducts();
        $this->viewProduct->listProducts($productsList);
    }

  function addProduct(){
        // 1. Verificamos que los datos vengan por POST
        if (isset($_POST['nombre']) && isset($_POST['precio'])) {
            
            // 2. Los guardamos en variables
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];

            // 3. Llamamos al Modelo para insertar
            $this->modelProduct->add($nombre, $descripcion, $precio);
            
            // 4. Redirigimos al home para ver los cambios y limpiar el form
            header("Location: " . BASE_URL . "home");
        } else {
            // Si entraron por error sin datos, los mandamos al home
            header("Location: " . BASE_URL . "home");
        }
    }

    function deleteProduct($id){

        $this->modelProduct->delete($id);

        header("Location: " . BASE_URL . "home");

    }

}