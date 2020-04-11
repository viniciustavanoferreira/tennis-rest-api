<?php defined('BASEPATH') OR exit('No direct script access allowed');

//Model Token
//Neros Labs
//Contem funções relacionadas ao token

//Token nunca é excluído

class Token_model extends CI_Model {

    //construtor
    public function __construct() {
        parent::__construct(); 
    }

    //cria o token e grava no banco de dados
    public function createToken($user_id) {
        
    } 

    //valida o token
    //existe? expirou? 
    public function validateToken($token) {

    }

}