<?php

namespace App\Helpers;
use PHPMailer;

class Mailer extends PHPMailer
{
    protected $assunto;


    public function __construct(){
        $this->isSMTP();                                       // Set mailer to use SMTP
        $this->Host = EMAIL_HOST;                              // Specify main and backup SMTP servers
        $this->SMTPAuth = true;                                // Enable SMTP authentication
        $this->Username = EMAIL_USR;                           // SMTP username
        $this->Password = EMAIL_PASS;                          // SMTP password
        $this->SMTPSecure = 'tls';                             // Enable TLS encryption, `ssl` also accepted
        $this->Port = 587;

    }


    public function getSubject()
    {
        return $this->Subject;
    }


    public function setSubject($Subject)
    {
        $this->Subject = $Subject;
        return $this;
    }




}