<?php

class Api {

    private static $root;
    private static $uri;
    private static $routesController;
    private static $api;

    public static function handleCalls($routesController){

        self::loadInstance($routesController);

        $controller = self::getController();
        
        if (self::callRoute($controller) === false) {
            http_response_code(500);
            return;
        }
    }

    private function __construct($routesController){

        $this->root = $_SERVER['DOCUMENT_ROOT'];
        define("URL_CONTROLLERS", "{$this->root}/src/routes/bases");

        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->uri = explode('/', $this->uri);

        $this->routesController = $routesController;

    }

    private static function loadInstance($routesController){
        if (empty(self::$api)){
            self::$api = new Api($routesController);
        }
    }
    
    private static function getController(){
        $requested_uri = self::$api->uri[1];
        $controller = URL_CONTROLLERS;

        if (array_key_exists($requested_uri, self::$api->routesController)) {
            $controllerName =  self::$api->routesController[$requested_uri];
            $controller .= "/{$controllerName}.php";
        } else {
            http_response_code(404);
            return;
        }

        return $controller;
    }

    private static function callRoute($controller){

        if (http_response_code() === 404){
            return;
        }

        $server_http_method = $_SERVER['REQUEST_METHOD'];
        $requested_uri = self::$api->uri[1];
        $controller = self::$api->routesController[$requested_uri];
        $routes = constant("$controller::routes");
        $sliced_uri = array_slice(self::$api->uri, 1);
        $requested_uri = '/' . implode('/', $sliced_uri);
        $requested_uri = (substr($requested_uri, -1) === '/') ? rtrim($requested_uri, '/') : $requested_uri;
        $matched_route = null;

        foreach ($routes as $pattern => $route){
            if (preg_match("#^$pattern$#", $requested_uri)){
                $matched_route = $route;
                break;
            }
        }
        list($http_method, $controller_method) = (count($matched_route = explode('@', $matched_route)) === 2) ? [$matched_route[0], $matched_route[1]] : [null, null];

        return $http_method == $server_http_method ? $controller::$controller_method() : false;
    }

}