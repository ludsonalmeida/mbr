<?php
namespace LA\Controllers;


abstract class Action
{
    protected $view;
    private $action;

    public function __construct(){
        $this->view = new \stdClass();
    }

    protected function render($action, $layout = true, $header = true, $footer = true){
        $this->action = $action;
        if($layout == true && file_exists("../App/Views/layout.phtml")) {
            include_once("../App/Views/layout.phtml");

        }else if($header == true AND $footer == true AND file_exists("../App/Views/index/header.phtml") AND file_exists("../App/Views/index/footer.phtml")){

            include_once("../App/Views/index/header.phtml");
            utf8_encode($this->content());
            include_once("../App/Views/index/footer.phtml");
        }else{
            utf8_encode($this->content());
        }
    }

    protected function content(){
        $current = get_class($this);
        $singleClassName = strtolower((str_replace('Controller',"",str_replace("App\\Controllers\\","",$current))));
        include_once "../App/Views/".$singleClassName."/".$this->action.".phtml";
    }

}