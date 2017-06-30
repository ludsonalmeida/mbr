<?php
namespace LA\Controllers;


abstract class Action
{
    protected $view;
    private $action;

    public function __construct(){
        $this->view = new \stdClass();
    }

    protected function render($action, $layout = true, $header = true, $footer = true, $admin = null){

        $this->action = $action;
        if($admin == true){

            include("../App/Views/Admin/header.phtml");
            include("../App/Views/Admin/menu.phtml");
            utf8_encode($this->content());
            include("../App/Views/Admin/footer.phtml");
        }

        if($layout == true && file_exists("../App/Views/layout.phtml")) {
            include_once("../App/Views/layout.phtml");

        }else if($header == true && $footer == true && file_exists("../App/Views/index/header.phtml") && file_exists("../App/Views/index/footer.phtml")){
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