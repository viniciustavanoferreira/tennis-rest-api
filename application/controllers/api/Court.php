<?php
require(APPPATH.'/libraries/REST_Controller.php');
 
class Court extends REST_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('court_model');
    }

    //get singke record
    function index_get()     {
        //if not specified, get the entire table
        if(!$this->get('id')) {
            $court = $this->court_model->get_all();
        } else {
            $court = $this->court_model->get($this->get('id') );
        }
    
        if($court)        {
            $this->response($court, 200); // 200 being the HTTP response code
        } else    {
            $this->response(NULL, 404);
        }
    }

    //insert new reccord
    function index_post()    {
        $result = $this->court_model->insert(array(
            'court_club_id'     => $this->post('court_club_id'), 
            'court_name'        => $this->post('court_name'),
            'court_address'     => $this->post('court_address')
        ));

        if($result === FALSE)        {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }

    //update record
    function index_put() {
        $result = $this->court_model->update($this->put('id'), array(
            'court_name'         => $this->put('court_name'),
            'court_address'      => $this->put('court_address')
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
        $result = $this->court_model->delete($id);
         
        if($result === FALSE)        {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }

}
