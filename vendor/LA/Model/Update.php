<?php

namespace LA\Model;


class Update extends Table
{

    protected $update;

    //->update("tabela",$dados, "WHERE id=:id", id=5)
    public function update($table, array $dados, $termos, $parseString){
        $this->table = (string) $table;
        $this->dados = $dados;
        $this->termos = (string) $termos;

        parse_str($parseString, $this->places);


        foreach($this->dados as $key => $value):
            $places[] = $key.' = :' .$key;
        endforeach;

        $places = implode(', ', $places);
        $this->update = "UPDATE {$this->table} SET {$places} {$this->termos}";

        try{
            $stmt = $this->db->prepare($this->update);
            $stmt->execute(array_merge($this->dados, $this->places));

        }catch (\PDOException $e){
            return $e->getCode()." - ".$e->getMessage()." - ".$e->getLine();
        }
    }
}