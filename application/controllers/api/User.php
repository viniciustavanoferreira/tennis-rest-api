<?php
require(APPPATH.'/libraries/REST_Controller.php');
 
class User extends REST_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    //clubs 
    //users can list or enlist clubs
    function index_clubs_get() {
        if($this->get('id'))        {
            $clubs_list = $this->user_model->getClubs($this->get('id'));
        } 

        var_export($clubs_list);

        //if($clubs_list)        {
        //    $this->response($clubs_list, 200); // 200 being the HTTP response code
        //} else    {
        //    $this->response(NULL, 404);
        //}
    }
    //function club_post(){
        //
    //}

    //get record
    function index_get($id = NULL)     {
        if(!$id)        {
            $user = $this->user_model->get_all();
        } else {
            $user = $this->user_model->get($id);
        }
 
        if($user)        {
            $this->response($user, 200); // 200 being the HTTP response code
        } else    {
            $this->response(NULL, 404);
        }
    }
     
    //insert new reccord
    function index_post()    {
        $result = $this->user_model->insert(array(
            'user_login'        => $this->post('user_login'),
            'user_display_name' => $this->post('user_display_name')
        ));

        if($result === FALSE)        {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }

    //update record
    function index_put() {
        //TODO: for testing purpposes
        //$this->response($this->post());

        //$result = $this->user_model->update($user_id, array(
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

}
