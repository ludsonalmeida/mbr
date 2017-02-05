<?php

namespace App;


class Conn
{
    public static function getDb(){
        try{
            return new \PDO("mysql:host=localhost;dbname=mvc", "root", "root");
        }catch (\PDOException $e){
            return $e->getCode()." - ".$e->getMessage()." - ".$e->getLine();
        }

    }
}