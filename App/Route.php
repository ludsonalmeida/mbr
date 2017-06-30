<?php

namespace App;

use LA\Init\Bootstrap;

class Route extends Bootstrap
{
    protected function initRoutes(){
        $routes['home']              = array('route'=>'/','controller'=>'indexController','action'=>'index');

        $routes['index']             = array('route'=>'/index','controller'=>'indexController','action'=>'index');

        $routes['cadastrar']         = array('route'=>'/cadastrar','controller'=>'indexController','action'=>'cadastrar');

        //Admin
        $routes['login']             = array('route'=>'/admin/login','controller'=>'adminController','action'=>'login');

        $routes['admin']             = array('route'=>'/admin','controller'=>'adminController','action'=>'index');

        $routes['dashboard']         = array('route'=>'/admin/dashboard','controller'=>'adminController','action'=>'dashboard');

        $routes['users']             = array('route'=>'/admin/users','controller'=>'adminController','action'=>'users');

        $routes['profile']           = array('route'=>'/admin/profile','controller'=>'adminController','action'=>'profile');

        $routes['registros']         = array('route'=>'/admin/registros','controller'=>'adminController','action'=>'registros');

        $routes['logout']            = array('route'=>'/admin/logout','controller'=>'adminController','action'=>'logout');

        $this->setRoutes($routes);
    }


}