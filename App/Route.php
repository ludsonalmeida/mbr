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

        $routes['exportar_registros']         = array('route'=>'/admin/registros/exportar','controller'=>'adminController','action'=>'exportarRegistro');

        $routes['editar_registros']  = array('route'=>'/admin/registros/editar','controller'=>'adminController','action'=>'editarRegistro');

        $routes['apagar_registros']  = array('route'=>'/admin/registros/apagar','controller'=>'adminController','action'=>'apagarRegistro');


        //************ Contatos *****************************//
        $routes['contato']         = array('route'=>'/admin/contatos','controller'=>'adminController','action'=>'listarContato');

        $routes['editar_contato']  = array('route'=>'/admin/contato/editar','controller'=>'adminController','action'=>'editarContato');

        $routes['pesquisar_contato']  = array('route'=>'/admin/contatos/pesquisar','controller'=>'adminController','action'=>'listarContato');

        $routes['adicionar_contato']  = array('route'=>'/admin/contatos/add','controller'=>'adminController','action'=>'addContato');

        $routes['logout']            = array('route'=>'/admin/logout','controller'=>'adminController','action'=>'logout');

        //************ Configurações *****************************//
        $routes['configuracoes']  = array('route'=>'/admin/config','controller'=>'adminController','action'=>'adminConfig');

        $this->setRoutes($routes);
    }


}