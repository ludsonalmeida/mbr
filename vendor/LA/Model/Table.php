<?php

namespace LA\Model;


abstract class Table
{
    protected $db;
    protected $table;
    protected $dados;
    protected $parseString;
    protected $places;
    protected $termos;


    public function __construct(\PDO $db){
        $this->db = $db;
    }

    public function fetchAll(){
        try{
            $query = "SELECT * FROM {$this->table}";
            return $this->db->query($query);
        }catch (\PDOException $e){
            return $e->getCode()." - ".$e->getMessage()." - ".$e->getLine();
        }
    }

    public function find($id){
        try{
            $query = "SELECT * FROM {$this->table} WHERE id=:id";
            $stmt  = $this->db->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }catch (\PDOException $e){
            return $e->getCode()." - ".$e->getMessage()." - ".$e->getLine();
        }
    }
}