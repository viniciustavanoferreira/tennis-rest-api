<?php defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

//Controller Acesso
//Neros Labs
//Este controller serve para cuidar das funções de acesso ao sistema
class Auth extends CI_Controller {

    function __construct() { 
        parent::__construct();
    }

    public function index() {
        //se tiver vindo de POST, segue com autenticação, caso contrario exibe o form
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $form_login = $this->input->post('form_login');
            $form_senha = $this->input->post('form_senha');

            $acesso = $this->login($form_login,$form_senha);

            if ($acesso != NULL) {
                $this->iniciarSessao($acesso);
                redirect('Dashboard');
            } else {
                $data['retorno'] = 'Usu&aacute;rio ou senha inv&aacute;lidos.';
                $this->load->view('auth/login',$data);
            }

        } else {
            //Exibe a tela de autenticação  
            $this->load->view('auth/login');
        }
    }

    //Recuperar
    //Serve para o usuário recuperar o acesso
    //O usuário deverá informar um e-mail válido e se encontrado o sistema irá gerar uma chave 
    //  temporária para que ele possa definir uma nova senha
    function recover($key=NULL){
        $this->load->model('usuario_model');

        //Se nao tiver chave, significa que é um novo pedido de senha
        if ($chave==NULL) {
            $form_login = $this->input->post('form_login');

            //Se for a primeira visita exibir o form de solicitação
            if ($form_login == NULL) {
                $this->load->view('acesso/recuperar');
            } else {
                //Caso contrário, localizar o e-mail no sistema... 
                $usuario = $this->usuario_model->localizarUsuario($form_login);
                
                //...e se encontrado gerar uma chave de acesso...
                if ($usuario != NULL) {
                    $chave = $this->usuario_model->gerarChaveAcesso($usuario['id']);
                    //...e mandar por e-mail para o cara
                    if ($chave != NULL) {
                        enviar_email($usuario['login'],'Sua chave de acesso','Chave: ' . $chave);
                        $data['retorno'] = 'Foi gerada uma chave de acesso e enviada em seu e-mail.';
                        $this->load->view('acesso/recuperar',$data);
                    }
                }
                
            }

        //Se foi gerada uma chave, verificar se confere com o que está no registro e reativa o cara
        } else {
            $registro = $this->usuario_model->localizarUsuarioChave($chave);
            if ($registro !=NULL) {
                //Se a chave confere, ativa o usuário e retorna para a tela de login
                $this->usuario_model->ativarUsuario($registro['id'],'-1');
                $this->index();
            }
        }
    }


    //Registrar
    //Serve para o aluno se cadastrar no site
    public function registrar($chave=NULL) {
        $this->load->model('usuario_model');

        if ($chave == NULL) {
            $form_login             = $this->input->post('form_login');
            $form_nome              = $this->input->post('form_nome');
            $form_senha             = $this->input->post('form_senha');
            $form_senha_confirmacao = $this->input->post('form_senha_confirmacao');
            
            if ($form_login == NULL || $form_nome == NULL || $form_senha == NULL) {
                $this->load->view('acesso/registro');
            } else {
                //Senhas conferem?
                if ($form_senha != $form_senha_confirmacao) {
                    $data['retorno'] = 'Senhas n&atilde;o conferem';
                    $this->load->view('acesso/registro',$data);
                } else {
                    //Faz um hash na senha para encriptar
                    $form_senha = hash('sha512',$form_senha);
                    //$form_senha = password_hash($form_senha,PASSWORD_DEFAULT);
                    
                    //Gera chave de acesso
                    $chave = gerarChave();

                    $registro = $this->usuario_model->registrarAluno($form_login,$form_senha,$form_nome,$chave);
                    if ($registro) {
                        //Se registrou o aluno, envia a chave de ativação por e-mail
                        enviar_email_registro($form_login,$form_nome,$chave);

                        $form_login = NULL;
                        $form_senha = NULL;
                        $form_nome  = NULL;
                        
                        redirect(base_url() . index_page() . '/inicio');
                    }
                }
            }
        } else {
            //Se tem chave de ativação, localiza e ativa o usuário
            $registro = $this->usuario_model->localizarUsuarioChave($chave);
            if ($registro !=NULL) {
                //Se a chave confere, ativa o usuário e retorna para a tela de login
                $this->usuario_model->ativarUsuario($registro['id'],'-1');
                redirect(base_url() . index_page() . '/inicio');
            } else {
                //Caso contrário, exibe a mensagem e volta para a tela de login
                $data['retorno'] = 'Chave de ativação inválida.';
                $this->load->view('acesso/login',$data);
            }
        }


    }
    
    //Autentica o usuário no sistema
    //TODO: criptografar a senha
    public function login($usuario,$senha) {
        $this->load->model('user_model');

        //Aqui é necessário fazer o hash da senha para mandar ao banco de dados
        $senha = hash('sha512',$senha);

        //Faz a busca do usuário no sistema e se encontrar preenche os dados de sessão
        $data = $this->auth_model->authenticate($usuario,$senha);
        return $data;
    }

}
