<?php
require_once 'request.php';
require_once 'response.php';

class Route {
    private $url;
    private $verb;
    private $controller;
    private $method;
    private $params;

    public function __construct($url, $verb, $controller, $method){
        $this->url = $url;
        $this->verb = $verb;
        $this->controller = $controller;
        $this->method = $method;
        $this->params = [];
    }

    public function match($url, $verb) {
        if($this->verb != $verb){
            return false;
        }
        $partsURL = explode("/", trim($url,'/'));
        $partsRoute = explode("/", trim($this->url,'/'));
        if(count($partsRoute) != count($partsURL)){
            return false;
        }
        foreach ($partsRoute as $key => $part) {
            if($part[0] != ":"){
                if($part != $partsURL[$key])
                return false;
            } else {
                $this->params[''.substr($part,1)] = $partsURL[$key];
            }
        }
        return true;
    }

    public function run($request, $response){
        $controller = $this->controller;  
        $method = $this->method;
        $request->params = (object) $this->params;
        
        (new $controller())->$method($request, $response);
    }
}

class Router {
    private $routeTable = [];
    private $middlewares = [];
    private $defaultRoute;
    private $request;
    private $response;

    public function __construct() {
        $this->defaultRoute = null;
        $this->request = new Request();
        $this->response = new Response();
    }

    public function addMiddleware($middleware) {
        $this->middlewares[] = $middleware;
    }

    public function addRoute ($url, $verb, $controller, $method) {
        $this->routeTable[] = new Route($url, $verb, $controller, $method);
    }

    public function setDefaultRoute($controller, $method) {
        $this->defaultRoute = new Route("", "", $controller, $method);
    }

    public function route($url, $verb) {
        // 1. Ejecutar Middlewares Globales
        foreach ($this->middlewares as $middleware) {
            $middleware->run($this->request, $this->response);
        }

        // 2. Ejecutar Ruta Coincidente
        foreach ($this->routeTable as $route) {
            if ($route->match($url, $verb)) {
                $route->run($this->request, $this->response);
                return;
            }
        }

        // 3. Ruta por defecto
        if ($this->defaultRoute != null)
            $this->defaultRoute->run($this->request, $this->response);
    }
}
?>