<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'tabla.php';
require_once 'ConfigApp.php';

// Leemos la acción que viene por parámetro (gracias al .htaccess)
/*
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
router estatico
*/

//router dinamico

// 1. Leemos la clave de la acción (definida en ConfigApp)
$actionKey = ConfigApp::$ACTION;

// 2. Tomamos la acción de la URL. Si no viene, usamos '' (home)
$actionValue = $_GET[$actionKey] ?? ''; 

// 3. Parseamos la URL (separamos acción de parámetros)
$urlData = parseUrl($actionValue);

// 4. Busamos si la acción existe en nuestro mapa (ConfigApp)
$actionName = $urlData[ConfigApp::$ACTION];

if (array_key_exists($actionName, ConfigApp::$ACTIONS)) {
    
    // Si existe, obtenemos el NOMBRE de la función a ejecutar
    $params = $urlData[ConfigApp::$PARAMS];
    $methodName = ConfigApp::$ACTIONS[$actionName]; // Ej: 'showTabla'

    // 5. EJECUCIÓN DINÁMICA (Meta-programación)
    if (isset($params) && $params != null) {
        // Llamamos a la función pasando los parámetros
        // Esto es equivalente a: showTabla($params)
        $methodName($params); 
    } else {
        // Llamamos a la función sin parámetros
        $methodName();
    }

} else {
    // Si la acción no existe en el mapa
    echo "404 - Página no encontrada";
}

// --- Función Auxiliar para desglosar la URL ---
function parseUrl($url) {
    $urlExploded = explode('/', $url);
    
    $arrayReturn[ConfigApp::$ACTION] = $urlExploded[0]; // La acción (ej: 'tabla')
    
    // Los parámetros (todo lo que sigue después de la acción)
    // Usamos array_slice para quitar la acción y dejar solo los params
    $arrayReturn[ConfigApp::$PARAMS] = isset($urlExploded[1]) ? array_slice($urlExploded, 1) : null;
    
    return $arrayReturn;
}