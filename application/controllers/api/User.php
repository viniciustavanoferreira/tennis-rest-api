<?php
require(APPPATH.'/libraries/REST_Controller.php');

class User extends REST_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }
    
    //get record
    function index_get() {
        $user_id    = $this->uri->segment(3, NULL);   // BASE_URL/api/user/id
        $resource   = $this->uri->segment(4, NULL);   // BASE_URL/api/user/id/clubs or /friends
        
        //if id not found, get all users
        if ($user_id == NULL) {
            $data = $this->user_model->get_all();
        } elseif (!is_numeric($user_id)) {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            //if resource not found, just get user info
            if ($resource == 'clubs') {
                $data = $this->user_model->getClubs($user_id);
            } elseif ($resource == 'friends') {
                $data = $this->user_model->getFriends($user_id);
            } else {
                $data = $this->user_model->get($user_id);
            }
        }
        
        if($data) {
            $this->response($data, REST_Controller::HTTP_OK); // 200 being the HTTP response code
        } else {
            $this->response(NULL, REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    //insert new record
    function index_post()    {
        $user_id    = $this->uri->segment(3, NULL);   // BASE_URL/api/user/id
        $resource   = $this->uri->segment(4, NULL);   // BASE_URL/api/user/id/clubs or /friends
        
        //if id is null, its a new user
        if ($user_id == NULL) {
            $result = $this->user_model->insert(array(
                'user_login'        => $this->post('user_login'),
                'user_display_name' => $this->post('user_display_name')
            ));
        } elseif (!is_numeric($user_id)) {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            //otherwise include resource accordingly
            if ($resource == 'clubs') {
                $club_id = $this->post('club_id');
                $result = $this->user_model->addClub($user_id,$club_id); 
            } elseif ($resource == 'friends') {
                $friend_user_id = $this->post('friend_user_id');
                $result = $this->user_model->addFriend($user_id,$friend_user_id); 
            } else {
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
            }
        }
        
        if($result === FALSE)        {
            $this->response(array('status' => 'failed'), REST_Controller::HTTP_OK);
        } else {
            $this->response(array('status' => 'success'), REST_Controller::HTTP_OK);
        }
    }
    
    //update record
    function index_put() {
        $result = $this->user_model->update($this->put('id'), array(
            'user_login'        => $this->put('user_login'),
            'user_display_name' => $this->put('user_display_name')
        ));
        
        if($result === FALSE)        {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
    
    //delete relations (not user for now)
    function index_delete($user_id) {
        $user_id  = $this->uri->segment(3, NULL); // BASE_URL/api/user/id
        $resource = $this->uri->segment(4, NULL); // BASE_URL/api/user/id/clubs or /friends
        $elem_id  = $this->uri->segment(5, NULL); // BASE_URL/api/user/id/clubs or /friends /id 
        $command  = $this->uri->segment(6, NULL); // BASE_URL/api/user/id/clubs or /friends /delete (just to confirm)
        
        //if id is null, its a new user
        if ($user_id == NULL || !is_numeric($user_id)) {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            //otherwise include resource accordingly
            if ($resource == 'clubs' && $command = 'delete') {
                $club_id = $elem_id;
                $result = $this->user_model->removeClub($user_id,$club_id); 
            } elseif ($resource == 'friends' && $command = 'delete') {
                $friend_user_id = $elem_id;
                $result = $this->user_model->removeFriend($user_id,$friend_user_id); 
            } else {
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
            }
        }
        //$this->response($result, REST_Controller::HTTP_OK);
        if($result === FALSE)        {
            $this->response(array('status' => 'failed'), REST_Controller::HTTP_OK);
        } else {
            $this->response(array('status' => 'success'), REST_Controller::HTTP_OK);
        }
    }
}
