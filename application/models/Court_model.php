<?php defined('BASEPATH') OR exit('No direct script access allowed');

//Model Court / Quadra
//Neros Labs

class Court_model extends CI_Model {

    //construtor
    public function __construct() {
        parent::__construct(); 
    }

    public function get($id) {
        $query = $this->db->get_where('tennis_court',array('id'=>$id));
        return $query->result_array();
    }

    public function get_all() {
        $query = $this->db->get('tennis_court');
        return $query->result_array();
    }

    public function insert($data) {
        $this->db->insert('tennis_court',$data);
        return ($this->db->affected_rows()>0?TRUE:FALSE);
    }

    public function update($id,$data) {
        $this->db->where('id',$id);
        $this->db->update('tennis_court',$data);
        return ($this->db->affected_rows()>0?TRUE:FALSE);
    }

    public function delete($id) {
        $this->db->where('id',$id);
        $this->db->delete('tennis_court');
        return ($this->db->affected_rows()>0?TRUE:FALSE);
    }
}