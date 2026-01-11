<?php
require_once 'tabla.php';

// Leemos la acción que viene por parámetro (gracias al .htaccess)
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'tabla'; // Acción por defecto
}

// Parseamos la acción. Ej: tabla/5 --> ['tabla', '5']
$params = explode('/', $action);

// Determinamos qué camino seguir según la primera parte de la URL
switch ($params[0]) {
    case 'tabla':
        // Si hay un segundo parámetro (el límite), lo usamos. Si no, null.
        $limit = isset($params[1]) ? $params[1] : null;
        showTabla($limit);
        break;
        
    case 'about':
        showAbout();
        break;
        
    default:
        echo "404 - Página no encontrada";
        break;
}
?>