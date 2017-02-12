<?php

namespace LA\Init;


abstract class Bootstrap
{
    private $routes;

    public function __construct(){
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    abstract protected function initRoutes();

    protected function run($url){
        $this->initConfig();


            array_walk($this->routes, function($routes) use($url){
                if($url == $routes['route']){
                    $class = "App\\Controllers\\".ucfirst($routes['controller']);
                    $controller = new $class;
                    $action = $routes['action'];
                    $controller->$action();
                }

            });



    }

    protected function setRoutes(array $routes){
        $this->routes = $routes;
    }

    protected function getUrl(){
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    private function initConfig(){
        require_once '../Config.php';
    }
}