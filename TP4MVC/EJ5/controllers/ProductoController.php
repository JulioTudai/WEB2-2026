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

}