<?php
namespace App\Controllers;
use LA\Controllers\Action;
use LA\DI\Container;

class BlogController extends Action
{
    public function index(){


        $usr = Container::getCrud('read');

        var_dump($usr->read($tabela = 'fd_users', $termos = 'WHERE email = :email AND senha = :senha LIMIT :limit', $parseString = "email=ludson.bsa&senha=123&limit=1"));
        $this->render("index", false, true, true);
    }

    public function single(){
        $this->render('single', false, true, true);
    }
}