<?php
namespace App\Controllers;
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

    public function permissoes(){
        $niveis = [
            'admin' => 1, //Patrão
            'atendente' => 2,

            /*
             *
             * Responsável de Ligação (Quem está ligando ou entrando em contato);
Status de Atendimento (Atendida (obs: Somente , Não atendida, Em atendimento);
Pós-Atendimento(Não atendeu, Ligar Depois(Notificar o atendente com horário de ligação), Boleto Gerado, Vendido, Não vendido(Não aparecer na lista));
Observações de Follow Up(Preencher em caso de obs);
Endereço para KIT(se vai receber kit ou não);
             *
             *
             * */
            'responsavel' => 3 //Inserir dados do formulário;

            /*
             * Inserir dados no formulário
             *
             * */
        ];
    }

    public function login(){

        if(isset($_POST['login'])) {

            //fazer a leitura do banco usuário especifico
            $email = strip_tags($_POST['email']);
            $senha = strip_tags($_POST['senha']);

            $users = Container::getCrud('read');
            if($userQuery = $users->Read('tb_users',"WHERE email = :email","email={$email}")){

            }else{
                header('Location: login?erro='.base64_encode('1'));
            }

            foreach($userQuery as $user);
            $userEmail  = $user['email'];
            $userSenha  = $user['senha'];

            if($user['status'] == 0){
                header('Location: admin');
            }

            if($email == $userEmail && $senha == $userSenha){
                session_start();
                $_SESSION['logado'] = true;
                $_SESSION['idUsuario'] = $user['id'];
                $_SESSION['nivel'] = $user['tipo'];
            }else{
                header('Location: login');
            }

            header('Location: dashboard');

        }else{
            $this->render("index", false, false, false);
        }

    }

    public function apagarRegistro(){
        if(isset($_GET['id'])){
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

            $apaga = Container::getCrud('delete');
            $this->view->registro = $apaga->delete('tb_registros', "WHERE id = :id",'id='.$id);
        }

        header("Location: /admin/registros");

        echo    '<section class="alert">
                    <div class="green">
                        <p>Registro Apagado</p>
                        <span class="close">&#10006;</span>
                    </div>
                </section>';
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
            $nome   = $_POST['nome'];

            $up = Container::getCrud('update');

            $dados =
                [
                    'email'  => $email,
                    'senha'  => $senha,
                    'tipo'   => $tipo,
                    'status' => $status,
                    'nome'   => $nome,
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
        $this->validaSession();

        if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
            $this->render("dashboard", false, false, false, true);
        }else{
            session_destroy();
            $this->render("index", false, false, false);
        }

    }

    /*CONTATO*/
    public function listarContato(){
        $this->validaSession();
        /*USANDO PAGINATOR*/
        //Pega o get
        $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);

        //Registra na classe o link, primeira e ultima
        $paginator = new Helpers\Pager("contatos?atual=");

        //executa no link, com a quantidade de resultados
        $paginator->exePager($atual, 15);

        //chama container estático de consulta
        $registros = Container::getCrud('read');

        //faz a consulta
        if(isset($_GET['busca'])){
            $pesquisa = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);

            $this->view->contatos = $registros->read("tb_contatos", 'WHERE status != "aprovado" AND nome LIKE "%'.$pesquisa.'%" OR email LIKE "%'.$pesquisa.'%" ORDER BY id DESC LIMIT :limit OFFSET :offset' , "limit={$paginator->getLimit()}&offset={$paginator->getOffset()}");

        }else{
            //fazer full read
            $this->view->contatos = $registros->fullRead("SELECT t1.id, t1.data_de_venda, t1.nome, t1.telefone, t1.email, t1.insercao_hotmart, t1.prioridade, t1
.id_responsavel, t2.user_nome FROM tb_contatos t1 INNER JOIN tb_users t2 ON (t1.id_responsavel = t2.id) ORDER BY id DESC LIMIT ".$paginator->getLimit()." OFFSET ".$paginator->getOffset());

            /*$this->view->contatos = $registros->read("tb_contatos", 'WHERE status != "aprovado" ORDER BY id DESC LIMIT :limit OFFSET :offset', "limit={$paginator->getLimit()}&offset={$paginator->getOffset()}");*/
        }

        //executa a paginação
        $paginator->exePagintor("tb_contatos");

        //pega a paginação e passa pra view
        $this->view->paginator = $paginator->getPaginator();

        /*USANDO PAGINATOR FIM*/

        if(isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
            $this->render("contato/contato", false, false, false, true);
        }

    }

    public function editarContato(){
        $this->validaSession();
        $id = $_GET['id'];

        if(isset($_GET['id'])){
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

            $ler = Container::getCrud('read');
            $this->view->registro = $ler->read('tb_contatos', "WHERE id = :id",'id='.$id);
            $this->view->user = $ler->read('tb_users', "WHERE id = :id", "id=".$_SESSION['idUsuario']);

            $entrada = [
                'status' => 1,
                'id_responsavel' => $_SESSION['idUsuario'],
                'id_contato' => $id,
                'inicio_atendimento' => date('Y/m/d H:i:s'),
            ];

            $create = Container::getCrud('create');
            $create->create('tb_atendimento', $entrada);
        }

        if(isset($_POST['sendForm'])) {

            /*$nome         = $_POST['nome'];
            $ddd          = $_POST['ddd'];
            $telefone     = $_POST['telefone'];
            $email        = $_POST['email'];

            $dados =
                [
                    'nome' => $nome,
                    'ddd' => $ddd,
                    'telefone' => $telefone,
                    'email' => $email,
                ];
            var_dump($dados);
            echo '<br>';
            $up = Container::getCrud('update');
            $up->update('tb_contatos', $dados, "WHERE id = :id",'id='.$id);*/


            /*$ler = Container::getCrud('read');
            $this->view->verifica = $ler->read('tb_contatos', "WHERE id = :id", "id=".$id);
            //Separar por nível de atendente e responsavel o update;
            if($this->view->verifica){
                $update = Container::getCrud('update');
                if($update->update('tb_contatos', $entradaDeDadosForm, "WHERE id_contato = :id", "id=".$id)){
                    echo "Deu certo";
                }else{
                    echo "Não deu update";
                }
                echo  '<section class="alert">
                        <div class="green">
                            <p>Registro realizado com sucesso</p>
                            <span class="close">&#10006;</span>
                        </div>
                    </section>';
            }else{
                $create = Container::getCrud('create');
                $create->create('tb_contatos', $entradaDeDadosForm);

                //header("Location: /admin/contato/editar?id=".$id);
                echo  '<section class="alert">
                        <div class="green">
                            <p>Registro realizado com sucesso</p>
                            <span class="close">&#10006;</span>
                        </div>
                    </section>';

            }*/

        }
        $this->render("contato/editar", false, false, false, true);

    }

    public function addContato(){
        $this->validaSession();
        $ler = Container::getCrud('read');
        $id = $_SESSION['idUsuario'];
        $this->view->contato = $ler->read('tb_users', "WHERE id = :id", "id=".$id);

        if(isset($_REQUEST['sendForm'])){
            $entradaDeDados =
                [
                    'nome_do_produto'     => '',
                    'nome_do_produtor'    => '',
                    'documento_produtor'  => '',
                    'nome_afiliado'       => '',
                    'transacao'           => NULL,
                    'meio_de_pagamento'   => '',
                    'origem'              => '',
                    'moeda_1'             => '',
                    'preco_do_produto'    => '',
                    'moeda_2'             => '',
                    'preco_da_oferta'     => '',
                    'taxa_de_cambio'      => '',
                    'moeda_3'             => '',
                    'preco_original'      => '',
                    'numero_da_parcela'   => '',
                    'recorrencia'         => '',
                    'data_de_venda'       => $_REQUEST["data_de_venda"],
                    'data_de_confirmacao' => '',
                    'status'              => '',
                    'nome'                => utf8_encode($_REQUEST["nome"]),
                    'documento_usuario'   => '',
                    'email'               => $_REQUEST["email"],
                    'ddd'                 => $_REQUEST["ddd"],
                    'telefone'            => $_REQUEST["telefone"],
                    'cep'                 => '',
                    'cidade'              => '',
                    'estado'              => '',
                    'bairro'              => '',
                    'pais'                => '',
                    'endereco'            => '',
                    'numero'              => '',
                    'complemento'         => '',
                    'chave'               => '',
                    'codigo_produto'      => '',
                    'codigo_afiliacao'    => '',
                    'codigo_oferta'       => '',
                    'origem_checkout'     => '',
                    'tipo_de_pagamento'   => '',
                    'periodo_gratis'      => '',
                    'coproducao'          => '',
                    'origem_comissao'     => '',
                    'preco_total'         => '',
                    'tipo_pagamento'      => '',
                    'insercao_hotmart'    => utf8_encode($_REQUEST["insercao_hotmart"]),
                    'prioridade'          => utf8_encode($_REQUEST["prioridade"]),
                    'observacao'          => utf8_encode($_REQUEST["observacao"]),
                    'id_responsavel'      => $id
                ];

            $this->view->duplicar = $ler->read('tb_contatos', "WHERE email = :email OR telefone = :telefone", "email=".$_REQUEST['email']."&telefone=".$_REQUEST['telefone']);

            if($this->view->duplicar){
                $this->view->corAlerta = "red";
                $idExistente = $this->view->duplicar[0]['id'];
                $this->view->message = "Já existe um registro com este e-mail ou telefone, <a href='/admin/contato/editar?id={$idExistente}'>clique aqui para editar o
contato</a>";

            }else{
                $this->view->corAlerta = "green";
                $this->view->message = "Registro inserido com sucesso.";
                $create = Container::getCrud('create');
                $create->create('tb_contatos', $entradaDeDados);
            }

            $this->render("contato/add", false, false, false, true);

        }else{
            $this->render("contato/add", false, false, false, true);
        }



    }

    public function adminConfig(){
        $this->validaSession();
        if(isset($_POST['enviarPlanilha'])){
            echo "TEm post";
            $planilha = $_FILES['planilha']['name'];
            $temp = $_FILES['planilha']['tmp_name'];
            var_dump($planilha);
            $import = new Helpers\PlanilhaImport();

            $import->setArquivo($planilha);
            $import->setNomeTemporario($temp);
            $import->setDestino('planilhas');
            $import->uploader();
        }


        $this->render("config/config", false, false, false, true);
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