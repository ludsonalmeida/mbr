<?php

namespace App\Controllers;

use LA\Controllers\Action;
use App\Helpers\Mailer;



class IndexController extends Action
{

    public function index(){
     $this->render("index", false, true, true);
    }

    public function contato(){
        $this->render("contato", false, true, true);

    }
    public function cursos_logica(){
        $this->render("cursos/logica", false, true , true);
    }

     public function ebook_comecando_web(){
        header('Location:https://mega.nz/#!JV4HwJiD!88-UrhHqdg3eot-TkQUzQoiIahlYbQLHZsYP-cbZ4tY');
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

    public function sendContato(){
            $mail = new Mailer();
            $mail->mailerConfig();
            $mail->AddAddress('ludson.bsa@gmail.com');
            $mail->setContatoMsg();
            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
                return false;
            } else {
                echo ('SEND');
                return true;
            }
    }


    public function email_confirm(){
        $this->render('email/confirmar', false, true, true);
    }

    public function inscrito(){
        $this->render('email/inscrito', false, true, true);
    }

}