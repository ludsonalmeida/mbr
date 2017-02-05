<?php

namespace App\Controllers;


use LA\Controllers\Action;
use LA\DI\Container;


class IndexController extends Action
{

    public function index()
    {

        $dados = ['id'=> '1','nome'=>'trusta','email'=>'truta@icck.com'];

        $update = Container::getCrud("create");

        $update->create("clientes", $dados);


        $this->render("index", true);
    }

}