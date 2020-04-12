<?php defined('BASEPATH') OR exit('No direct script access allowed');

//Model Usuario
//Neros Labs

class User_model extends CI_Model {

    //construtor
    public function __construct() {
        parent::__construct(); 
    }

    //remove friend
    public function removeFriend($user_id,$friend_user_id) {
        //remove id1 -> id2
        $data = array(
            'user_id_1'   =>  $user_id,
            'user_id_2'   =>  $friend_user_id
        );
        $this->db->where($data);
        $this->db->delete('tennis_user_relation');
        $del_1 = ($this->db->affected_rows()>0?TRUE:FALSE);

        //remove id1 -> id2
        $data = array(
            'user_id_2'   =>  $user_id,
            'user_id_1'   =>  $friend_user_id
        );
        $this->db->where($data);
        $this->db->delete('tennis_user_relation');
        $del_2 = ($this->db->affected_rows()>0?TRUE:FALSE);
        
        return ($del_1 || $del_2);
    }
    //add friend 
    public function addFriend($user_id,$friend_user_id) {
        $data = array(
            'user_id_1'   =>  $user_id,
            'user_id_2'   =>  $friend_user_id
        );
        $this->db->insert('tennis_user_relation',$data);
        return ($this->db->affected_rows()>0?TRUE:FALSE);
    }
    //list friends where user is listed
    public function getFriends($id) {
        $this->db->from('uvw_user_friends');
        $this->db->where(array('id'=>$id));
        $query = $this->db->get();
        return $query->result_array();
    }

    //remove club
    public function removeClub($user_id,$club_id) {
        $data = array(
            'user_id'   =>  $user_id,
            'club_id'   =>  $club_id
        );
        $this->db->delete('tennis_user_club',$data);
        return ($this->db->affected_rows()>0?TRUE:FALSE);
    }

    //add club 
    public function addClub($user_id,$club_id) {
        $data = array(
            'user_id'   =>  $user_id,
            'club_id'   =>  $club_id
        );
        $this->db->insert('tennis_user_club',$data);
        return ($this->db->affected_rows()>0?TRUE:FALSE);
    }

    //list clubs where user is listed
    public function getClubs($id) {
        $this->db->from('uvw_user_clubs');
        $this->db->where(array('id'=>$id));
        $query = $this->db->get();
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