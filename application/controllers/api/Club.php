<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Club extends REST_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('club_model');
    }
    
    //get users list
    function users() {
        if($this->get('id')) {
            $users = $this->club_model->getUsers($this->get('id'));
        } 
        
        if($users)        {
            $this->response($users, 200); // 200 being the HTTP response code
        } else    {
            $this->response(NULL, 404);
        }
    }
    
    //get court list
    function courts() {
        if($this->get('id')) {
            $courts = $this->club_model->getCourts($this->get('id'));
        } 
        
        if($courts)        {
            $this->response($courts, 200); // 200 being the HTTP response code
        } else    {
            $this->response(NULL, 404);
        }
    }
    
    //get single record
    function index_get()     {
        //if not specified, get the entire table
        if(!$this->get('id')) {
            $club = $this->club_model->get_all();
        } else {
            $club = $this->club_model->get($this->get('id') );
        }
        
        if($club)        {
            $this->response($club, 200); // 200 being the HTTP response code
        } else    {
            $this->response(NULL, 404);
        }
    }
    
    //insert new reccord
    function index_post()    {
        $result = $this->club_model->insert(array(
            'club_name'         => $this->post('club_name'),
            'club_address'      => $this->post('club_address')
        ));
        
        if($result === FALSE)        {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
    
    //update record
    function index_put() {
        $result = $this->club_model->update($this->put('id'), array(
            'club_name'         => $this->put('club_name'),
            'club_address'      => $this->put('club_address')
        ));
        
        if($result === FALSE)        {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
    
    //delete record
    //cannot send body, just set the parameter
    function index_delete($id) {
        //TODO: continuar a partir daqui, pegar a base do controller User
        $result = $this->club_model->delete($id);
        
        if($result === FALSE)        {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
    
}
