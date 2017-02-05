<?php

namespace LA\Model;


class Delete extends Table
{
    protected $delete;
    //->delete("tabela", "WHERE id=:id", id=5)
    public function delete($tabela, $termos, $parseString){
        $this->table = $tabela;
        $this->termos = $termos;
        parse_str($parseString, $this->places);
        $this->delete = "DELETE FROM {$this->table} {$this->termos}";

        try{
            $stmt = $this->db->prepare($this->delete);
            $stmt->execute($this->places);
        }catch (\PDOException $e){
            return $e->getCode()." - ".$e->getMessage()." - ".$e->getLine();
        }
    }
}