<?php

namespace App\Controllers;


use LA\Controllers\Action;
use LA\DI\Container;


class IndexController extends Action
{

    public function index()
    {
        $client = Container::getModel("Clientes");
        $this->views->clientes = $client->find(1);
        $this->render("index", true);
    }

}