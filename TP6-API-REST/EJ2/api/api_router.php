<?php
require_once 'config.php';
require_once 'libs/router/router.php';

// IMPORTANTE: Descomentaremos esto a medida que creemos los archivos
require_once 'app/controllers/ProductApiController.php';
require_once 'app/controllers/auth-api.controller.php';
require_once 'app/middlewares/JWTMiddleware.php';
require_once 'app/middlewares/GuardMiddleware.php';

// Instancia del Router
$router = new Router();

// --- MIDDLEWARES ---
 $router->addMiddleware(new JWTMiddleware());

// --- RUTAS DE AUTENTICACIÓN ---
// Endpoint para obtener el token
$router->addRoute('auth/token',     'GET',     'AuthApiController',   'getToken');

// --- RUTAS DE PRODUCTOS (PÚBLICAS) ---
$router->addRoute('productos',      'GET',     'ProductApiController', 'getAll');
$router->addRoute('productos/:id',  'GET',     'ProductApiController', 'getOne');

// 3. Activamos el GUARDIA
// De aquí para abajo, nadie pasa sin ser ADMIN
$router->addMiddleware(new GuardMiddleware());

$router->addRoute('productos',      'POST',    'ProductApiController', 'create');
$router->addRoute('productos/:id',  'PUT',     'ProductApiController', 'update');
$router->addRoute('productos/:id',  'DELETE',  'ProductApiController', 'delete');

// --- RUTA POR DEFECTO (404) ---
$router->setDefaultRoute('ProductApiController', 'show404'); // Haremos una funcion simple para esto luego

// Ejecutar el ruteo
$resource = $_GET['resource'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];
$router->route($resource, $method);
?>