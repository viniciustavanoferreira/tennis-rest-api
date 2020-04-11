<?php defined('BASEPATH') OR exit('No direct script access allowed');

//Model Usuario
//Neros Labs

class User_model extends CI_Model {

    //construtor
    public function __construct() {
        parent::__construct(); 
    }

    //list clubs where user is listed
    public function getClubs($id) {
        $query = $this->db->get_where('uvw_user_clubs',array('id'=>$id));
        return $query->result_array();
    }

    public function get($id) {
        $query = $this->db->get_where('tennis_user',array('id'=>$id));
        return $query->result_array();
    }

    public function get_all() {
        $query = $this->db->get('tennis_user');
        return $query->result_array();
    }

    public function insert($data) {
        $this->db->insert('tennis_user',$data);
        return ($this->db->affected_rows()>0?TRUE:FALSE);
    }

    public function update($id,$data) {
        $this->db->where('id',$id);
        $this->db->update('tennis_user',$data);
        return ($this->db->affected_rows()>0?TRUE:FALSE);
    }
}