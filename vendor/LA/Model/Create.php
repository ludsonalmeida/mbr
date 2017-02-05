<?php

namespace LA\Model;


class Create extends Table
{
    protected $result;
    protected $create;

    //->create("tabela", $dados)
    public function create($table, array $dados){
        $this->table = (string) $table;
        $this->dados = (array) $dados;
        $campos = implode(', ', array_keys($this->dados));
        $prepare = ':'.implode(', :', array_keys($this->dados));
        $this->create = "INSERT INTO {$this->table} ({$campos}) VALUES ({$prepare})";

        try{
            $stmt = $this->db->prepare($this->create);
            $stmt->execute($this->dados);
        }catch (\PDOException $e){
            return $e->getCode()." - ".$e->getMessage()." - ".$e->getLine();
        }
    }
}