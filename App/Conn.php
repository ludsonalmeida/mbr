<?php

namespace App;

class Conn
{
    public static function getDb(){
        try{
            return new \PDO("mysql:host=".DB_HOST.";dbname=".DB_SA, DB_USER, DB_PASSWORD);

        }catch (\PDOException $e){
            return $e->getCode()." - ".$e->getMessage()." - ".$e->getLine();
        }

    }
}