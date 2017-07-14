<?php

namespace App\Helpers;


class Uploader
{
    protected $destinoFinal;
    protected $arquivo;
    protected $nome_temporario;
    protected $destino;


    /* Insira aqui a pasta que deseja salvar o arquivo. Ex: imagens

    $uploaddir = 'imagens/';

    $uploadfile = $uploaddir . $_FILES['arquivo']['name'];

    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile))*/


    public function uploader(){
        $this->destinoFinal = $this->getDestino().'/'.$this->getArquivo();
        if(move_uploaded_file($this->getNomeTemporario(), $this->destinoFinal)){
            echo "fez upload";
        }else{
            echo "não fez upload";
        }
    }
    /**
     * @return mixed
     */
    public function getArquivo()
    {
        return $this->arquivo;
    }

    /**
     * @param mixed $arquivo
     */
    public function setArquivo($arquivo)
    {
        $this->arquivo = $arquivo;
    }

    /**
     * @return mixed
     */
    public function getNomeTemporario()
    {
        return $this->nome_temporario;
    }

    /**
     * @param mixed $nome_temporario
     */
    public function setNomeTemporario($nome_temporario)
    {
        $this->nome_temporario = $nome_temporario;
    }

    /**
     * @return mixed
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * @param mixed $destino
     */
    public function setDestino($destino)
    {

        if(is_dir($this->destino)){
            return $this->destino = $destino;
        }else{
            mkdir($destino);
            $this->destino = $destino;
        }

    }

}