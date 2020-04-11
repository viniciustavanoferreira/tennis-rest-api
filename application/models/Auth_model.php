<?php defined('BASEPATH') OR exit('No direct script access allowed');

//Model Club / Associação
//Neros Labs

class Auth_model extends CI_Model {

    //construtor
    public function __construct() {
        parent::__construct(); 
        $this->load->model('user_model');
    }

    public function authenticate($user,$password) {
        $criteria = array(
            'user_login'    => $user,
            'user_password' => $password
        );

        $data = $this->db->get_where('tennis_user',$criteria);

        return ($data != NULL);
    }

}