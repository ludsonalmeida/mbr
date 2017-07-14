<?php
namespace LA\Model;


class Read extends Table
{

    protected $places;
    protected $select;
    protected $read;
    protected $result;
    protected $termos;

    //->Read ($tabela = 'fd_users', $termos = 'WHERE email = :email AND senha = :senha LIMIT :limit', $parseString = "email=ludson.bsa&senha=123&limit=1"));


    public function Read($table = null, $termos = null, $parseString = null){
        if(!empty($parseString)):
            parse_str($parseString, $this->places);
        endif;

        $this->select = "SELECT * FROM {$table} {$termos}";

        $this->termos = $termos;
        $this->table = $table;

        $this->Execute();

        return $this->getResult();

    }

    public function fullRead($query){
        $this->select = $query;

        $this->Execute();
        return $this->getResult();

    }

    private function getResult(){
        return $this->result;
    }


    public function getRowCount(){
        $this->connect();
        $this->getSyntax();
        $this->read->execute();
        return $this->read->rowCount();
    }

    //Prepara a Query e seta o fetch Mode
    public function connect(){
        $this->read = $this->db->prepare($this->select);
        $this->read->setFetchMode(\PDO::FETCH_ASSOC);
    }

    private function getSyntax()
    {
        if (!empty($this->places)):
            foreach ($this->places as $vinc => $value) :
                if($vinc == 'limit' || $vinc == 'offset'):
                    $value = (int)$value;
                endif;
                $this->read->bindValue(":{$vinc}", $value, ( is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR));
            endforeach;
        endif;
    }

    private function Execute(){
        $this->connect();
        try{
            $this->getSyntax();
            $this->read->execute();
            $this->result = $this->read->fetchAll();
        }catch (\PDOException $e){
            return $e->getCode()." - ".$e->getMessage()." - ".$e->getLine();
        }
    }


}