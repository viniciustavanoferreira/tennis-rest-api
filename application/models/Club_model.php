<?php defined('BASEPATH') OR exit('No direct script access allowed');

//Model Club / Associação
//Neros Labs

class Club_model extends CI_Model {

    //construtor
    public function __construct() {
        parent::__construct(); 
    }

    //list members
    public function getUsers($id) {
        $query = $this->db->get_where('uvw_club_users',array('id'=>$id));
        return $query->result_array();
    }

    //list courts from this club
    public function getCourts($id) {
        $query = $this->db->get_where('tennis_court',array('club_id'=>$id));
        return $query->result_array();
    }

    public function get($id) {
        $query = $this->db->get_where('tennis_club',array('id'=>$id));
        return $query->result_array();
    }

    public function get_all() {
        $query = $this->db->get('tennis_club');
        return $query->result_array();
    }

    public function insert($data) {
        $this->db->insert('tennis_club',$data);
        return ($this->db->affected_rows()>0?TRUE:FALSE);
    }

    public function update($id,$data) {
        $this->db->where('id',$id);
        $this->db->update('tennis_club',$data);
        return ($this->db->affected_rows()>0?TRUE:FALSE);
    }

    public function delete($id) {
        $this->db->where('id',$id);
        $this->db->delete('tennis_club');
        return ($this->db->affected_rows()>0?TRUE:FALSE);
    }

}