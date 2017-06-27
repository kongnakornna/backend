<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Keys extends REST_Controller{

    public function __construct() {
                parent::__construct();
                $this->load->model('Model_keys');
    } 
	public function index()
	{
		$this->load->helper('url');
       echo 'API KEY';
	}

	function testconnect_get(){
		$id = $this->session->userdata('id');
		$id = $this->session->userdata('apikey');
		var_dump($id);
		echo $id == false;
		// echo 'Total Results: ' . $query->num_rows();
	}

	function get_get(){
		echo 123;
	}
//data_get
	public function all_get(){
	// respond with information about a user
		#  /api/keys/all/?format=html
		#  /api/keys/all/?format=xml
		#  /api/keys/all/?format=json
		$order_by='desc';
		$limit='100';
		$lang='th';
		$data = $this->Model_keys->list_all_data();
		if($data){
			    $count=count($data);
			    $this->set_response([
	            	'code' => 200,
	                'status' => TRUE,
	                'error' => 'REST Done',
	                'remarks' => 'API REST  OK',
	                'count' => $count,
	                'data' => $data,
	            ],REST_Controller::HTTP_OK); 
			}else{
	            $this->set_response([
	            	'code' => 404,
	                'status' => FALSE,
	                'error' => 'Record could not be found',
	                'remarks' => 'Record could not be found',
	            ], REST_Controller::HTTP_NOT_FOUND); 
	        }
	}
		
}