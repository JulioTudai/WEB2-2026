<?php
require_once 'controller/tareas.controller.php';

// 1. Definimos la BASE_URL para usarla en redirecciones y enlaces si fuera necesario
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// 2. Leemos la acción que viene del .htaccess
// Si no hay acción, por defecto vamos a 'home'
$action = 'home';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// 3. "Desarmamos" la URL (ej: "eliminar/5" se convierte en ["eliminar", "5"])
$params = explode('/', $action);

// 4. Instanciamos el Controlador (El cerebro)
$controller = new TareasController();

// 5. Decidimos qué método ejecutar según la primera parte de la URL ($params[0])
switch ($params[0]) {
    case 'home':
        $controller->showTareas();
        break;

    case 'agregar':
        $controller->addTarea();
        break;

    case 'eliminar':
        // En la URL "eliminar/5", el ID está en la posición 1 ($params[1])
        if (isset($params[1])) {
            $controller->removeTarea($params[1]);
        } else {
            // Si falta el ID, volvemos al home
            $controller->showTareas();
        }
        break;

    case 'finalizar':
        // Igual que eliminar, necesitamos el ID
        if (isset($params[1])) {
            $controller->finishTarea($params[1]);
        } else {
            $controller->showTareas();
        }
        break;

    default:
        // Si escriben cualquier cosa rara, mostramos la lista
        $controller->showTareas();
        
}
?>