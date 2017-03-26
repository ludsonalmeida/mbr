<?php

namespace App\Helpers;
use PHPMailer;

class Mailer extends \PHPMailer
{
    public function mailerConfig(){

        $this->IsSMTP(); //Habilita envio SMPT
        $this->SMTPAuth = true; //Ativa email autenticado
        $this->SMTPSecure = 'ssl';
        $this->IsHTML(true);
        $this->SMTPDebug = 0;
        $this->Host = 'mail.virtudedigital.com.br'; //Servidor de envio
        $this->Port = 465; //Porta de envio
        $this->Username = 'contato@virtudedigital.com.br'; //email para smtp autenticado
        $this->Password = 'i5i8t4a6'; //seleciona a porta de envio;
        $this->SetFrom('contato@virtudedigital.com.br', 'Ludson Almeida - #FADEV'); //Seu e-mail
        //$this->AddReplyTo('contato@virtudedigital.com.br', 'Nome'); //Seu e-mail
        //Define os destinatário(s)
        //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

    }

    public function setContatoMsg(){
        $this->Subject = $_POST['assunto'];
        $this->MsgHTML("
        <p><b>Nome: </b>{$_POST['nome']}</p>
        <p><b>Telefone: </b>{$_POST['telefone']}</p>
        <p><b>Email: </b>{$_POST['email']}</p>
        <p><b>Assunto: </b>{$_POST['assunto']}</p>
        <p><b>Mensagem: </b>{$_POST['mensagem']}</p>
        ");
    }

    public function setSubEmsg(){
        $this->Subject = '[E-Book] Começando a programar para Web'; //Assunto do e-mail
        $this->MsgHTML
        ("
            <h1>Olá {$_POST['emailSigned']}, parabéns pela decisão!</h1>
            <p style='font-size:16px;'>Fico feliz que você pode estar entrando em um mundo novo, cheio de possibilidades e oportunidades!</p>
            <p style='font-size:16px;'>Preparado? Vamos que vamos então!</p>
            <p style='font-size:16px;'>Como te prometi no final deste e-mail vai o link pra você baixar o e-book...</p>
            <h2>Começando a Programar Para a Web</h2>
            <p style='font-size:16px;'>Nele eu falo um pouco sobre as linguagens de programação e marcação existentes em ação no momento como: php, java, javaScript, python e algumas outras. Além de claro uma demonstração clássica de HTML com um PLUS pra você, nesse e-book eu dou um caminho das pedras que vem solucionando a vida dos meus alunos que é a forma de aprendizado. Um método que eu desenvolvi, apliquei e consigo aprender qualquer linguagem nova, não é a toa que tenho conhecimento em várias linguagens e já utilizei e utilizo todas as citadas neste ebook. Tem muito mais por vir, quero te ensinar as melhores tecnicas que desenvolvi e aprendi para APRENDER programação sem vacilos e sem perda de tempo, parece bom demais pra ser verdade né?</p>
            <p style='font-size:16px;'>Faz o seguinte, vou te dar um conselho: Após ler o ebook aplique apenas essa primeira etapa de aprendizado que te ensinei em qualquer linguagem, ou para qualquer coisa que você deseja aprender e me diga se isso não foi o suficiente pra te deixar mais organizado e com acesso rápido em sua memória daquilo que foi estudado, combinado?</p>
            <p style='font-size:16px;'>Conto com você pra que possamos <i>JUNTOS</i> transformar-mos esse mito e essa dificuldade com programação apenas na caixinha do passado, e <b>te garanto</b> o seu futuro não será mais o mesmo! </p>
            <p style='font-size:16px;'><a href='http://fadev.virtudedigital.com.br/comecando-para-web' >Clique Aqui para Baixar o E-book</a></p>
            <p>Meu sinceros votos de sucesso.</p>
            <p>Tamo junto my friend!</p>
            <b><u>Ludson Almeida</u></b>
            <p>Analista de Sistemas & CEO na Virtude Digital</p>
            ");
    }
}