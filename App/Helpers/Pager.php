<?php
namespace App\Helpers;
use LA\DI\Container;

class Pager
{
    private $page;
    private $limit;
    private $offset;

    private $tabela;
    private $termos;
    private $places;

    private $rows;
    private $link;
    private $maxLinks;
    private $first;
    private $last;

    private $paginator;

    public function __construct($link, $first = null, $last = null, $maxLinks = null)
    {
        $this->link = (string)$link;
        $this->maxLinks = ( (int)$maxLinks ? $maxLinks : 5);
        $this->first = ( (string) $first ? $first : 'Primeira Página' );
        $this->last = ( (string) $last ? $last : 'Última Página' );
    }

    public function exePager($page, $limit){
        $this->page = ((int) $page ? $page : 1);
        $this->limit = (int) $limit;
        $this->offset = ($this->page * $this->limit) - $this->limit;
    }

    public function returnPage(){
        if($this->page > 1):
            $nPage = $this->page - 1;
        header("Location: {$this->link}{$nPage}");
        endif;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @return mixed
     */
    public function getOffset()
    {
        return $this->offset;
    }

    public function exePagintor($tabela, $termos = null, $parseString = null){
        $this->tabela = (string)$tabela;
        $this->termos = (string)$termos;
        $this->places = (string)$parseString;
        $this->getSyntax();
    }

    public function getPaginator(){
        return $this->paginator;
    }

    private function getSyntax(){
        $read = Container::getCrud('read');
        $read->Read($this->tabela, $this->termos, $this->places);
        $this->rows = $read->getRowCount();

        if($this->rows > $this->limit):
            $paginas = ceil($this->rows / $this->limit);
            $maxLinks = $this->maxLinks;

            $this->paginator  = "<ul class=\"paginator\">";
            $this->paginator .= "<li><a title=\"{$this->first}\" href=\"{$this->link}\">{$this->first}</a></li>";

                for($iPag = $this->page - $maxLinks; $iPag <= $this->page - 1; $iPag++):
                   if($iPag >= 1):

                    $this->paginator .= "<li><a title=\"Página {$iPag}\" href=\"{$this->link}{$iPag}\">{$iPag}</a></li>";
                    endif;
                endfor;

                $this->paginator .= "<li><span class=\"active\">{$this->page}</span></li>";

                for($dPag = $this->page + 1; $dPag <= $this->page + $maxLinks; $dPag++):

                    if($dPag <= $paginas):
                        $this->paginator .= "<li><a title=\"Página {$dPag}\" href=\"{$this->link}{$dPag}\">{$dPag}</a></li>";
                        //$this->paginator .= '<li><a href='.$this->link.$dPag.'>'.$this-</a></li>';
                    endif;
                endfor;

                $this->paginator .= "<li><a title=\"{$this->last}\" href=\"{$this->link}{$paginas}\">{$this->last}</a></li>";
                $this->paginator .= "</ul>";

        endif;

    }
}