<?php

namespace App\Controllers;


use LA\Controllers\Action;
use App\Helpers\Mailer;
use LA\DI\Container;


class IndexController extends Action
{


    public function index()
    {

        $this->render("index", false, true, true);

        //RENDER('view',se layout, header, footer);

    }

    public function error(){
        $this->render("error", false, true, true);
    }

}