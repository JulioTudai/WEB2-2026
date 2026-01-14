<?php
require_once 'controllers/ProductoController.php';

//definir base url
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

//Leer la accion que viene de htaccess
//ponemos una por defecto
$action = 'home';
if(!empty($_GET['action'])){

    $action = $_GET['action'];
}

//separamos los parametros que vienen por la ulr
$params = explode('/',$action);

//instanciamos el controlador

$controller = new ProductController();

//ahora decidimos a donde va todo

switch ($params[0]){
    case 'home':
        $controller->showProducts();
        break;

    case 'agregar':
        $controller->addProduct();
        break;
    
    case 'descripcion':
        $controller->viewDescription();
        break;

    case 'eliminar':
        if(!empty($params[1])){

            $controller->deleteProduct($params[1]);
        }else{
            $controller->showProducts();
        }
        break;

    case 'actualizar':
        $controller->updateProduct();
        break;
        
    case 'editar':
        // Esperamos la URL tipo: editar/5
        if(isset($params[1])){
            $controller->editProduct($params[1]);
        }
        break;

    default:
    $controller->showProducts();

}


