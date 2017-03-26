<?php

namespace App;

use LA\Init\Bootstrap;

class Route extends Bootstrap
{
    protected function initRoutes(){
        $routes['home']              = array('route'=>'/','controller'=>'indexController','action'=>'index');
        $routes['index']             = array('route'=>'/index','controller'=>'indexController','action'=>'index');
        $routes['contato']           = array('route'=>'/contato','controller'=>'indexController','action'=>'contato');
        $routes['error']             = array('route'=>'/error','controller'=>'indexController','action'=>'error');
        $routes['enviarContato']     = array('route'=>'/enviar-contato','controller'=>'indexController','action'=>'sendContato');

        //Cursos
        $routes['cursos']            = array('route'=>'/curso-logica','controller'=>'indexController','action'=>'cursos_logica');

        //Rota de formulario
        //$routes['contato']     = array('route'=>'/sign-in','controller'=>'indexController','action'=>'sign_in');

        //Rota para download de ebook
        $routes['web_ebook']         = array('route'=>'/comecando-para-web','controller'=>'indexController','action'=>'ebook_comecando_web');

        //Confirmação de Inscrição
        $routes['confirmar']            = array('route'=>'/confirmar','controller'=>'indexController','action'=>'email_confirm');
        $routes['inscrito']             = array('route'=>'/inscrito','controller'=>'indexController','action'=>'inscrito');

        //Blog
        $routes['blog']              = array('route'=>'/blog','controller'=>'blogController','action'=>'index');
        $routes['single']            = array('route'=>'/blog/single','controller'=>'blogController','action'=>'single');

        //Admin
        //$routes['login']              = array('route'=>'/admin/','controller'=>'sessionController','action'=>'index');
        $routes['admin']              = array('route'=>'/admin','controller'=>'adminController','action'=>'index');
        $routes['dashboard']          = array('route'=>'/admin/dashboard','controller'=>'adminController','action'=>'dashboard');
        $routes['logout']             = array('route'=>'/admin/logout','controller'=>'adminController','action'=>'logout');


        $this->setRoutes($routes);
    }


}