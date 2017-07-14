<?php

namespace App\Helpers;


class PlanilhaImport extends Uploader
{
    private $ids;
    private $arquivoPlanilha;
    private $query;
    private $table;


    /**
     * @return mixed
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * @param mixed $ids
     * @return PlanilhaImport
     */
    public function setIds($ids)
    {
        $this->ids = $ids;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getArquivoPlanilha()
    {
        return $this->arquivoPlanilha;
    }

    /**
     * @param mixed $arquivoPlanilha
     */
    public function setArquivoPlanilha($arquivoPlanilha)
    {
        $this->arquivoPlanilha = $arquivoPlanilha;
    }

    /**
     * @return mixed
     */


    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param mixed $query
     * @return PlanilhaImport
     */
    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     * @return PlanilhaImport
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }


}