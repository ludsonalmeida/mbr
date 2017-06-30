<?php

namespace App\Controllers;

use LA\Controllers\Action;
use App\Helpers\Mailer;
use LA\DI\Container;


class IndexController extends Action
{

    public function index(){

        if(isset($_POST['enviar'])){
            $dados['nome']       = $_POST['nome'];
            $dados['telefone']   = $_POST['telefone'];
            $dados['email']      = $_POST['email'];
            $dados['mensagem']   = $_POST['mensagem'];

            $cadastrar = Container::getCrud('Create');
            $this->view->cadastrar = $cadastrar->create("tb_registros", $dados);
            $this->view->msg = true;
        }
     $this->render("index", false, true, true);
    }


    public function cadastrar(){



        //$this->create = "INSERT INTO {$this->table} ({$campos}) VALUES ({$prepare})";
        //$dados = [ 'nome telefone email mensagem',  ];


    }

    public function error(){
        $this->render("error", false, true, true);
    }

    /*public function sign_in(){
        $mail = new Mailer();
        $mail->mailerConfig();
        $mail->AddAddress($_POST['emailSigned']);
        $mail->setSubEmsg();

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            return false;
        } else {
            echo ('SEND');
            return true;
        }

        //$this->render("php/sign-in-form", false, false, false);
    }*/



}