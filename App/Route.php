<?php

namespace App;

use LA\Init\Bootstrap;

class Route extends Bootstrap
{
    protected function initRoutes(){
        $routes['home'] = array('route'=>'/','controller'=>'indexController','action'=>'index');
        $this->setRoutes($routes);
    }
}