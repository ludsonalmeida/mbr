<?php

namespace App\Controllers;


use LA\Controllers\Action;
use LA\DI\Container;


class IndexController extends Action
{

    public function index()
    {
        //$cliente = Container::getModel("Clientes");

        /*$dados = ['id'=> '1','nome'=>'truta','email'=>'truta@icck.com'];

        $update = Container::getCrud("update");

        $update->update("clientes", $dados, "WHERE id = :id","id=0");*/

        $del = Container::getCrud("delete");

        $del->delete("clientes","WHERE id =:id", "id=0");

        $this->render("index", true);
    }

}