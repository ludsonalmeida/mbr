<?php
namespace App\Controllers;
use App\Conn;
use LA\Controllers\Action;
use LA\DI\Container;

class AdminController extends Action
{
    protected $view;

    public function __construct(){
        $this->view = new \stdclass();
    }

    public function index(){
        $this->render("index", false, false, false);
    }



    public function login(){

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if(isset($_POST['login'])):
            //fazer a leitura do banco usuário especifico


        endif;
        session_start();


    }

    public function dashboard(){

        //$date = date('Y/m/d H:i:s');

        /*$dados = [

            'email'=>'truta@icck.com',
            'senha' => '123452',

        ];*/

        $id = 1;
        $users = Container::getCrud('read');
        $this->view->usuarios = $users->Read('fd_users',"WHERE id = :id","id={$id}");

        var_dump($this->view->usuarios);


       $this->render("dashboard", false, false, false, true);
    }

    public function logout(){
        header("Location: ".HOMEP);
    }
}