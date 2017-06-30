<?php
namespace App\Controllers;
use App\Conn;
use LA\Controllers\Action;
use LA\DI\Container;
use App\Helpers;

class AdminController extends Action
{
    protected $view;

    public function __construct(){
        $this->view = new \stdclass();
    }

    public function index(){
        $this->render("index", false, false, false);
    }

    protected function validaSession(){
        session_start();
        $id = $_SESSION['idUsuario'];
        $users = Container::getCrud('read');
        $this->view->usuarios = $users->Read('tb_users',"WHERE id = :id","id={$id}");

    }

    public function login(){

        if(isset($_POST['login'])) {

            //fazer a leitura do banco usuário especifico
            $email = strip_tags($_POST['email']);
            $senha = strip_tags($_POST['senha']);

            $users = Container::getCrud('read');
            $userQuery = $users->Read('tb_users',"WHERE email = :email","email={$email}");

            foreach($userQuery as $user);
            $userEmail  = $user['email'];
            $userSenha  = $user['senha'];

            if($email == $userEmail && $senha == $userSenha){
                session_start();
                $_SESSION['logado'] = true;
                $_SESSION['idUsuario'] = $user['id'];
            }

            $this->dashboard();

        }else{
            $this->render("index", false, false, false);
        }

    }

    public function registros(){
        $this->validaSession();

        /*USANDO PAGINATOR*/
        //Pega o get
        $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);

        //Registra na classe o link, primeira e ultima
        $paginator = new Helpers\Pager("registros?atual=",'Primeira', 'Última');

        //executa no link, com a quantidade de resultados
        $paginator->exePager($atual, 6);

        //chama container estático de consulta
        $registros = Container::getCrud('read');

        //faz a consulta
        $this->view->registros = $registros->read("tb_registros", 'ORDER BY id DESC LIMIT :limit OFFSET :offset' , "limit={$paginator->getLimit()}&offset={$paginator->getOffset()}");

        //executa a paginação
        $paginator->exePagintor("tb_registros");

        //pega a paginação e passa pra view
        $this->view->paginator = $paginator->getPaginator();

        /*USANDO PAGINATOR FIM*/

        if(isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
            $this->render("registros/registros", false, false, false, true);
        }
    }

    public function users(){
        $this->validaSession();

        if(isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
            $this->render("users/users", false, false, false, true);
        }
    }

    public function profile(){

        $this->validaSession();
        if(isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
            $this->render("users/perfil", false, false, false, true);
        }

        if(isset($_POST['sendForm'])){
            $email  = $_POST['email'];
            $senha  = $_POST['senha'];
            $tipo   = $_POST['tipo'];
            $status = $_POST['status'];

            $up = Container::getCrud('update');

            $dados =
                [
                    'email'  => $email,
                    'senha'  => $senha,
                    'tipo'   => $tipo,
                    'status' => $status,
                ];

            $up->update('tb_users', $dados, "WHERE id=:id", "id={$_SESSION['idUsuario']}");

            echo    '<section class="alert">
                        <div class="green">
                            <p>Update realizado com sucesso</p>
                            <span class="close">&#10006;</span>
                        </div>
                    </section>';

            //->update("tabela",$dados, "WHERE id=:id", id=5)
        }
    }

    public function dashboard(){
        //$date = date('Y/m/d H:i:s');
        /*$dados = [

            'email'=>'truta@icck.com',
            'senha' => '123452',
        ];*/

        $this->validaSession();

        if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
            $this->render("dashboard", false, false, false, true);
        }else{
            session_destroy();
            $this->render("index", false, false, false);
        }

    }

    public function logout(){
        session_start();
        session_destroy();
        unset($_SESSION['logado']);
        unset($_SESSION['idUsuario']);
        $this->render("index", false, false, false);
        exit();
    }
}